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
   
    <h1><?=$this->lang->line('menu_member_cert')?></h1>
    
    <div class="card">
        <div class="card-header">&nbsp;</div>
        <div class="card-body">
            
            <table id="data-table" class="table table-striped table-bordered nowrap" style="width:100%">
                <thead>
                    <tr>
                        <th><?=$this->lang->line('member_name')?></th>
                        <th><?=$this->lang->line('member_email')?></th>
                        <th><?=$this->lang->line('member_birthday')?></th>
                        <th>證件正面</th>
                        <th>證件背面</th>
                        <th><?=$this->lang->line('member_certified')?></th>
                        <th><?=$this->lang->line('member_create_date')?></th>
                    </tr>
                </thead>
                <tbody></tbody>
                <tfoot>
                    <tr>
                        <th><?=$this->lang->line('member_name')?></th>
                        <th><?=$this->lang->line('member_email')?></th>
                        <th><?=$this->lang->line('member_birthday')?></th>
                        <th>證件正面</th>
                        <th>證件背面</th>
                        <th><?=$this->lang->line('member_certified')?></th>
                        <th><?=$this->lang->line('member_create_date')?></th>
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
            url  : 'admin/interface/member/get_wait_member',
            data : function(d){
                return $.extend({}, d, {
                    [CSRF_NAME] : CSRF_HASH
                });
            }
        },
        columns : [
            { name : 'name', data : 'name' },
            { name : 'email', data : 'email' },
            { name : 'birthday', data : 'birthday' },
            {
                name      : 'certificate_file1',
                data      : 'certificate_file1',
                className : 'text-center',
                render    : function(data){
                    var obj = '<a class="btn btn-primary" href="' + data + '" target="_blank">' + '圖片' + '</a>';
                    return obj;
                }
            },
            {
                name      : 'certificate_file2',
                data      : 'certificate_file2',
                className : 'text-center',
                render    : function(data){
                    var obj = '<a class="btn btn-primary" href="' + data + '" target="_blank">' + '圖片' + '</a>';
                    return obj;
                }
            },
            {
                name      : 'is_certified',
                data      : 'is_certified',
                className : 'text-center',
                render    : function(data){
                    var obj = '<a class="btn btn-primary" href="' + data + '" target="_blank">' + comm.lang.wait_certified + '</a>';
                    return obj;
                }
            },
            { name : 'create_date', data : 'create_date' }
        ],
        order : [[ 0, 'asc' ]],
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