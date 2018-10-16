<!DOCTYPE html>
<html>
<head>
<?$this->load->view('admin/include/meta')?>
<script>
CURRENT_PAGE = 'member/index';
</script>
</head>
<body>

<?$this->load->view('admin/include/header')?>

<main role="main" class="container">
   
    <h1><?=$this->lang->line('member_mng')?></h1>
    
    <?if($form_success){?><div class="alert alert-success" role="alert"><?=$form_success?></div><?}?>
    <?if($form_error){?><div class="alert alert-danger"  role="alert"><?=$form_error?></div><?}?>
    
    <div class="card">
        <div class="card-header">
            <ul class="nav nav-tabs card-header-tabs">
                <li class="nav-item">
                    <a class="nav-link" href="admin/member"><?=$this->lang->line('menu_member_list')?></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="admin/member/member_add"><?=$this->lang->line('menu_member_add')?></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="admin/member/member_upd/<?=$id?>"><?=$this->lang->line('menu_member_upd')?></a>
                </li>
            </ul>
        </div>
        <div class="card-body">
            
            <?=form_open('admin/member/member_upd/' . $id)?>
                
                <div class="form-row">
                
                    <div class="form-group col-md-6">
                        <label><?=$this->lang->line('member_introducer')?></label>
                        <input class="form-control" value="<?=$pname?>" disabled />
                    </div>
                    <div class="form-group col-md-6">
                        <label><?=$this->lang->line('member_team')?></label>
                        <input class="form-control" value="<?=$team_name?>" disabled />
                    </div>
                    
                    <div class="form-group col-md-6">
                        <label for="name"><?=$this->lang->line('member_name')?></label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="<?=$this->lang->line('member_name_plz')?>" value="<?=set_value('name', $name)?>" required minlength="2" maxlength="80" />
                    </div>
                    <div class="form-group col-md-6">
                        <label><?=$this->lang->line('member_login_account')?></label>
                        <input class="form-control" value="<?=$account?>" disabled />
                    </div>
                    
                    <div class="form-group col-md-6">
                        <label for="email"><?=$this->lang->line('member_email')?></label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="<?=$this->lang->line('member_email_plz')?>" value="<?=set_value('email', $email)?>" required />
                    </div>
                    <div class="form-group col-md-6">
                        <label for="phone"><?=$this->lang->line('member_phone')?></label>
                        <input type="text" class="form-control" id="phone" name="phone" placeholder="<?=$this->lang->line('member_phone_plz')?>" value="<?=set_value('phone', $phone)?>" />
                    </div>
                    
                    <div class="form-group col-md-6">
                        <label for="js-birthday"><?=$this->lang->line('member_birthday')?></label>
                        <input type="text" class="form-control" id="js-birthday" name="birthday" placeholder="<?=$this->lang->line('member_birthday_plz')?>" value="<?=set_value('birthday', $birthday)?>" readonly="readonly" />
                    </div>
                    <div class="form-group col-md-6">
                        <label for="address"><?=$this->lang->line('member_address')?></label>
                        <input type="text" class="form-control" id="address" name="address" placeholder="<?=$this->lang->line('member_address_plz')?>" value="<?=set_value('address', $address)?>" />
                    </div>
                    
                    <div class="form-group col-md-6">
                        <label for="certificate_id"><?=$this->lang->line('member_certificate_id')?></label>
                        <input type="text" class="form-control" id="certificate_id" name="certificate_id" placeholder="<?=$this->lang->line('member_certificate_id_plz')?>" value="<?=set_value('certificate_id', $certificate_id)?>" />
                    </div>
                    <div class="form-group col-md-6">
                        <label for="genderM"><?=$this->lang->line('member_gender')?></label>
                        <br />
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="gender" id="genderM" value="M" <?=set_radio('gender', 'M', ($gender == 'M' ? true : false))?> />
                            <label class="form-check-label" for="genderM"><?=$this->lang->line('male')?></label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="gender" id="genderF" value="F" <?=set_radio('gender', 'F', ($gender == 'F' ? true : false))?> />
                            <label class="form-check-label" for="genderF"><?=$this->lang->line('female')?></label>
                        </div>
                    </div>
                    
                    <div class="form-group col-md-6">
                        <label for="status1"><?=$this->lang->line('member_status')?></label>
                        <br />
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="status" id="status1" value="1" <?=set_radio('status', 1, ($status == 1 ? true : false))?> />
                            <label class="form-check-label" for="status1"><?=$this->lang->line('activated')?></label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="status" id="status2" value="0" <?=set_radio('status', 0, ($status == 0 ? true : false))?> />
                            <label class="form-check-label" for="status2"><?=$this->lang->line('inactivated')?></label>
                        </div>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="is_certified1"><?=$this->lang->line('member_certified')?></label>
                        <br />
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="is_certified" id="is_certified1" value="1" <?=set_radio('is_certified', 1, ($is_certified == 1 ? true : false))?> />
                            <label class="form-check-label" for="is_certified1"><?=$this->lang->line('certified')?></label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="is_certified" id="is_certified0" value="0" <?=set_radio('is_certified', 0, ($is_certified == 0 ? true : false))?> />
                            <label class="form-check-label" for="is_certified0"><?=$this->lang->line('un_certified')?></label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="is_certified" id="is_certified2" value="2" <?=set_radio('is_certified', 2, ($is_certified == 2 ? true : false))?> />
                            <label class="form-check-label" for="is_certified0"><?=$this->lang->line('wait_certified')?></label>
                        </div>
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

    // 日期選擇器套用
    $('#js-birthday').datepicker({
        changeYear  : true,
        changeMonth : true,
        dateFormat  : 'yy-mm-dd',
        defaultDate : '-40y'
    });
    
});
</script>