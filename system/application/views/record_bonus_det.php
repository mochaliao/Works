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
		<span><?=$this->lang->line('trans_bonus')?></span>
	</div>
    
    <div><?=$this->lang->line('trans_level')?></div>
	<div class="inner-page-l">
		<ul class="table-type">
			<li>
				<div class="table-title">
					<span><img src="resource/img/icon-list4-1.svg"></span>
					<span><?=$this->lang->line('trans_date')?></span></div>
				<div class="table-cnt"><?=substr($data['create_date'], 0, 10)?></div>
			</li>
			<li>
				<div class="table-title">
					<span><img src="resource/img/icon-list4-2.svg"></span>
					<span><?=$this->lang->line('trans_level')?></span></div>
				<div class="table-cnt">LV.7</div>
			</li>
			<li>
				<div class="table-title">
					<span><img src="resource/img/icon-list4-3.svg"></span>
					<span><?=$this->lang->line('trans_block_money')?></span></div>
				<div class="table-cnt"><?=$data['block_money']?></div>
			</li>
			<li>
				<div class="table-title">
					<span><img src="resource/img/icon-list4-4.svg"></span>
					<span><?=$this->lang->line('trans_block_ipoint')?></span></div>
				<div class="table-cnt"><?=$data['block_ipoint']?></div>
			</li>
			<li>
				<div class="table-title">
					<span><img src="resource/img/icon-list4-5.svg"></span>
					<span><?=$this->lang->line('trans_link_cash')?></span></div>
				<div class="table-cnt"><?=$data['link_money']?></div>
			</li>
			<li>
				<div class="table-title">
					<span><img src="resource/img/icon-list4-6.svg"></span>
					<span><?=$this->lang->line('trans_link_ipoint')?></span></div>
				<div class="table-cnt"><?=$data['link_ipoint']?></div>                
			</li>
		</ul>
	</div>

</div>
<div class="main-bk container-fluid text-center">
	<? $this->load->view('include/footer') ?>
</div>

</body>
</html>
