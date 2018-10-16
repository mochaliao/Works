<!DOCTYPE html>
<html>
<head>
<?$this->load->view('admin/include/meta')?>
</head>
<body>

<?$this->load->view('admin/include/header')?>

<main role="main" class="container">
   
    <h1><?=$this->lang->line('menu_team_list')?></h1>
    
    <?if($form_success){?><div class="alert alert-success" role="alert"><?=$form_success?></div><?}?>
    <?if($form_error){?><div class="alert alert-danger"  role="alert"><?=$form_error?></div><?}?>
    
    <div class="card">
        <div class="card-header">
            <ul class="nav nav-tabs card-header-tabs">
                <li class="nav-item">
                    <a class="nav-link" href="admin/team"><?=$this->lang->line('team_list')?></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="admin/team/team_add"><?=$this->lang->line('team_add')?></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="admin/team/team_upd"><?=$this->lang->line('team_upd')?></a>
                </li>
            </ul>
        </div>
        <div class="card-body">
            
            <?if($id === null){?>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <input type="text" class="form-control" id="team_pname" name="team_pname" placeholder="<?=$this->lang->line('member_team_plz')?>" readonly="readonly" data-toggle="modal" data-target="#js-team-modal" />
                        <input type="hidden" class="form-control" id="team_pid" name="team_pid" readonly="readonly" />
                    </div>
                    <div class="form-group col-md-6">
                        <button type="button" id="js-goto-edit" class="btn btn-primary"><?=$this->lang->line('ok')?></button>
                    </div>
                </div>
            <?}else{?>
                
                <?=form_open('admin/team/team_upd/' . $id)?>
                
                    <input type="hidden" class="form-control" id="team_id" name="team_id" readonly="readonly" value="<?=set_value('team_id', $id)?>" />
                    
                    <div class="form-row">
                    
                        <div class="form-group col-md-6">
                            <label for="leader_name"><?=$this->lang->line('team_leader')?></label>
                            <input type="text" class="form-control" id="leader_name" name="leader_name" placeholder="<?=$this->lang->line('team_leader_plz')?>" value="<?=set_value('leader_name', $leader_name)?>" readonly="readonly" data-toggle="modal" data-target="#js-member-modal" required />
                            <input type="hidden" class="form-control" id="leader_id" name="leader_id" value="<?=set_value('leader_id', $leader_id)?>" readonly="readonly" required />
                        </div>
                        <div class="form-group col-md-6">
                            <label for="team_pname"><?=$this->lang->line('team_pname')?></label>
                            <input type="text" class="form-control" id="team_pname" name="team_pname" placeholder="<?=$this->lang->line('team_pid_plz')?>" value="<?=set_value('team_pname', $pname)?>" readonly="readonly" data-toggle="modal" data-target="#js-team-modal" />
                            <input type="hidden" class="form-control" id="team_pid" name="team_pid" value="<?=set_value('team_pid', $pid)?>" readonly="readonly" />
                        </div>
                        
                        <div class="form-group col-md-6">
                            <label for="name"><?=$this->lang->line('team_name')?></label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="<?=$this->lang->line('team_name')?>" value="<?=set_value('name', $name)?>" required minlength="2" maxlength="80" />
                        </div>
                        <div class="form-group col-md-6">
                            <label for="status1"><?=$this->lang->line('team_status')?></label>
                            <br />
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="status" id="status1" value="1" <?=set_radio('status', 1, ( $status == 1 ? true : false ))?> />
                                <label class="form-check-label" for="status1"><?=$this->lang->line('activated')?></label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="status" id="status2" value="0" <?=set_radio('status', 0, ( $status == 0 ? true : false ))?> />
                                <label class="form-check-label" for="status2"><?=$this->lang->line('inactivated')?></label>
                            </div>
                        </div>
                        
                    </div>
                    
                    <button type="submit" class="btn btn-primary"><?=$this->lang->line('submit')?></button>
                </form>
                
            <?}?>
            
            <?$this->load->view('admin/include/member_modal')?>
            <?$this->load->view('admin/include/team_modal')?>
            
        </div>
    </div>
    
</main>

</body>
</html>

<script>
$(document).ready(function(){
    
    // 團隊領導者選擇器套用
    comm.show_member($('#js-member-modal'), 0, $('input[name=leader_id]'), $('input[name=leader_name]'), true);
    
    // 上層團隊選擇器套用
    comm.show_team($('#js-team-modal'), 0, $('input[name=team_pid]'), $('input[name=team_pname]'), <?=$id?>);
    
    // 前往編輯
    $('#js-goto-edit').unbind('click').click(function(){
        var team_id = $.trim($('input[name=team_pid]').val());
        if(team_id != '') document.location.href = '<?=current_url()?>' + '/' + team_id;
    });

});
</script>