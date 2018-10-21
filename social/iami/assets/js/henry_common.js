

function getChatApi()
{
   // var master = master;
   // var client = client;

  $.get("/Chat_pop/getChat",{
        // "master" : master,
        // "client" : client
        // <?=$this->security->get_csrf_token_name()?>: '<?=$this->security->get_csrf_hash()?>'
        },function(data){

        // console.log(data);
        $(".flyout-cnt").html("");
        var obj = eval("("+data+")");
        var array = obj.result;
        for(var i=0;i<array.length;i++){

             $(".flyout-cnt").html(obj.msg);
        }
  })
};