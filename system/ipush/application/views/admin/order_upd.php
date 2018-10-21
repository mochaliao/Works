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
                    <a class="nav-link" href="admin/order/order_add"><?=$this->lang->line('menu_order_add')?></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="admin/order/order_upd/<?=$id?>"><?=$this->lang->line('menu_order_upd')?></a>
                </li>
            </ul>
        </div>
        <div class="card-body">
            
            <?=form_open('admin/order/order_upd/' . $id)?>
                
                <div class="form-row">
                
                    <div class="form-group col-md-6">
                        <label><?=$this->lang->line('member')?></label>
                        <input class="form-control" value="<?=$name?>" disabled />
                    </div>
                    <div class="form-group col-md-6">
                        <label for="product_id"><?=$this->lang->line('order_product')?></label>
                        <select class="form-control" disabled>
                        <?foreach($products as $k => $v){?>
                            <option value="<?=$v['id']?>" <?=set_select('product_id', $v['id'], ( $product_id == $v['id'] ? true : false ))?>><?=$v['name']?> [ <?=$v['money']?> ]</option>
                        <?}?>
                        </select>
                    </div>
                    
                    <div class="form-group col-md-6">
                        <label for="pay_type"><?=$this->lang->line('order_pay_type')?></label>
                        <select class="form-control" id="pay_type" name="pay_type" required>
                        <?foreach($pay_types as $k => $v){?>
                            <option value="<?=$v['pay_type']?>" <?=set_select('pay_type', $v['pay_type'], ( $pay_type == $v['pay_type'] ? true : false ))?>><?=$v['pay_name']?></option>
                        <?}?>
                        </select>
                    </div>
                    <div class="form-group col-md-6">
                        <label><?=$this->lang->line('order_pay_date')?></label>
                        <input class="form-control" value="<?=$pay_date?>" disabled />
                    </div>
                    
                    <div class="form-group col-md-6">
                        <label><?=$this->lang->line('order_status')?></label>
                        <select class="form-control" id="status" name="status" disabled>
                            <option value="1" <?=set_select('status', 1,   ( $status == 1  ? true : false ))?>><?=$this->lang->line('order_status_activated')?></option>
                            <option value="0" <?=set_select('status', 0,   ( $status == 0  ? true : false ))?>><?=$this->lang->line('order_status_inactivated')?></option>
                            <option value="-1" <?=set_select('status', -1, ( $status == -1 ? true : false ))?>><?=$this->lang->line('order_status_invalid')?></option>
                        </select>
                    </div>
                    
                </div>
                
                <button type="submit" class="btn btn-primary"><?=$this->lang->line('submit')?></button>
            </form>
            
            
            
        </div>
    </div>
    
</main>

</body>
</html>

<script>
$(document).ready(function(){
    
    
    
});
</script>