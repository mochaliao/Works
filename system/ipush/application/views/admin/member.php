<!DOCTYPE html>
<html>
<head>
<?$this->load->view('admin/include/meta')?>
<script src="resource/plugin/datatables/datatables.min.js"></script>
<link type="text/css" rel="stylesheet" href="resource/plugin/datatables/datatables.min.css" />
</head>
<body>

<?$this->load->view('admin/include/header')?>

<main role="main" class="container">
   
    <h1><?=$this->lang->line('member_mng')?></h1>
    
    <div class="card">
        <div class="card-header">
            <ul class="nav nav-tabs card-header-tabs">
                <li class="nav-item">
                    <a class="nav-link active" href="admin/member"><?=$this->lang->line('menu_member_list')?></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="admin/member/member_add"><?=$this->lang->line('menu_member_add')?></a>
                </li>
            </ul>
        </div>
        <div class="card-body">
            
            <table id="data-table" class="table table-striped table-bordered nowrap" style="width:100%">
                <thead>
                    <tr>
                        <th><?=$this->lang->line('member_name')?></th>
                        <th><?=$this->lang->line('member_pname')?></th>
                        <th><?=$this->lang->line('member_team')?></th>
                        <th><?=$this->lang->line('member_side')?></th>
                        <th><?=$this->lang->line('member_certified')?></th>
                        <th><?=$this->lang->line('member_login_account')?></th>
                        <th><?=$this->lang->line('member_email')?></th>
                        <th><?=$this->lang->line('member_phone')?></th>
                        <th><?=$this->lang->line('member_gender')?></th>
                        <th><?=$this->lang->line('member_birthday')?></th>
                        <th><?=$this->lang->line('member_address')?></th>
                        <th><?=$this->lang->line('member_certificate_id')?></th>
                        <th><?=$this->lang->line('member_status')?></th>
                        <th><?=$this->lang->line('member_create_date')?></th>
                        <th><?=$this->lang->line('action')?></th>
                    </tr>
                </thead>
                <tbody></tbody>
                <tfoot>
                    <tr>
                        <th><?=$this->lang->line('member_name')?></th>
                        <th><?=$this->lang->line('member_pname')?></th>
                        <th><?=$this->lang->line('member_team')?></th>
                        <th><?=$this->lang->line('member_side')?></th>
                        <th><?=$this->lang->line('member_certified')?></th>
                        <th><?=$this->lang->line('member_login_account')?></th>
                        <th><?=$this->lang->line('member_email')?></th>
                        <th><?=$this->lang->line('member_phone')?></th>
                        <th><?=$this->lang->line('member_gender')?></th>
                        <th><?=$this->lang->line('member_birthday')?></th>
                        <th><?=$this->lang->line('member_address')?></th>
                        <th><?=$this->lang->line('member_certificate_id')?></th>
                        <th><?=$this->lang->line('member_status')?></th>
                        <th><?=$this->lang->line('member_create_date')?></th>
                        <th><?=$this->lang->line('action')?></th>
                    </tr>
                </thead>
                </tfoot>
            </table>
            
        </div>
    </div>
    
</main>

</body>
</html>

<script>
$(document).ready(function(){
    
    var table = $('#data-table').DataTable({
        responsive : true,
        serverSide : true,
        searchDelay : 1000,
        ajax : {
            type : 'post',
            url  : 'admin/interface/member/get_member',
            data : function(d){
                return $.extend({}, d, {
                    [CSRF_NAME] : CSRF_HASH
                });
            }
        },
        columns : [
            { name : 'name', data : 'name' },
            { name : 'pname', data : 'pname' },
            { name : 'team_name', data : 'team_name' },
            { name : 'side', data : 'side' },
            { name : 'is_certified_name', data : 'is_certified_name' },
            { name : 'account', data : 'account' },
            { name : 'email', data : 'email' },
            { name : 'phone', data : 'phone' },
            { name : 'gender', data : 'gender' },
            { name : 'birthday', data : 'birthday' },
            { name : 'address', data : 'address' },
            { name : 'certificate_id', data : 'certificate_id' },
            { name : 'status_name', data : 'status_name' },
            { name : 'create_date', data : 'create_date' },
            {
                name      : 'action',
                data      : 'action',
                className : 'text-center',
                render    : function(data){
                    return '<a class="btn btn-sm btn-primary" href="' + data + '" title="' + comm.lang.edit + '">' + comm.lang.edit + '</a>';
                }
            }
        ],
        order : [[ 13, 'asc' ]],
        language : {
            lengthMenu  : comm.lang.datatables_lengthMenu,
            search      : comm.lang.datatables_search,
            zeroRecords : comm.lang.datatables_zeroRecords,
            info        : comm.lang.datatables_info,
            infoEmpty   : comm.lang.datatables_infoEmpty,
            paginate    : {
                previous : comm.lang.datatables_paginate_previous,
                next     : comm.lang.datatables_paginate_next
            }
        }
    });
    new $.fn.dataTable.FixedHeader( table );
    
});
</script>