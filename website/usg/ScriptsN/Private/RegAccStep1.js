$(function () {
    $(".BtnSubmit").prop("disabled", false);

    $("#VerifyReloadBtn").click(function () {
        $('#VerifyImg').attr('src', $('#VerifyImg').attr('src') + '?' + Math.random());
    });

    $("#Nationality").change(function () {

        if ($("#Nationality").val() != "") {
            $.ajax({
                type: "Post",
                url: NationalityAPIUrl,
                cache: false,
                data: { NationalStr: $("#Nationality").val() },
                dataType: "json",
                success: function (data, status, xhr) {
                    if (data.State != "OK") {
                        alert("GetPhoneCountryByNational - Error");
                    }
                    else {
                        $("#PhoneCountry").val(data.Seq);
                    }
                },
                error: function (xhr, status, errorThrown) {
                    alert("GetPhoneCountryByNational - Error");
                }
            });
        }
        else {
            $("#PhoneCountry").val("");
        }
    });

    $("#FirstMail").blur(function () {
        $("#EmailTips").show();
    });

    $("#FirstPhoneCode").blur(function () {
        $("#PhoneCodeTips").show();
    });
});

function ValidateNumber(e, pnumber) {
    if (!/^\d+[.]?[0-9]?[0-9]?$/.test(pnumber)) {
        e.value = /\d+[.]?[0-9]?[0-9]?/.exec(e.value) == null ? "" : /\d+[.]?[0-9]?[0-9]?/.exec(e.value);
    }
}