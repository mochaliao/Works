<!DOCTYPE html>
<html>
<head>
	<? $this->load->view('include/meta') ?>
	<link type="text/css" rel="stylesheet" href="resource/css/inner-page.css"/>
	<link type="text/css" rel="stylesheet" href="resource/css/table_sheet.css"/>
</head>
<body>

<? $this->load->view('include/header') ?>
<div class="inner-page-wrap">
	<div class="inner-header">
		<span><?=$this->lang->line('assets')?></span>
	</div>
	<div class="inner-page-l">
		<ul class="table-type">
			<li>
				<div class="table-title">
					<span><img src="resource/img/icon-list4-2.svg"></span>
					<span><?=$this->lang->line('assets_level')?></span></div>
				<div class="table-cnt">LV.<?=$member['level']?></div>
			</li>
			<li>
				<div class="table-title">
					<span><img src="resource/img/icon-i-points.svg"></span>
					<span>I Points</span></div>
				<div class="table-cnt"><?=$member['wallet_ipoint']?></div>
			</li>
			<li>
				<div class="table-title">
					<span><img src="resource/img/icon-list4-12.svg"></span>
					<span><?=$this->lang->line('assets_wallet_cash')?></span></div>
				<div class="table-cnt"><?=$member['wallet_cash']?></div>
			</li>
			<li>
				<div class="table-title">
					<span><img src="resource/img/icon-list4-5.svg"></span>
					<span><?=$this->lang->line('assets_link')?></span></div>
				<div class="table-cnt"><?=$bonus['link']?></div>
			</li>
			<li>
				<div class="table-title">
					<span><img src="resource/img/icon-list4-3.svg"></span>
					<span><?=$this->lang->line('assets_block_left')?></span></div>
				<div class="table-cnt"><?=$bonus['block']['left']?></div>
			</li>
			<li>
				<div class="table-title">
					<span><img src="resource/img/icon-list4-4.svg"></span>
					<span><?=$this->lang->line('assets_block_right')?></span></div>
				<div class="table-cnt"><?=$bonus['block']['right']?></div>
			</li>
		</ul>
	</div>

</div>
<div class="main-bk container-fluid text-center">
	<? $this->load->view('include/footer') ?>
</div>

</body>
</html>
