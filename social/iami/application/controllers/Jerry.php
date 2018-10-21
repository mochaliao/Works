<?php
class Jerry extends CI_Controller
{
	public function __construct()
	{
        parent::__construct();
        $this->load->model('member_model');
        $this->load->model('like_model');
        $this->load->model('invite_model');

        $this->load->library('form_validation');
	}

	public function connection(){
	   $this->load->library('bulloss');
       $this -> bulloss -> connection();
    }

    public function fileExists(){
        return qiniu_exists("/member_data/picture/89_picture_20180506164055_5aeebf973cbb4.jpeg");
var_dump($res);
        exit;
    }

    public function fileDelete(){
        $res = qiniu_delete("/member_data/picture/89_picture_20180506164055_5aeebf973cbb4.jpeg");

        exit;
    }

    public function fileList(){
        $files = qiniu_list("");
        echo "<pre>";
        print_r($files);
        echo "</pre>";

    }

    public function fileFormat(){
        $files = qiniu_list("/member");

        print_r($files);

        foreach($files as $file){
            qiniu_delete($file["key"]);
        }
    }

	public function sync_dev_to_test(){
	    echo shell_exec("/bin/cp -rp /var/www/html/iami/* /var/www/html/iami-test/");
    }

    public function convertMediaToOSS(){
        $imagePath = dirname(BASEPATH) . "/member_data/picture/";

        $files = scandir($imagePath);
        // print_r($files);

        $this->load->library('ResizeImage');
        $image = new ResizeImage();


        if(!file_exists(dirname(BASEPATH) . "/member_data/chat_files/lastkey.txt")){
            file_put_contents(dirname(BASEPATH) . "/member_data/chat_files/lastkey.txt", "-1");
        }

        $lastkey = (int)file_get_contents(dirname(BASEPATH) . "/member_data/chat_files/lastkey.txt");

        echo "總共：" . count($files) . "個檔案\r\n";
        foreach($files as $key => $file){
            if($key < $lastkey){
                continue;
            }
            if(in_array($file, array(".",".."))){
                continue;
            }

            if(is_dir($imagePath . $file)){
                continue;
            }

            echo $key . "==>" . $imagePath . $file . "\r\n";
            $ext = strtolower(pathinfo($file, PATHINFO_EXTENSION));
            if(in_array($ext, array("jpg", "jpeg", "png"))){

                // 翻轉到正常的圖片
                if(in_array($ext, array("jpg", "jpeg"))) {
                    if(!qiniu_exists($imagePath . $file)) {
                        image_fix_orientation($imagePath . $file);
                    }
                }

                echo $imagePath . "70p/" . $file . "\r\n";
                if(!file_exists($imagePath . "70p/" . $file)){
                    $image->load($imagePath . $file);
                    $image->scale(70);
                    $image->save($imagePath . "70p/" . $file);
                }
                if(!qiniu_exists($imagePath . "70p/" . $file, "70p/")){
                    upload_to_qiniu($imagePath . "70p/" . $file, "70p/");
                }


                echo $imagePath . "10x10/" . $file . "\r\n";
                if(!file_exists($imagePath . "10x10/" . $file)){
                    $image->load($imagePath . $file);
                    $image->resizeToFit(10,10);
                    $image->save($imagePath . "10x10/" . $file);
                }
                if(!qiniu_exists($imagePath . "10x10/" . $file, "10x10/")){
                    upload_to_qiniu($imagePath . "10x10/" . $file, "10x10/");
                }

            }

            if(!qiniu_exists($imagePath . $file)){
                upload_to_qiniu($imagePath . $file);
            }

            file_put_contents(dirname(BASEPATH) . "/member_data/chat_files/lastkey.txt", $key);
        }

        echo "END";
    }

    public function convertBannerToOSS(){
        $imagePath = dirname(BASEPATH) . "/member_data/banner/";

        $files = scandir($imagePath);
        // print_r($files);

        $this->load->library('ResizeImage');
        $image = new ResizeImage();

        if(!file_exists(dirname(BASEPATH) . "/member_data/chat_files/lastkey_banner.txt")){
            file_put_contents(dirname(BASEPATH) . "/member_data/chat_files/lastkey_banner.txt", "-1");
        }

        $lastkey = (int)file_get_contents(dirname(BASEPATH) . "/member_data/chat_files/lastkey_banner.txt");

        echo "總共：" . count($files) . "個檔案\r\n";
        foreach($files as $key => $file){

            if($key < $lastkey){
                continue;
            }

            if(in_array($file, array(".",".."))){
                continue;
            }

            if(is_dir($imagePath . $file)){
                continue;
            }

            echo $imagePath . $file . "\r\n";
            $ext = strtolower(pathinfo($file, PATHINFO_EXTENSION));
            if(in_array($ext, array("jpg", "jpeg", "png"))){

                // 翻轉到正常的圖片
                if(in_array($ext, array("jpg", "jpeg"))) {
                    if(!qiniu_exists($imagePath . $file)) {
                        image_fix_orientation($imagePath . $file);
                    }
                }

            }

            if(!qiniu_exists($imagePath . $file)){
                upload_to_qiniu($imagePath . $file);
            }

            file_put_contents(dirname(BASEPATH) . "/member_data/chat_files/lastkey_banner.txt", $key);
        }

        echo "END";
    }

