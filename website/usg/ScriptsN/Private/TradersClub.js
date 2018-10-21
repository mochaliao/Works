function validateEmail(sEmail) {
    var filter = /^([\w-\.]+)@@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;
    return filter.test(sEmail);
}
function CheckQuickRegister() {
    //var retval = true;
    if ($("#first_name").val() == "") {
        alert(error_First_Name);
        $("#first_name").focus();
        return false;
    }
    if ($("#last_name").val() == "") {
        alert(error_Last_Name);
        $("#last_name").focus();
        return false;
    }
    if (validateEmail($("#email1").val())) {
    } else {
        alert(error_Email);
        $("#email1").focus();
        return false;
    }
    if ($("#primary_address_country").val() == "") {
        alert(error_Country);
        $("#primary_address_country").focus();
        return false;
    }
    if (($("#phone_mobile").val() == "") || ($("#phone_mobile").val() == $("#phone_mobile").attr("sequence"))) {
        alert(error_Phone);
        $("#phone_mobile").focus();
        return false;
    }
    return true;
}
$(function () {
    $('#primary_address_country').change(function () {
        $("#phone_mobile").val('+' + $('#primary_address_country option:selected').attr("sequence"));
        $("#phone_mobile").attr("sequence", '+' + $('#primary_address_country option:selected').attr("sequence"));
    })
})