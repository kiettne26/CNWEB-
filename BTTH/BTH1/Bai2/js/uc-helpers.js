var UcHelpers = function () {
    function GetLangueResource(url) {
        $.ajax({
            type: "GET",
            contentType: "application/json",
            dataType: "json",
            url: url,
            headers: { "Authorization": "Bearer " + new UcHelpers().GetAccessToken() },
            success: function (res) {
                localStorage.setItem('UcLang', JSON.stringify(res));
            },
            error: function () {

            }
        });
    }
    function GetUserInfo() {
        return localStorage.getItem('UcUserInfo');
    }
    function GetAccessToken() {
        let userInfo = JSON.parse(localStorage.getItem('UcUserInfo'));
        if (userInfo) {
            return userInfo.accessToken;
        }
        return '';
    }
    function GetUserId() {
        let userInfo = JSON.parse(localStorage.getItem('UcUserInfo'));
        if (userInfo) {
            return userInfo.userId;
        }
        return '';
    }
    function GetUserName() {
        let userInfo = JSON.parse(localStorage.getItem('UcUserInfo'));
        if (userInfo) {
            return userInfo.userName;
        }
        return '';
    }
    function SetUserInfo(data) {
        localStorage.setItem('UcUserInfo', JSON.stringify(data));
    }
    function SetLang(data) {
        localStorage.setItem('UcLang', data);
    }
    function TruncateString(str, num) {
        if (str) {
            if (str.length > num) {
                return str.slice(0, num) + "...";
            } else {
                return str;
            }
        }
        else {
            return str;
        }
    }
    function NumberToMoney(num) {
        return parseInt(num).toLocaleString('vi', { style: 'currency', currency: 'VND' });
    }
    return {
        GetLangueResource,
        GetUserInfo,
        SetUserInfo,
        SetLang,
        GetUserId,
        GetUserName,
        GetAccessToken,
        TruncateString,
        NumberToMoney
    };
}