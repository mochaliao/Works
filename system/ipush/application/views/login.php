<!DOCTYPE html>
<html>
<head>
	<? $this->load->view('include/meta') ?>
	<link type="text/css" rel="stylesheet" href="resource/css/login.css"/>
</head>
<body>

<div class="signIn-wrap">
	<img class="login-logo" src="resource/img/logo-w.svg" alt="ips">
	<ul class="nav nav-tabs form-title" role="tablist">
        <li>
			<a class="nav-link <?= !$register ? 'active' : '' ?>" href="#signIn" role="tab" data-toggle="tab"><?=$this->lang->line('login')?></a>
        </li>
        <li>
			<a class="nav-link <?= $register  ? 'active' : '' ?>" href="#register" role="tab" data-toggle="tab"><?=$this->lang->line('register')?></a>
        </li>
	</ul>
	
	
	<div class="tab-content">
		<!-- signIn -->
		<div role="tabpanel" class="tab-pane fade <?= !$register ? 'show active' : '' ?>" id="signIn">
			
			<?= form_open('main/login', array('class' => 'form-signin')) ?>
			
			<? if ($form_success || $form_error) { ?>
				<? $this->load->view('include/dialog_form_1') ?>
			<? } ?>
			
			<div class="form-cnt">
				<ul>
					<li>
						<!--account-->
						<label for="login_account" class="sr-only"><?= $this->lang->line('account') ?></label>
						<input type="text" id="login_account" name="login_account" class="form-type" placeholder="<?= $this->lang->line('account') ?>" required minlength="4" maxlength="12" autofocus value="<?= set_value('login_account') ?>"/>
					</li>
					<li>
						<!--password-->
						<label for="login_pwd" class="sr-only"><?= $this->lang->line('password') ?></label>
						<input type="password" id="login_pwd" name="login_pwd" class="form-type" placeholder="<?= $this->lang->line('password') ?>" required minlength="6" maxlength="12" value="<?= set_value('login_pwd') ?>"/>
					</li>
					<li>
						<!--captcha-->
						<div>
							<input type="text" class="form-type" id="js-captcha" name="login_chkcode" placeholder="<?= $this->lang->line('chkcode') ?>" required minlength="4" maxlength="4"/>
						</div>
						<div id="js-captcha-box" class="input-group-prepend"></div>
					</li>
					<li class="form-btn">
						<button class="btn-block button btn1 btn-xl" type="submit"><?= $this->lang->line('login') ?></button>
					</li>
					<li>
						<a href="member/get_pwd" class="forget-ps-link"><?= $this->lang->line('forget_password') ?></a>
					</li>
				</ul>
			</div>
			
			</form>
		</div>
		<!-- register -->
		<div role="tabpanel" class="tab-pane fade <?= $register ? 'show active' : '' ?>" id="register">
			<?= form_open('main/login/register') ?>
			
			<? if ($form_success || $form_error) { ?>
				<? $this->load->view('include/dialog_form_1') ?>
			<? } ?>
			
			<div class="form-cnt">
				<ul>
					<li>
						<!--name-->
						<label for="name-reg" class="sr-only"><?= $this->lang->line('member_name') ?></label>
						<input type="text" id="name-reg" name="name" class="form-type" placeholder="<?= $this->lang->line('member_name') ?>" required autofocus value="<?= set_value('name') ?>" minlength="2" maxlength="40"/>
					</li>
					<li>
						<!--email-->
						<div>
							<label for="js-email" class="sr-only"><?= $this->lang->line('email') ?></label>
							<input type="email" id="js-email" name="email" class="form-type" placeholder="<?= $this->lang->line('email') ?>" required value="<?= set_value('email') ?>"/>
						</div>
						<div>
							<input type="button" id="js-send-chkcode" class="btn-block button btn1 btn-m" value="<?= $this->lang->line('send_chkcode') ?>"/>
						</div>
					</li>
					<li>
						<!--chkcode-->
						<input type="text" class="form-type" id="js-chkcode1" name="chkcode1" placeholder="<?= $this->lang->line('chkcode') ?>" required minlength="4" maxlength="4" value="<?= set_value('chkcode1') ?>"/>
						<input type="hidden" class="form-type" id="js-chkcode2" name="chkcode2" required minlength="4" maxlength="4" value="<?= set_value('chkcode2') ?>"/>
					</li>
					<li>
						<!--account-->
						<label for="account-reg" class="sr-only"><?= $this->lang->line('account') ?></label>
						<input type="text" id="account-reg" name="account" class="form-type" placeholder="<?= $this->lang->line('account') ?>" required value="<?= set_value('account') ?>" minlength="4" maxlength="12"/>
						<p class="form-excMark">
							<span><img src="resource/img/icon-excMark-dis.svg"></span>
							<span><?= $this->lang->line('account_plz') ?></span>
						</p>
					</li>
					<li>
						<!--password-->
						<label for="pwd-reg" class="sr-only"><?= $this->lang->line('password') ?></label>
						<input type="password" id="pwd-reg" name="pwd" class="form-type" placeholder="<?= $this->lang->line('password') ?>" required minlength="6" maxlength="12" value="<?= set_value('pwd') ?>"/>
						<p class="form-excMark">
							<span><img src="resource/img/icon-excMark-dis.svg"></span>
							<span><?= $this->lang->line('password_plz') ?></span>
						</p>
					</li>
					<li>
						<!--password check-->
						<label for="pwd-again" class="sr-only"><?= $this->lang->line('re_password') ?></label>
						<input type="password" id="pwd-again" name="re_pwd" class="form-type" placeholder="<?= $this->lang->line('re_password') ?>" required minlength="6" maxlength="12" value="<?= set_value('re_pwd') ?>"/>
						<p class="form-excMark">
							<span><img src="resource/img/icon-excMark-dis.svg"></span>
							<span><?= $this->lang->line('re_password_plz') ?></span>
						</p>
					</li>
					<li>
						<!--references-->
						<label for="references" class="sr-only"><?= $this->lang->line('member_introducer') ?></label>
						<input type="text" id="references" name="paccount" class="form-type" placeholder="<?= $this->lang->line('member_introducer') ?>" required minlength="4" maxlength="12" value="<?= set_value('paccount') ?>"/>
						<p class="form-excMark">
							<span><img src="resource/img/icon-excMark-dis.svg"></span>
							<span><?= $this->lang->line('member_introducer_plz') ?></span>
						</p>
					</li>
					<li class="text-left form-agree-term">
						<!--agree terms-->
						<label class="form-checkbox">
							<input type="checkbox" name="agree" value="1" required <?= set_checkbox('agree', '1') ?>>
							<span></span>
						</label>
						<span><?= $this->lang->line('agree') ?>
							<a href="member/terms"><?= $this->lang->line('member_terms') ?></a></span>
					</li>
					<li class="form-btn">
						<input type="submit" class="btn-block button btn1 btn-xl" value="<?= $this->lang->line('register') ?>"/>
					</li>
				</ul>
			</div>
			</form>
		
		</div>
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

    // 置入 Cpatcha
    comm.captcha($('#js-captcha-box'));

    // 發送驗證碼
    $('#js-send-chkcode').unbind('click').click(function(){
        var btn = $(this);
        if($.trim($('#js-email').val()) != '' && !btn.hasClass('disabled')){
            btn.addClass('disabled').val(comm.lang.sending_chkcode).text(comm.lang.sending_chkcode);
            var email = $.trim($('#js-email').val());
            comm.chkcode(email, function(res){
                if(res.success === true){
                    $('#js-chkcode1').attr('placeholder', comm.lang.send_chkcode_success);
                    $('#js-chkcode2').val(res.chkcode);
                }else{
                    $('#js-chkcode1').attr('placeholder', comm.lang.send_chkcode_failed);
                }
                btn.removeClass('disabled').val(comm.lang.re_send_chkcode).text(comm.lang.re_send_chkcode);
            });
        }
    });
    
});
</script>