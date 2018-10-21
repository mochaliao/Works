$(function () {
    $('#reload').click(function () {
        $('#imgVerification').attr('src', $('#imgVerification').attr('src') + '?' + Math.random());
    });
    $('#HomeCountry').change(function () {
        $("#TelCode").val('+' + $('#HomeCountry option:selected').attr("sequence"));
        $("#TelCode").attr("sequence", '+' + $('#HomeCountry option:selected').attr("sequence"));
        $("#TelCode").attr("data-val-regex-pattern", '^(\\+' + $('#HomeCountry option:selected').attr("sequence") + '){1}(\\d|-){4,20}$');
        $("#DemoForm").data("validator", null);
        $.validator.unobtrusive.parse("#DemoForm");
    })
})