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
		<span><?=$this->lang->line('trans_wallet')?></span>
	</div>
	<div class="inner-page-l">
		<ul class="table-type">
			<li>
				<div class="table-title">
					<span><img src="resource/img/icon-list4-6.svg"></span>
					<span><?=$this->lang->line('trans_cash')?></span></div>
				<div class="table-cnt"><?=$data['money']?></div>
			</li>
			<li>
				<div class="table-title">
					<span><img src="resource/img/icon-list4-7.svg"></span>
					<span><?=$this->lang->line('trans_ipoint')?></span></div>
				<div class="table-cnt"><?=$data['ipoint']?></div>
			</li>
			<li>
				<div class="table-title">
					<span><img src="resource/img/icon-list4-8.svg"></span>
					<span><?=$this->lang->line('trans_system')?></span></div>
				<div class="table-cnt"><?=SITE_NAME?></div>
			</li>
			<li>
				<div class="table-title">
					<span><img src="resource/img/icon-list4-9.svg"></span>
					<span><?=$this->lang->line('trans_item')?></span></div>
				<div class="table-cnt"><?=$data['trans_name']?></div>
			</li>
			<li>
				<div class="table-title">
					<span><img src="resource/img/icon-list4-1.svg"></span>
					<span><?=$this->lang->line('trans_date')?></span></div>
				<div class="table-cnt"><?=substr($data['create_date'], 0, 10)?></div>
			</li>
			<li>
				<div class="table-title">
					<span><img src="resource/img/icon-list4-10.svg"></span>
					<span><?=$this->lang->line('trans_pay_name')?></span></div>
				<div class="table-cnt"><?=$data['pay_name']?></div>
			</li>
			<li>
				<div class="table-title">
					<span><img src="resource/img/icon-list4-11.svg"></span>
					<span><?=$this->lang->line('trans_balance_cash')?></span></div>
				<div class="table-cnt"><?=$data['wallet_cash']?></div>
			</li>
            <li>
				<div class="table-title">
					<span><img src="resource/img/icon-list4-11.svg"></span>
					<span><?=$this->lang->line('trans_balance_ipoint')?></span></div>
				<div class="table-cnt"><?=$data['wallet_ipoint']?></div>
			</li>
		</ul>
	</div>

</div>
<div class="main-bk container-fluid text-center">
	<? $this->load->view('include/footer') ?>
</div>

</body>
</html>
