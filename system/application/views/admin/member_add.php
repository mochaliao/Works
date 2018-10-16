<!DOCTYPE html>
<html>
<head>
<?$this->load->view('admin/include/meta')?>
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
                    <a class="nav-link active" href="admin/member/member_add"><?=$this->lang->line('menu_member_add')?></a>
                </li>
            </ul>
        </div>
        <div class="card-body">
            
            <?=form_open('admin/member/member_add')?>
                
                <div class="form-row">
                
                    <div class="form-group col-md-6">
                        <label for="p_name"><?=$this->lang->line('member_introducer')?></label>
                        <input type="text" class="form-control" id="p_name" name="p_name" placeholder="<?=$this->lang->line('member_introducer_plz')?>" value="<?=set_value('p_name')?>" readonly="readonly" data-toggle="modal" data-target="#js-member-modal" required />
                        <input type="hidden" class="form-control" id="p_id" name="p_id" value="<?=set_value('p_id')?>" readonly="readonly" required />
                    </div>
                    <div class="form-group col-md-6">
                        <label for="team_name"><?=$this->lang->line('member_team')?></label>
                        <input type="text" class="form-control" id="team_name" name="team_name" placeholder="<?=$this->lang->line('member_team_plz')?>" value="<?=set_value('team_name')?>" readonly="readonly" data-toggle="modal" data-target="#js-team-modal" />
                        <input type="hidden" class="form-control" id="team_id" name="team_id" value="<?=set_value('team_id')?>" readonly="readonly" />
                    </div>
                    
                    <div class="form-group col-md-6">
                        <label for="name"><?=$this->lang->line('member_name')?></label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="<?=$this->lang->line('member_name_plz')?>" value="<?=set_value('name')?>" required minlength="2" maxlength="80" />
                    </div>
                    <div class="form-group col-md-6">
                        <label for="account"><?=$this->lang->line('member_login_account')?></label>
                        <input type="text" class="form-control" id="account" name="account" placeholder="<?=$this->lang->line('member_login_account_plz')?>" value="<?=set_value('account')?>" required />
                    </div>
                    
                    <div class="form-group col-md-6">
                        <label for="pwd"><?=$this->lang->line('member_login_pwd')?></label>
                        <input type="password" class="form-control" id="pwd" name="pwd" placeholder="<?=$this->lang->line('member_login_pwd_plz')?>" value="<?=set_value('pwd')?>" required minlength="6" maxlength="12" />
                    </div>
                    <div class="form-group col-md-6">
                        <label for="email"><?=$this->lang->line('member_email')?></label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="<?=$this->lang->line('member_email_plz')?>" value="<?=set_value('email')?>" required />
                    </div>
                    
                    <div class="form-group col-md-6">
                        <label for="phone"><?=$this->lang->line('member_phone')?></label>
                        <input type="text" class="form-control" id="phone" name="phone" placeholder="<?=$this->lang->line('member_phone_plz')?>" value="<?=set_value('phone')?>" />
                    </div>
                    <div class="form-group col-md-6">
                        <label for="js-birthday"><?=$this->lang->line('member_birthday')?></label>
                        <input type="text" class="form-control" id="js-birthday" name="birthday" placeholder="<?=$this->lang->line('member_birthday_plz')?>" value="<?=set_value('birthday')?>" readonly="readonly" />
                    </div>
                    
                    <div class="form-group col-md-6">
                        <label for="address"><?=$this->lang->line('member_address')?></label>
                        <input type="text" class="form-control" id="address" name="address" placeholder="<?=$this->lang->line('member_address_plz')?>" value="<?=set_value('address')?>" />
                    </div>
                    <div class="form-group col-md-6">
                        <label for="certificate_id"><?=$this->lang->line('member_certificate_id')?></label>
                        <input type="text" class="form-control" id="certificate_id" name="certificate_id" placeholder="<?=$this->lang->line('member_certificate_id_plz')?>" value="<?=set_value('certificate_id')?>" />
                    </div>
                    
                    <div class="form-group col-md-6">
                        <label for="genderM"><?=$this->lang->line('member_gender')?></label>
                        <br />
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="gender" id="genderM" value="M" <?=set_radio('gender', 'M', true)?> />
                            <label class="form-check-label" for="genderM"><?=$this->lang->line('male')?></label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="gender" id="genderF" value="F" <?=set_radio('gender', 'F')?> />
                            <label class="form-check-label" for="genderF"><?=$this->lang->line('female')?></label>
                        </div>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="status1"><?=$this->lang->line('member_status')?></label>
                        <br />
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="status" id="status1" value="1" <?=set_radio('status', 1, true)?> />
                            <label class="form-check-label" for="status1"><?=$this->lang->line('activated')?></label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="status" id="status2" value="0" <?=set_radio('status', 0)?> />
                            <label class="form-check-label" for="status2"><?=$this->lang->line('inactivated')?></label>
                        </div>
                    </div>
                    
                    <div class="form-group col-md-6">
                        <label for="is_certified1"><?=$this->lang->line('member_certified')?></label>
                        <br />
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="is_certified" id="is_certified1" value="1" <?=set_radio('is_certified', 1, true)?> />
                            <label class="form-check-label" for="is_certified1"><?=$this->lang->line('certified')?></label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="is_certified" id="is_certified0" value="0" <?=set_radio('is_certified', 0)?> />
                            <label class="form-check-label" for="is_certified0"><?=$this->lang->line('un_certified')?></label>
                        </div>
                    </div>
                    
                </div>
                
                <button type="submit" class="btn btn-primary"><?=$this->lang->line('submit')?></button>
            </form>
            
            <?$this->load->view('admin/include/member_modal')?>
            <?$this->load->view('admin/include/team_modal')?>
            
        </div>
    </div>
    
</main>

</body>
</html>

<script>
$(document).ready(function(){
    
    // 介紹人選擇器套用
    comm.show_member($('#js-member-modal'), 0, $('input[name=p_id]'), $('input[name=p_name]'));
    
    // 團隊選擇器套用
    comm.show_team($('#js-team-modal'));
    
    // 日期選擇器套用
    $('#js-birthday').datepicker({
        changeYear  : true,
        changeMonth : true,
        dateFormat  : 'yy-mm-dd',
        defaultDate : '-40y'
    });
    
});
</script>