<!DOCTYPE html>
<html>
<head>
	<? $this->load->view('include/meta') ?>
	<link type="text/css" rel="stylesheet" href="resource/css/login.css"/>
</head>
<body>

<div class="signIn-wrap">
	<img class="login-logo" src="resource/img/logo-w.svg" alt="ips">
	<div class="nav nav-tabs form-title" role="tablist" id="modify-pwd-title-wrap">
		<a class="nav-link <?if(!$inner){?>active<?}?>" id="get-pwd-title" href="#get-pwd" role="tab" data-toggle="tab"><?=$this->lang->line('forget_password')?></a>
		<a class="nav-link <?if($inner) {?>active<?}?>" id="modify-pwd-title" href="#modify-pwd" role="tab" data-toggle="tab"><?=$this->lang->line('update_password')?></a>
	</div>
	<div class="tab-content">
		<?if(!$inner){?>
            <!-- get-pwd -->
                <div role="tabpanel" class="tab-pane fade show active" id="get-pwd">

                    <?=form_open('member/get_pwd')?>

                        <?if($form_success || $form_error){?>
                            <?$this->load->view('include/dialog_form_1')?>
                        <?}?>
                        <div class="form-cnt">
                            <ul>
                                <li>
                                    <!--account-->
                                    <label for="account-reg" class="sr-only"><?=$this->lang->line('account')?></label>
                                    <input type="text" id="account-reg" name="account" class="form-type" placeholder="<?=$this->lang->line('account')?>" required value="<?=set_value('account')?>" minlength="4" maxlength="12" />
                                    <p class="form-excMark">
                                        <span><img src="resource/img/icon-excMark-dis.svg"></span>
                                        <span><?=$this->lang->line('account_plz')?></span>
                                    </p>
                                </li>
                                <li>
                                    <!--email-->
                                    <label for="email" class="sr-only"><?=$this->lang->line('email')?></label>
                                    <input type="email" id="email" name="email" class="form-type" placeholder="<?=$this->lang->line('email')?>" value="<?=set_value('email')?>" autofocus required />
                                    <p class="form-excMark">
                                        <span><img src="resource/img/icon-excMark-dis.svg"></span>
                                        <span><?=implode('', array($this->lang->line('plz_enter'), $this->lang->line('email')))?></span>
                                    </p>
                                </li>
                                <li class="form-btn">
                                    <input type="hidden" name="mixed" value="" />
                                    <button class="btn-block button btn1 btn-xl" type="submit" onclick="$('input[name=mixed]').val($('input[name=account]').val()+'|'+$('input[name=email]').val())"><?=$this->lang->line('ok')?></button>
                                </li>
                            </ul>
                        </div>
                    </form>
                    
                </div>
        <?}else{?>
            <!-- modify-pwd -->
            <div role="tabpanel" class="tab-pane fade show active" id="modify-pwd">
                    <?=form_open('member/get_pwd/inner')?>

                        <?if($form_success || $form_error){?>
                            <?$this->load->view('include/dialog_form_1')?>
                        <?}?>
                        
                    <div class="form-cnt">
                        <ul>
                            <li>
                                <!--password-->
                                <label for="pwd-modify" class="sr-only"><?=$this->lang->line('member_new_pwd')?></label>
                                <input type="password" id="pwd-reg" name="pwd" class="form-type" placeholder="<?=$this->lang->line('member_new_pwd')?>" required minlength="6" maxlength="12" value="<?= set_value('pwd') ?>" />
                                <p class="form-excMark">
                                    <span><img src="resource/img/icon-excMark-dis.svg"></span>
                                    <span><?=$this->lang->line('password_plz')?></span>
                                </p>
                            </li>
                            <li>
                                <!--password check-->
                                <label for="pwd-modify-again" class="sr-only"><?=$this->lang->line('re_password')?></label>
                                <input type="password" id="pwd-again" name="re_pwd" class="form-type" placeholder="<?=$this->lang->line('re_password')?>" required minlength="6" maxlength="12" value="<?= set_value('re_pwd') ?>" />
                                <p class="form-excMark">
                                    <span><img src="resource/img/icon-excMark-dis.svg"></span>
                                    <span><?=$this->lang->line('re_password_plz')?></span>
                                </p>
                            </li>
                            <li class="form-btn">
                                <button class="btn-block button btn1 btn-xl" type="submit"><?=$this->lang->line('ok')?></button>
                            </li>
                        </ul>
                    </div>
                </form>
            </div>
        <?}?>
	</div>
	<? $this->load->view('include/footer') ?>
</div>
</body>
</html>

<script>
    $(document).ready(function () {

        // 切換語系
        $('.js-lang-switch').unbind('click').click(function () {
            comm.post($(this).attr('href'), {}, function () {
                document.location.reload();
            });
            return false;
        });

        // 開啟 modal
        $('#myModal').on('shown.bs.modal', function () {
            $('#myInput').trigger('focus')
        })
    });
</script>