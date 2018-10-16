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
		<span>提現錢包</span>
	</div>
	<div class="inner-page-s">
		<div class="form-cnt">
			<ul>
				<li>
					<!--withdrawal-->
					<label for="wdrl" class="sr-only"><?=$this->lang->line('plz_enter')?>提現金額(USD)</label>
					<input type="text" class="form-type" id="wdrl" name="wdrl" placeholder="<?=$this->lang->line('plz_enter')?>提現金額(USD)" autofocus required/>
					<p class="form-excMark">
						<span><img src="resource/img/icon-excMark-dis.svg"></span>
						<span>確認後可由交易紀錄視察提現狀態</span>
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
