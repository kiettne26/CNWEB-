class AjaxHelper {
    constructor() {
        $.ajaxSetup({
            headers: {
                Authorization: "Bearer " + new UcHelpers().GetAccessToken(),
            },
            beforeSend: () => openLoader(),
            error: (jqXHR, textStatus, errorThrown) =>
                this.handleAjaxError(jqXHR, textStatus, errorThrown),
            complete: () => closeLoader(),
        });
    }

    request(url, method, data = null) {
        return $.ajax({
            url: url,
            type: method,
            contentType: "application/json",
            dataType: "json",
            data: data ? JSON.stringify(data) : undefined,
        });
    }

    handleAjaxError(jqXHR, textStatus, errorThrown) {
        let errorMessage = "Đã xảy ra lỗi bất ngờ. Vui lòng thử lại sau.";

        if (jqXHR.responseText) {
            try {
                let error = JSON.parse(jqXHR.responseText);
                errorMessage = error.message || "Đã xảy ra lỗi trên máy chủ.";
            } catch (e) {
                errorMessage = jqXHR.responseText;
                console.log("Lỗi phân tích JSON:", e);
            }
        } else if (textStatus === "timeout") {
            errorMessage =
                "Yêu cầu đã hết thời gian chờ. Vui lòng kiểm tra kết nối internet và thử lại.";
        } else if (textStatus === "abort") {
            errorMessage = "Yêu cầu đã bị hủy. Vui lòng thử lại.";
        } else if (jqXHR.status === 0) {
            errorMessage =
                "Lỗi kết nối mạng. Vui lòng kiểm tra kết nối internet của bạn.";
        } else if (jqXHR.status === 404) {
            errorMessage = "Không tìm thấy tài nguyên được yêu cầu (404).";
        } else if (jqXHR.status === 500) {
            errorMessage = "Lỗi máy chủ (500). Vui lòng thử lại sau.";
        } else if (jqXHR.status === 502) {
            errorMessage =
                "Lỗi gateway (502). Máy chủ đang gặp sự cố. Vui lòng thử lại sau.";
        }

        Toast().ShowToastError(errorMessage);
        console.log("Phản hồi:", jqXHR.responseText);
        console.log("Trạng thái:", textStatus);
        console.log("Lỗi:", errorThrown);
        console.log("Mã trạng thái:", jqXHR.status);
    }
}

class UserService {
    constructor(base_url_core, jsonConfig, assignUserService, ajaxHelper) {
        this.base_url_core = base_url_core;
        this.jsonConfig = jsonConfig;
        this.is_loaded = false;
        this.assignUserService = assignUserService;
        this.ajaxHelper = ajaxHelper;
    }

    getUsers(oSearch) {
        this.ajaxHelper
            .request(
                this.base_url_core + "Ums_User/search-user-internal",
                "POST",
                oSearch
            )
            .then((response) => {
                if (response.success) {
                    UcFormHelpers().DataTableAjaxClientSide(
                        "#tbl_users",
                        this.jsonConfig.columns,
                        response.data || [],
                        {
                            autoWidth: false,
                            rowCallback: (row, data) => {
                                var statusCheckbox = this.getActiveCheckbox(
                                    data.is_active
                                );
                                $("td.is-active", row).html(statusCheckbox);
                                var sex = data.sex ? "Nam" : "Nữ";
                                $("td.sex", row).text(sex);
                            },
                        }
                    );
                    this.updateUserTable();
                }
            })
            .catch((error) => {
                console.error(error);
            });
    }

    getActiveCheckbox(status) {
        var checkbox = '<label class="custom_check me-1 c-pointer">';
        if (status) {
            checkbox += '<input type="checkbox" checked disabled>';
        } else {
            checkbox += '<input type="checkbox" disabled>';
        }
        checkbox += '<span class="checkmark"></span>';
        checkbox += "</label>";
        return checkbox;
    }

    updateUserTable() {
        const self = this;
        var node, checkbox;
        $("#tbl_users")
            .DataTable()
            .rows({ pages: "current" })
            .iterator("row", function (context, index) {
                node = $(this.row(index).node());
                checkbox = node.find("td.checkbox input");
                if (
                    self.assignUserService.assginedUserIds.includes(
                        checkbox.data("id")
                    )
                ) {
                    node.addClass("disabled-row");
                    checkbox.prop("checked", false);
                    checkbox.addClass("is-disabled");
                } else {
                    node.removeClass("disabled-row");
                    checkbox.removeClass("is-disabled");
                }
            });
    }

