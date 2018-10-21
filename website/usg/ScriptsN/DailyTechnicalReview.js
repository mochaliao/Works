$(function () {
    $('#SignFreeTrail').click(function () {
        $('#Usg-Upgrade-02').slideToggle("fast", function () {
            if (!$(this).is(':hidden')) {
                $('#first_name').focus();
            }
        });
    });
    $('#close').click(function () {
        $('#Usg-Upgrade-02').slideUp("fast");
    });
});