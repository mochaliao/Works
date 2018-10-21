<!DOCTYPE html>
<html>
<head>
	<? $this->load->view('include/meta') ?>
	<link type="text/css" rel="stylesheet" href="resource/css/inner-page.css"/>
	<link type="text/css" rel="stylesheet" href="resource/css/upd_info.css"/>
</head>
<body>

<? $this->load->view('include/header') ?>
<div class="inner-page-wrap">
	<div class="inner-header">
		<span><?= $this->lang->line('member_certifite_upload') ?></span>
	</div>
	<div class="inner-page-m">
		<?= form_open_multipart('member/upd_info_upload') ?>
		<? if ($form_success || $form_error) { ?>
			<? $this->load->view('include/dialog_form_2') ?>
		<? } ?>
		<div>
			<ul>
				<li class="upd_info_wrap">
					<!--upload document-->
					<div>
						<? if ($certificate_file1 !== null) { ?>
							<div class="upd_info_pic">
								<img src="<?= $certificate_file1 ?>"/>
							</div>
						<? } ?>
						<button class=" button btn1 btn-l" type="button" onclick="$('input[name=certificate_file1]').trigger('click')"><?= $this->lang->line('member_certifite_upload_1') ?></button>
						<input type="file" style="display:none;" name="certificate_file1" value="<?= set_value('certificate_file1') ?>"/>
					</div>
					<div>
						<? if ($certificate_file2 !== null) { ?>
							<div class="upd_info_pic">
								<img src="<?= $certificate_file2 ?>"/>
							</div>
						<? } ?>
						<button class="button btn1 btn-l" type="button" onclick="$('input[name=certificate_file2]').trigger('click')"><?= $this->lang->line('member_certifite_upload_2') ?></button>
						<input type="file" style="display:none;" name="certificate_file2" value="<?= set_value('certificate_file1') ?>"/>
					</div>
				</li>
			</ul>
		</div>
		<div class="upd_info_btn">
			<div>
				<button class="btn-block button btn1 btn-xl" type="submit" <? if ($member['is_certified'] > 0){ ?>disabled<? } ?>><?= $this->lang->line('ok') ?></button>
				<p class="form-excMark">
					<span><img src="resource/img/icon-excMark-dis.svg"></span>
					<span><?= $this->lang->line('member_certifite_upload_note') ?></span>
				</p>
			</div>
		</div>
		</form>
	</div>

</div>
<div class="main-bk container-fluid text-center">
	<? $this->load->view('include/footer') ?>
</div>
</body>
</html>