<!DOCTYPE html>
<html>
<head>
<?$this->load->view('admin/include/meta')?>
</head>
<body>

<?$this->load->view('admin/include/header')?>

<main role="main" class="container">

   <h1><?=$this->lang->line('order_mng')?></h1>
   
    <?if($form_success){?><div class="alert alert-success" role="alert"><?=$form_success?></div><?}?>
    <?if($form_error){?><div class="alert alert-danger"  role="alert"><?=$form_error?></div><?}?>
   
    <div class="card">
        <div class="card-header">
            <ul class="nav nav-tabs card-header-tabs">
                <li class="nav-item">
                    <a class="nav-link" href="admin/order"><?=$this->lang->line('menu_order_list')?></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="admin/order/order_add"><?=$this->lang->line('menu_order_add')?></a>
                </li>
            </ul>
        </div>
        <div class="card-body">
            
            <?=form_open('admin/order/order_add')?>
                
                <div class="form-row">
                
                    <div class="form-group col-md-6">
                        <label for="m_name"><?=$this->lang->line('member')?></label>
                        <input type="text" class="form-control" id="m_name" name="m_name" placeholder="<?=$this->lang->line('member_member_plz')?>" value="<?=set_value('m_name')?>" readonly="readonly" data-toggle="modal" data-target="#js-member-modal" required />
                        <input type="hidden" class="form-control" id="m_id" name="m_id" value="<?=set_value('m_id')?>" readonly="readonly" required />
                    </div>
                    <div class="form-group col-md-6">
                        <label for="product_id"><?=$this->lang->line('order_product')?></label>
                        <select class="form-control" id="product_id" name="product_id" required>
                            <option value="" <?=set_select('product_id', '', true)?>><?=$this->lang->line('order_product_plz')?></option>
                        <?foreach($products as $k => $v){?>
                            <option value="<?=$v['id']?>" <?=set_select('product_id', $v['id'])?>><?=$v['name']?> [ <?=$v['money']?> ]</option>
                        <?}?>
                        </select>
                    </div>
                    
                    <div class="form-group col-md-6">
                        <label for="pay_type"><?=$this->lang->line('order_pay_type')?></label>
                        <select class="form-control" id="pay_type" name="pay_type" required>
                            <option value="" <?=set_select('pay_type', '', true)?>><?=$this->lang->line('order_pay_type_plz')?></option>
                        <?foreach($pay_types as $k => $v){?>
                            <option value="<?=$v['pay_type']?>" <?=set_select('pay_type', $v['pay_type'])?>><?=$v['pay_name']?></option>
                        <?}?>
                        </select>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="js-pay-date"><?=$this->lang->line('order_pay_date')?></label>
                        <input type="text" class="form-control" id="js-pay-date" name="pay_date" placeholder="<?=$this->lang->line('order_pay_date_plz')?>" value="<?=set_value('pay_date')?>" readonly="readonly" required />
                    </div>
                    
                    <div class="form-group col-md-6">
                        <label for="status"><?=$this->lang->line('order_status')?></label>
                        <select class="form-control" id="status" name="status" required>
                            <option value="1" <?=set_select('status', 1, true)?>><?=$this->lang->line('order_status_activated')?></option>
                            <option value="0" <?=set_select('status', 0)?>><?=$this->lang->line('order_status_inactivated')?></option>
                            <option value="-1" <?=set_select('status', -1)?>><?=$this->lang->line('order_status_invalid')?></option>
                        </select>
                    </div>
                    
                </div>
                
                <button type="submit" class="btn btn-primary"><?=$this->lang->line('submit')?></button>
            </form>
            
            <?$this->load->view('admin/include/member_modal')?>
            
        </div>
    </div>
    
</main>

</body>
</html>

<script>
$(document).ready(function(){
    
    // 介紹人選擇器套用
    comm.show_member($('#js-member-modal'));
    
    // 日期選擇器套用
    $('#js-pay-date').datepicker({
        changeYear  : true,
        changeMonth : true,
        dateFormat  : 'yy-mm-dd'
    });
    
});
</script>