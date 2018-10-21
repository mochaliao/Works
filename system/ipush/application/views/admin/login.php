<!DOCTYPE html>
<html>
<head>
<?$this->load->view('admin/include/meta')?>
<link type="text/css" rel="stylesheet" href="resource/admin/css/login.css" />
</head>
<body class="text-center">

    <?=form_open('admin/main/login', array('class' => 'form-signin'))?>
        <img class="mb-4" src="resource/admin/img/logo.png" alt="" width="232" height="80">
        <h1 class="h3 mb-3 font-weight-normal"><?=$this->lang->line('back_system')?></h1>
        <?if($form_error){?><div class="alert alert-danger"  role="alert"><?=$form_error?></div><?}?>
        <label for="account" class="sr-only">Account</label>
        <input type="text" id="account" name="account" class="form-control" placeholder="Account" required minlength="5" maxlength="12" autofocus value="<?=set_value('account')?>" />
        <label for="pwd" class="sr-only">Password</label>
        <input type="password" id="pwd" name="pwd" class="form-control" placeholder="Password" required minlength="6" maxlength="12" value="<?=set_value('pwd')?>" />
        <div class="input-group mb-3">
            <div id="js-captcha-box" class="input-group-prepend"></div>
            <input type="text" class="form-control" id="js-captcha" name="chkcode" placeholder="<?=$this->lang->line('plz_enter')?><?=$this->lang->line('chkcode')?>" required minlength="4" maxlength="4" />
        </div>
        <div class="checkbox mb-3">
            <div class="dropdown">
                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?=$this->lang->line('language_switch')?></button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <a class="js-lang-switch dropdown-item <?if(LANG == 'zh-tw'){?>active<?}?>" href="main/lang/zh-tw">繁體中文</a>
                    <a class="js-lang-switch dropdown-item <?if(LANG == 'zh-cn'){?>active<?}?>" href="main/lang/zh-cn">简体中文</a>
                    <a class="js-lang-switch dropdown-item <?if(LANG == 'english'){?>active<?}?>" href="main/lang/english">English</a>
                </div>
            </div>
        </div>
        <button class="btn btn-lg btn-light btn-block" type="submit"><?=$this->lang->line('login')?></button>
        <p class="mt-5 mb-3 text-muted">&copy; 2017-<?=date('Y')?></p>
    </form>
    
</body>
</html>

<script>
$(document).ready(function(){
    
    // 綁定語系切換事件
    $('.js-lang-switch').unbind('click').click(function(){
        comm.post($(this).attr('href'), {}, function(){
            document.location.reload();
        });
        return false;
    });
    
    comm.captcha($('#js-captcha-box'));
    
});
</script>