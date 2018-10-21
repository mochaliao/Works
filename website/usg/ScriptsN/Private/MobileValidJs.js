$(function () {
    $("#GetVerCodeBtn").show();
    $(".CelValid").show();

    $("#GetVerCodeBtn").click(function () {
        var CountryVal = $("#NationalityF").val().trim();
        var PhoneCountryVal = RemoveWord($("#PhoneCountryF").val()).trim();
        var PhoneCodeVal = RemoveWord($("#PhoneCodeF").val()).trim();
        var PhoneNumVal = PhoneCountryVal + "-" + PhoneCodeVal;
        var RID = $("#RID").val().trim();

        if (PhoneCodeVal == "" || PhoneCountryVal == "") {
            alert(MsgPhoneError);
            return false;
        }

        if (PhoneCountryVal != "" && PhoneCodeVal != "") {
            var RegConfirmBox = new ConfirmBox();

            //Set Dialog Title And Message
            RegConfirmBox.SetCheckDataDefMsg(PhoneNumVal);

            //Set Parameters
            RegConfirmBox.SetPhoneNum(PhoneCountryVal + PhoneCodeVal);
            RegConfirmBox.SetCountry(CountryVal);
            RegConfirmBox.SetRID(RID);
            RegConfirmBox.SetMobileCodeErrorStr(MsgPhoneErrorAndCheck);
            RegConfirmBox.SetValidCodeExpiredStr(MsgValidCodeExpired);
            //Show Dialog
            RegConfirmBox.Show();
        }

    });

    $("#VerifyBtn").click(function () {
        var ValidCode = $("#txtValidCode").val().trim();
        if (ValidCode != "" && ValidCode.length == 6) {
            var RegConfirmBox = new ConfirmBox();
            var RID = $("#RID").val().trim();
            RegConfirmBox.SetRID(RID);

            var PhoneCountryVal = RemoveWord($("#PhoneCountryF").val()).trim();
            var PhoneCodeVal = RemoveWord($("#PhoneCodeF").val()).trim();
            var PhoneNumVal = PhoneCountryVal + PhoneCodeVal;

            RegConfirmBox.SetPhoneNum(PhoneNumVal);
            RegConfirmBox.SetValidCode(ValidCode);
            RegConfirmBox.CheckValidCode();
        }
        else {
            alert(MsgValidCodeError);
        }
    });

    function RemoveWord(Str) {
        if (Str.length > 0) {
            var NewWord = Str.replace(/\+|-/g, "");
            if (NewWord.substring(0, 1) == "0") {
                NewWord = NewWord.substring(1, NewWord.length);
            }
            return NewWord;
        }
        return Str;
    }
});