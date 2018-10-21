$(function () {
    $('#reload').click(function () {
        $('#imgVerification').attr('src', $('#imgVerification').attr('src') + '?' + Math.random());
    });
});