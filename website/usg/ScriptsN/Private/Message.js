$(function () {
    if (typeof message_ReturnURL != 'undefined' && message_ReturnURL != "") {
        setTimeout(function () {window.location.href = message_ReturnURL;}, 5000);
    }
});