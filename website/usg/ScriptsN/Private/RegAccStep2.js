//ENUM
var EnumAccClass = function () {
    return {
        "Person": "person",
        "Jointly": "jointly",
        "Company": "company",
        "All": "all", //For: ShowAccClassBtn_F
        "None": "none" //For: ShowAccClassBtn_F
    }
}();
var EnumAccSize = function () {
    return {
        "Mini": "mini",
        "Cent": "centaccount",
        "Islamic": "islamicaccount",
        "Stand": "Standard",
        "VIP": "vipaccount",
        "Platinum": "Platinum",
        "Agency": "agencyaccount",
        "ECN": "ecn",
        "Special": "special"
    }
}();
var ActionURL = function () {

    var _Path = "../RegAcc/";

    return {
        "Person": _Path + "PersonForm",
        "Jointly": _Path + "JointlyForm",
        "Company": _Path + "CompanyForm",
        "SpecialAccount": _Path + "GetSpecialAccount"
    }
}();

//Public Function
function GetFormByAccClassStr(AccClassStr) {

    var FormUrl = "";

    switch (AccClassStr) {
        case EnumAccClass.Person:
            FormUrl = ActionURL.Person;
            break;
        case EnumAccClass.Jointly:
            FormUrl = ActionURL.Jointly;
            break;
        case EnumAccClass.Company:
            FormUrl = ActionURL.Company;
            break;
    }

    if (FormUrl != "") {
        if (AccClassStr != "") {
            $('#FormArea').empty();
            $(".BtnSubmit").prop("disabled", true);
            $('#FormArea').append("<div style='text-align:center; clear:both'><hr /><img src='../ImagesN/Loding.GIF' /><div>Loading...</div><hr /></div>");

            $.ajax({
                url: FormUrl,
                data: { IsECN: $("#IsECN").val() },
                dataType: "html",
                async: true,
                success: function (data) {
                    if (MobileAuthenticate == "True" && MobileVaild != "True") {
                        $(".BtnSubmit").prop("disabled", true);
                    }
                    else {
                        $(".BtnSubmit").prop("disabled", false);
                    }

                    $('#FormArea').empty();
                    $('#FormArea').html(data);

                    $("#RegForm").removeData('validator');
                    $("#RegForm").removeData('unobtrusiveValidation');
                    $.validator.unobtrusive.parse($("#RegForm"));
                }
            });
        }
        else {
            alert("Error-AccSizeIsNullorEmpty");
            return false;
        }
    }
    else {
        alert("Error-GetURLError");
        return false;
    }
}
function GetSpecialAccountBySpecialCodeStrAndCulture(SpecialCodeStr, CultureStr) {

    if (SpecialCodeStr != "") {
        $.ajax({
            type: "Post",
            url: ActionURL.SpecialAccount,
            cache: false,
            data: { SpecialCode: SpecialCodeStr, Lang: CultureStr },
            dataType: "json",
            success: function (data, status, xhr) {
                if (data.ResVal == "OK") {
                    switch (data.AccountValue) {
                        case EnumAccSize.Islamic:
                            $(".BtnAccClassArea").hide();
                            GetFormByAccClassStr(EnumAccClass.Person);
                            IsIslamic_F();
                            break;
                        case EnumAccSize.Agency:
                            $(".BtnAccClassArea").show();
                            IsAgency_F();
                            IsAgencyExtra_F();
                            break;
                    }
                    $("#AccSize").val(data.AccountValue);
                }
                else {
                    ShowAccClassBtn_F(EnumAccClass.None, true);
                }
            },
            error: function (xhr, status, errorThrown) {
                alert(data.status);
            }
        });
    }
    else {
        ShowAccClassBtn_F(EnumAccClass.None, true);
    }
}
function IsIslamic_F() {
    SetAccSizeVal_F(EnumAccSize.Islamic, true);
    $("#MT4Currency").val("");
    $("input:radio[name=UDF]").removeAttr('checked');
    $(".Rate").show();
}
function IsAgency_F() {
    $(".NoAgc").hide();
    ShowAccClassBtn_F(EnumAccClass.All, true);
}
function IsAgencyExtra_F() {
    $("#MT4Currency").val("USD");
    $("input:radio[name=UDF]").filter('[value=100]').prop('checked', true);
    ECN_UDF_Show();
}
function IsECN_F() {
    $("input:radio[name=UDF]").filter('[value=100]').prop('checked', true);
    $("#IsECN").val(true);
    ECN_UDF_Show();
}
function ECN_UDF_Show() {
    $(".Rate").hide();
    $(".ECN").show();
}
function ShowAccClassBtn_F(AccClassName, ResetVal) {

    $(".BtnAccClass").removeClass("Usg-AT-Btn-AccSize-Selected");

    switch (AccClassName) {
        case EnumAccClass.Person:
            $("#jointly, #company").hide();
            $("#person").show();
            break;
        case EnumAccClass.Jointly:
            $("#person, #company").hide();
            $("#jointly").show();
            break;
        case EnumAccClass.Company:
            $("#person, #jointly").hide();
            $("#company").show();
            break;
        case EnumAccClass.None:
            $("#person, #jointly, #company").hide();
            break;
        case EnumAccClass.All:
            $("#person, #jointly, #company").show();
            break;
    }

    if (ResetVal) {
        $("input[type=checkbox]").prop("checked", false);
        $("input:radio[name=UDF]").removeAttr('checked');
        $("#AccSize").val(EnumAccSize.Special);
        $("#AccClass, #TxtSpecial, #AuthorityName").val("");
        $("#FormArea").empty();
        $(".BtnSubmit").prop("disabled", true);
        $(".PubArea , .div_Notice , #HThirdParty").hide();
    }

}
function SetAccSizeVal_F(BtnAccSize, ResetVal) {
    switch (BtnAccSize) {

        case EnumAccSize.Mini:
        case EnumAccSize.Cent:
        case EnumAccSize.Islamic:

            $("#AccClass").val(EnumAccClass.Person);
            $("#AccSize").val(BtnAccSize);
            $(".BtnAccClassArea").hide();
            $(".PubArea").show();
            break;

        case EnumAccSize.Stand:
        case EnumAccSize.VIP:
        case EnumAccSize.Platinum:
        case EnumAccSize.Agency:
        case EnumAccSize.ECN:

            ShowAccClassBtn_F(EnumAccClass.All, ResetVal);
            if (BtnAccSize == EnumAccSize.ECN) {
                IsECN_F();
                BtnAccSize = EnumAccSize.VIP;
            }
            if (BtnAccSize == EnumAccSize.Agency) {
                ECN_UDF_Show();
            }
            $("#AccSize").val(BtnAccSize);
            $(".BtnAccClassArea").show();
            break;

        default:

            ShowAccClassBtn_F(EnumAccClass.None, ResetVal);
            $("#AccSize").val(EnumAccSize.Special);
            break;
    }
}

