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

class GroupService {
    constructor(base_url_core, jsonConfig, ajaxHelper) {
        this.base_url_core = base_url_core;
        this.jsonConfig = jsonConfig;
        this.ajaxHelper = ajaxHelper;
    }

    ExtendData(oValue) {
        oValue.id = oValue.id || Uuid().Uuidv4();
        oValue.code = oValue.code || "";
        oValue.name = oValue.name || "";
        return oValue;
    }

    GetGroupList() {
        this.ajaxHelper
            .request(this.base_url_core + "Ums_Group/get-items", "GET")
            .done((response) => {
                if (response.success) {
                    UcFormHelpers().DataTableAjaxClientSide(
                        "#tbl_search",
                        this.jsonConfig.columns,
                        response.data || [],
                        {
                            autoWidth: false,
                        }
                    );
                }
            })
            .catch((error) => {
                console.error(error);
            });
    }

    InsertGroup(oValue) {
        this.ajaxHelper
            .request(
                this.base_url_core + "Ums_Group/insert-item",
                "POST",
                oValue
            )
            .then((response) => {
                if (response.success) {
                    Toast().ShowToastSuccess("Thêm thành công!");
                    this.GetGroupList();
                    this.RefreshForm();
                } else {
                    Toast().ShowToastError(response.message);
                }
            })
            .catch((error) => {
                console.error(error);
            });
    }

    UpdateGroup(oValue) {
        this.ajaxHelper
            .request(
                this.base_url_core + "Ums_Group/update-item",
                "PUT",
                oValue
            )
            .then((response) => {
                if (response.success) {
                    Toast().ShowToastSuccess("Cập nhật thành công!");
                    this.GetGroupList();
                } else {
                    Toast().ShowToastError(response.message);
                }
            })
            .catch((error) => {
                console.error(error);
            });
    }

    GetItemById(id) {
        this.ajaxHelper
            .request(
                this.base_url_core + "Ums_Group/get-item-by-id/" + id,
                "GET"
            )
            .then((response) => {
                if (response.success && response.data) {
                    UcFormHelpers().SetFormValues(
                        "add_new_group",
                        response.data
                    );
                } else {
                    Toast().ShowToastError(response.message);
                }
            })
            .catch((error) => {
                console.error(error);
            });
    }

    DeleteGroup(id) {
        this.ajaxHelper
            .request(
                this.base_url_core + "Ums_Group/delete-item/" + id,
                "DELETE"
            )
            .then((response) => {
                if (response.success) {
                    Toast().ShowToastSuccess("Xóa thành công!");
                    this.GetGroupList();
                } else {
                    Toast().ShowToastError(response.message);
                }
            })
            .catch((error) => {
                console.error(error);
            });
    }

    RefreshForm() {
        UcFormHelpers().RefreshFormValues("add_new_group");
        $(".add_new_group input").eq(0).focus();
    }

    setupEventHandlers() {
        const self = this;

        $("#btn-add").on("click", () => {
            this.RefreshForm();
            $("#hd_key").val("");
            $("#DetailLabel").text("Thêm nhóm quyền");
        });

        $("#modalAddNewGroup").on("shown.bs.modal", () => {
            $(".add_new_group input").eq(0).focus();
        });

        $("#btn-refresh").on("click", () => {
            this.RefreshForm();
            $(".add_new_group input").eq(0).focus();
        });

        $("#btn-save").on("click", () => {
            var oForm = UcFormHelpers().GetFormValues("add_new_group");
            if (!oForm) return;
            var oValue = UcFormHelpers().FormFieldsToObject(oForm);
            oValue = this.ExtendData(oValue);
            var id = $("#hd_key").val();

            if (!id) {
                this.InsertGroup(oValue);
            } else {
                oValue.id = id;
                this.UpdateGroup(oValue);
            }
        });

        $(document).on("click", "#tbl_search tbody .action-edit", function () {
            self.RefreshForm();
            $("#DetailLabel").text("Sửa nhóm quyền");
            var id = $(this).data("id");
            $("#hd_key").val(id);
            self.GetItemById(id);
        });

        $(document).on(
            "click",
            "#tbl_search tbody .action-delete",
            function () {
                var id = $(this).data("id");
                Notification().Confirm(
                    "Bạn có muốn xóa nhóm quyền này không?",
                    function () {
                        self.DeleteGroup(id);
                    },
                    null
                );
            }
        );

        $(document).on(
            "click",
            "#tbl_search tbody .action-assign",
            function () {
                var tr = $(this).closest("tr");
                var groupName = $("td.name", tr).text();
                var groupId = $(this).data("id");
                window.location.href = `${locationVal}/Group/AssignUsers?group_id=${groupId}&group_name=${groupName}`;
            }
        );
    }
}

class Main {
    constructor(base_url_core) {
        this.ajaxHelper = new AjaxHelper();
        this.groupService = new GroupService(
            base_url_core,
            null,
            this.ajaxHelper
        );
    }

    async init() {
        const groupJsonConfig = await Config().FormSearchList(
            "Ums/Group/index.json"
        );
        this.groupService.jsonConfig = groupJsonConfig;
        this.groupService.GetGroupList();
        this.groupService.setupEventHandlers();
    }
}

$(document).ready(function () {
    const main = new Main(base_url_core);
    main.init();
});
