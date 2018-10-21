var pictures = [];
var movie = 0;
var perPage =10;
var page= 0;
var pageTotal=0;
var cpost=true;
var isLast=false;
var fileLength=0;
var cmtFID={};
$(document).ready(function () {

    // $(".bubble-wrap").hide();

    if ($("#post").length > 0) {

        $("#post").on("click",".movie>a",function () {
            var li=$(this).parent();
            var src= $(this).attr("vhref");
            $(this).remove();
            if(location.href.indexOf("/hot/video")>-1){
                li.append("<video src='"+$(this).attr("vhref")+"' style='width:100%' controls/>");
            }else{
                li.append("<video src='"+$(this).attr("vhref")+"' style='max-width: inherit' controls/>");
            }
            var video = li.find("video").get(0);
            video.play();
            video.addEventListener("play",function () {
                $("video").each(function () {
                    if(this!=video){
                        this.pause();
                    }
                })
            },false)
            return false;
        })

        $("#post").on("click",".post-pic .delete-btn-up-pic",function () {
            if($(this).css("opacity")!="1"){
                return false;
            }

            Array.prototype.indexOf = function(val) {
                for (var i = 0; i < this.length; i++) {
                    if (this[i] == val) return i;
                }
                return -1;
            };
            Array.prototype.remove = function(val) {
                var index = this.indexOf(val);
                if (index > -1) {
                    this.splice(index, 1);
                }
            };
            pictures.remove($(this).attr("picId"));
            $(this).parent().remove();
            return false;
        })

        $("#post").on("click",".cog-icon",function () {
            var self=$(this).siblings(".edit-post-drop");
            var hide=self.is(":hidden");
            $(".edit-post-drop").slideUp(500);
            if(hide){
                self.slideDown(500);
            }
            return false;
        })
        $("#post").on("click",".edit-post-link.editpost",function () {
            var item=$(this).closest("article").find(".items-txt:first");
            $(".edit-post-text").val(item.html().replace(/<br>/g, "\r"));
            var btn = $(".box-wrap.top-cnt:first").find(".publish-btn").removeClass("post-publish");
            btn.clone().addClass("btn-gray").html(descriArr["cancel"]).insertAfter(btn);
            btn.addClass("post-edit-publish");
            btn.attr("post-id",$(this).closest("article").attr("post-id"));
            $(".tool-icon-g").css({'visibility':'hidden'});
            $(".box-wrap.top-cnt.disable").removeClass("disable");
            $.colorbox({
                inline: true,
                width: "80%",//90%
                height: "auto",
                overlayClose: true,
                closeButton: true,
                escKey: false,
                href: '.box-wrap.top-cnt:first'
                //scalePhotos: true
            });
            return false;
        })
        $(".box-wrap.top-cnt").on("click",".post-edit-publish",function () {
            var self=$(this);
            self.attr("disabled","disabled");
            var content = $(".edit-post-text").val();
            var postId=self.attr("post-id");
            if($.trim(content)==""){
                self.removeAttr("disabled");
                return false;
            }

            ajaxPost("/post/editPost", {
                'post_id':postId,
                'content': content
            }, function (response) {
                if (response.status == "failed") {


                    //console.log(response.message);
                    //console.log(response.code);
                }
                else {
                    self.closest(".box-wrap.top-cnt").addClass("disable");
                    $.colorbox.close();
                    $("article[post-id="+postId+"] .items-txt:first").html($(".edit-post-text").val().replace(/(\r\n|\n\r|\r|\n)/g, "<br />"));
                    $(".edit-post-text").val("");
                    self.removeClass("post-edit-publish").addClass("post-publish").siblings().remove();
                    $(".tool-icon-g").css({'visibility':'visible'});
                    $(".edit-post-drop").slideUp(500);
                }
                self.removeAttr("disabled");
            });
            return false;
        })
        $(".box-wrap.top-cnt").on("click",".btn-gray",function () {
            $(this).closest(".box-wrap.top-cnt").addClass("disable");
            $(".edit-post-text").val("");
            $(".tool-icon-g").css({'visibility':'visible'});
            $(".box-wrap.top-cnt .post-edit-publish").removeClass("post-edit-publish").addClass("post-publish").siblings().remove();
            $(".box-wrap.top-cnt .comment-edit-publish").removeClass("comment-edit-publish").addClass("post-publish").siblings().remove();
            $.colorbox.close();
            $(".edit-post-drop").slideUp(500);
            return false;
        })



        $(".box-wrap.top-cnt").on("click",".comment-edit-publish",function () {
            var self=$(this);
            self.attr("disabled","disabled");
            var content = $(".edit-post-text").val();
            var comment_id=self.attr("comment-id");
            if($.trim(content)==""){
                self.removeAttr("disabled");
                return false;
            }

           var tag_json = $(".edit-post-text").attr("data");
           var tags = JSON.parse(tag_json);

            ajaxPost("/post/editComment", {
                'comment_id':comment_id,
                'content': content
            }, function (response) {
                if (response.status == "failed") {

                    //console.log(response.message);
                    //console.log(response.code);
                }
                else {
                    self.closest(".box-wrap.top-cnt").addClass("disable");
                    $.colorbox.close();
                    var content = $(".edit-post-text").val();

                    for (var key in tags) {
                        content = content.replace("@" + tags[key].nickname, "<a href='/page/info?i=" + tags[key].id + "' style='font-weight:lighter;color:mediumpurple' data-id='" + tags[key].id + "' data-nickname='" + tags[key].nickname + "'>" + tags[key].nickname + "</a>");
                    }



                    $("[sn="+comment_id+"]").siblings(".items-txt.h6").html(content);
                    $(".edit-post-text").val("");
                    self.removeClass("comment-edit-publish").addClass("post-publish").siblings().remove();
                    $(".tool-icon-g").css({'visibility':'visible'});
                    $(".edit-post-drop").slideUp(500);
                }
                self.removeAttr("disabled");
            });
            return false;
        })

        $("#post").on("click",".cm-list .delete-post-link",function () {
            var block = $(this).closest("li");
            var postBlock = $(this).closest("article");
            var comment_id = block.find("[sn]").attr("sn");
            $("#confirm-delete-dialog .ok").unbind("click");
            $("#confirm-delete-dialog .ok").click(function () {

                ajaxPost("/post/delComment", {
                    "comment_id": comment_id
                }, function (response) {
                    if (response.status == "success") {
                        loadComments(postBlock);
                        $.colorbox.close();
                    }
                });
            });

            $("#confirm-delete-dialog .cancel").unbind("click");
            $("#confirm-delete-dialog .cancel").click(function () {
                $.colorbox.close();
                $(".edit-post-drop").slideUp(500);
            });

            $.colorbox({
                inline: true,
                width: "300px",
                height: "auto",
                overlayClose: true,
                closeButton: false,
                escKey: false,
                href: '#confirm-delete-dialog'
                //scalePhotos: true
            });

            return false;
        });
        function RemoveHTML( strText ) {
            var regEx = /<[^>]*>/g;
            return strText.replace(regEx, "");
        }
        $("#post").on("click",".edit-comment",function () {

            var item=$(this).closest("li").find(".items-txt.h6");

            var content = item.html();

            var tags = [];



            item.find("a").each(function(){
                var id = $(this).attr("data-id");
                var nickname = $(this).attr("data-nickname");
                tags.push({'id':id, 'nickname':nickname});

                content = content.replace(">" + nickname + "<", ">@" + nickname + "<");
            });

            var tag_json = JSON.stringify(tags);

            $(".edit-post-text").attr("data", tag_json);
            $(".edit-post-text").val(RemoveHTML(content));


            var btn = $(".box-wrap.top-cnt:first").find(".publish-btn").removeClass("post-publish");
            btn.clone().addClass("btn-gray").html(descriArr["cancel"]).insertAfter(btn);
            btn.addClass("comment-edit-publish");
            btn.attr("comment-id",$(this).closest("li").find("[sn]").attr("sn"));
            $(".tool-icon-g").css({'visibility':'hidden'});

            var width="";
            if(window.matchMedia('screen and (max-width: 1024px)').matches){
                width="95%";
            }else{
                width="50%"
            }
            $(".box-wrap.top-cnt:first").removeClass("disable");
            $.colorbox({
                inline: true,
                width: width,
                height: "auto",
                overlayClose: true,
                closeButton: true,
                escKey: false,
                href: '.box-wrap.top-cnt:first'
                //scalePhotos: true
            });
            return false;
        })


        //点赞列表里的追踪按钮
        $(".like-list-cnt").on("click",".follow-btn",function () {
            var trace_id = $(this).parent().attr("member-id");
            var object = $(this);
            if ($(this).hasClass("active")) {
                ajaxPost("/trace/delTrace", {
                    'trace_id': trace_id
                }, function (response) {
                    if (response.status == "success") {
                        object.html(descriArr["trace"]);
                        object.removeClass("active");
                    }
                });
            }
            else {
                ajaxPost("/trace/addTrace", {
                    'trace_id': trace_id
                }, function (response) {
                    if (response.status == "success") {
                        object.html(descriArr["traced"]);
                        object.addClass("active");
                    }
                });
            }
        })
        //点赞列表里的好友邀请按钮
        $(".like-list-cnt").on("click",".friend-btn",function () {
            var object = $(this).attr("disabled","disabled");
            var asibling=$(this).siblings("a.follow-btn");
            var trace_id = $(this).parent().attr("member-id");
            if(asibling.length>0 && !asibling.hasClass("active") && !object.hasClass("active")){
                asibling.click();
            }

            if (object.hasClass("active")) {

                ajaxPost("/invite/delInvite", {
                    'invitee_id': trace_id
                }, function (response) {
                    //console.log(response);
                    if (response.status == "success") {
                        object.removeClass("active");
                        object.html(descriArr['friend_invite']);
                        object.removeAttr("disabled");
                    }
                });
            }
            else {
                ajaxPost("/invite/addInvite", {
                    'invitee_id': trace_id
                }, function (response) {
                    //console.log(response);
                    if (response.status == "success") {
                        object.addClass("active");
                        object.html(descriArr['friend_invited']);
                        object.removeAttr("disabled");
                    }
                });
            }
        })


        if(location.href.indexOf("/page/")>-1){
            // 發佈貼文
            $(".box-wrap.top-cnt").on("click",".post-publish",function () {
                postArticle();
            })

            uploadFileListener("#picture", "/post/uploadPicture", "picture", function (e, data) {
                var res = JSON.parse(data.result);
                // console.log(res);
                if(res.code == "P0010"){

                    $("#file-format-dialog .ok").unbind("click");
                    $("#file-format-dialog .ok").click(function () {
                        $.colorbox.close();
                        $(".post-publish").removeAttr("disabled");
                    });

                    $.colorbox({
                        inline: true,
                        width: "300px",
                        height: "auto",
                        overlayClose: true,
                        closeButton: false,
                        escKey: false,
                        href: '#file-format-dialog'
                        //scalePhotos: true
                    });
                }
                else{
                    $.each(data.files, function (index, file) {
                        var uploaded = $(".post-picture").clone();
                        uploaded.removeClass("post-picture");
                        uploaded.removeClass("disable");
                        $(".post-pic ul").append(uploaded);

                        var reader = new FileReader();
                        reader.onload = function (el) {
                            delBtn=$("<span class=\"delete-btn-up-pic\"></span>");
                            var targetImage = $("img", uploaded);
                            delBtn.attr("picId",res.id).insertBefore(targetImage);
                            targetImage.attr('src', el.target.result);
                            targetImage.nailthumb({width: 50, height: 50, method: 'crop', fitDirection: 'center center'});
                        };
                        reader.readAsDataURL(file);
                    });

                    fileLength=fileLength-1;
                    pictures.push(res.id);
                    movie = 0;
                    if(fileLength==0){
                        $(".post-publish").prop("disabled", false);
                        //$(".post-publish").css("background", "linear-gradient(#fdc965, #faecd1, #fdc965)");
                        $(".post-publish").css("background", "linear-gradient(#8361c2, #c3a3ec, #8361c2)");
                    }

                }
            });

            uploadFileListener("#movie", "/post/uploadMovie", "movie", function (e, data) {
                var res = JSON.parse(data.result);
                pictures = [];
                movie = res.id;
            });

            // 清空重載貼文
            if(($("#isMyself").length==1 && $("#isMyself").val()=="1") ||
                ($("#isFriend").length==1 && $("#isFriend").val()=="1") ||
                ($("#isTrace").length==1 && $("#isTrace").val()=="1") ||
                ($("#isFriend").length==0 && $("#isFriend").length==0)){
                var member_id = $("input[name='member_id']").val();
                loadPosts(member_id);

                $(window).scroll(function(){
                    $(".guang").remove();
                    // if(!$('.edit-post').hasClass("active")){
                    //     return false;
                    // }
                    if (($(window).height() + $(window).scrollTop() + 60) >= $(document).height()) {
                        $(".sjjz").remove();
                        $(".guang").remove();
                        if(!cpost){
                            $("#post").append("<div class='sjjz' style=\"text-align: center;\">"+descriArr["loading"]+"</div>");
                            return false;
                        }
                        if(isLast){
                            $("#post").append("<div class='guang' style=\"text-align: center;\">"+descriArr["fullload"]+"</div>");
                            return false;
                        }

                        if(page<pageTotal){
                            loadPosts(member_id);
                        }
                    }
                });
            }
        }

        if(location.href.indexOf("/hot/post")>-1){
            loadHotPosts();

            $(window).scroll(function(){
                $(".guang").remove();

                if (($(window).height() + $(window).scrollTop() + 60) >= $(document).height()) {
                    $(".sjjz").remove();
                    $(".guang").remove();
                    if(!cpost){
                        $("#post").append("<div class='sjjz' style=\"text-align: center;\">"+descriArr["loading"]+"</div>");
                        return false;
                    }
                    if(isLast){
                        $("#post").append("<div class='guang' style=\"text-align: center;\">"+descriArr["fullload"]+"</div>");
                        return false;
                    }

                    if(page<pageTotal){
                        loadHotPosts();
                    }
                }
            });
        }
        if(location.href.indexOf("/hot/video")>-1){
            loadHotVideos();

            $(window).scroll(function(){
                $(".guang").remove();

                if (($(window).height() + $(window).scrollTop() + 60) >= $(document).height()) {
                    $(".sjjz").remove();
                    $(".guang").remove();
                    if(!cpost){
                        $("#post").append("<div class='sjjz' style=\"text-align: center;\">"+descriArr["loading"]+"</div>");
                        return false;
                    }
                    if(isLast){
                        $("#post").append("<div class='guang' style=\"text-align: center;\">"+descriArr["fullload"]+"</div>");
                        return false;
                    }

                    if(page<pageTotal){
                        loadHotVideos();
                    }
                }
            });
        }
    }

    if ($(".profile").length > 0 || $(".edit-profile").length > 0) {
        var member_id = $("input[name='member_id']").val();
        loadProfile(member_id);
    }

    if ($(".media-wrap").length > 0) {
        var member_id = $("input[name='member_id']").val();
        loadPictures(member_id);

        $(".media-wrap").on("click",".del_picture",function () {
            var picture_id = $(this).closest(".media-picture").attr("picture-id");

            $("#confirm-delete-dialog .ok").unbind("click");
            $("#confirm-delete-dialog .ok").click(function () {
                ajaxPost("/picture/delPicture", {
                    "picture_id": picture_id
                }, function (response) {
                    if (response.status == "success") {
                        loadPictures(member_id);
                        $.colorbox.close();
                    }
                });
            });

            $("#confirm-delete-dialog .cancel").unbind("click");
            $("#confirm-delete-dialog .cancel").click(function () {
                $.colorbox.close();
            });

            $.colorbox({
                inline: true,
                width: "300px",
                height: "auto",
                overlayClose: true,
                closeButton: false,
                escKey: false,
                href: '#confirm-delete-dialog'
                //scalePhotos: true
            });

        });

        $(".media-wrap").on("click",".movie",function () {

            if( $(".media-wrap [picture-id=0]").length==1){
                return false;
            }

            var video=$("#mediamovie").find("video");
            video.attr("src",$(this).attr("vhref"));
            var width ="100%";
            if(window.matchMedia('screen and (max-width: 1024px)').matches){
                width="95%";
            }else{
                width="40%"
            }
            $.colorbox({
                inline: true,
                width: width,
                height: "auto",
                overlayClose: true,
                closeButton: false,
                escKey: false,
                href: '#mediamovie'
            });
            $(video).attr("height",($("#cboxLoadedContent").height()-10)+"px");
            video.get(0).play();
        })

        uploadFileListener("#media", "/post/uploadPictureAndMovie", "media", function (e, data) {
            var json =JSON.parse(data.result);
            if(data.files[0]['type'].indexOf('image')==-1){
                var picture = $(".media-picture-object").clone();
                picture.removeClass("disable");
                picture.removeClass("media-picture-object");
                picture.addClass("media-picture");
                picture.insertAfter(".media-wrap .add-btn");
                picture.find("a").removeClass("picture_group").addClass("movie").attr("href","javascript:void(0);");
                $(".center-cropped-media",picture).attr('src', "/assets/img/default_movie.jpg");


                    function get_qiniu_oss_setting()
                    {
                        var platform = location.host;
                        switch (platform) {
                            case 'production':
                                return "http://p5oe5axh4.bkt.clouddn.com/";
                                break;
                            case 'dev':
                                return "http://p6888w4wr.bkt.clouddn.com/";
                                break;
                            case 'test':
                                return "http://p6888w4wr.bkt.clouddn.com/";
                                break;
                            case 'demo':
                                return "http://p5oe5axh4.bkt.clouddn.com/";
                                break;
                            default:
                                return "http://p6888w4wr.bkt.clouddn.com/";
                        }


                    }



                $(".media-wrap [picture-id=0]").find("a").attr("vhref",get_qiniu_oss_setting() + json.path);
            }else{
                $(".media-wrap [picture-id=0]").find("a").attr("href",get_qiniu_oss_setting() + json.path);
            }
            $(".media-wrap [picture-id=0]").attr("picture-id",json.id);
            $(".media-wrap .picture_group").colorbox({rel: 'picture_group', width:'100%'});
        });
    }

    if ($(".photo-list").length > 0) {
        var member_id = $("input[name='member_id']").val();
        loadMediaWidget(member_id);
    }

    if ($(".cog-icon-l.userpic").length > 0) {
        userpicEditListener();
        uploadFileListener("#edit_pic", "/post/uploadPicture", "lightbox", function (e, data) {
            var res = JSON.parse(data.result);
            //console.log(res);
            var member_id = $("input[name='member_id']").val();
            loadMediaLightbox(member_id);
        });
    }

    if ($(".cog-icon-l.banner").length > 0) {
        bannerEditListener();
        uploadFileListener("#edit_pic", "/post/uploadPicture", "lightbox", function (e, data) {
            var res = JSON.parse(data.result);
            //console.log(res);
            var member_id = $("input[name='member_id']").val();
            loadMediaLightbox(member_id);
        });
    }

    if ($(".follow .follow-list").length > 0) {
        var member_id = $("input[name='member_id']").val();
        loadRecommend(member_id);
    }

    if ($("#follower").length > 0) {
        var member_id = $("input[name='member_id']").val();
        loadInfoFollow(member_id);
    }

    if ($("#fans").length > 0) {
        var member_id = $("input[name='member_id']").val();
        loadInfoFans(member_id);
    }

    if ($("#storage").length > 0) {
        loadCollections($("input[name='member_id']").val());
    }

    if ($(".edit-btn .follow-btn-l").length > 0) {
        traceListener();
    }

    if ($(".edit-btn .friend-btn-l").length > 0) {
        friendListener();
    }

    if($(".friend-cog").length > 0){
        var member_id = $("input[name='member_id']").val();
        loadFriendsWidget(member_id);
    }

    if($("#friend-list").length > 0){
        var member_id = $("input[name='member_id']").val();
        loadFriends(member_id);
    }

    if ($(".online .follow-list").length > 0) {
        loadOnlineFriends();
    }

    if($(".tool-message").length>0){
        bindCommentLikeClick();
    }

    friendSearchListener();

    friendSearchMobileListener();

    if($(".inner-header-cover").length > 0){
        $(window).resize(function(){
            $(".inner-header-cover img").css("width", "100%");
            var width = $(".inner-header-cover").width();
            var banner_height = width / 3;
            $(".inner-header-cover").css("margin-bottom", "0px");
            $(".edit-pic-wrap").css("bottom", "10px");
            $(".inner-header-cover").css("height", banner_height + "px");
            var userpic_height = $(".edit-pic-cnt").height();
            if( userpic_height > banner_height){
                $(".inner-header-cover").css("margin-bottom", "80px");
                // var bottom = $(".edit-pic-wrap").css("bottom").replace(/px/,"");
                $(".edit-pic-wrap").css("bottom", (-userpic_height / 2 + 5) + "px");


            }


        }).resize();
    }

});


