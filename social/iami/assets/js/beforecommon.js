function ajaxPost(url, data, feedback) {

    var csrf = $("input[name='csrf_token_name']").val();
    data.csrf_token_name = csrf;

    if (feedback != undefined) {
        $.ajax({
            type: 'POST',
            url: url,
            async: true,
            data: data,
            dataType: 'json',
            success: feedback,
            error: function (result) {
                //your code here
            }
        });
    }
    else {
        var res = [];
        $.ajax({
            type: 'POST',
            url: url,
            async: false,
            data: data,
            dataType: 'json',
            success: function (response) {
                res = response;

            },
            error: function (result) {
                //your code here
            }
        });


        return res;
    }

}