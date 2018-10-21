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

   <h1><?=$this->lang->line('menu_team_list')?></h1>
    
    <div class="card">
        <div class="card-header">
            <ul class="nav nav-tabs card-header-tabs">
                <li class="nav-item">
                    <a class="nav-link active" href="admin/team"><?=$this->lang->line('team_list')?></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="admin/team/team_add"><?=$this->lang->line('team_add')?></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="admin/team/team_upd"><?=$this->lang->line('team_upd')?></a>
                </li>
            </ul>
        </div>
        <div class="card-body">
            
            <table id="data-table" class="table table-striped table-bordered nowrap" style="width:100%">
                <thead>
                    <tr>
                        <th><?=$this->lang->line('team_name')?></th>
                        <th><?=$this->lang->line('team_leader')?></th>
                        <th><?=$this->lang->line('team_pname')?></th>
                        <th><?=$this->lang->line('team_status')?></th>
                        <th><?=$this->lang->line('create_date')?></th>
                        <th><?=$this->lang->line('action')?></th>
                    </tr>
                </thead>
                <tbody></tbody>
                <tfoot>
                    <tr>
                        <th><?=$this->lang->line('team_name')?></th>
                        <th><?=$this->lang->line('team_leader')?></th>
                        <th><?=$this->lang->line('team_pname')?></th>
                        <th><?=$this->lang->line('team_status')?></th>
                        <th><?=$this->lang->line('create_date')?></th>
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
        responsive  : true,
        serverSide  : true,
        searchDelay : 1000,
        ajax : {
            type : 'post',
            url  : 'admin/interface/team/get_team',
            data : function(d){
                return $.extend({}, d, {
                    [CSRF_NAME] : CSRF_HASH
                });
            }
        },
        columns : [
            { name : 'name', data : 'name' },
            { name : 'leader_name', data : 'leader_name' },
            { name : 'pname', data : 'pname' },
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
        order : [[ 4, 'asc' ]],
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