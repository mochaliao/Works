<!DOCTYPE html>
<html>
<head>
	<? $this->load->view('include/meta') ?>
	<link type="text/css" rel="stylesheet" href="resource/css/inner-page.css"/>
</head>
<body>

<?$this->load->view('include/header')?>
<div class="inner-page-wrap">
	<div class="inner-header">
		<span><?=$this->lang->line('member_upd_pwd')?></span>
	</div>
	<div class="inner-page-s">
        <?=form_open('member/upd_pwd')?>

        <?if($form_success || $form_error){?>
            <?$this->load->view('include/dialog_form_1')?>
        <?}?>
            <div class="form-cnt">
                <ul>
                    <li>
                        <!--password old-->
                        <label for="pwd" class="sr-only"><?=$this->lang->line('member_old_pwd')?></label>
                        <input type="password" class="form-type" id="pwd" name="pwd" placeholder="<?=$this->lang->line('member_old_pwd')?>" value="<?=set_value('pwd')?>" autofocus required minlength="6" maxlength="12" />
                    </li>
                    <li>
                        <!--password-->
                        <label for="pwd_new" class="sr-only"><?=$this->lang->line('member_new_pwd')?></label>
                        <input type="password" class="form-type" id="pwd_new" name="pwd_new" placeholder="<?=$this->lang->line('member_new_pwd')?>" value="<?=set_value('pwd_new')?>" required minlength="6" maxlength="12"/>
                        <p class="form-excMark">
                            <span><img src="resource/img/icon-excMark-dis.svg"></span>
                            <span><?= $this->lang->line('password_plz') ?></span>
                        </p>
                    </li>
                    
                    <li>
                        <!--password check-->
                        <label for="pwd_new_check" class="sr-only"><?=$this->lang->line('member_new_pwd')?></label>
                        <input type="password" class="form-type" id="pwd_new_check" name="pwd_new_check" placeholder="<?= $this->lang->line
                        ('re_password_plz') ?>" value="<?=set_value('pwd_new')?>" required minlength="6" maxlength="12"/>
                        <p class="form-excMark">
                            <span><img src="resource/img/icon-excMark-dis.svg"></span>
                            <span><?= $this->lang->line('re_password_plz') ?></span>
                        </p>
                    </li>
                    
                    <li class="form-btn">
                        <button class="btn-block button btn1 btn-xl" type="submit"><?=$this->lang->line('ok')?></button>
                    </li>
                </ul>
            </div>
        </form>
	</div>

</div>
<div class="main-bk container-fluid text-center">
	<? $this->load->view('include/footer') ?>
</div>

</body>
</html>
