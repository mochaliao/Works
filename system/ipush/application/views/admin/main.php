<!DOCTYPE html>
<html>
<head>
<?$this->load->view('admin/include/meta')?>
</head>
<body>

<?$this->load->view('admin/include/header')?>

<main role="main" class="container-fluid">
    
    <div class="starter">
        <h1><?=$this->lang->line('back_system_news');?></h1>
        <p class="lead"><?=$this->lang->line('back_system_news_tmp')?> ..</p>
        
        <br /><br />
        
        <table class="table table-hover table-dark table-bordered">
            <thead>
                <tr>
                    <th scope="col" width="60">#</th>
                    <th scope="col"><?=$this->lang->line('member_certificate_num_rows')?></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th scope="row">1</th>
                    <td><a class="btn btn-primary" href="admin/member/member_cert" target="_blank"><?=$certificate_need?></a></td>
                </tr>
            </tbody>
        </table>
        
        <table class="table table-hover table-dark table-bordered">
            <thead>
                <tr>
                    <th scope="col" width="60">#</th>
                    <th scope="col"><?=$this->lang->line('order_today_un_chk')?></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th scope="row">2</th>
                    <td><a class="btn btn-primary" href="admin/order/index" target="_blank"><?=$orders_need?></a></td>
                </tr>
            </tbody>
        </table>
        
    </div>

</main>

</body>
</html>