    setupEventHandlers() {
        const self = this;

        $(document).on(
            "click",
            "#tbl_search tbody .action-assign",
            function () {
                var groupId = $(this).data("id");
                $("#hd_group_id").val(groupId);

                var oSearch = {
                    fields: [
                        {
                            code: "string",
                            value: "string",
                        },
                    ],
                };

                if (!self.is_loaded) {
                    self.getUsers(oSearch);
                    self.is_loaded = true;
                }
            }
        );

        $("#tbl_users").on("change", ".check_all_item", function () {
            $("#tbl_users")
                .DataTable()
                .rows((idx, data, node) => {
                    const $input = $(node).find("input:not(.is-disabled)");
                    if ($input.length > 0) {
                        var checked = $(this).prop("checked");
                        $input.prop("checked", checked);
                    }
                });
        });

        $("#btn-assign").click(() => {
            var selectedUsers = [];
            $("#tbl_users")
                .DataTable()
                .rows()
                .every(function () {
                    var row = $(this.node());
                    var checkbox = row.find("td.checkbox input");
                    if (checkbox.is(":checked")) {
                        var newUser = {
                            id: checkbox.data("id"),
                            user_name: $("td.user_name", row).text(),
                            full_name: $("td.full_name", row).text(),
                        };
                        selectedUsers.push(newUser);
                        self.assignUserService.assginedUserIds.push(
                            checkbox.data("id")
                        );
                    }
                });

            if (selectedUsers.length == 0) {
                Toast().ShowToastWarning(
                    "Vui lòng chọn người dùng để gắn vào nhóm quyền!"
                );
                return;
            }

            this.assignUserService.assginedUsers = [
                ...this.assignUserService.assginedUsers,
                ...selectedUsers,
            ];

            UcFormHelpers().DataTableAjaxClientSide(
                "#tbl_assigned_users",
                this.assignUserService.jsonConfig.columns,
                this.assignUserService.assginedUsers,
                {
                    autoWidth: false,
                }
            );

            Toast().ShowToastSuccess("Thêm thành công!");
            $("#modalAssignUsers").modal("hide");
        });

        $("#tbl_users").on("draw.dt", () => {
            this.updateUserTable();
        });

        $(document).on("click", "#tbl_users tbody td", function () {
            var row = $(this).closest("tr");
            var checkbox = row.find("td.checkbox input");
            if (checkbox.hasClass("is-disabled")) return;
            checkbox.prop("checked", !checkbox.prop("checked"));
        });
    }
}

class AssignUserService {
    constructor(base_url_core, jsonConfig, userService, ajaxHelper) {
        this.base_url_core = base_url_core;
        this.jsonConfig = jsonConfig;
        this.userService = userService;
        this.ajaxHelper = ajaxHelper;
        this.assginedUserIds = [];
        this.assginedUsers = [];
    }

    getAssignedUsers(groupId) {
        return this.ajaxHelper.request(
            this.base_url_core + "Ums_Group/get-group/" + groupId + "/users",
            "GET"
        );
    }

    assignUsersIntoGroup(groupId, users) {
        this.ajaxHelper
            .request(
                this.base_url_core +
                    "Ums_Group/save-group/" +
                    groupId +
                    "/users",
                "POST",
                users
            )
            .then((response) => {
                if (response.success) {
                    Toast().ShowToastSuccess(response.message);
                } else {
                    Toast().ShowToastError(response.message);
                }
            })
            .catch((error) => {
                console.error(error);
            });
    }

    setupEventHandlers() {
        const self = this;
        $(document).on(
            "click",
            "#tbl_assigned_users tbody .action-delete",
            function () {
                var id = $(this).data("id");
                self.assginedUserIds = self.assginedUserIds.filter(
                    (item) => item !== id.toString()
                );
                self.assginedUsers = self.assginedUsers.filter(
                    (item) => item.id !== id.toString()
                );
                UcFormHelpers().DataTableAjaxClientSide(
                    "#tbl_assigned_users",
                    self.jsonConfig.columns,
                    self.assginedUsers,
                    {
                        autoWidth: false,
                    }
                );
            }
        );
    }
}

class Main {
    constructor(base_url_core, groupId, groupName) {
        this.ajaxHelper = new AjaxHelper();
        this.assignUserService = new AssignUserService(
            base_url_core,
            null,
            null,
            this.ajaxHelper
        );
        this.userService = new UserService(
            base_url_core,
            null,
            null,
            this.ajaxHelper
        );
        this.groupId = groupId;
        this.groupName = groupName;
    }

    async init() {
        const userJsonConfig = await Config().FormSearchList(
            "Ums/Group/user.json"
        );

        const assignUserJsonConfig = await Config().FormSearchList(
            "Ums/Group/assigned_user.json"
        );

        this.userService.jsonConfig = userJsonConfig;
        this.userService.assignUserService = this.assignUserService;

        this.assignUserService.jsonConfig = assignUserJsonConfig;
        this.assignUserService.userService = this.userService;
        this.assignUserService
            .getAssignedUsers(this.groupId)
            .then((response) => {
                if (response.success) {
                    this.assignUserService.assginedUserIds = response.data.map(
                        (item) => item.id
                    );
                    this.assignUserService.assginedUsers = response.data.map(
                        ({ id, user_name, full_name }) => ({
                            id,
                            user_name,
                            full_name,
                        })
                    );
                    UcFormHelpers().DataTableAjaxClientSide(
                        "#tbl_assigned_users",
                        this.assignUserService.jsonConfig.columns,
                        response.data || [],
                        {
                            autoWidth: false,
                        }
                    );
                } else {
                    Toast().ShowToastError(response.message);
                }
            });
        this.userService.setupEventHandlers();
        this.assignUserService.setupEventHandlers();
        this.setupPage();
    }

    setupPage() {
        $("#group-name").text(this.groupName);

        $("#btn-go-back").click(() => {
            window.history.back();
        });

        $("#btn-add").click(() => {
            var oSearch = {
                fields: [
                    {
                        code: "string",
                        value: "string",
                    },
                ],
            };

            if (!this.userService.is_loaded) {
                this.userService.getUsers(oSearch);
                this.userService.is_loaded = true;
            } else {
                this.userService.updateUserTable();
            }
        });

        $("#btn-save").click(() => {
            var userIds = [];
            this.assignUserService.assginedUserIds.forEach((userId) => {
                var value = {
                    userId: userId,
                };
                userIds.push(value);
            });
            this.assignUserService.assignUsersIntoGroup(this.groupId, userIds);
        });
    }
}

$(document).ready(function () {
    const params = new URLSearchParams(window.location.search);
    const groupId = params.get("group_id");
    const groupName = params.get("group_name");
    const main = new Main(base_url_core, groupId, groupName);
    main.init();
});
