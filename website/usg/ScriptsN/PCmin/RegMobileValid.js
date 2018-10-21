var States = function () {
    return {
        'Error': 'Error',
        'Sucess': 'Sucess',
        'Check': 'Check'
    }
}();

var Func = function () {
    return {
        'PostPhoneNum': 1
    }
}


var ConfirmBox = function () {
    this.Container = "ConfirmBox";
    this.Messages = "";
    this.Title = States.Check;
    this.GetValidCodeAction = "";
    this.ClearDataAction = "";
    this.DigitsImgUrl = "";

    this.PhoneNum = "";
    this.RID = "";
    this.Country = "";
    this.ValidCode = "";

    this.ValidCodeExpiredStr = "";
    this.MobileCodeErrorStr = "";
}

ConfirmBox.prototype.Show = function (_Title, _Messages, _FuncObj) {
    if (typeof _Title != "undefined" && _Title != "" && _Title != null) {
        this.Title = _Title;
    }

    if (typeof _Messages != "undefined" && _Messages != "" && _Messages != null) {
        this.Messages = _Messages;
    }

    $('html').append("<div id='" + this.Container + "'></div>");
    $MainContainer = $("#" + this.Container);
    $MainContainer.append(this.Messages);

    //-------------------------------------------------
    var PhoneNum = this.PhoneNum.trim();
    var Country = this.Country.trim();
    var ValidCodeExpiredStr = this.ValidCodeExpiredStr.trim();
    var MobileCodeErrorStr = this.MobileCodeErrorStr.trim();
    var RID = this.RID.trim();
    //-------------------------------------------------

    if (PhoneNum != "") {
        if (RID != "") {
            $MainContainer.dialog({
                title: this.Title,
                draggable: false,
                modal: true,
                closeOnEscape: false,
                open: function (event, ui) { $(".ui-dialog-titlebar-close").hide(); },
                show: {
                    effect: "blind",
                    duration: 500
                },
                hide: {
                    effect: "explode",
                    duration: 500
                },
                buttons: {
                    Ok: function () {
                        $.ajax({
                            type: "Post",
                            url: "../../ValidCode/GetCelValidCodeForReg",
                            cache: false,
                            data: { CusPhoneNum: PhoneNum, CusCountry: Country, RID: RID },
                            dataType: "json",
                            success: function (data, status, xhr) {
                                if (data.State != "Error" && data.State != "NumError") {
                                    $(".digits").countdown({
                                        stepTime: 60,
                                        format: 'mm:ss',
                                        startTime: data.StartTime,
                                        timerEnd: function () {
                                            $.post("../../ValidCode/ClearData").always(function () {
                                                $("#GetVerCodeBtn").prop("disabled", false);
                                                $("#VerifyBtn").prop("disabled", true);
                                                $(".digits").empty();
                                                alert(ValidCodeExpiredStr);
                                            });
                                        },
                                        image: "../../../ImagesN/digits.png"
                                    });

                                    $("#GetVerCodeBtn").prop("disabled", true);
                                    $("#VerifyBtn").prop("disabled", false);
                                }
                                else {
                                    $("#GetVerCodeBtn").prop("disabled", false);
                                    $("#VerifyBtn").prop("disabled", true);

                                    switch (data.State) {
                                        case "NumError":
                                            alert(MobileCodeErrorStr);
                                            break;
                                        default:
                                            alert("SMS Error");
                                            break;
                                    }
                                }
                            },
                            error: function (xhr, status, errorThrown) {
                                $("#GetVerCodeBtn").prop("disabled", false);
                                $("#VerifyBtn").prop("disabled", true);

                                alert("Error");
                            }
                        });

                        $(this).dialog("close");
                        $MainContainer.remove();
                    },
                    Cancel: function () {
                        $(this).dialog("close");
                        $MainContainer.remove();
                    }
                }
            });
        }
        else {
            alert("The RID is incorrect.");
        }
    }
    else {
        alert("The phone number is incorrect.");
    }
}

ConfirmBox.prototype.CheckValidCode = function () {
    $.ajax({
        type: "Post",
        url: "../../ValidCode/CheckValidCode",
        cache: false,
        data: { RID: this.RID, ValidCode: this.ValidCode, CusPhoneNum: this.PhoneNum },
        dataType: "json",
        success: function (data, status, xhr) {
            if (data.RetVal != false) {
                $("#GetVerCodeBtn").prop("disabled", true);
                $("#NextBtn").prop("disabled", false);
                $(".digits").empty().append("<img src='../../../ImagesN/Pass.png'>");
                $(".ValidBlock").hide();

                $("#MobileVaild").val(true);
            }
            else {
                alert("Please Enter The Correct Code！");
            }
        },
        error: function (xhr, status, errorThrown) {
            alert("Error");
        }
    });
}

ConfirmBox.prototype.SetMsg = function (_Messages) {
    this.Messages = _Messages;
}

ConfirmBox.prototype.SetBoxTitle = function (_Title) {
    this.Title = _Title;
}

ConfirmBox.prototype.SetCheckDataDefMsg = function (PhoneNumer) {
    this.Messages = "<p>Please Check Your Registry Infomation！</p><br />" +
                    "<p>Phone Number: </p><p><b>" + PhoneNumer + "</b></p><br />" +
                    "<p style='color:red'>* Please click the 'OK' button to continue. We will send message to your mobile phone after the dialog has closed.</p>";
}

ConfirmBox.prototype.SetPhoneNum = function (_PhoneNum) {
    this.PhoneNum = _PhoneNum;
}

ConfirmBox.prototype.SetCountry = function (_Country) {
    this.Country = _Country;
}

ConfirmBox.prototype.SetValidCode = function (_ValidCode) {
    this.ValidCode = _ValidCode;
}

ConfirmBox.prototype.SetRID = function (_RID) {
    this.RID = _RID;
}


//Messsages

ConfirmBox.prototype.SetValidCodeExpiredStr = function (_ValidCodeExpiredStr) {
    this.ValidCodeExpiredStr = _ValidCodeExpiredStr;
}

ConfirmBox.prototype.SetMobileCodeErrorStr = function (_MobileCodeErrorStr) {
    this.MobileCodeErrorStr = _MobileCodeErrorStr;
}