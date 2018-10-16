<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jeff extends CI_Controller
{
    public function __construct ()
    {
        parent::__construct ();
    }

    public function test()
    {
        $this->load->model('bonus_md');
        //$this->bonus_md->do_bonus(5, '2018-08-07');
        $members = $this->member_md->get_all_children(1, 'DESC')->result_array();
        print_r($members);
    }

    public function index()
    {
        $this->load->library('email');
        $config['protocol'] = 'sendmail';
        $config['smtp_host'] = 'mail.phc-web.net';
        $config['smtp_user'] = 'jeff';
        $config['smtp_pass'] = 'no0818';
        $config['smtp_port'] = '465';
        $config['smtp_crypto'] = 'ssl';
        $this->email->initialize($config);

        $this->email->from('jeff@phc-web.net', 'jeff');
        //$this->email->to('reddo5281@gmail.com');
        $this->email->to('reddo07@hotmail.com');
        $this->email->subject('Email Test');
        $this->email->message('Testing the email class.');
        if ($this->email->send()){
            echo "send email success !";
        }else{
            echo "send email failed";
        }

        //$result = sms($member_id, $message);
        //var_dump($result);
        //die();
        //$members = $this->member_md->get_member(1, NULL, NULL, NULL);
        //var_dump($members);
        //$this->load->model('member_md');
        //$result = $this->member_md->get_member_by_id(2);
        //var_dump($result);
    }

    public function gen_member_data($pid, $team_id, $rows)
    {
        set_time_limit(0);
        ob_end_clean();
        ob_implicit_flush();
        header('X-Accel-Buffering: no');

        $this->load->model('member_md');
        $pmember = $this->member_md->get_member($pid)->row_array();
        $genders = array('M', 'F');
        $insert_rows = 0;
        for ($i = 1; $i <= $rows; $i++){
            $member['pid'] = $pid;
            $member['team_id'] = $team_id;
            $member['email'] = $this->gen_ramdon_email();
            $member['account'] = explode('.', explode('@', $member['email'])[1])[0];
            $member['name'] = $pmember['name'].' - 下線'.date('YmdHis').'_'.$i;
            $member['pwd'] = '123456';
            $member['phone'] = $this->gen_random_phone();
            $member['gender'] = $genders[rand(0, 1)];
            $member['certificate_id'] = $this->gen_certficate_id();
            $member['is_certified'] = 1;
            $member['status'] = 1;
            if ($this->member_md->add_member($member)) {
                echo '新增會員('.$member['name'].') 成功 ! <br>';
                $insert_rows++;
            }else{
                echo '<div style="color:red; font-weight: bold;">新增會員('.$member['name'].') 失敗 ! </div><br>';
            }
        }
        echo '<hr>總共新增會員筆數: '.$insert_rows.'<hr>';
    }

    public function gen_order_data_by_member_id($member_id, $product_id = NULL, $pay_date = NULL, $rows = 1)
    {
        set_time_limit(0);
        ob_end_clean();
        ob_implicit_flush();
        header('X-Accel-Buffering: no');

        $this->load->model('member_md');
        $this->load->model('order_md');
        $this->load->model('product_md');

         $member = $this->member_md->get_member($member_id)->row_array();
        if (empty($pay_date) || strtoupper($pay_date) === 'NULL') $pay_date = date("Y-m-d H:i:s");
        $products = $this->product_md->get_product()->result_array();
        $pay_date_interval = 1;
        $pay_type = array('Cash', 'CEN', 'Paypal');
        $insert_rows = 0;
        for ($i = 1; $i <= $rows; $i++){
            $order['member_id'] = $member_id;
            $order['product_id'] = strtoupper($product_id) === 'NULL' ? $products[rand(0, sizeof($products) - 1)]['id'] : $product_id;
            $order['pay_type'] = $pay_type[rand(0, 2)];
            $order['pay_date'] = date("Y-m-d H:i:s", strtotime($pay_date." +".$pay_date_interval." seconds"));
            $order['status'] = 1;
            $order['sys_member_id'] = 1;
            $product = $this->product_md->get_product($order['product_id'])->row_array();
            if ($this->order_md->add_order($order)) {
                echo '新增訂單('.$member['name'].', '.$member['team_name'].', '.$order['pay_type'].', '.$product['name'].', '.$product['price'].') 成功 ! <br>';
                $insert_rows++;
            }else{
                echo '<div style="color:red; font-weight: bold;">新增訂單('.$member['name'].', '.$member['team_name'].', '.$order['pay_type'].', '.$product['name'].', '.$product['price'].') 失敗 ! </div><br>';
            }
        }
        echo '<hr>總共新增訂單筆數: '.$insert_rows.'<hr>';
    }

    public function gen_order_data_by_member_pid($pid, $pay_date = NULL, $rows = 1)
    {
        set_time_limit(0);
        ob_end_clean();
        ob_implicit_flush();
        header('X-Accel-Buffering: no');

        $this->load->model('member_md');
        $this->load->model('order_md');
        $this->load->model('product_md');

        $members = $this->member_md->get_member_by_pid($pid)->result_array();
        if (empty($pay_date)) $pay_date = date("Y-m-d H:i:s");
        $pay_date_interval = 1;
        $pay_type = array('Cash', 'CEN', 'Paypal');
        $insert_rows = 0;
        for ($i = 1; $i <= $rows; $i++){
            $member = $members[rand(0, sizeof($members) -1)];
            $order['member_id'] = $member['id'];
            $order['product_id'] = rand(1, 6);
            $order['pay_type'] = $pay_type[rand(0, 2)];
            $pay_date = date("Y-m-d H:i:s", strtotime($pay_date." +".$pay_date_interval." seconds"));
            $order['pay_date'] = $pay_date;
            $order['status'] = 1;
            $order['sys_member_id'] = 1;
            $product = $this->product_md->get_product($order['product_id'])->row_array();
            if ($this->order_md->add_order($order)) {
                echo '新增訂單('.$member['name'].', '.$member['team_name'].', '.$order['pay_type'].', '.$product['name'].', '.$product['price'].') 成功 ! <br>';
                $insert_rows++;
            }else{
                echo '<div style="color:red; font-weight: bold;">新增訂單('.$member['name'].', '.$member['team_name'].', '.$order['pay_type'].', '.$product['name'].', '.$product['price'].') 失敗 ! </div><br>';
            }
        }
        echo '<hr>總共新增訂單筆數: '.$insert_rows.'<hr>';
    }

    private function gen_ramdon_email()
    {
        $tlds = array("com", "net", "gov", "org", "edu", "biz", "info");
        $char = "0123456789abcdefghijklmnopqrstuvwxyz";

        $ulen = mt_rand(5, 10);
        $dlen = mt_rand(7, 17);

        $email = "";
        for ($i = 1; $i <= $ulen; $i++) {
            $email .= substr($char, mt_rand(0, strlen($char)), 1);
        }

        $email .= "@";
        for ($i = 1; $i <= $dlen; $i++) {
            $email .= substr($char, mt_rand(0, strlen($char)), 1);
        }

        $email .= ".";

        $email .= $tlds[mt_rand(0, (sizeof($tlds)-1))];

        return $email;
    }

    private function gen_random_phone()
    {
        $numbers = array('0','1','2','3','4','5','6','7','8','9');
        $phone = '09';
        for ($i = 1; $i <= 2; $i++) {
            $phone .= $numbers[rand(0, 9)];
        }

        $phone .= '-';

        for ($i = 1; $i <= 6; $i++) {
            $phone .= $numbers[rand(0, 9)];
        }

        return $phone;
    }

    private function gen_certficate_id()
    {
        $numbers = array('0','1','2','3','4','5','6','7','8','9');
        $num = rand(10, 20);
        $certificate_id = '';
        for ($i = 1; $i <= $num; $i++){
            $certificate_id .= $numbers[rand(0, 9)];
        }

        return $certificate_id;
    }

}