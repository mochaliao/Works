<!DOCTYPE html>
<html>
<head>
	<? $this->load->view('include/meta') ?>
	<link type="text/css" rel="stylesheet" href="resource/css/index.css"/>
</head>
<body>

<? $this->load->view('include/header') ?>

<div class="main-pic">
	<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
		<ol class="carousel-indicators">
			<li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
			<li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
			<li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
		</ol>
		<div class="carousel-inner">
			<div class="carousel-item carousel-cnt1_<?=LANG?> active"><a href="main/news/banner_info1" class="d-block"></a></div>
			<div class="carousel-item carousel-cnt2_<?=LANG?>"><a href="main/news/banner_info2" class="d-block"></a></div>
			<div class="carousel-item carousel-cnt3_<?=LANG?>"><a href="main/news/banner_info3" class="d-block"></a></div>
		</div>
		<a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
			<span class="carousel-control-prev-icon" aria-hidden="true"></span>
			<span class="sr-only">Previous</span>
		</a>
		<a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
			<span class="carousel-control-next-icon" aria-hidden="true"></span>
			<span class="sr-only">Next</span>
		</a>
	</div>
</div>

<div class="main-bk container-fluid text-center fixed-bottom">
	<? $this->load->view('include/footer') ?>
</div>
<script>

</script>
</body>
</html>