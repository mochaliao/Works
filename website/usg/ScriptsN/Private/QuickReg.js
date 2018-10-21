$(function () {
    $('#HomeCountryQuick').change(function () {
        $("#phone_mobileQuickReg").val('+' + $('#HomeCountryQuick option:selected').attr("sequence"));
        $("#phone_mobileQuickReg").attr("sequence", '+' + $('#HomeCountryQuick option:selected').attr("sequence"));
        $("#phone_mobileQuickReg").attr("data-val-regex-pattern", '^(\\+' + $('#HomeCountryQuick option:selected').attr("sequence") + '){1}(\\d|-){4,20}$');
        $("#QuickRegForm").data("validator", null);
        $.validator.unobtrusive.parse("#QuickRegForm");
    })
    if ($('#HomeCountryQuick option:selected').length > 0) {
        $("#phone_mobileQuickReg").attr("data-val-regex-pattern", '^(\\+' + $('#HomeCountryQuick option:selected').attr("sequence") + '){1}(\\d|-){4,20}$');
        $("#QuickRegForm").data("validator", null);
        $.validator.unobtrusive.parse("#QuickRegForm");
    }

})