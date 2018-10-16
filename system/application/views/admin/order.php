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

   <h1><?=$this->lang->line('order_mng')?></h1>
   
   <div class="card">
        <div class="card-header">
            <ul class="nav nav-tabs card-header-tabs">
                <li class="nav-item">
                    <a class="nav-link active" href="admin/order"><?=$this->lang->line('menu_order_list')?></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="admin/order/order_add"><?=$this->lang->line('menu_order_add')?></a>
                </li>
            </ul>
        </div>
        <div class="card-body">
            <table id="data-table" class="table table-striped table-bordered nowrap" style="width:100%">
                <thead>
                    <tr>
                        <th><?=$this->lang->line('member_name')?></th>
                        <th><?=$this->lang->line('member_pname')?></th>
                        <th><?=$this->lang->line('member_tname')?></th>
                        <th><?=$this->lang->line('member_side')?></th>
                        <th><?=$this->lang->line('order_product')?></th>
                        <th><?=$this->lang->line('order_product_amount')?></th>
                        <th><?=$this->lang->line('order_product_times')?></th>
                        <th><?=$this->lang->line('order_product_iami_score')?></th>
                        <th><?=$this->lang->line('order_pay_type')?></th>
                        <th><?=$this->lang->line('order_pay_date')?></th>
                        <th><?=$this->lang->line('order_status')?></th>
                        <th><?=$this->lang->line('order_sys_member_name')?></th>
                        <th><?=$this->lang->line('order_create_date')?></th>
                        <th><?=$this->lang->line('action')?></th>
                    </tr>
                </thead>
                <tbody></tbody>
                <tfoot>
                    <tr>
                        <th><?=$this->lang->line('member_name')?></th>
                        <th><?=$this->lang->line('member_pname')?></th>
                        <th><?=$this->lang->line('member_tname')?></th>
                        <th><?=$this->lang->line('member_side')?></th>
                        <th><?=$this->lang->line('order_product')?></th>
                        <th><?=$this->lang->line('order_product_amount')?></th>
                        <th><?=$this->lang->line('order_product_times')?></th>
                        <th><?=$this->lang->line('order_product_iami_score')?></th>
                        <th><?=$this->lang->line('order_pay_type')?></th>
                        <th><?=$this->lang->line('order_pay_date')?></th>
                        <th><?=$this->lang->line('order_status')?></th>
                        <th><?=$this->lang->line('order_sys_member_name')?></th>
                        <th><?=$this->lang->line('order_create_date')?></th>
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
            url  : 'admin/interface/order/get_order',
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
            { name : 'product_name', data : 'product_name' },
            { name : 'product_money', data : 'product_money' },
            { name : 'product_times', data : 'product_times' },
            { name : 'product_ipoint', data : 'product_ipoint' },
            { name : 'pay_name', data : 'pay_name' },
            { name : 'pay_date', data : 'pay_date' },
            { name : 'status_name', data : 'status_name' },
            { name : 'sys_member_name', data : 'sys_member_name' },
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
        order : [[ 12, 'desc' ]],
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