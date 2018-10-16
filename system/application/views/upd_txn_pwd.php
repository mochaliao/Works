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
		<span>修改交易密碼</span>
	</div>
	<div class="inner-page-s">
		<div class="form-cnt">
			<ul>
				<li>
					<!--password old-->
					<label for="txn_pwd" class="sr-only">原交易密碼</label>
					<input type="password" class="form-type" id="pwd" name="pwd" placeholder="原交易密碼" autofocus required
					minlength="6" maxlength="12" />
					<p class="form-excMark">
						<span><img src="resource/img/icon-excMark-dis.svg"></span>
						<span>首次變更請輸入登入密碼</span>
					</p>
				</li>
				<li>
					<!--password-->
					<label for="txn_pwd_new" class="sr-only">新交易密碼</label>
					<input type="password" class="form-type" id="pwd_new" name="pwd_new" placeholder="新交易密碼" value="" required minlength="6" maxlength="12"/>
					<p class="form-excMark">
						<span><img src="resource/img/icon-excMark-dis.svg"></span>
						<span><?= $this->lang->line('password_plz') ?></span>
					</p>
				</li>
				
				<li>
					<!--password check-->
					<label for="txn_pwd_new_check" class="sr-only">確認交易密碼</label>
					<input type="password" class="form-type" id="pwd_new_check" name="pwd_new_check" placeholder="確認交易密碼" value="" required minlength="6" maxlength="12"/>
					<p class="form-excMark">
						<span><img src="resource/img/icon-excMark-dis.svg"></span>
						<span><?= $this->lang->line('re_password_plz') ?></span>
					</p>
				</li>
				
				<li class="form-btn">
					<button class="btn-block button btn1 btn-xl" type="submit" disabled>確認</button>
				</li>
			</ul>
		</div>
	</div>

</div>
<div class="main-bk container-fluid text-center">
	<? $this->load->view('include/footer') ?>
</div>

</body>
</html>