/////////////////////////////////////////////////////////////
//                  發文(貼文、分享、留言...)
/////////////////////////////////////////////////////////////

/**
 *  貼文
 */
function postArticle() {
    $(".post-publish").attr("disabled","disabled");
    var member_id = $("input[name='member_id']").val();
    var content = $(".post-text").val().replace(/[\uD83C|\uD83D|\uD83E][\uDC00-\uDFFF][\u200D|\uFE0F]|[\uD83C|\uD83D|\uD83E][\uDC00-\uDFFF]|[0-9|*|#]\uFE0F\u20E3|[0-9|#]\u20E3|[\u203C-\u3299]\uFE0F\u200D|[\u203C-\u3299]\uFE0F|[\u2122-\u2B55]|\u303D|[\A9|\AE]\u3030|\uA9|\uAE|\u3030/ig, "");
    var postType = "text";

    if($.trim(content)=="" && pictures.length==0 && movie==0){
        $(".post-publish").removeAttr("disabled");
        return false;
    }

    if (pictures.length > 0) {
        postType = "picture";
    }

    if (movie > 0) {
        postType = "video";
    }
    ajaxPost("/post/doPost", {
        'target': member_id,
        'post_type': postType,
        'content': content,
        'pictures': pictures,
        'movie': movie
    }, function (response) {
        if (response.status == "failed") {
            //console.log(response.message);
            //console.log(response.code);


        }
        else {
            $(".post-text").val("").height(textOriHeight);
            $(".post-pic ul li").remove();
            $('.post-pic').slideUp(300);
            // 載入新貼文
            pictures = [];
            page=0;
            loadPosts(member_id);
        }
        $(".post-publish").removeAttr("disabled");
    });
}

/**
 *  分享貼文
 */
function postShare(from_post_id,shareBtn) {

    var member_id = $("input[name='member_id']").val();
    var content = $("#share-post .share-content").val();
    var postType = "share";
    if($.trim(content)==""){
        return false;
    }

    shareBtn.attr("disabled","disabled");
    ajaxPost("/post/doPost", {
        'target': member_id,
        'post_type': postType,
        'share_id': from_post_id,
        'content': content
    }, function (response) {
        if (response.status == "failed") {
            //console.log(response.message);
            //console.log(response.code);
        }
        else {
            $("#share-post .share-content").val("");
            shareBtn.removeAttr("disabled");
          //  $.colorbox.close();

            if(location.href.indexOf("/page/info")>-1 && getQueryString("i")!=null){
                var shareNumObj = $(".items-tool .tool-share .tool-num","article[post-id="+from_post_id+"]");
                var shareNum = parseInt(shareNumObj.html()) + 1;
                shareNumObj.html(shareNum);
                tip(descriArr["share_success"]);
                return false;
            }

            page=0;
            if(location.href.indexOf("/hot/video")>-1){
                loadHotVideos();
            }else if(location.href.indexOf("/hot/post")>-1){
                loadHotPosts();
            }else{
                loadPosts(member_id);
            }
        }

        $.colorbox.close();
    });
}

/**
 * 留言
 * @param post_id 貼文識別碼
 * @param content 留言內容
 */
function postComment(post_id, content) {
    var member_id = $("input[name='member_id']").val();
    var parmjson={
        // 'member_id': member_id,
        'post_id': post_id,
        'content': content,
    };

    if(cmtFID[post_id]!=undefined){
        var reqFID={};

        console.log(cmtFID[post_id]);
        // $.each(cmtFID[post_id],function (i,item) {
        //     if(content.indexOf("@"+item.nickname)!=-1){
        //         reqFID[item.nickname]=item.id;
        //         // console.log(item.nickname + " "+ item.id);
        //     }
        //     // console.log('alert'+cmtFID[post_id]);
        // })

        for(var i=0; i<cmtFID[post_id].length;i++){
            if(content.indexOf("@"+cmtFID[post_id][i].nickname)!=-1){
                reqFID[cmtFID[post_id][i].nickname]=cmtFID[post_id][i].id;
                // console.log(item.nickname + " "+ item.id);
            }
        }




        if(JSON.stringify(reqFID)!="{}"){
            parmjson["friend_id"]=JSON.stringify(reqFID);
        }
        cmtFID[post_id]=[];
    }

    ajaxPost("/post/doComment",parmjson, function (response) {
        if (response.status == "failed") {
            //console.log(response.message);
            //console.log(response.code);
        }
        else {
            $(".comment-content").val("");
            var block = $(".post-block[post-id='" + post_id + "']");
            loadComments(block);
            // 載入新貼文
        }
        $(".comment-publish").removeAttr("disabled");
    });


}

/////////////////////////////////////////////////////////////
//                  檔案上傳
/////////////////////////////////////////////////////////////

/**
 * 檔案上傳
 * @param selector 上傳物件
 * @param url 上傳路徑
 * @param type 圖片| 影片
 * @param complete 完成 function
 */
function uploadFileListener(selector, url, type, complete) {

    var csrf = $("input[name='csrf_token_name']").val();
    $(".post-pic ul li").remove();

    var fu = $(selector).fileupload({
        url: url,
        autoUpload: false,
        maxFileSize: 1000000000,
        disableImageResize: /Android(?!.*Chrome)|Opera/
            .test(window.navigator.userAgent),
        previewCrop: true,
        formData: {
            "csrf_token_name": csrf
        },
        add: function (e, data) {
            if(fileLength>10){
                tip(descriArr["maxuploadnum"]);
                return false;
            }

            if(data.files[0]['type'].indexOf('image')==-1 && data.files[0]['size'] > 100 * 1000 * 1000) {
                tip(descriArr["mv_maxuploadsize"]);
                return ;
            }
            if(data.files[0]['type'].indexOf('image')>-1 && data.files[0]['size'] > 10 * 1000 * 1000) {
                tip(descriArr["pic_maxuploadsize"]);
                return;
            }

            $('.post-pic').slideDown(300);

            if (type == "picture") {
                pictureUploadPrehandle(e, data);
            }
            else if (type == "movie") {
                movieUploadPrehandle(e, data);
            }
            else if (type == "media") {
                mediaUploadPrehandle(e, data);
            }
            else if (type == "lightbox") {
                mediaLightboxUploadPrehandle(e, data);
            }
            $(".progress-bar").addClass(type);
            data.submit();
            $(".progress-bar"+"."+type).show();
            // $(".post-publish").prop("disabled", true);
            $(".media-wrap .add-btn").find("label").removeAttr("for");
            $(".post-publish").css("background", "linear-gradient(#797774, #FFFF, #797774)");
        },
        progressall: function (e, data) {
            var progress = parseInt(data.loaded / data.total * 100, 10);
            $(".progress-bar"+"."+type).show();
            $(".progress-bar"+"."+type).css({"width": progress + "%"});
            if (progress == 100) {

                if(type!="picture"){
                    $(".post-publish").prop("disabled", false);
                    //$(".post-publish").css("background", "linear-gradient(#fdc965, #faecd1, #fdc965)");
                    $(".post-publish").css("background", "linear-gradient(#8361c2, #c3a3ec, #8361c2)");
                }

                $(".media-wrap .add-btn").find("label").attr("for","media");
                $(".progress-bar"+"."+type).hide();
                $(".progress-bar"+"."+type).css({"width": "0%"});
            }
        },
        done: function (e, data) {
            $(".progress-bar").hide();
            complete(e, data);
        }
    });
}

/**
 * 圖片上傳處理
 * @param e
 * @param data
 */
function pictureUploadPrehandle(e, data) {
    movie=[];
    $("#post .post-pic li.lzyy").remove();
}


/**
 * 柏 9:40
 * 2/8 4:30 - 巴士 桃園…中清、文心交叉口
 * 影片上傳處理
 * @param e
 * @param data
 */
function movieUploadPrehandle(e, data) {
    pictures=[];
    $("#post .post-pic li").remove();

    $.each(data.files, function (index, file) {
        var uploaded = $(".post-movie").clone();
        uploaded.removeClass("post-movie");
        uploaded.removeClass("disable");
        $(".post-pic ul").append(uploaded);
        var reader = new FileReader();
        reader.onload = function (e) {
            $(".preview_movie").attr("src", e.target.result);
            // $("<span class=\"delete-btn-up-pic\"></span>").insertBefore($(".preview_movie").attr("src", e.target.result));
            $(".preview_movie").get(1).addEventListener("play",function () {
                var self = this;
                $("video").each(function () {
                    if(this!=self){
                        this.pause();
                    }
                })
            },false)
        }
        reader.readAsDataURL(file);
    });
}

/**
 * 媒體上傳處理(媒體頁圖片)
 * @param e
 * @param data
 */
function mediaUploadPrehandle(e, data) {
    $.each(data.files, function (index, file) {
        if(data.files[0]['type'].indexOf('image')>-1){
            var picture = $(".media-picture-object").clone();
            picture.removeClass("disable");
            picture.removeClass("media-picture-object");
            picture.addClass("media-picture");
            picture.insertAfter(".media-wrap .add-btn");
            var reader = new FileReader();
            reader.onload = function (e) {
                var targetImage = $(".center-cropped-media", picture);
                targetImage.attr('src', e.target.result);
            };
            reader.readAsDataURL(file);
        }

    });
}

/**
 * Popup媒體上傳處理
 * @param e
 * @param data
 */
function mediaLightboxUploadPrehandle(e, data) {
    $.each(data.files, function (index, file) {
        /*
        var picture = $(".up-pic-cnt-object").clone();
        picture.removeClass("disable");
        picture.removeClass("up-pic-cnt-object");
        picture.addClass("up-pic-cnt");
        picture.insertAfter(".progress-bar");

        var reader = new FileReader();
        reader.onload = function (e) {
            var targetImage = $(".center-cropped-media-lightbox", picture);
            targetImage.attr('src', e.target.result);
        };
        reader.readAsDataURL(file);
        */
    });
}


/////////////////////////////////////////////////////////////
//                        載入內容
/////////////////////////////////////////////////////////////


function loadPosts(member_id) {
    $(".guang").remove();
    cpost=false;
    isLast=false;
    var pageType = "/post/getPosts";
    if($("input[name='pageType']").length > 0 && $("input[name='pageType']").val() == "info"){
        pageType = "/post/getSelfPosts";
    }

    page=page+1;
    var parms ={
        "member_id": member_id,
        "perPage":perPage,
        "Page":page
    };

    if(getQueryString("post_id")!=null){
        parms["post_id"]=getQueryString("post_id");
    }

    ajaxPost(pageType,parms , function (response) {
        if(page==1){
            pageTotal=response.pageTotal;
        }
        var length = response.data.length;
        if(length==0 || page==pageTotal){
            isLast=true;
        }
        if(page==1){
            $("#post .post-block").remove();
        }
        for (var i = 0; i < length; i++) {
            loadPost(response.data[i]);
        }

        // 載入讚資訊 (與載入貼文分開處理，非同步處理，節省時間 )
        for (var i = 0; i < length; i++) {
            loadlikesMember(response.data[i].post_id);
        }

        cpost=true;
        $(".sjjz").remove();
        postDeleteListener();
        sharesListener();
        commentsListener();
        likesListener();
        collectListener();

    });
}

function loadHotPosts() {
    $(".guang").remove();
    cpost=false;
    isLast=false;
    page=page+1;
    var parms ={
        "perPage":perPage,
        "page":page
    };

    ajaxPost("getPost",parms , function (response) {
        if(page==1){
            pageTotal=response.pageTotal;
        }
        var length = response.data.length;
        if(length==0 || page==pageTotal){
            isLast=true;
        }
        if(page==1){
            $("#post article").remove();
        }
        for (var i = 0; i < length; i++) {
            loadPost(response.data[i]);
        }

        // 載入讚資訊 (與載入貼文分開處理，非同步處理，節省時間 )
        for (var i = 0; i < length; i++) {
            loadlikesMember(response.data[i].post_id);
        }

        cpost=true;
        $(".sjjz").remove();
        postDeleteListener();
        sharesListener();
        commentsListener();
        likesListener();
        collectListener();

    });
}
function loadHotVideos() {
    $(".guang").remove();
    cpost=false;
    isLast=false;
    page=page+1;
    var parms ={
        "perPage":perPage,
        "page":page
    };

    ajaxPost("getVideo",parms , function (response) {
        if(page==1){
            pageTotal=response.pageTotal;
        }
        var length = response.data.length;
        if(length==0 || page==pageTotal){
            isLast=true;
        }
        if(page==1){
            $("#post article").remove();
        }
        for (var i = 0; i < length; i++) {
            loadHotVideo(response.data[i]);
        }

        // 載入讚資訊 (與載入貼文分開處理，非同步處理，節省時間 )
        for (var i = 0; i < length; i++) {
            loadlikesMember(response.data[i].post_id);
        }

        cpost=true;
        $(".sjjz").remove();
        postDeleteListener();
        sharesListener();
        commentsListener();
        likesListener();
        collectListener();

    });
}




function loadSelfPosts(member_id) {
    ajaxPost("/post/getSelfPosts", {
        "member_id": member_id
    }, function (response) {

        $(".post-block").remove();

        //console.log(response);

        var length = response.data.length;
        for (var i = 0; i < length; i++) {
            loadPost(response.data[i]);
        }

        // 載入讚資訊 (與載入貼文分開處理，非同步處理，節省時間 )
        for (var i = 0; i < length; i++) {
            loadlikesMember(response.data[i].post_id);
        }

        postDeleteListener();
        sharesListener();
        commentsListener();
        likesListener();
        collectListener();

        $(".picture_group").colorbox({rel: 'picture_group', width: '90%', closeButton: true});
    });
}

function loadPost(post) {

    var block = $(".post-block-object").clone();
    block.attr("post-id", post.post_id);
    block.attr("pmsid", post.member.member_id);
    block.removeClass("post-block-object");
    block.addClass("post-block");
    // 讚清單隱藏
    // $(".items-name.other-page", block).remove();

    //判斷是否為網址
    function isValidURL(url){
        var RegExp = /[-a-zA-Z0-9@:%_\+.~#?&//=]{2,256}\.[a-z]{2,4}\b(\/[-a-zA-Z0-9@:%_\+.~#?&//=]*)?/gi;
        if(RegExp.test(url)){
            return true;
        }else{
            return false;
        }
    }

    function isValidURL2(url){
        var RegExp = /https?:\/\/(www\.)?[-a-zA-Z0-9@:%._\+~#=]{2,256}\.[a-z]{2,6}\b([-a-zA-Z0-9@:%_\+.~#?&//=]*)/;
        if(RegExp.test(url)){
            return true;
        }else{
            return false;
        }
    }


    if(isValidURL2(post.content)){
        post.content = post.content.replace(
            /([^\S]|^)(((https?\:\/\/)|(www\.))(\S+))/gi,
            function(match, space, url){
                var hyperlink = url;
                if (!hyperlink.match('^https?:\/\/')) {
                    hyperlink = 'http://' + hyperlink;
                }
                return space + '<a href="' + hyperlink + '" target="_blank">' + url + '</a>';
            }
        );
        // post.content = "<a href="+post.content+" target='_blank'>"+post.content;
    }else if(isValidURL(post.content)){
        post.content = post.content.replace(
            /([^\S]|^)(((https?\:\/\/)|(www\.))(\S+))/gi,
            function(match, space, url){
                var hyperlink = url;
                if (!hyperlink.match('^https?:\/\/')) {
                    hyperlink = 'http://' + hyperlink;
                }
                return space + '<a href="' + hyperlink + '" target="_blank">' + url + '</a>';
            }
        );
        // post.content = "<a href=//"+post.content+" target='_blank'>"+post.content;
    }
    //判斷是否為網址_end

    $(".items-name a", block).html(post.member.nickname);
    $(".items-name a", block).attr("href", "/page/info?i=" + post.member.member_id);
    $(".items-txt", block).html(post.content);
    $(".items-min", block).html(post.create_time);
    $(".items-tool .tool-like .tool-num", block).html(post.likeCount);
    $(".tool-message .tool-num", block).html(post.commentCount);
    $(".tool-share .tool-num", block).html(post.shareCount);

    $(".cnt-photo-wrap a", block).eq(0).attr("href", "/page/info?i=" + post.member.member_id);
    if (post.member.avatar == null || post.member.avatar == undefined || post.member.avatar == '') {
        $(".cnt-photo-wrap img", block).attr("src", "/assets/img/self-user-pic.jpg");
    }
    else {
        $(".cnt-photo-wrap img", block).attr("src", post.member.avatar);
    }

    if (post.member.member_id != post.for_who.member_id) {
        $(".other-page", block).removeClass("disable");
        $(".other-page a", block).html(post.for_who.nickname);
        $(".other-page a", block).attr("href", "/page/info?i=" + post.for_who.member_id);
    }

    if($("#selfid").length>0 && $("#selfid").val()!=post.member.member_id){//不是自己不能删除
        block.find(".cog-icon-wrap").remove();
    }


    if (post.post_type == "picture") {
        $(".items-photo-wrap li", block).remove();


        if (post.pictures.length == 1) {
            var image = $(".picture-in-post").clone();
            image.removeClass("disable");
            image.removeClass("picture-in-post");
            $("a.picture_group", image).attr("href", post.pictures[0].path);
            $("a.picture_group img", image).attr("src", post.pictures[0].path);
            $("a.picture_group img", image).addClass("center-cropped-one");
            $(".items-photo-wrap.one ul", block).append(image);
            $(".items-photo-wrap.one", block).removeClass("disable");
            $(".items-photo-wrap.one .picture_group", block).colorbox({
                rel: 'picture_group'+post.post_id,
                width: '80%',
                closeButton: true,
                scalePhotos: true,
                maxWidth: "80%",
                minWidth:"80%",
                onComplete:function(e){

                    var image_width = $(".cboxPhoto").width();
                     $("#cboxContent").css("width",image_width + "px");
                     $("#cboxLoadedContent").css("width",image_width + "px");
                     $("#cboxWrapper").css("width",image_width + "px");
                     $("#colorbox").css("width",image_width + "px");

                    // 置中
                    var body_width = $(document).width();
                    var new_left = body_width / 2 - image_width / 2;
                    $("#colorbox").css("left",new_left + "px");
                }
            });
        }
        else {
            for (var i = 0; i < post.pictures.length; i++) {
                var image = $(".picture-in-post").clone();
                image.removeClass("disable");
                image.removeClass("picture-in-post");

                $("a.picture_group", image).attr("href", post.pictures[i].path);
                $("a.picture_group img", image).attr("src", post.pictures[i].path);
                $("a.picture_group img", image).addClass("center-cropped-nine");
                $(".items-photo", block).append(image);
                $(".items-photo-wrap.nine", block).removeClass("disable");
                $(".items-photo-wrap.nine .picture_group", block).colorbox({
                    rel: 'picture_group'+post.post_id,
                    width: '80%',
                    closeButton: true,
                    scalePhotos: true,
                    maxWidth: "80%",
                    minWidth:"80%",
                    onComplete:function(e){

                                                var image_width = $(".cboxPhoto").width();
                                                $("#cboxContent").css("width",image_width + "px");
                                                $("#cboxLoadedContent").css("width",image_width + "px");
                                                $("#cboxWrapper").css("width",image_width + "px");
                                                $("#colorbox").css("width",image_width + "px");

                                                // 置中
                                                var body_width = $(document).width();
                                                var new_left = body_width / 2 - image_width / 2;
                                                $("#colorbox").css("left",new_left + "px");

                    }
                });
            }
        }

    }
    else if (post.post_type == "video") {
        $(".items-photo-wrap li", block).remove();
        var video = $(".video-in-post").clone();
        video.removeClass("disable");
        video.removeClass("video-in-post");
        if(post.video.length > 0) {
            $("a", video).attr("vhref", post.video[0].path);
        }
        $(".items-photo-wrap ul", block).append(video);
        $(".items-photo-wrap.one", block).removeClass("disable");


    }
    else if (post.post_type == "share") {
        $(".itmes-share", block).removeClass("disable");
        $(".share-cnt-wrap", block).removeClass("disable");
        loadSharePost(post.share_post.data, block);
    }
    else {
        $(".items-photo-wrap", block).remove();
    }

    if (post.isLike == "Y") {
        $(".tool-like", block).addClass("active");
    }
    else {
        $(".tool-like", block).removeClass("active");
    }

    if (post.isCollect == "Y") {
        $(".tool-storage", block).addClass("active");
    }
    else {
        $(".tool-storage", block).removeClass("active");
    }

    $("#post.active").append(block);
    block.removeClass("disable");

    $(".items-txt", block).each(function () {
        if(parseFloat($(this).css("lineHeight"))*4<$(this).height()){
            itemsTxtAction($(this));
        }
    })

}

function showAll(showBtn){
    var itemsTxt=$(showBtn).html(descriArr["post_collapse"]).siblings(".items-txt");
    $(showBtn).attr("onclick","hidePost(this)");
    itemsTxt.height(itemsTxt.attr("oriHg")).css("overflow","visible");
}
function  hidePost(showBtn) {
    var itemsTxt=$(showBtn).siblings(".items-txt");
    $(showBtn).remove();
    itemsTxtAction(itemsTxt);
}
function itemsTxtAction(itemsTxt){
    $(itemsTxt).attr("oriHg",$(itemsTxt).height()).height(parseFloat($(itemsTxt).css("lineHeight"))*4).css("overflow","hidden").after("<div" +
        " class='readmore' +  onclick='showAll(this)' style='cursor:pointer;'>..."+descriArr["post_more"]+"</div>");
}

function loadHotVideo(post) {

    var block = $(".hot-video-block").clone();
    block.attr("post-id", post.post_id);
    block.attr("pmsid", post.member.member_id);
    block.removeClass("hot-video-block");
    block.addClass("post-block");
    // 讚清單隱藏
    // $(".items-name.other-page", block).remove();

    //判斷是否為網址
    function isValidURL(url){
        var RegExp = /[-a-zA-Z0-9@:%_\+.~#?&//=]{2,256}\.[a-z]{2,4}\b(\/[-a-zA-Z0-9@:%_\+.~#?&//=]*)?/gi;
        if(RegExp.test(url)){
            return true;
        }else{
            return false;
        }
    }

    function isValidURL2(url){
        var RegExp = /https?:\/\/(www\.)?[-a-zA-Z0-9@:%._\+~#=]{2,256}\.[a-z]{2,6}\b([-a-zA-Z0-9@:%_\+.~#?&//=]*)/;
        if(RegExp.test(url)){
            return true;
        }else{
            return false;
        }
    }


    if(isValidURL2(post.content)){
        post.content = "<a href="+post.content+" target='_blank'>"+post.content;
    }else if(isValidURL(post.content)){
        post.content = "<a href=//"+post.content+" target='_blank'>"+post.content;
    }
    //判斷是否為網址_end

    $(".items-name a", block).html(post.member.nickname);
    $(".items-name a", block).attr("href", "/page/info?i=" + post.member.member_id);
    $(".items-txt", block).html(post.content);
    $(".items-min:first", block).html(post.create_time);
    // $(".items-min:eq(1) span", block).html("2");
    $(".items-tool .tool-like .tool-num", block).html(post.likeCount);
    $(".tool-message .tool-num", block).html(post.commentCount);
    $(".tool-share .tool-num", block).html(post.shareCount);

    $(".cnt-photo-wrap a", block).eq(0).attr("href", "/page/info?i=" + post.member.member_id);
    if (post.member.avatar == null || post.member.avatar == undefined || post.member.avatar == '') {
        $(".cnt-photo-wrap img", block).attr("src", "/assets/img/self-user-pic.jpg");
    }
    else {
        $(".cnt-photo-wrap img", block).attr("src", post.member.avatar);
    }

    if (post.member.member_id != post.for_who.member_id) {
        $(".other-page", block).removeClass("disable");
        $(".other-page a", block).html(post.for_who.nickname);
        $(".other-page a", block).attr("href", "/page/info?i=" + post.for_who.member_id);
    }

    if($("#selfid").length>0 && $("#selfid").val()!=post.member.member_id){//不是自己不能删除
        block.find(".cog-icon-wrap").remove();
    }


    if (post.post_type == "picture") {
        $(".items-photo-wrap li", block).remove();


        if (post.pictures.length == 1) {
            var image = $(".picture-in-post").clone();
            image.removeClass("disable");
            image.removeClass("picture-in-post");
            $("a.picture_group", image).attr("href", post.pictures[0].path);
            $("a.picture_group img", image).attr("src", post.pictures[0].path);
            $("a.picture_group img", image).addClass("center-cropped-one");
            $(".items-photo-wrap.one ul", block).append(image);
            $(".items-photo-wrap.one", block).removeClass("disable");
            $(".items-photo-wrap.one .picture_group", block).colorbox({
                rel: 'picture_group'+post.post_id,
                width: '80%',
                closeButton: true,
                scalePhotos: true,
                maxWidth: "80%",
                minWidth:"80%",
                onComplete:function(e){

                                        var image_width = $(".cboxPhoto").width();
                                        $("#cboxContent").css("width",image_width + "px");
                                        $("#cboxLoadedContent").css("width",image_width + "px");
                                        $("#cboxWrapper").css("width",image_width + "px");
                                        $("#colorbox").css("width",image_width + "px");

                                        // 置中
                                        var body_width = $(document).width();
                                        var new_left = body_width / 2 - image_width / 2;
                                        $("#colorbox").css("left",new_left + "px");

                }
            });
        }
        else {
            for (var i = 0; i < post.pictures.length; i++) {
                var image = $(".picture-in-post").clone();
                image.removeClass("disable");
                image.removeClass("picture-in-post");

                $("a.picture_group", image).attr("href", post.pictures[i].path);
                $("a.picture_group img", image).attr("src", post.pictures[i].path);
                $("a.picture_group img", image).addClass("center-cropped-nine");
                $(".items-photo", block).append(image);
                $(".items-photo-wrap.nine", block).removeClass("disable");
                $(".items-photo-wrap.nine .picture_group", block).colorbox({
                    rel: 'picture_group'+post.post_id,
                    width: '80%',
                    closeButton: true,
                    scalePhotos: true,
                    maxWidth: "80%",
                    minWidth:"80%",
                    onComplete:function(e){

                                            var image_width = $(".cboxPhoto").width();
                                            $("#cboxContent").css("width",image_width + "px");
                                            $("#cboxLoadedContent").css("width",image_width + "px");
                                            $("#cboxWrapper").css("width",image_width + "px");
                                            $("#colorbox").css("width",image_width + "px");

                                            // 置中
                                            var body_width = $(document).width();
                                            var new_left = body_width / 2 - image_width / 2;
                                            $("#colorbox").css("left",new_left + "px");

                    }
                });
            }
        }

    }
    else if (post.post_type == "video") {
        $(".h-video-clip a", block).attr("vhref",post.video[0]!=undefined?post.video[0].path:"");
    }
    else if (post.post_type == "share") {
        $(".itmes-share", block).removeClass("disable");
        $(".share-cnt-wrap", block).removeClass("disable");
        loadSharePost(post.share_post.data, block);
    }
    else {
        $(".items-photo-wrap", block).remove();
    }

    if (post.isLike == "Y") {
        $(".tool-like", block).addClass("active");
    }
    else {
        $(".tool-like", block).removeClass("active");
    }

    if (post.isCollect == "Y") {
        $(".tool-storage", block).addClass("active");
    }
    else {
        $(".tool-storage", block).removeClass("active");
    }

    $("#post.active").append(block);
    block.removeClass("disable");

    $(".items-txt", block).each(function () {
        if(parseFloat($(this).css("lineHeight"))*4<$(this).height()){
            itemsTxtAction($(this));
        }
    })

}

function loadSharePost(post, block) {
    if(post==undefined){
        $(".share-cnt-wrap .share-cnt", block).html("贴文已被主人删除!").css('text-align','center');
        return ;
    }
    $(".share-cnt-wrap .items-name a", block).html(post.member.nickname);
    $(".share-cnt-wrap .items-name a", block).attr("href", "/page/info?i=" + post.member.member_id);
    $(".share-cnt-wrap .items-txt", block).html(post.content);
    $(".share-cnt-wrap .items-min", block).html(post.create_time);

    $(".share-cnt-wrap .share-cnt .cnt-photo-wrap a", block).attr("href", "/page/info?i=" + post.member.member_id);
    $(".share-cnt-wrap .share-cnt .cnt-photo-wrap img", block).attr("src", post.member.avatar);

    if (post.post_type == "picture") {
        $(".share-cnt-wrap .items-photo-wrap li", block).remove();
        if (post.pictures.length == 1) {
            var image = $(".picture-in-post").clone();
            image.removeClass("disable");
            image.removeClass("picture-in-post");
            $("a.picture_group", image).attr("href", post.pictures[0].path);
            $("a.picture_group img", image).attr("src", post.pictures[0].path);
            $("a.picture_group img", image).addClass("center-cropped-share-one");
            $(".share-cnt-wrap .items-photo-wrap ul", block).append(image);
            $(".share-cnt-wrap .items-photo-wrap ul", block).removeClass("items-photo");
            $(".share-cnt-wrap .items-photo-wrap.one", block).removeClass("disable");
            $(".share-cnt-wrap .items-photo-wrap .picture_group", block).colorbox({rel: 'picture_group'+post.post_id, width: '90%', closeButton: true});
        }
        else {
            for (var i = 0; i < post.pictures.length; i++) {
                var image = $(".picture-in-post").clone();
                image.removeClass("disable");
                image.removeClass("picture-in-post");

                $("a.picture_group", image).attr("href", post.pictures[i].path);
                $("a.picture_group img", image).attr("src", post.pictures[i].path);
                $("a.picture_group img", image).addClass("center-cropped-share-nine");
                $(".share-cnt-wrap .items-photo", block).append(image);
                $(".share-cnt-wrap .items-photo-wrap.nine", block).removeClass("disable");
                $(".share-cnt-wrap .items-photo .picture_group", block).colorbox({rel: 'picture_group'+post.post_id, width: '90%', closeButton: true});
            }

        }
    }
    else if (post.post_type == "video") {
        $(".items-photo-wrap li", block).remove();
        var video = $(".video-in-post").clone();
        video.removeClass("disable").removeClass("video-in-post").css("width","100%");
        if(post.video.length > 0) {
            $("video", video).attr("src", post.video[0].path);
        }
        $(".share-cnt-wrap .items-photo-wrap ul", block).append(video);
        $(".share-cnt-wrap .items-photo-wrap.one", block).removeClass("disable");
        $(".share-cnt-wrap a.media", block).attr("vhref",post.video[0]!=undefined?post.video[0].path:"");

    }
    else if (post.post_type == "share") {
        $(".itmes-share", block).removeClass("disable");
        $(".share-cnt-wrap", block).removeClass("disable");
        loadSharePost(post.share_post.data, block);
    }
    else {
        $(".share-cnt-wrap .items-photo-wrap", block).remove();
    }
}

function loadCollections(member_id) {
    ajaxPost("/post/getCollections", {}, function (response) {

        $("#storage article").remove();

        var length = response.data.length;
        for (var i = 0; i < length; i++) {
            loadCollection(response.data[i]);
        }

        // 載入讚資訊 (與載入貼文分開處理，非同步處理，節省時間 )
        for (var i = 0; i < length; i++) {
            loadlikesMember(response.data[i].post_id);
        }
        postDeleteListener();
        sharesListener();
        commentsListener();
        likesListener();
        collectListener();

    });
}

function loadCollection(post) {
    var block = $(".post-block-object").clone();
    block.attr("post-id", post.post_id);
    block.removeClass("post-block-object");
    block.addClass("post-block");
    // 讚清單隱藏
    // $(".items-name.other-page", block).remove();
    $(".cog-icon-wrap",block).remove();
    $(".items-name a", block).html(post.member.nickname);
    $(".items-txt", block).html(post.content);
    $(".items-min", block).html(post.create_time);
    $(".items-tool .tool-like .tool-num", block).html(post.likeCount);
    $(".tool-message .tool-num", block).html(post.commentCount);
    $(".tool-share .tool-num", block).html(post.shareCount);

    $(".cnt-photo-wrap a", block).eq(0).attr("href", "/page/info?i=" + post.member.member_id);
    if (post.member.avatar == null || post.member.avatar == undefined || post.member.avatar == '') {
        $(".cnt-photo-wrap img", block).attr("src", "/assets/img/self-user-pic.jpg");
    }
    else {
        $(".cnt-photo-wrap img", block).attr("src", post.member.avatar);
    }

    if (post.member.member_id != post.for_who.member_id) {
        $(".other-page", block).removeClass("disable");
        $(".other-page a", block).html(post.for_who.nickname);
        $(".other-page a", block).attr("href", "/page/info?i=" + post.for_who.member_id);
    }

    if (post.post_type == "picture") {
        $(".items-photo-wrap li", block).remove();
        if (post.pictures.length == 1) {
            var image = $(".picture-in-post").clone();
            image.removeClass("disable");
            image.removeClass("picture-in-post");
            $("a.picture_group", image).attr("href", post.pictures[0].path);
            $("a.picture_group img", image).attr("src", post.pictures[0].path);
            $("a.picture_group img", image).addClass("center-cropped-one");
            $(".items-photo-wrap ul", block).append(image);
            $(".items-photo-wrap.one", block).removeClass("disable");
        }
        else {
            for (var i = 0; i < post.pictures.length; i++) {
                var image = $(".picture-in-post").clone();
                image.removeClass("disable");
                image.removeClass("picture-in-post");

                $("a.picture_group", image).attr("href", post.pictures[i].path);
                $("a.picture_group img", image).attr("src", post.pictures[i].path);
                $("a.picture_group img", image).addClass("center-cropped-nine");
                $(".items-photo", block).append(image);
                $(".items-photo-wrap.nine", block).removeClass("disable");
            }

        }
    }
    else if (post.post_type == "video") {
        $(".items-photo-wrap li", block).remove();
        var video = $(".video-in-post").clone();
        video.removeClass("disable");
        video.removeClass("video-in-post");
        if(post.video.length > 0){
            $("video", video).attr("src", post.video[0].path);
        }
        $(".items-photo-wrap ul", block).append(video);
        $(".items-photo-wrap.one", block).removeClass("disable");
    }
    else if (post.post_type == "share") {
        $(".itmes-share", block).removeClass("disable");
        $(".share-cnt-wrap", block).removeClass("disable");
        loadSharePost(post.share_post.data, block);
    }
    else {
        $(".items-photo-wrap", block).remove();
    }

    if (post.isLike == "Y") {
        $(".tool-like", block).addClass("active");
    }
    else {
        $(".tool-like", block).removeClass("active");
    }

    if (post.isCollect == "Y") {
        $(".tool-storage", block).addClass("active");
    }
    else {
        $(".tool-storage", block).removeClass("active");
    }

    $("#storage").append(block);
    block.removeClass("disable");
}

function loadlikesMember(post_id) {
    var block = $(".post-block[post-id='" + post_id + "']");
    ajaxPost("/like/getPostLikes", {
        "post_id": post_id
    }, function (response) {

        var count = response.data.length;
        $(".items-tool .tool-like .tool-num", block).html(count);
        $(".items-like-fd a", block).remove();

        if (count > 0) {
            $(".items-like-wrap", block).removeClass("disable");

            for (var i = 0; i < count && i < 5; i++) {
                var like = $(".like-member").clone();
                like.removeClass("disable");
                like.removeClass("like-member");
                like.attr("href", "/page/info?i=" + response.data[i].member_id);
                $("img", like).attr("src", response.data[i].avatar);
                $(".items-like-fd", block).append(like);
            }

            if (count > 5) {
                $(".items-like-txt", block).removeClass("disable");
                $(".items-like-txt a", block).html(count - 5);
            }

        }
        else {
            $(".items-like-wrap", block).addClass("disable");
        }
    });
}

function loadComments(postblock) {

    var post_id = postblock.attr("post-id");

    ajaxPost("/post/getComments", {
        "post_id": post_id
    }, function (response) {

        var length = response.data.length;
        $(".dropdown-list li", postblock).remove();
        for (var i = 0; i < length; i++) {

            $.ajax({
                type: 'POST',
                url: "/like/getCommentLikes",
                async: false,
                data: {"comment_id":response.data[i].sn,"csrf_token_name":$("input[name='csrf_token_name']").val()},
                dataType: 'json',
                success: function (resp) {
                    var comment = $(".post-comment").clone();
                    comment.removeClass("disable");
                    comment.removeClass("post-comment");
                    $(".user-pic-s a", comment).attr("href", "/page/info?i=" + response.data[i].member.member_id);
                    $(".user-pic-s img", comment).attr("src", response.data[i].member.avatar);
                    $(".items-name a", comment).html(response.data[i].member.nickname);
                    $(".items-name a", comment).attr("href", "/page/info?i=" + response.data[i].member.member_id);
                    $(".items-min", comment).html(response.data[i].create_time);


                    // response.data[i].friend_tags = JSON.stringify(response.data[i].friend_tags);
                    // for(var key in response.data[i].friend_tags){
                    //     alert(key);
                    // }
                    // var myJSON = response.data[i].friend_tags;
                    // for(var key in myJSON){
                    //     console.log(key);
                    // }
                    // console.log(myJSON);


                    var a = response.data[i].content.split(' ');
                    var b = response.data[i].content;
                    console.log(a);
                    // var b = JSON.stringify(response.data[i].friend_tags);
                    // console.log(b);

                    // var subdata = JSON.parse(response.data[i].friend_tags);
                    // var k = 0;
                    // var items = new Array();
                    //     for (var item in subdata){
                    //     // console.log( item +":" + subdata[item] )
                    //     items[k] = item;
                    //         k++;
                    //         console.log(items);
                    // }
                        if(b.indexOf("@")!=-1) {
                            var subdata = JSON.parse(response.data[i].friend_tags);

                            console.log(subdata);
                            var items = new Array();
                            for (var item in subdata) {

                                items.push(subdata[item]);
                                console.log(item);

                                b = b.replace("@" + item, "<a href='/page/info?i=" + subdata[item] + "' style='font-weight:lighter;color:mediumpurple' data-id='" + subdata[item] + "' data-nickname='" + item + "'>" + item + "</a>");
                            }
                        }

                    // var k=0;
                    // for(j=0;j<a.length;j++){
                    //     // if(a[j].indexOf("@"+k) === k)
                    //     // {
                    //         console.log(a[j]);
                    //         // console.log(items[k]);
                    //         // console.log(response.data[i].friend_tags);
                    //         // a[j] = "<a href='/page/info?i="+items[k]+"' style='font-weight:lighter;color:mediumpurple'>"+a[j]+"</a>";
                    //         b = b.replace(k,"<a href='/page/info?i="+items[k]+"' style='font-weight:lighter;color:mediumpurple'>"+k +"</a>");
                    //         console.log(b);
                    //         k++;
                    //     // }
                    // }


                    // response.data[i].content = response.data[i].content.replace(/@/g,'#');

                    $(".items-txt", comment).html(b);
                    $(".tool-num",comment).html(resp.data.length);
                    $(".tool-like",comment).attr("sn",response.data[i].sn);
                    if(response.data[i].isLike=="Y"){
                        $(".tool-like",comment).addClass("active");
                    }
                    if(response.data[i].member.member_id!=$("#selfid").val() && postblock.attr("pmsid")!=$("#selfid").val() || $(".edit-storage").hasClass("active")){
                        $(".cog-icon-wrap",comment).remove();
                    }else if(response.data[i].member.member_id!=$("#selfid").val() && postblock.attr("pmsid")==$("#selfid").val()){
                        $(".edit-comment",comment).remove();
                    }
                    $(".edit-post-drop",comment).hide();

                    $(".dropdown-list", postblock).append(comment);
                }})
        }

        $(".tool-message .tool-num", postblock).html(length);

    });
}


function loadMediaWidget(member_id) {
    ajaxPost("/picture/getPictures", {
        "member_id": member_id,
		"type":"media"
    }, function (response) {

        var length = response.data.length;

        $(".photo-list .media-widget-picture").remove();
        for (var i = 0; i < length; i++) {
            var picture = $(".media-widget-picture-object").clone();
            picture.removeClass("disable");
            picture.removeClass("media-widget-picture-object");
            picture.addClass("media-widget-picture");
            $("a", picture).attr("href", response.data[i].path);
            $("a img", picture).attr("src", response.data[i].path);
            $(".photo-list").append(picture);
        }

        $(".photo-list .picture_group").colorbox({
            rel: 'photo_list_picture_group',
            width: '80%',
            closeButton: true,
            scalePhotos: true,
            maxWidth: "80%",
            minWidth:"80%",
            onComplete:function(e){

                                var image_width = $(".cboxPhoto").width();
                                $("#cboxContent").css("width",image_width + "px");
                                $("#cboxLoadedContent").css("width",image_width + "px");
                                $("#cboxWrapper").css("width",image_width + "px");
                                $("#colorbox").css("width",image_width + "px");

                                // 置中
                                var body_width = $(document).width();
                                var new_left = body_width / 2 - image_width / 2;
                                $("#colorbox").css("left",new_left + "px");

            }
        });
    });
}

function loadMediaLightbox(member_id) {
    ajaxPost("/picture/getPictures", {
        "member_id": member_id,
		"type":"lightbox"
    }, function (response) {

        var length = response.data.length;

        $(".up-pic-wrap .up-pic-cnt").remove();
        for (var i = 0; i < length; i++) {
            var picture = $(".up-pic-cnt-object").clone();
            picture.removeClass("disable");
            picture.removeClass("up-pic-cnt-object");
            picture.addClass("up-pic-cnt");
            picture.attr("picture-id", response.data[i].picture_id);
            // $("a", picture).attr("href", response.data[i].path);
            $(".center-cropped-media-lightbox", picture).attr("src", response.data[i].path);
            $(".up-pic-wrap").append(picture);
        }

        $(".up-pic-cnt").unbind("click");
        $(".up-pic-cnt").click(function () {
            $(".up-pic-cnt").removeClass("center-cropped-media-lightbox-selected");
            $(this).addClass("center-cropped-media-lightbox-selected");
        });
    });
}

function loadPictures(member_id) {
    ajaxPost("/picture/getPictures", {
        "member_id": member_id
    }, function (response) {

        var length = response.data.length;

        $(".media-wrap .media-picture").remove();

        for (var i = 0; i < length; i++) {
            var picture = $(".media-picture-object").clone();

            picture.removeClass("media-picture-object");
            picture.addClass("media-picture");
            picture.attr("picture-id", response.data[i].picture_id);
            if(response.data[i].fileType=="movie"){
                $("a", picture).attr("href","javascript:void(0);").attr("vhref", response.data[i].path).removeClass("picture_group").addClass("movie");
                $("a img", picture).attr("src", "/assets/img/default_movie.jpg");

            }else{
                $("a", picture).attr("href", response.data[i].path);
                $("a img", picture).attr("src", response.data[i].path);
            }

            if(getQueryString("i")!=null){
                picture.insertBefore($(".media-wrap .add-btn"));
            }else{
                $(".media-wrap").append(picture);
            }

            picture.removeClass("disable");
        }

        $(".media-wrap .picture_group").colorbox({
            rel: 'picture_group',
            width:'80%',
            closeButton: true,
            scalePhotos: true,
            maxWidth: "80%",
            minWidth:"80%",
            onComplete:function(e){

                                var image_width = $(".cboxPhoto").width();
                                $("#cboxContent").css("width",image_width + "px");
                                $("#cboxLoadedContent").css("width",image_width + "px");
                                $("#cboxWrapper").css("width",image_width + "px");
                                $("#colorbox").css("width",image_width + "px");

                                // 置中
                                var body_width = $(document).width();
                                var new_left = body_width / 2 - image_width / 2;
                                $("#colorbox").css("left",new_left + "px");

            }
        });


        $(".center-cropped-media").css("height", ($(".media-add-btn img").width() + 8) + "px");



    });
}

function loadProfile(member_id) {
    //$(".profile").addClass("disable");
    // $(".edit-profile").hide();
    ajaxPost("/member/getMemberBrief", {
        "member_id": member_id
    }, function (response) {


        if(response.companies !== undefined){
            var com_length = response.companies.length;

            //console.log(response);
            var work_source = $(".profile .work.disable");
            for(var i=0;i<com_length;i++){
                var new_work = work_source.clone();
                new_work.removeClass("disable");
                new_work.html(response.companies[i].company + response.companies[i].position);
                new_work.insertBefore(work_source);
            }

            var work_source = $(".edit-profile .work.disable");
            for(var i=0;i<com_length;i++){
                var new_work = work_source.clone();
                new_work.removeClass("disable");
                new_work.html(response.companies[i].company + response.companies[i].position);
                new_work.insertBefore(work_source);
            }
        }

        if(response.schools !== undefined) {
            var school_length = response.schools.length;
            var school_source = $(".profile .school.disable");
            for (var i = 0; i < school_length; i++) {
                var new_school = school_source.clone();
                new_school.removeClass("disable");
                new_school.html(response.schools[i].school + response.schools[i].department);
                new_school.insertBefore(school_source);
            }

            var school_source = $(".edit-profile .school.disable");

            for (var i = 0; i < school_length; i++) {
                var new_school2 = school_source.clone();
                new_school2.removeClass("disable");
                new_school2.html(response.schools[i].school + response.schools[i].department);
                new_school2.insertBefore(school_source);
            }
        }

        $(".profile .cog-cnt h5").html(response.resume);
        //$(".profile .work").html(response.company);
        //$(".profile .school").html(response.school + " " + response.department);
        $(".profile .birth").html(response.birth);
        $(".profile .gender").html(response.gender);
        $(".profile .phone").html(response.phone);
        $(".profile .location").html(response.city);
        $(".profile .country").html(response.country);
        $(".profile .relationship").html(response.relationship);

        $(".profile").removeClass("disable");


        $(".edit-profile h5").html(response.resume);
        //$(".edit-profile .work").html(response.company);
        //$(".edit-profile .school").html(response.school + response.department);
        $(".edit-profile .birth").html(response.birth);
        $(".edit-profile .gender").html(response.gender);
        $(".edit-profile .phone").html(response.phone);
        $(".edit-profile .location").html(response.city);
        $(".edit-profile .country").html(response.country);
        $(".edit-profile .relationship").html(response.relationship);
        $(".edit-profile").show();
    });
}

function loadRecommend(member_id) {

    $(".follow").addClass("disable");

    ajaxPost("/page/recommendMembers", {
        "member_id": member_id
    }, function (response) {

        var length = response.data.length;
        if (length > 0) {
            $(".follow").removeClass("disable");
        }
        $(".follow .follow-list ul li").remove();
        for (var i = 0; i < length; i++) {
            if(response.data[i].member_id==member_id ||($("#selfid").length>0 && response.data[i].member_id==$("#selfid").val())){//排除自己
                continue;
            }

            var follow = $(".follow-item").clone();
            follow.removeClass("disable");
            follow.removeClass("follow-item");
            $(".follow-cnt a", follow).attr("href", "/page/info?i=" + response.data[i].member_id);

            if (response.data[i].avatar == null || response.data[i].avatar == '' || response.data[i].avatar == undefined) {
                $(".follow-cnt .user-pic-m img", follow).attr("src", "/assets/img/self-user-pic.jpg");
            }
            else {
                $(".follow-cnt .user-pic-m img", follow).attr("src", response.data[i].avatar);
            }


            $(".follow-cnt .pic-m-info h5", follow).html(response.data[i].nickname);
            $(".follow-cnt .pic-m-info level", follow).html(response.data[i].level);

            $(".follow-btn-wrap", follow).attr("trace-id", response.data[i].member_id);

            $(".follow .follow-list ul").append(follow);

        }

        recommendListener();
    });
}

function loadOnlineFriends() {

    ajaxPost("/friend/getOnlineFriends", {
    }, function (response) {
        if(response.status == "success"){

            var length = response.data.length;
            $(".online .follow-list ul li").remove();

            for(var i=0;i<length;i++){

                var friend = $(".online-friobj").clone();
                friend.attr("mid",response.data[i].member_id);
                friend.removeClass("disable").removeClass("online-friobj");
                $(".follow-btn-wrap>a", friend).attr("href", "/chat/"+ response.data[i].member_id);

                if (response.data[i].avatar == null || response.data[i].avatar == '' || response.data[i].avatar == undefined) {
                    $(".follow-cnt img", friend).attr("src", "/assets/img/self-user-pic.jpg");
                }
                else {
                    $(".follow-cnt img", friend).attr("src", response.data[i].avatar);
                }

                $(".follow-cnt h5", friend).html(response.data[i].nickname);
                $(".follow-cnt .lev-btn", friend).html("Lv."+response.data[i].level);
                $(".follow-cnt>a", friend).attr("href","/page/info?i="+response.data[i].member_id);
                $(".online .follow-list ul").append(friend);

            }
        }
    });
}

function loadInfoFollow(member_id) {

    $("#follower .list-cnt-wrap ul li").remove();

    ajaxPost("/trace/getTraceByMember", {
        "member_id": member_id
    }, function (response) {
        //console.log(response);

        var length = response.data.length;

        $(".edit-follower h4").html(length);

        $("#follower .list-cnt-wrap ul li").remove();
        for (var i = 0; i < length; i++) {
            var follow = $(".info-follow-item").clone();
            follow.removeClass("disable");
            follow.removeClass("info-follow-item");
            $(".list-cnt-l a", follow).attr("href", "/page/info?i=" + response.data[i].member_id);

            if (response.data[i].avatar == null || response.data[i].avatar == '' || response.data[i].avatar == undefined) {
                $(".user-pic-xl img", follow).attr("src", "/assets/img/self-user-pic.jpg");
            }
            else {
                $(".user-pic-xl img", follow).attr("src", response.data[i].avatar);
            }


            $(".pic-xl-info h3", follow).html(response.data[i].nickname);
            $(".pic-xl-info  level", follow).html(response.data[i].level);

            if(response.data[i].is_trace == "1"){
                $(".list-cnt-r .follow-btn", follow).addClass("active");
                $(".list-cnt-r .follow-btn", follow).html(descriArr["traced"]);
            }

            if(response.data[i].is_friend == "0"){
                if(response.data[i].invite_status != null && response.data[i].invite_status != undefined && response.data[i].invite_status != ''){
                    $(".list-cnt-r .friend-btn", follow).addClass("active").html(descriArr['friend_invited']);
                }
            }
            else{
                $(".list-cnt-r .friend-btn", follow).addClass("disable");
            }

            $(follow).attr("trace-id", response.data[i].member_id);

            $("#follower .list-cnt-wrap ul").append(follow);

        }

        followListener();
    });
}


function loadInfoFans(member_id) {

    $("#fans .list-cnt-wrap ul li").remove();

    ajaxPost("/trace/getMemberByTrace", {
        "member_id": member_id
    }, function (response) {
        //console.log(response);

        var length = response.data.length;
        $(".edit-fans h4").html(length);
        $("#fans .list-cnt-wrap ul li").remove();
        for (var i = 0; i < length; i++) {
            var follow = $(".info-fans-item").clone();
            follow.removeClass("disable");
            follow.removeClass("info-fans-item");
            $(".list-cnt-l a", follow).attr("href", "/page/info?i=" + response.data[i].member_id);

            if (response.data[i].avatar == null || response.data[i].avatar == '' || response.data[i].avatar == undefined) {
                $(".user-pic-xl img", follow).attr("src", "/assets/img/self-user-pic.jpg");
            }
            else {
                $(".user-pic-xl img", follow).attr("src", response.data[i].avatar);
            }




            $(".pic-xl-info h3", follow).html(response.data[i].nickname);
            $(".pic-xl-info level", follow).html(response.data[i].level);

            if(response.data[i].is_trace == "1"){
                $(".list-cnt-r .follow-btn", follow).addClass("active");
                $(".list-cnt-r .follow-btn", follow).html(descriArr["traced"]);
            }

            if(response.data[i].is_friend == "0"){
                if(response.data[i].invite_status != null && response.data[i].invite_status != undefined && response.data[i].invite_status != ''){
                    $(".list-cnt-r .friend-btn", follow).addClass("active").html(descriArr['friend_invited']);

                }
            }
            else{
                $(".list-cnt-r .friend-btn", follow).addClass("disable");
            }



            $(follow).attr("trace-id", response.data[i].member_id);

            $("#fans .list-cnt-wrap ul").append(follow);

        }

        fansListener();
    });
}


function loadFriendsWidget(member_id){
    ajaxPost("/friend/getFriendList", {
        "member_id" : member_id
    }, function (response) {
        if(response.status == "success"){
            var length = response.data.length;
            $(".friend-cog .friend-list article").remove();
            for(var i=0;i<length;i++){
                var friend = $(".friend-item-object").clone();
                friend.removeClass("disable");
                friend.removeClass("friend-item-object");
                friend.addClass("friend-item");

                $("a", friend).attr("href", "/page/info?i=" + response.data[i].member_id);

                if (response.data[i].avatar == null || response.data[i].avatar == '' || response.data[i].avatar == undefined) {
                    $("img", friend).attr("src", "/assets/img/self-user-pic.jpg");
                }
                else {
                    $("img", friend).attr("src", response.data[i].avatar);
                }

                $(".friend-cog .friend-list").append(friend);
            }
        }
    });
}

function loadFriends(member_id){
    ajaxPost("/friend/getFriendList", {
        "member_id" : member_id
    }, function (response) {
        //console.log(response);
        if(response.status == "success"){
            var length = response.data.length;
            $("#friend-list .list-cnt-wrap ul li").remove();
            for(var i=0;i<length;i++){
                var friend = $(".friend-list-item-object").clone();
                friend.removeClass("disable");
                friend.removeClass("friend-list-item-object");
                friend.addClass("friend-list-item");

                $(".list-cnt-l a", friend).attr("href", "/page/info?i=" + response.data[i].member_id);

                if (response.data[i].avatar == null || response.data[i].avatar == '' || response.data[i].avatar == undefined) {
                    $(".list-cnt-l .user-pic-xl img", friend).attr("src", "/assets/img/self-user-pic.jpg");
                }
                else {
                    $(".list-cnt-l .user-pic-xl img", friend).attr("src", response.data[i].avatar);
                }

                $(".list-cnt-l .pic-xl-info h3", friend).html(response.data[i].nickname);
                $(".list-cnt-l .pic-xl-info .level", friend).html(response.data[i].level);
                $(".chat-btn", friend).attr("href","../../../chat/"+response.data[i].member_id);

                if($("#selfid").val()!=member_id){
                    $(".list-cnt-r",friend).remove();
                }

                $("#friend-list .list-cnt-wrap ul").append(friend);

            }
        }
    });
}

/////////////////////////////////////////////////////////////
//                        領聽事件
/////////////////////////////////////////////////////////////

function postDeleteListener() {
    $('.post-delete').unbind("click");
    $('.post-delete').click(function () {
        var block = $(this).closest(".post-block");
        var member_id = $("input[name='member_id']").val();
        var post_id = block.attr("post-id");

        $("#confirm-delete-dialog .ok").unbind("click");
        $("#confirm-delete-dialog .ok").click(function () {
            if($('.tool-storage',block).hasClass("active")){
                $('.tool-storage',block).click();
            }

            ajaxPost("/post/delPost", {
                "post_id": post_id
            }, function (response) {
                if (response.status == "success") {
                    page=0;
                    if(location.href.indexOf("/hot/video")>-1){
                        loadHotVideos();
                    }else if(location.href.indexOf("/hot/post")>-1){
                        loadHotPosts();
                    }else{
                        loadPosts(member_id);
                    }
                    $.colorbox.close();
                }
            });
        });

        $("#confirm-delete-dialog .cancel").unbind("click");
        $("#confirm-delete-dialog .cancel").click(function () {
            $.colorbox.close();
            $(".edit-post-drop").slideUp(500);
        });

        $.colorbox({
            inline: true,
            width: "300px",
            height: "auto",
            overlayClose: true,
            closeButton: false,
            escKey: false,
            href: '#confirm-delete-dialog'
            //scalePhotos: true
        });


        return false;
    });
}

function sharesListener() {
    $(".tool-share").unbind("click");
    $(".tool-share").click(function () {

        var post_id = $(this).closest(".post-block").attr("post-id");

        ajaxPost("/post/getShares", {
            "post_id": post_id
        }, function (response) {

            var length = response.data.length;

            $("#share-post .shareCount").html(response.data.length);
            $("#share-post .share-content").val("");
            $("#share-post .share-publish").unbind("click");
            $("#share-post .share-publish").click(function () {
                // 分享
                //var content = $("#share-post .share-content").val();
                //console.log(content);
                postShare(post_id,$(this));
            });
            $("#share-post .share-list-cnt .dropdown-list li").remove();
            for (var i = 0; i < length; i++) {
                var share_post = $(".share-post").clone();
                share_post.removeClass("disable");
                share_post.removeClass("share-post");

                $(".user-pic-s a", share_post).attr("href", "/page/info?i=" + response.data[i].member.member_id);
                $(".user-pic-s img", share_post).attr("src", response.data[i].member.avatar);

                $(".items-name a", share_post).html(response.data[i].member.nickname);
                $(".items-name a", share_post).attr("href", "/page/info?i=" + response.data[i].member.member_id);
                $(".items-min", share_post).html(response.data[i].create_time);
                $(".items-txt", share_post).html(response.data[i].content);
                $("#share-post .share-list-cnt .dropdown-list").append(share_post);
            }

            $.colorbox({
                inline: true,
                width: "auto",
                height: "auto",
                overlayClose: true,
                closeButton: false,
                escKey: false,
                href: '#share-post'
                //scalePhotos: true
            });

        });

    });
}

function bindCommentLikeClick(){
    $("#post").on("click",".comment-like",function () {
        $(this).attr("disabled","disabled");
        var object =$(this);
        ajaxPost("/like/toggleCommentLike", {
            "comment_id": object.attr('sn'),
            "member_id": $("input[name='member_id']").val()
        }, function (response) {
            if (response.status == "success") {
                var num= parseInt(object.find(".tool-num").html());
                if (response.data == "yes") {
                    object.addClass("active");
                    object.find(".tool-num").html(num+1);
                }
                else {
                    object.removeClass("active");
                    object.find(".tool-num").html(num-1);
                }
            }
            $(this).removeAttr("disabled");

        });
    });
}

function likesListener() {
    $('.items-tool .tool-like').unbind("click");
    $('.items-tool .tool-like').click(function () {
        var block = $(this).closest(".post-block");
        var post_id = block.attr("post-id");
        var member_id = $("input[name='selfid']").val();
        var object = $(this);
        ajaxPost("/like/togglePostLike", {
            "post_id": post_id,
            "member_id": member_id
        }, function (response) {
            if (response.status == "success") {
                if (response.data == "yes") {
                    object.addClass("active");
                }
                else {
                    object.removeClass("active");
                }
            }

            loadlikesMember(post_id);
        });

        return false;
    });

    $('.items-like-txt a').unbind("click");
    $(".items-like-txt a").click(function () {


        var block = $(this).closest(".post-block");
        var post_id = block.attr("post-id");
        ajaxPost("/like/getPostLikes", {
            "post_id": post_id
        }, function (response) {

            $("#like-list .like-list-cnt li:gt(0)").remove();
            for(var i=0;i<response.data.length;i++){

                var clone = $("#like-list .like-list-cnt li:first").clone();
                $(".list-cnt-l a",clone).attr("href","info?i="+response.data[i].member_id);
                if (response.data[i].avatar == null || response.data[i].avatar == '' || response.data[i].avatar == undefined) {
                    $(".user-pic-s img",clone).attr("src", "/assets/img/self-user-pic.jpg");
                }else{
                    $(".user-pic-s img",clone).attr("src",response.data[i].avatar);
                }
                $(".pic-s-info h5",clone).text(response.data[i].nickname);
                $(".lev-btn",clone).text(response.data[i].level);

                $(".list-cnt-r",clone).attr("member-id",response.data[i].member_id);

                if($("#selfid").val()==response.data[i].member_id){
                    $(".follow-btn",clone).remove();
                    $(".friend-btn",clone).remove();
                }

                if(response.data[i].is_trace=="1"){
                    $(".follow-btn",clone).text(descriArr["traced"]).removeClass("disabled").addClass("active");
                }
                if(response.data[i].is_invite=="1"){
                    $(".friend-btn",clone).removeClass("disabled").addClass("active").html(descriArr['friend_invited']);
                }

                $("#like-list .like-list-cnt ul").append(clone.show());
            }
        });


        $.colorbox({
            inline: true,
            width: "450px",
            height: "auto",
            overlayClose: true,
            closeButton: false,
            escKey: false,
            href: '#like-list'
            //scalePhotos: true
        });
    });
}

function collectListener() {
    $('.tool-storage').unbind("click");
    $('.tool-storage').click(function () {
        var block = $(this).closest(".post-block");
        var post_id = block.attr("post-id");
        var member_id = $("input[name='member_id']").val();
        var object = $(this);
        ajaxPost("/post/collectPost", {
            "post_id": post_id,
            "member_id": member_id
        }, function (response) {
            if (response.status == "success") {
                var h4 =$(".edit-storage").find("h4");
                if (response.data == "yes") {
                    h4.html( parseInt(h4.html())+1);
                    object.addClass("active");
                }
                else {
                    if($(".edit-storage").hasClass("active")){
                        block.remove();
                    }
                    h4.html( parseInt(h4.html())-1);
                    object.removeClass("active");
                }
            }
        });

        return false;
    });
}

function commentsListener() {
    $('.items-dropdown-wrap#mes2').hide();
    $('.tool-message#mes2').unbind("click");
    $('.tool-message#mes2').click(function () {


        var block = $(this).closest(".post-block");
        $('.items-dropdown-wrap#mes2', block).slideToggle(500,function(){
            if(!$(this).is(":hidden")){
                if(!$(".comment-content",this).attr("clicked")){
                    initCmtFri($(".comment-content", block),block.attr("post-id"));
                }

                loadComments(block);
            }

        });

        return false;
    });

    $(".comment-publish").unbind("click");
    $(".comment-publish").click(function () {
        $(this).attr("disabled","disabled");
        var block = $(this).closest(".post-block");
        var post_id = block.attr("post-id");
        var content = $(".comment-content", block).val();
        postComment(post_id, content);
    });
}

function initCmtFri(inputor,postId) {
    var at_config = {
        at: "@",
        searchKey: "nickname",
        data: "/Tags/getTags",
        headerTpl: '<div class="atwho-header">Friends List</div>',
        insertTpl: '${nickname}',
        displayTpl: " <li fid='${member_id}'><div class=\"flyout-cnt\"><a href=\"#\"><div class=\"user-pic-s\"><img onerror=\"this.src='/assets/img/self-user-pic.jpg'\" src=\"${avatar}\"></div><div class=\"pic-s-info\"><span>${nickname}</span></div></a> </div></li>",
        limit: 200,
        postId:postId
    }

    inputor=inputor.atwho(at_config);
}

function userpicEditListener() {
    $(".cog-icon-l.userpic").unbind("click");
    $(".cog-icon-l.userpic").click(function (event) {

        $("#edit-self-pic .title").html(descriArr["edit_avatar"]);

        $("#edit-self-pic .ok").unbind("click");
        $("#edit-self-pic .ok").click(function () {

            var picture_src = $(".center-cropped-media-lightbox-selected img").attr("src");
            if(picture_src==undefined){
                $.colorbox.close();
                return false;
            }

            $(".cog-icon-l.banner").addClass("disable");

            $(".edit-pic img").attr("src", picture_src).load(function(){
                var w = $(this).width();
                var h = $(this).height();
                if(w > h){
                    $(this).height(400);
                }
                else{
                    $(this).width(400);
                }

            });
            //$(".edit-pic img").css("width","300px");
            //$(".edit-pic img").css("height","300px");
            $(".edit-pic img").css("max-width","none");
            $(".edit-pic-btn-w.userpic").removeClass("disable");
            $(".edit-pic-btn-w.userpic .check").unbind("click");
            $(".edit-pic-btn-w.userpic .check").click(function () {
                var picture_src = $(".center-cropped-media-lightbox-selected img").attr("src");
                var image = $(".edit-pic img").eq(1);
                if(image.length > 1){
                    image = image.eq(1);
                }
                //console.log(image);
                //console.log("X=" + image.position().left + ", Y=" + image.position().top + ", width=" + image.width() + ", height=" + image.height());
                ajaxPost("/picture/pictureSplit", {
                    "imagePath": picture_src,
                    "x": image.position().left,
                    "y": image.position().top,
                    "width": image.width(),
                    "height": image.height(),
                    "cutWidth": $(".edit-pic").width(),
                    "cutHeight": $(".edit-pic").height(),
                    "type": 'avatar'
                }, function (response) {
                    if (response.status == "success") {
                        location.reload();
                    }
                });
            });
            $(".edit-pic-btn-w.userpic .cancle").unbind("click");
            $(".edit-pic-btn-w.userpic .cancle").click(function () {
                location.reload();
            });

            $(".edit-pic-btn-w.userpic .zoomin").unbind("click");
            $(".edit-pic-btn-w.userpic .zoomin").click(function () {

                var image = $(".edit-pic img").eq(1);
                if(image.length > 1){
                    image = image.eq(1);
                }
                var current_width = parseInt(image.css("width").replace(/px/,""));
                var current_height = parseInt(image.css("height").replace(/px/,""));
                var rate = current_width / current_height;
                //console.log(current_width);
                //console.log(current_height);
                image.css("width", (current_width * 1.05) + "px");
                image.css("height", (current_height * 1.05) + "px");

            });

            $(".edit-pic-btn-w.userpic .zoomout").unbind("click");
            $(".edit-pic-btn-w.userpic .zoomout").click(function () {
                // $(".edit-pic img").css("max-width","none");
                $(".edit-pic img").css("min-width","210px");
                $(".edit-pic img").css("min-height","210px");
                var image = $(".edit-pic img").eq(1);
                if(image.length > 1){
                    image = image.eq(1);
                }
                var current_width = image.width();
                var current_height = image.height();
                image.css("width", (current_width * 0.95) + "px");
                image.css("height", (current_height * 0.95) + "px");


            });




            $(".edit-pic img").draggable({
                drag: function (event, ui) {
                    var border_width = $(".edit-pic").width();
                    var border_height = $(".edit-pic").height();

                    if (ui.position.left > 0) {
                        ui.position.left = 0;
                    }
                    if (ui.position.top > 0) {
                        ui.position.top = 0;
                    }
                    if (ui.position.left + ui.helper.width() < border_width) {
                        ui.position.left = border_width - ui.helper.width();
                    }
                    if (ui.position.top + ui.helper.height() < border_height) {
                        ui.position.top = border_height - ui.helper.height();
                    }

                }
            });


            $.colorbox.close();
        });

        var member_id = $("input[name='member_id']").val();
        loadMediaLightbox(member_id);

        $.colorbox({
            inline: true,
            width: "auto",
            height: "auto",
            overlayClose: true,
            closeButton: false,
            escKey: false,
            href: '#edit-self-pic'
            //scalePhotos: true
        });
    });
}

function bannerEditListener() {
    $(".cog-icon-l.banner").unbind("click");
    $(".cog-icon-l.banner").click(function (event) {

        $("#edit-self-pic .title").html(descriArr["edit_cover"]);

        $("#edit-self-pic .ok").unbind("click");
        $("#edit-self-pic .ok").click(function () {
            var picture_id = $(".center-cropped-media-lightbox-selected").attr("picture-id");
            var picture_src = $(".center-cropped-media-lightbox-selected img").attr("src");
            if(picture_src==undefined){
                $.colorbox.close();
                return;
            }

            $(".cog-icon-l.userpic").addClass("disable");

            $(".inner-header-cover img").attr("src", picture_src);

            $(".edit-pic-btn-w.banner").removeClass("disable");
            $(".edit-pic-btn-w.banner .check").unbind("click");
            $(".edit-pic-btn-w.banner .check").click(function () {
                var picture_src = $(".center-cropped-media-lightbox-selected img").attr("src");
                var image = $(".inner-header-cover img");

                ajaxPost("/picture/pictureSplit", {
                    "imagePath": picture_src,
                    "x": image.position().left,
                    "y": image.position().top,
                    "width": image.width(),
                    "height": image.height(),
                    "cutWidth": $(".inner-header-cover").width(),
                    "cutHeight": $(".inner-header-cover").height(),
                    "type": 'banner'
                }, function (response) {
                    if (response.status == "success") {
                        location.reload();
                    }
                });
            });
            $(".edit-pic-btn-w.banner .cancle").unbind("click");
            $(".edit-pic-btn-w.banner .cancle").click(function () {
                location.reload();
            });


            $(".inner-header-cover img").draggable({
                drag: function (event, ui) {
                    var border_width = $(".inner-header-cover").width();
                    var border_height = $(".inner-header-cover").height();

                    if (ui.position.left > 0) {
                        ui.position.left = 0;
                    }
                    if (ui.position.top > 0) {
                        ui.position.top = 0;
                    }
                    if (ui.position.left + ui.helper.width() < border_width) {
                        ui.position.left = border_width - ui.helper.width();
                    }
                    if (ui.position.top + ui.helper.height() < border_height) {
                        ui.position.top = border_height - ui.helper.height();
                    }

                }
            });
            $.colorbox.close();
        });

        var member_id = $("input[name='member_id']").val();
        loadMediaLightbox(member_id);

        $.colorbox({
            inline: true,
            width: "auto",
            height: "auto",
            overlayClose: true,
            closeButton: false,
            escKey: false,
            href: '#edit-self-pic'
            //scalePhotos: true
        });
    });
}

function friendSearchListener() {
    $("input[name='main_search']").keyup(function () {

        var keyword = $(this).val();

        ajaxPost("/page/memberQuery", {
            "keyword": keyword
        }, function (response) {

            if (response.status == "success") {
                $("#search-cnt .flyout-cnt-wrap ul li").remove();
                $("#search-cnt").addClass("disable");

                var length = response.data.length;
                if (length > 0) {
                    $("#search-cnt").removeClass("disable");
                    $(".flyout-box2").show();
                }
                for (var i = 0; i < length; i++) {
                    var search_item = $(".search-item").clone();
                    search_item.removeClass("disable");
                    search_item.removeClass("search-item");

                    if (response.data[i].avatar == null || response.data[i].avatar == '' || response.data[i].avatar == undefined) {
                        $("img", search_item).attr("src", "/assets/img/self-user-pic.jpg");
                    }
                    else {
                        $("img", search_item).attr("src", response.data[i].avatar);
                    }

                    $(".pic-s-info h5", search_item).html(response.data[i].nickname);
                    $(".pic-s-info h7", search_item).html(response.data[i].email);
                    $("a", search_item).attr("href", "/page/info?i=" + response.data[i].member_id);

                    $("#search-cnt .flyout-cnt-wrap ul").append(search_item);
                }
            }
        });
    });
}

function friendSearchMobileListener() {
    $("input[name='mobile_search'], input[name='mobile_search2']").keyup(function () {

        var keyword = $(this).val();

        ajaxPost("/page/memberQuery", {
            "keyword": keyword
        }, function (response) {

            if (response.status == "success") {
                $("#search-cnt .flyout-cnt-wrap ul li").remove();
                $("#search-cnt").addClass("disable");
                $("#search-cnt").css({"top":"80px"});

                var length = response.data.length;
                if (length > 0) {
                    $("#search-cnt").removeClass("disable");
                    $(".flyout-box2").show();
                }
                for (var i = 0; i < length; i++) {
                    var search_item = $(".search-item").clone();
                    search_item.removeClass("disable");
                    search_item.removeClass("search-item");

                    if (response.data[i].avatar == null || response.data[i].avatar == '' || response.data[i].avatar == undefined) {
                        $("img", search_item).attr("src", "/assets/img/self-user-pic.jpg");
                    }
                    else {
                        $("img", search_item).attr("src", response.data[i].avatar);
                    }

                    $(".pic-s-info h5", search_item).html(response.data[i].nickname);
                    $(".pic-s-info h7", search_item).html(response.data[i].email);
                    $("a", search_item).attr("href", "/page/info?i=" + response.data[i].member_id);

                    $("#search-cnt .flyout-cnt-wrap ul").append(search_item);
                }
            }
        });
    });
}


function recommendListener() {

    $(".follow .follow-list .follow-btn-wrap a.friend-btn").unbind("click");
    $(".follow .follow-list .follow-btn-wrap a.friend-btn").click(function () {
        var trace_id = $(this).parent().attr("trace-id");
        var object = $(this).attr("disabled","disabled");

        if (object.hasClass("active")) {

            ajaxPost("/invite/delInvite", {
                'invitee_id': trace_id
            }, function (response) {
                //console.log(response);
                if (response.status == "success") {
                    object.removeClass("active");
                    object.html(descriArr['friend_invite']);
                    object.removeAttr("disabled");
                }
            });
        }
        else {
            ajaxPost("/invite/addInvite", {
                'invitee_id': trace_id
            }, function (response) {
                //console.log(response);
                if (response.status == "success") {
                    object.addClass("active");
                    object.html(descriArr['friend_invited']);
                    object.removeAttr("disabled");
                }
            });
        }

    });

    $(".follow .cog-icon").unbind("click");
    $(".follow .cog-icon").click(function () {
        var member_id = $("input[name='member_id']").val();
        loadRecommend(member_id);
    });
}

function followListener() {
    $("#follower .list-cnt-wrap .list-cnt .friend-btn").unbind("click");
    $("#follower .list-cnt-wrap .list-cnt .friend-btn").click(function () {
        var trace_id = $(this).closest(".list-cnt").attr("trace-id");
        var object = $(this).attr("disabled","disabled");

        //var followBtn = object.siblings(".follow-btn");
        //if(followBtn.length==1 && !followBtn.hasClass("active") && !object.hasClass("active")){
        //    followBtn.click();
        //}

        if (object.hasClass("active")) {

            ajaxPost("/invite/delInvite", {
                'invitee_id': trace_id
            }, function (response) {
                //console.log(response);
                if (response.status == "success") {
                    object.removeClass("active");
                    object.html(descriArr['friend_invite']);
                    object.removeAttr("disabled");
                }
            });
        }
        else {
            ajaxPost("/invite/addInvite", {
                'invitee_id': trace_id
            }, function (response) {
                //console.log(response);
                if (response.status == "success") {
                    object.addClass("active");
                    object.html(descriArr['friend_invited']);
                    object.removeAttr("disabled");
                }
            });
        }

    });

    $("#follower .list-cnt-wrap .list-cnt .follow-btn").unbind("click");
    $("#follower .list-cnt-wrap .list-cnt .follow-btn").click(function (e) {
        var trace_id = $(this).closest(".list-cnt").attr("trace-id");

        var object = $(this);
        var h4 = $(".edit-follower").find("h4");
        if ($(this).hasClass("active")) {
            ajaxPost("/trace/delTrace", {
                'trace_id': trace_id
            }, function (response) {
                if (response.status == "success") {
                    if(h4.length>0){
                        h4.html(parseInt(h4.html())-1);
                    }
                    object.html(descriArr["trace"]);
                    object.removeClass("active");
                }
            });
        }
        else {
            ajaxPost("/trace/addTrace", {
                'trace_id': trace_id
            }, function (response) {
                if (response.status == "success") {
                    if(h4.length>0){
                        h4.html(parseInt(h4.html())+1);
                    }
                    object.html(descriArr["traced"]);
                    object.addClass("active");
                }
            });
        }
    });
}

function fansListener() {
    $("#fans .list-cnt-wrap .list-cnt .friend-btn").unbind("click");
    $("#fans .list-cnt-wrap .list-cnt .friend-btn").click(function () {
        var trace_id = $(this).closest(".list-cnt").attr("trace-id");
        var object = $(this).attr("disabled","disabled");

        //var followBtn = $(this).siblings(".follow-btn");
        //if(followBtn.length==1 && !followBtn.hasClass("active") && !object.hasClass("active")){
        //    followBtn.click();
        //}

        if (object.hasClass("active")) {

            ajaxPost("/invite/delInvite", {
                'invitee_id': trace_id
            }, function (response) {
                //console.log(response);
                if (response.status == "success") {
                    object.removeClass("active");
                    object.html(descriArr['friend_invite']);
                    object.removeAttr("disabled");
                }
            });
        }
        else {
            ajaxPost("/invite/addInvite", {
                'invitee_id': trace_id
            }, function (response) {
                //console.log(response);
                if (response.status == "success") {
                    object.addClass("active");
                    object.html(descriArr['friend_invited']);
                    object.removeAttr("disabled");
                }
            });
        }

    });

    $("#fans .list-cnt-wrap .list-cnt .follow-btn").unbind("click");
    $("#fans .list-cnt-wrap .list-cnt .follow-btn").click(function (e) {
        var trace_id = $(this).closest(".list-cnt").attr("trace-id");

        var h4= $(".edit-follower").find("h4");
        var object = $(this);
        if ($(this).hasClass("active")) {
            ajaxPost("/trace/delTrace", {
                'trace_id': trace_id
            }, function (response) {
                if (response.status == "success") {
                    if(h4.length>0){
                        h4.html(parseInt(h4.html())-1);
                    }
                    object.html(descriArr["trace"]);
                    object.removeClass("active");
                }
            });
        }
        else {
            ajaxPost("/trace/addTrace", {
                'trace_id': trace_id
            }, function (response) {
                if (response.status == "success") {
                    if(h4.length>0){
                        h4.html(parseInt(h4.html())+1);
                    }
                    object.html(descriArr["traced"]);
                    object.addClass("active");
                }
            });
        }
    });
}

function traceListener() {
    $(".edit-btn .follow-btn-l").unbind("click");
    $(".edit-btn .follow-btn-l").click(function () {
        var object = $(this);
        var member_id = $("input[name='member_id']").val();
        if (object.hasClass("active")) {
            ajaxPost("/trace/delTrace", {
                'trace_id': member_id
            }, function (response) {
                if (response.status == "success") {
                    object.html(descriArr["trace"]);
                    object.removeClass("active");
                }
            });
        }
        else {
            ajaxPost("/trace/addTrace", {
                'trace_id': member_id
            }, function (response) {
                if (response.status == "success") {
                    object.html(descriArr["traced"]);
                    object.addClass("active");
                }
            });
        }
    });
}
function  inviteBtnListen() {
    $(".edit-btn .friend-btn-l.finvite").unbind("click");
    $(".edit-btn .friend-btn-l.finvite").click(function () {
        var object = $(this).attr("disabled","disabled");

        //if(!$(".follow-btn-l").hasClass("active") && !object.hasClass("active")){
        //    $(".edit-btn .follow-btn-l").click();
        //}

        var member_id = $("input[name='member_id']").val();
        if (object.hasClass("active")) {

            ajaxPost("/invite/delInvite", {
                'invitee_id': member_id
            }, function (response) {
                //console.log(response);
                if (response.status == "success") {
                    object.removeClass("active");
                    object.html(descriArr['friend_invite']);
                    object.removeAttr("disabled");
                }
            });
        }
        else {
            ajaxPost("/invite/addInvite", {
                'invitee_id': member_id
            }, function (response) {
                //console.log(response);
                if (response.status == "success") {
                    object.addClass("active");
                    object.html(descriArr['friend_invited']);
                    object.removeAttr("disabled");
                }
            });
        }
    });
}
function friendListener() {
    inviteBtnListen();

    $("#acceptRequest").click(function () {
        $(this).attr("disabled","disabled");
        var memberId=$("input[name=member_id]").val();
        ajaxPost("/invite/setInviteStatus", {
            "invitee_id" : memberId,
            "status" : "1"
        }, function (response) {
            if(response.status == "success"){
                $("#acceptRequest").after($("<a class=\"chat-btn-l\" href=\"../../../chat/"+memberId+"\">"+descriArr["chat"]+"</a>"));
                $(".edit-btn .friend-btn-l").remove();
            }
        });
    })
    $("#refuseRequest").click(function () {
        $(this).attr("disabled","disabled");

        ajaxPost("/invite/setInviteStatus", {
            "invitee_id" : $("input[name=member_id]").val(),
            "status" : "0"
        }, function (response) {
            if(response.status == "success"){
                if($("#isInvite").val()=="1"){
                    $("#refuseRequest").after($("<a class=\"friend-btn-l finvite active\">"+descriArr["friend_invited"]+"</a>"));
                }
                if($("#isInvite").val()==""){
                    $("#refuseRequest").after($("<a class=\"friend-btn-l finvite\">"+descriArr["friend_invite"]+"</a>"));
                }

                inviteBtnListen();
                $("#acceptRequest,#refuseRequest").remove();
            }
        });
    })
}

///////////////////////////////////////////////////
///////////////////////////////////////////////////

//获取url参数值
function getQueryString(name)
{
    var reg = new RegExp("(^|&)"+ name +"=([^&]*)(&|$)");
    var r = window.location.search.substr(1).match(reg);
    if(r!=null)return  unescape(r[2]); return null;
}

function  tip(message){
    $("#tip-dialog .tip").html(message);
    $.colorbox({
        inline: true,
        width: "300px",
        height: "auto",
        overlayClose: true,
        closeButton: false,
        escKey: false,
        href: '#tip-dialog'
        //scalePhotos: true
    });
}
function  debug(mes) {
    //console.log(mes);
}
