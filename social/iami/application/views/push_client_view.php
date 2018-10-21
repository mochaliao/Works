<html>
<head>
    <script src="/assets/jquery-ui-1.12.1/external/jquery/jquery.js"></script>
    <script src="/assets/js/socket.io.js"></script>
    <script>
        // 连接服务端，workerman.net:2120换成实际部署web-msg-sender服务的域名或者ip
        //var socket = io('http://shiefu.com:2120');
        var socket = io('<?=get_push_domain().':'.CLIENT_PUSH_PORT.'/';?>');
        // uid可以是自己网站的用户id，以便针对uid推送以及统计在线人数
        uid = <?=$member_id?>;
        // socket连接后以uid登录
        socket.on('connect', function(){
            socket.emit('login', uid);
            $('#member_id').html('<h1>'+'member_id:'+uid+'</h1>');
        });
        // 后端推送来消息时
        socket.on('new_msg', function(msg){
            //console.log("收到資料："+msg);
            //$('#message').html('<p>'+msg+'</p>');
            //var json_obj = $.parseJSON(JSON.stringify(msg));
            //console.log(json_obj);
            //for (var key in json_obj){
            //    console.log(json_obj[key]["member_id"]);
            //}
            msg = $($.parseHTML(msg)).get(0).data;
            //msg = $(msg).get(0).data;
            // console.log(msg);
            // var JSONString = '[{"name":"Jonathan Suh","gender":"male"},{"name":"William Philbin","gender":"male"},{"name":"Allison McKinnery","gender":"female"}]';
            // console.log(JSONString);
            //console.log(JSONString);
            // $('#message').html('<p>'+JSONString+'</p>');
            $('#message2').html('<p>'+msg+'</p>');
            // var JSONObject = JSON.parse(JSONString);
            // for (var key in JSONObject) {
            //     if (JSONObject.hasOwnProperty(key)) {
            //         console.log(JSONObject[key]["name"] + ", " + JSONObject[key]["gender"]);
            //     }
            // }
            var JSONObject = JSON.parse(msg);
            for (var key in JSONObject) {
                if (JSONObject.hasOwnProperty(key)) {
                    // console.log(JSONObject[key]["member_id"] + ", " + JSONObject[key]["nickname"]);
                }
            }
        });
        // 后端推送来在线数据时
        socket.on('update_online_count', function(online_stat){
            //console.log(online_stat);
        });
    </script>
</head>
<body>
<div id="member_id"></div>
<hr>
<div id="message"></div>
<div id="message2"></div>
</body>
</html>