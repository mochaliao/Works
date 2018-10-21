<!--colorbox-->
<link rel="stylesheet" href="/assets/js/colorbox/colorbox.css">
<script src="/assets/js/colorbox/jquery.colorbox-min.js"></script>

<!--jQuery UI-->
<script src="/assets/js/fileupload/vendor/jquery.ui.widget.js"></script>
<script src="/assets/js/fileupload/jquery.iframe-transport.js"></script>
<script src="/assets/js/fileupload/jquery.fileupload.js"></script>
<script src="/assets/js/nailthumb/jquery.nailthumb.1.1.min.js"></script>
<link rel="stylesheet" href="/assets/js/nailthumb/jquery.nailthumb.1.1.min.css">
<script src="/assets/js/jquery.cookie.js"></script>

<!--jQuery UI 2-->
<!--<script src="/assets/jquery-ui-1.12.1/external/jquery/jquery.js"></script>-->
<script src="/assets/jquery-ui-1.12.1/jquery-ui.min.js"></script>
<link rel="stylesheet" href="/assets/jquery-ui-1.12.1/jquery-ui.css"/>

<script src="/assets/js/at/jquery.caret.js"></script>
<!--<script src="https://ichord.github.io/Caret.js/src/jquery.caret.js"></script>-->
<script src="/assets/js/at/jquery.atwho.js"></script>
<link rel="stylesheet" href="/assets/js/at/jquery.atwho.min.css">

<!--切換中間版面內容-->
<script>
    //切換貼文、粉絲、追蹤、收藏、好友清單、編輯個人資料(info)
    $(document).ready(function () {
//貼文
        $('.edit-post').click(function () {
            $('.edit-cnt li.active').removeClass('active');
            $('.edit-post').addClass('active');
            $('#post').addClass('active');
            $('#fans.active').removeClass('active');
            $('#follower.active').removeClass('active');
            $('#storage.active').removeClass('active');
            $('#friend-list.active').removeClass('active');
            $('#info-edit-list.active').removeClass('active');
            <?php if(isset($isFriend) && isset($is_myself) && ($isFriend || $is_myself)):?>
            page = 0;
            loadPosts($("input[name='member_id']").val());
            <?php endif;?>
        });

//粉絲
        $('.edit-fans').click(function () {
            $('.edit-cnt li.active').removeClass('active');
            $('.edit-fans').addClass('active');
            $('#fans').addClass('active');
            $('#post.active').removeClass('active');
            $('#follower.active').removeClass('active');
            $('#storage.active').removeClass('active');
            $('#friend-list.active').removeClass('active');
            $('#info-edit-list.active').removeClass('active');
        });
//追蹤
        $('.edit-follower').click(function () {
            $('.edit-cnt li.active').removeClass('active');
            $('.edit-follower').addClass('active');
            $('#follower').addClass('active');
            $('#post.active').removeClass('active');
            $('#fans.active').removeClass('active');
            $('#storage.active').removeClass('active');
            $('#friend-list.active').removeClass('active');
            $('#info-edit-list.active').removeClass('active');
        });
//收藏
        $('.edit-storage').click(function () {
            $('.edit-cnt li.active').removeClass('active');
            $('.edit-storage').addClass('active');
            $('#storage').addClass('active');
            $('#post.active').removeClass('active');
            $('#fans.active').removeClass('active');
            $('#follower.active').removeClass('active');
            $('#friend-list.active').removeClass('active');
            $('#info-edit-list.active').removeClass('active');
        });
//好友
        $('.friend-cog .show-btn').click(function () {
            $('.edit-cnt li.active').removeClass('active');
            $('#friend-list').addClass('active');
            $('#post.active').removeClass('active');
            $('#fans.active').removeClass('active');
            $('#follower.active').removeClass('active');
            $('#storage.active').removeClass('active');
            $('#info-edit-list.active').removeClass('active');
        });
//編輯資料
        $('.profile .cog-icon a').click(function () {
            $('.edit-cnt li.active').removeClass('active');
            $('#info-edit-list').addClass('active');
            $('#friend-list.active').removeClass('active');
            $('#post.active').removeClass('active');
            $('#fans.active').removeClass('active');
            $('#follower.active').removeClass('active');
            $('#storage.active').removeClass('active');
        });
 <?php
            $show_type = isset($show_type) ? $show_type : "";
             if ($show_type == 'edit') {
                 echo '$(".profile .cog-icon a").click();';
             } elseif ($show_type == 'member_edit_password') {
                 echo '$(".modify-ps").click();';
             } elseif ($show_type == "friend_list") {
                 echo "$('.friend-cog .show-btn').click();";
             } elseif ($show_type == "collection_list") {
                 echo "$('.edit-storage').click();";
             } elseif ($show_type == "post") {
                 echo "$('.edit-post').click();";
             } elseif ($show_type == "fans") {
                 echo "$('.edit-fans').click();";
             } elseif ($show_type == "follower") {
                 echo "$('.edit-follower').click();";
             } elseif ($show_type == "change_password") {
                 echo "$('.edit-follower').click();";
             } elseif ($show_type == "change_success") {
                 echo "$('.edit-follower').click()";
             }

             if (!in_array($show_type, array("", "edit", "member_edit_password", "friend_list", "collection_list", "post", "fans", "follower", "Privacy", "Service", "change_password", "change_success"))) {
                 redirect("/page/pageNotFound");
             }


                 ?>
     $('#birth').datepicker({dateFormat: 'yy-mm-dd', changeYear: true, changeMonth: true, yearRange: '-100:+0'});
    });

     function addCompanyPosition() {
         var placeholder_company = '<?php echo $this->lang->line('member_field_company')?>';
         var placeholder_position = '<?php echo $this->lang->line('member_field_position')?>';
         $('#company_position').append('' +
             '<li>' +
             '<input name="company[]" type="text" class="input-type2" placeholder="' + placeholder_company + '"> ' +
             '<input name="position[]" type="text" class="input-type2" placeholder="' + placeholder_position + '">' +
             '</li>');
     }

     function addSchoolDepartment() {
         var placeholder_school = '<?php echo $this->lang->line('member_field_school')?>';
         var placeholder_department = '<?php echo $this->lang->line('member_field_department')?>';
         $('#school_department').append('' +
             '<li>' +
             '<input name="school[]" type="text" class="input-type2" placeholder="' + placeholder_school + '"> ' +
             '<input name="department[]" type="text" class="input-type2" placeholder="' + placeholder_department + '">' +
             '</li>');
     }

</script>

<!--修改密碼-->
<script>
    var show_type = '<?=$show_type?>';
    $(document).ready(function () {
        if (show_type == 'change_password') {
            $(".modify-ps").click();
        }<!--修改密碼-->
    });
</script>