//Page Load Data
if (FinancialFStr != "") {
    if (FinancialFStr == "employed" || FinancialFStr == "self-employed") {
        $(".HJobType").show();
        $(".HJobOtherType").hide();
    }
    else {
        $(".HJobOtherType").show();
        $(".HJobType").hide();
    }
}

if (FinancialSStr != "") {
    if (FinancialSStr == "employed" || FinancialSStr == "self-employed") {
        $(".HJobTypeSec").show();
        $(".HJobOtherTypeSec").hide();
    }
    else {
        $(".HJobOtherTypeSec").show();
        $(".HJobTypeSec").hide();
    }
}

if (GreencardStr == "True") {
    $(".GreenCardExtra").show();
}
else {
    $(".GreenCardExtra").hide();
}

if (SameASCROStr == "True") {
    $(".PPArea").hide();
}
else {
    $(".PPArea").show();
}

$("#MbFirst, #MbSec").val("");

if (IsECN == "True") {
    IsECN_F();
}

if (AccSize == EnumAccSize.Agency) {
    IsAgencyExtra_F();
}

if (IsAuthority == "True") {
    $("#HAuthority").show();
    $('#HThirdParty').show();
}
else {
    $("#HAuthority").hide();
    $('#HThirdParty').hide();
}

if (IsUseEA == "True") {
    $("#HUseEA").show();
}
else {
    $("#HUseEA").hide();
}

