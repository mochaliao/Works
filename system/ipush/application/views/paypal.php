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
		<span><?=$this->lang->line('member_paypal_set')?></span>
	</div>
	<div class="inner-page-s">
        <?=form_open('member/set_paypal')?>

        <?if($form_success || $form_error){?>
            <?$this->load->view('include/dialog_form_1')?>
        <?}?>
		<div class="form-cnt">
			<ul>
				<li>
					<!--withdrawal-->
					<label for="paypal" class="sr-only"><?=$this->lang->line('plz_enter')?><?=$this->lang->line('member_paypal_account')?></label>
					<input type="text" class="form-type" id="paypal" name="paypal_account" value="<?=set_value('paypal_account', $member['paypal_account'])?>" placeholder="<?=$this->lang->line('plz_enter')?><?=$this->lang->line('member_paypal_account')?>" autofocus required />
					
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
