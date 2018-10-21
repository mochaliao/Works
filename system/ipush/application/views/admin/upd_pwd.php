<!DOCTYPE html>
<html>
<head>
<?$this->load->view('admin/include/meta')?>
</head>
<body>

<?$this->load->view('admin/include/header')?>

<main role="main" class="container">

    <h1><?=$this->lang->line('member_upd_pwd')?></h1>
    
    <div class="card">
    
        <div class="card-header">&nbsp;</div>
    
        <div class="card-body">
            
            <?if($form_success){?><div class="alert alert-success" role="alert"><?=$form_success?></div><?}?>
            <?if($form_error){?><div class="alert alert-danger"  role="alert"><?=$form_error?></div><?}?>
            
            <?=form_open('admin/member/upd_pwd')?>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="pwd"><?=$this->lang->line('member_old_pwd')?></label>
                        <input type="password" class="form-control" id="pwd" name="pwd" placeholder="<?=$this->lang->line('plz_enter')?><?=$this->lang->line('member_old_pwd')?>" value="<?=set_value('pwd')?>" autofocus required minlength="6" maxlength="12" />
                    </div>
                    <div class="form-group col-md-6">
                        <label for="pwd_new"><?=$this->lang->line('member_new_pwd')?></label>
                        <input type="password" class="form-control" id="pwd_new" name="pwd_new" placeholder="<?=$this->lang->line('plz_enter')?><?=$this->lang->line('member_new_pwd')?>" value="<?=set_value('pwd_new')?>" required minlength="6" maxlength="12" />
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label for="js-captcha"><?=$this->lang->line('chkcode')?></label>
                        <div class="input-group mb-3">
                            <div id="js-captcha-box" class="input-group-prepend"></div>
                            <input type="text" class="form-control" id="js-captcha" name="chkcode" placeholder="<?=$this->lang->line('plz_enter')?><?=$this->lang->line('chkcode')?>" required minlength="4" />
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
    
    comm.captcha($('#js-captcha-box'));
    
});
</script>