var BtnObj = AccSize;

if (AccClass != "") {
    if (SubAccSize == "1" || AccSize == EnumAccSize.Agency) {
        BtnObj = EnumAccSize.Special;
    }

    if (IsECN == "True") {
        BtnObj = EnumAccSize.ECN;
    }

    $(".Btn" + BtnObj).addClass("Usg-AT-Btn-P-selected");

    if (AccSize != "" && AccSize != EnumAccSize.Special) {
        SetAccSizeVal_F(AccSize, false);
    }

    if (AccClass != EnumAccClass.Company) {
        $("#RegForm").removeAttr("onsubmit");
    }
    else {
        $("#RegForm").attr("onsubmit", "return CheckData(this);");
    }

    $("#AccClass").val(AccClass);
    $(".PubArea").show();
    $("#" + AccClass).addClass("Usg-AT-Btn-AccSize-Selected");

    DetectNoticeShow();
}

if (Empcode != "" && IsIBorCoworker == "True") {
    $('input:radio[name="RdoIBCodeMethod"]').filter('[value="True"]').attr('checked', true);
    $('input:radio[name="RdoIBCodeMethod"]').filter('[value="False"]').attr('disabled', 'disabled');
    $("#EnertIBCode").hide();
    $("#Empcode").show();
    $("#Empcode").prop("readonly", "readonly");
}
else {
    $('input:radio[name="RdoIBCodeMethod"]').filter('[value="True"]').attr('checked', true);
    $("#EnertIBCode").hide();
    $("#Empcode").show();
    $("input:radio[id='RdoIBCodeMethod']").on('click', function () {
        if ($(this).val() == "True") {
            $("#EnertIBCode").hide();
            $("#Empcode").show();
            $("#Empcode").focus();
        }
        else {
            $("#EnertIBCode").show();
            $("#Empcode").hide();
            $("#Empcode").val("");
        }
    });
}

//Event
$.validator.unobtrusive.adapters.addBool("mustbetrue", "required");

$("#TxtSpecial").blur(function () {
    GetSpecialAccountBySpecialCodeStrAndCulture($(this).val(), culture);
});

$('.BtnAccSize').click(function () {
    if (!$(this).hasClass("Usg-AT-Btn-P-selected")) {

        $('.BtnAccSize').removeClass("Usg-AT-Btn-P-selected");
        $(this).addClass("Usg-AT-Btn-P-selected");

        ShowAccClassBtn_F(EnumAccClass.None, true);

        $("#MT4Currency").val("");
        $(".BtnAccClass").removeClass("Usg-AT-Btn-AccSize-Selected");

        var BtnAccSize = $(this).attr('data-sizeval');
        if (typeof BtnAccSize != "undefined" && BtnAccSize != "") {

            if (BtnAccSize == EnumAccSize.Special) {
                $("#TxtSpecial").focus();
            }

            switch (BtnAccSize) {
                case EnumAccSize.Special:
                    $("#TxtSpecial").focus();
                    $(".BtnAccClassArea").hide();
                    break;
                case EnumAccSize.Mini:
                case EnumAccSize.Cent:
                    GetFormByAccClassStr(EnumAccClass.Person);
                    DetectNoticeShow();
                    break;
            }

            $(".Rate").show();
            $("#IsECN").val(false);

            SetAccSizeVal_F(BtnAccSize, true);
        }
    }
});

$("#MT4Currency").change(function () {
    if ($("#AccSize").val() == EnumAccSize.Agency) {
        IsAgencyExtra_F();
    }
});

$(".BtnAccClass").click(function () {

    DetectNoticeShow();
    $(".PubArea").show();

    if (!$(this).hasClass("Usg-AT-Btn-AccSize-Selected")) {

        GetFormByAccClassStr($(this).prop("id"));

        $(".BtnAccClass").removeClass("Usg-AT-Btn-AccSize-Selected");
        $(this).addClass("Usg-AT-Btn-AccSize-Selected");

        $("#AccClass").val($(this).prop("id"));

        if ($(this).prop("id") != EnumAccClass.Company) {
            $("#RegForm").removeAttr("onsubmit");
        }
        else {
            $("#RegForm").attr("onsubmit", "return CheckData(this);");
        }
    }
});

