<!DOCTYPE html>
<html>
<head>
	<? $this->load->view('include/meta') ?>
	<link type="text/css" rel="stylesheet" href="resource/css/inner-page.css"/>
	<link type="text/css" rel="stylesheet" href="resource/plugin/jquery-ui/jquery-ui.css"/>
	<script src="resource/plugin/jquery-ui/jquery-ui.min.js"></script>
	<link type="text/css" rel="stylesheet" href="resource/css/order_entry.css"/>
</head>

<body>

<? $this->load->view('include/header') ?>
<div class="inner-page-wrap">
	<div class="inner-header">
		<span><?=$this->lang->line('order_add')?></span>
	</div>
	<div class="inner-page-s">
		<div class="form-cnt">
        <?=form_open('order/order_add')?>
        
            <?if($form_success || $form_error){?>
                <?$this->load->view('include/dialog_form_1')?>
            <?}?>
            
			<ul>
				<li>
					<!--order entry-->
					<select name="product_id" id="plan">
						<optgroup style="background: #000">
                            <option selected disabled><?=$this->lang->line('order_product')?></option>
                        <?foreach($products as $k => $v){?>
                            <option value="<?=$v['id']?>" <?=set_select('product_id', $v['id'])?>><?=$v['name']?> [ <?=$v['money']?> ]</option>
                        <?}?>
						</optgroup>
					</select>
				</li>
				
				<li>
					<!--order entry-->
					<select name="pay_type" id="payway">
						<option selected disabled><?=$this->lang->line('order_pay_type')?></option>
                        <?foreach($pay_types as $k => $v){?>
                            <option value="<?=$v['pay_type']?>" <?=set_select('pay_type', $v['pay_type'])?>><?=$v['pay_name']?></option>
                        <?}?>
					</select>
				</li>
				
				<li class="form-btn">
					<button class="btn-block button btn1 btn-xl" type="submit"><?=$this->lang->line('ok')?></button>
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
        $("#plan").selectmenu();

        $("#payway").selectmenu();
    });
</script>
</body>
</html>
