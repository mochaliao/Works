<!doctype html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=0">
    <link rel="icon" href="/assets/img/iami-logo-icon.png">
    <title>IAMI</title>
    <link rel="stylesheet" href="/assets/css/common.css">
    <link rel="stylesheet" href="/assets/css/reg-page.css">
</head>
<script src="/assets/js/commonJS.js"></script>
<style>
    .error-txt {
        visibility: visible;
    }
</style>
<body>
<?php echo $time_token_auth;?>
<div class="wrapper">
    <!--header-->
<!--    <div>--><?php //require_once "html/header2.html"; ?><!--</div>-->
    <?php $this->load->view('includes/header2');?>
    <!--main-->
    <div class="main-content">
        <div id="fg-ps-cnt" class="container-mid-c">
            <div class="content-area">
                <div class="ps-cnt">
                    <form class="ps-cnt-form form" action="/member/getPassword" method="POST" id="getpassword-form">
                        <input type="hidden" value="<?php echo $member_id?>" name="member_id">
                        <input type="hidden" value="<?php echo $key?>" name="active_auth">
                        <input type="hidden" value="<?php echo $time_token_auth?>" name="time_token">
                        <div>
                            <h1 class="color313131"><?php echo $this->lang->line('forget-password');?></h1>
                            <ul class="txt-left">
                                <li>
                                    <input type="password" class="add-tip" placeholder="<?php echo $this->lang->line('member_field_password');?>" name="newpassword" class="<?= empty(form_error('newpassword')) ? '' : 'error' ?>" value="<?php echo set_value('newpassword'); ?>"  required>
                                    <span class="error-txt"><?= form_error('newpassword'); ?></span>
                                </li>
                                <li>
                                    <input type="password" class="add-tip" placeholder="<?php echo $this->lang->line('member_field_repassword');?>" name="renewpassword" class="<?= empty(form_error('renewpassword')) ? '' : 'error' ?>" value="<?php echo set_value('renewpassword'); ?>" required>
                                    <span class="error-txt"><?= form_error('renewpassword'); ?></span>
                                </li>







                                <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>" />

                                <input type="hidden" name="member_id_password" value="<?php echo $member_id;?>">
                                <li>
                                    <button type="submit" class="btn-gold-gra">
                                        <a href="#" onclick="document.getElementById('getpassword-form').submit();" class="color313131"><?php echo $this->lang->line('confirm');?></a>
                                    </button>
                                </li>
                            </ul>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>

    <!--footer-->
<!--    <div id="fg-ps">--><?php //require_once "html/footer.html"; ?><!--</div>-->
    <?php $this->load->view('includes/footer2');?>
</div>

</body>
</html>