$("#RegForm").on("click", ".Quesion", function () {
    $("#Ans" + $(this).attr("data-qa"))
        .toggle("fast")
        .css({
            "font-weight": 900,
            "color": "red"
        });
});

$("#FormArea").on("focus", "#MbFirst, #MbSec", function () {
    $("#MbFirst, #MbSec").datepicker({
        changeYear: true,
        changeMonth: true,
        dateFormat: "yy-mm-dd",
        yearRange: '-100:+0',
        defaultDate: new Date(1970, 00, 01)
    });
});

$("#FormArea").on("change", "input[type=radio][id=Greencard]", function () {
    $("#TaxIdentificationNumber").val("");
    if ($(this).val() == "True") {
        $(".GreenCardExtra").show();
    }
    else {
        $(".GreenCardExtra").hide();
    }
});

$("#FormArea").on("change", ".cboJob,.cboJobSec", function () {
    var SelectorName = ".";
    var SelectorOtherName = ".";

    if ($(this).attr("Otag") == "First") {
        SelectorName += "HJobType";
        SelectorOtherName += "HJobOtherType";
    }
    else {
        SelectorName += "HJobTypeSec";
        SelectorOtherName += "HJobOtherTypeSec";
    }

    if ($(this).val() == "employed" || $(this).val() == "self-employed") {
        $(SelectorName).show();
        $(SelectorOtherName).hide();
    }
    else {
        $(SelectorOtherName).show();
        $(SelectorName).hide();
    }
});

$("#FormArea").on("change", "#HomeCountrySec", function () {
    if ($("#HomeCountrySec").val() != "") {
        $.ajax({
            type: "Post",
            url: "../RegAcc/GetPhoneCountryByNational",
            cache: false,
            data: { NationalStr: $("#HomeCountrySec").val() },
            dataType: "json",
            success: function (data, status, xhr) {
                if (data.State != "OK") {
                    alert("GetPhoneCountryByNational - Error");
                }
                else {
                    $("#PhoneCountrySec").val(data.Seq);
                }
            },
            error: function (xhr, status, errorThrown) {
                alert("GetPhoneCountryByNational - Error");
            }
        });
    }
    else {
        $("#PhoneCountrySec").val("");
    }
});

$("#FormArea").on("change", "input[type=radio][class=SameASCRO]", function () {
    if ($(this).val() == "True") {
        $(".PPArea").hide();
    } else {
        $(".PPArea").show();
    }
});

$('input[type=checkbox][id=chkAuthority],[id=chkAuthoritySec]').change(function () {
    var SelectorName = "";

    if ($(this).prop("id") == "chkAuthority") {
        SelectorName = "#HAuthority,#HThirdParty";
    }
    else {
        SelectorName = "#HAuthoritySec,#HThirdPartySec";
    }

    if ($(this).prop("checked")) {
        $(SelectorName).show();
    }
    else {
        $(SelectorName).hide();
    }
});

$('input[type=checkbox][id=UseEA],[id=UseEASec]').change(function () {
    var SelectorName = "#";

    if ($(this).attr("id") == "UseEA") {
        SelectorName += "HUseEA";
    }
    else {
        SelectorName += "HUseEASec";
    }

    if (this.checked) {
        $(SelectorName).show();
    }
    else {
        $(SelectorName).hide();
    }
});

function CheckData(theform) {

    if ($("#ComManName").val() == "") {
        $("#ComManName").focus();
        return false;
    }

    if ($("#ComManDuty").val() == "") {
        $("#ComManDuty").focus();
        return false;
    }

    if ($("#ComManID").val() == "") {
        $("#ComManID").focus();
        return false;
    }

    return true;
}

function DetectNoticeShow() {
    if (!$("#Notice").hasClass("NoticeShow")) {
        $("#Notice").addClass("NoticeShow");
    }
}