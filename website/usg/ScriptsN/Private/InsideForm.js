$(function () {
    $('#HomeCountry').change(function () {
        $("#phone_mobile").val('+' + $('#HomeCountry option:selected').attr("sequence"));
        $("#phone_mobile").attr("sequence", '+' + $('#HomeCountry option:selected').attr("sequence"));
        $("#phone_mobile").attr("data-val-regex-pattern", '^(\\+' + $('#HomeCountry option:selected').attr("sequence") + '){1}(\\d|-){4,20}$');
        $("#DemoForm,#InhouseForm").data("validator", null);
        $.validator.unobtrusive.parse("#DemoForm,#InhouseForm");
    })
    if ($('#HomeCountry option:selected').length > 0) {
        $("#phone_mobile").attr("data-val-regex-pattern", '^(\\+' + $('#HomeCountry option:selected').attr("sequence") + '){1}(\\d|-){4,20}$');
        $("#DemoForm,#InhouseForm").data("validator", null);
        $.validator.unobtrusive.parse("#DemoForm,#InhouseForm");
    }
})
