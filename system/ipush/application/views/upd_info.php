<!DOCTYPE html>
<html>
<head>
	<? $this->load->view('include/meta') ?>
	<link type="text/css" rel="stylesheet" href="resource/css/inner-page.css"/>
	<link type="text/css" rel="stylesheet" href="resource/css/upd_info.css"/>
	<link type="text/css" rel="stylesheet" href="resource/plugin/bootstrap/css/bootstrap-datepicker.css"/>
	<script src="resource/plugin/bootstrap/js/bootstrap-datepicker.js"></script>
	<script src="resource/plugin/bootstrap/js/bootstrap-datepicker.<?= LANG ?>.min.js"></script>
</head>
<body>

<? $this->load->view('include/header') ?>
<div class="inner-page-wrap">
	<div class="inner-header">
		<span><?= $this->lang->line('member_certifite') ?></span>
	</div>
	<div class="inner-page-s">
		<div class="form-cnt">
			<?= form_open('member/upd_info') ?>
			<? if ($form_success || $form_error) { ?>
				<? $this->load->view('include/dialog_form_2') ?>
			<? } ?>
			<ul>
				<li>
					<!--email-->
					<label for="email" class="sr-only"><?= $this->lang->line('email') ?></label>
					<input type="email" id="js-email" name="email" class="form-type" placeholder="<?= $this->lang->line('email') ?>" required value="<?= set_value('email', $member['email']) ?> " readonly/>
				</li>
				<li>
					<!--name-->
					<label for="name" class="sr-only"><?= $this->lang->line('member_name') ?></label>
					<input type="text" id="name" name="name" class="form-type" placeholder="<?= $this->lang->line('member_name') ?>" value="<?= set_value('name', $member['name']) ?>" required/>
				</li>
				<li class="birth-date-wrap">
					<!--birth-->
					<label><img src="resource/img/icon-arrow.svg"></label>
					<input type="text" class="birth-date form-type" id="js-birthday" name="birthday" placeholder="<?= $this->lang->line('member_birthday') ?>" data-provide="datepicker" value="<?= set_value('birthday', $member['birthday']) ?>" required/>
				</li>
				<li class="form-btn-m">
					<button id="js-certifite-upload" class="btn-block button btn1 btn-l" type="button" <? if ($member['is_certified'] > 0){ ?>disabled="disabled"<? } ?>><?= $this->lang->line('member_certifite_upload') ?></button>
				</li>
				<li class="form-btn">
					<button class="btn-block button btn1 btn-xl" type="submit" <? if ($member['is_certified'] > 0 || ($member['certificate_file1'] == null || $member['certificate_file2'] == null)){ ?>disabled="disabled"<? } ?>><?= $this->lang->line('member_certifite_submit') ?></button>
					<p class="form-excMark">
						<span><img src="resource/img/icon-excMark-dis.svg"></span>
						<span><?= $this->lang->line('member_certifite_txt') ?></span>
					</p>
				</li>
			</ul>
			</form>
		</div>
	</div>

</div>
<div class="main-bk container-fluid text-center">
	<? $this->load->view('include/footer') ?>
</div>
<script>
    $(document).ready(function () {

        // 套用日期選擇器
        $('#js-birthday').datepicker({
            format: 'yyyy-mm-dd',
            weekStart: 1,
            endDate: 'today',
            maxViewMode: 2,
            language: LANG,
            orientation: 'upper auto',
            todayHighlight: true
        });

        // 前往上傳
        $('#js-certifite-upload').unbind('click').click(function () {
            document.location.href = '<?=base_url('member/upd_info_upload')?>';
        });

    });
</script>
</body>
</html>