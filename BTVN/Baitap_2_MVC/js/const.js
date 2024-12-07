var authentication_method = "admin";
var sync_type = 'receipt';//order, receipt

var file_config = {
    reader_avatar: {
        ref_type: "blib_reader_avatar",
        folder_code: "blib_reader_avatar",
    },
    dl_bib_avatar: {
        ref_type: "blib_dl_bib_avatar",
        folder_code: "blib_dl_bib_avatar",
    },
    blib_file_digital: {
        ref_type: "blib_file_digital",
        folder_code: "blib_file_digital"
    }, 
    ck_finder: {
        ref_type: "ck_finder",
        folder_code: "ck_finder",
    },
    cip_image: {
        ref_type: "cip_images",
        folder_code: "cip_images",
    },
    cip_file: {
        ref_type: "cip_files",
        folder_code: "cip_files"
    }, 
};

var perm_config = {
    role_menu: {
        class_code: "Menu",
        sid_code: "role",
    },
    group_menu: {
        class_code: "Menu",
        sid_code: "group",
    },
    role_ctdt: {
        class_code: "CTDT",
        sid_code: "role",
    },
    group_ctdt: {
        class_code: "CTDT",
        sid_code: "group",
    },
};

//var root_url_web = "http://ucvn.vn:8089/";
var root_url_web = "http://localhost:5096/";

var base_url_signalr = root_url_web + "signalr/";

var socket_client_key = "ucvn";

var ckfinder_upload_url =
    "http://ucvn.vn:5530/Services/Core/Fms_File/ck-upload?refType=" +
    file_config.ck_finder.ref_type +
    "&folderCode=" +
    file_config.ck_finder.folder_code;

var select2_config = {
    minimumResultsForSearch: -1,
    placeholder: "",
    allowClear: true
};
var select2_config_search = function (code) {
    return {
        dropdownParent: $(code).parent(),
        placeholder: "",
        allowClear: true
    }
}