    public function convertUserPicToOSS(){
        $imagePath = dirname(BASEPATH) . "/member_data/avatar/";

        $files = scandir($imagePath);
        // print_r($files);

        $this->load->library('ResizeImage');
        $image = new ResizeImage();

        if(!file_exists(dirname(BASEPATH) . "/member_data/chat_files/lastkey_avatar.txt")){
            file_put_contents(dirname(BASEPATH) . "/member_data/chat_files/lastkey_avatar.txt", "-1");
        }

        $lastkey = (int)file_get_contents(dirname(BASEPATH) . "/member_data/chat_files/lastkey_avatar.txt");

        echo "總共：" . count($files) . "個檔案\r\n";
        foreach($files as $key => $file){

            if($key < $lastkey){
                continue;
            }

            if(in_array($file, array(".",".."))){
                continue;
            }

            if(is_dir($imagePath . $file)){
                continue;
            }

            echo $imagePath . $file . "\r\n";
            $ext = strtolower(pathinfo($file, PATHINFO_EXTENSION));
            if(in_array($ext, array("jpg", "jpeg", "png"))){

                // 翻轉到正常的圖片
                if(in_array($ext, array("jpg", "jpeg"))) {
                    if(!qiniu_exists($imagePath . $file)) {
                        image_fix_orientation($imagePath . $file);
                    }
                }

            }

            if(!qiniu_exists($imagePath . $file)){
                upload_to_qiniu($imagePath . $file);
            }

            file_put_contents(dirname(BASEPATH) . "/member_data/chat_files/lastkey_avatar.txt", $key);
        }

        echo "END";
    }

    public function covertDBMembers(){
        $params = array();
        $sql = "SELECT * FROM v_members";
        $members = $this->db->query($sql, $params) -> result_array();

        $qiniuSetting = get_qiniu_oss_setting();
        $this -> load -> model("member_model");
        foreach($members as $member){
            $tmpMember = array();
            $tmpMember["member_id"] = $member["member_id"];
            $tmpMember["avatar"] = $qiniuSetting["baseUrl"] . basename($member["avatar"]);
            $tmpMember["banner"] = $qiniuSetting["baseUrl"] . basename($member["banner"]);
            print_r($tmpMember);
            $res = $this -> member_model -> editMember($tmpMember);
        }
    }

	public function sendmail2(){

	    $query["mail"] = "yenchiawei@gmail.com";
        $query["subject"] = 'IamI註冊通知信';
        $query["content"] = 'Testing the email <br /><b>class</b>.';

       // $this->email->subject('IamI註冊通知信');
        //$this->email->message('Testing the email <br /><b>class</b>.');

        $ch = curl_init();
        $post_fields = (true) ? $query : http_build_query($query);

        $options = array(
            CURLOPT_URL => "http://recharge.hengruishang.com/index.php/api/sendMail",
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HEADER => true,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_USERAGENT => "Mozilla/5.0 (Windows NT 5.1; rv:14.0) Gecko/20100101 Firefox/14.0.1",
            // CURLOPT_REFERER => $this -> referer
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => $post_fields
        );

        curl_setopt_array($ch, $options);
        $output = curl_exec($ch);


        $header_size = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
        $header = substr($output, 0, $header_size);
        $body = substr($output, $header_size);

        curl_close($ch);
        unset($ch);


        $result = json_decode($body);
        $email = "";
        if($result -> status == "success"){
            $email = "發送成功\r\n" . $email . "\r\n";
            return true;
        }
        else{
            $email = "發送失敗\r\n" . $email . "\r\n";
            return false;
        }
        echo $email;
    }

	public function sendmail(){
        $this->load->library('email');

        $this->email->from('jeff@phc-web.net', 'Jeff寄來的信');
        $this->email->to('yenchiawei@gmail.com');
        $this->email->cc('umpdsa@gmail.com');
        $this->email->bcc('yenchiawei.studio@gmail.com');

        $this->email->subject('IamI註冊通知信');
        $this->email->message('Testing the email <br /><b>class</b>.');

        $this->email->send();

        echo $this->email->print_debugger();
    }

    public function getNotifies(){
        $memberID = $this->session->userdata("member_id");
        $datas = $this -> like_model -> getNotifies($memberID , 100);

        foreach($datas["data"] as $key => $data){
            $member = $this -> member_model -> getMember($data -> member_id) -> row_array();
            $datas["data"][$key] -> member = $member;

        }
        $this -> load -> view("notice2_view", array(
            "member_id" => $memberID,
            "datas" => $datas["data"]
        ));
    }

    public function invite_notifies(){

        $invitee_id = $this->session->userdata('member_id');
        if (is_null($this->input->get_post('status'))){
            $status = 2;
        }else{
            $status = $this->input->get_post('status');
        }
        $start_row = $this->input->get_post('start_row');
        $return_rows = $this->input->get_post('return_rows');
        $members = $this->invite_model->getMemberByInvitee($invitee_id, $status, $start_row, $return_rows)->result_array();


        $this -> load -> view("invite_notice_view", array(
            "member_id" => $invitee_id,
            "datas" => $members
        ));
    }

    public function message_notifies(){

        $master = $this->session->userdata('member_id');

        // $master = '1';
        // $client = '2';
        // $group = $this->input->get('group');
        $this->load->model('Chat_Model','CM');
        $msg = $this->CM->getChat($master);
        $array = array();
        foreach ($msg->result() as $row)
        {
            $array[] = $row;
        }

        $this -> load -> view("message_notice_view", array(
            "member_id" => $master,
            "datas" => $array
        ));
    }





}
?>