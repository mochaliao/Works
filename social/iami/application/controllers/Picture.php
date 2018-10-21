<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Picture extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('picture_model');
        $this->load->model('member_model');
    }

    public function getPictures()
    {
        if (!isLogin(FALSE)){
            $result = array('status'=>'failed', 'message'=>$this->lang->line('member_not_login_error'), 'code'=>'M0001');
            echo json_encode($result, JSON_UNESCAPED_UNICODE);
            return FALSE;
        }

        if (!empty($this->input->get_post('member_id'))) {
            $memberID = $this->input->get_post('member_id');
        } else {
            $memberID = $this->session->userdata('member_id');
        }
        // $memberID = trim($this->input->get_post('member_id'));
		$type = $this->input->post('type');
        // 是否輸入會員識別碼
        if ((int)$memberID == 0) {
            echo json_encode(array(
                    'status' => 'failed',
                    'message' => $this->lang->line('post_no_member_id'),
                    'code' => 'P0001')
            );
            exit;
        }

        $res = $this->picture_model->getPictures($memberID,$type);
        echo json_encode($res);

    }

    public function delPicture()
    {

        if (!isLogin(FALSE)){
            $result = array('status'=>'failed', 'message'=>$this->lang->line('member_not_login_error'), 'code'=>'M0001');
            echo json_encode($result, JSON_UNESCAPED_UNICODE);
            return FALSE;
        }

        if (!empty($this->input->get_post('member_id'))) {
            $memberID = $this->input->get_post('member_id');
        } else {
            $memberID = $this->session->userdata('member_id');
        }
        $pictureID = trim($this->input->get_post('picture_id'));

        // 是否輸入貼文識別碼
        if ((int)$pictureID == 0) {
            echo json_encode(array(
                    'status' => 'failed',
                    'message' => $this->lang->line('picture_no_picture_id'),
                    'code' => 'PIC0001')
            );
            exit;
        }

        $res = $this->picture_model->delPicture($pictureID, $memberID);
        echo json_encode($res);
    }

    public function pictureSplit(){

        if (!empty($this->input->get_post('member_id'))) {
            $memberID = $this->input->get_post('member_id');
        } else {
            $memberID = $this->session->userdata('member_id');
        }



        $image = $this -> input -> post("imagePath");
        $x = $this -> input -> post("x");
        $y = $this -> input -> post("y");
        $width = $this -> input -> post("width");
        $height = $this -> input -> post("height");
        $cutWidth = $this -> input -> post("cutWidth");
        $cutHeight = $this -> input -> post("cutHeight");
        $type = $this -> input -> post("type");

        // OSS 檔案在遠端(路徑為http://開頭)，因此需要先抓下來
        $image_content = file_get_contents($image);
        $image = dirname(BASEPATH) . "/temp/" . basename($image);
        file_put_contents($image, $image_content);
        // $image = dirname(BASEPATH) . $image;
        $size = getimagesize($image);

        switch($size["mime"]){
            case "image/jpeg":
                $sourceImage = imagecreatefromjpeg($image); //jpeg file
                break;
            case "image/gif":
                $sourceImage = imagecreatefromgif($image); //gif file
                break;
            case "image/png":
                $sourceImage = imagecreatefrompng($image); //png file
                break;
        }
        $debug = false;
        $clientWidth = $width;
        $clientHeight = $height;

        $sourceWidth = imagesx($sourceImage);
        $sourceHeight = imagesy($sourceImage);
        if($debug){
            echo "current_x=" . $x . "\r\n";
            echo "current_y=" . $y . "\r\n";
            echo "current_width=" . $clientWidth . "\r\n";
            echo "current_height=" . $clientHeight . "\r\n";
        }
        $rate = $sourceWidth / $clientWidth;
        $x = $x * $rate;
        $y = $y * $rate;
        $sourceCutWidth = $cutWidth * $rate;
        $sourceCutHeight = $cutHeight * $rate;
        if($debug){
            echo "rate=" . $rate . "\r\n";
            echo "source_x=" . $x . "\r\n";
            echo "source_y=" . $y . "\r\n";
            echo "source_width=" . $sourceWidth . "\r\n";
            echo "source_height=" . $sourceHeight . "\r\n";

            echo "current_cut_width=" . $cutWidth . "\r\n";
            echo "current_cut_height=" . $cutHeight . "\r\n";

            echo "source_cut_width=" . $sourceCutWidth . "\r\n";
            echo "source_cut_height=" . $sourceCutHeight . "\r\n";
        }
        if($type == "banner"){
            $cutWidth = $sourceWidth;
            $cutHeight = $sourceWidth / 3;
  
        }
        $newImage = imagecreatetruecolor($cutWidth, $cutHeight);

        imagecopyresampled(
            $newImage,
            $sourceImage,
            0, 0,
            -$x, // Center the image horizontally
            -$y, // Center the image vertically
            $cutWidth, $cutHeight,
            $sourceCutWidth, $sourceCutHeight);



        $parts = explode("/", $image);
        $filename = end($parts);
        $ext = pathinfo($filename, PATHINFO_EXTENSION);
        // $newImagePath = "/member_data/" . $type . "/" . $memberID . "_" . $type . "_" . date("YmdHis") . "_" . uniqid() . "." . $ext;

        $newImagePath = "/temp/" . $memberID . "_" . $type . "_" . date("YmdHis") . "_" . uniqid() . "." . $ext;
        imagejpeg($newImage, dirname(BASEPATH). $newImagePath, 100);

        $this -> load -> model("member_model");
        $tmpMember = $this -> member_model -> getMember($memberID) -> row_array();

        if(!qiniu_exists($newImagePath)){
            upload_to_qiniu(dirname(BASEPATH) . $newImagePath);
        }
        unlink(dirname(BASEPATH) . $newImagePath);

        $qiniuSetting = get_qiniu_oss_setting();
        $newImagePath = $qiniuSetting["baseUrl"] . "/" . basename($newImagePath);

        $member["member_id"] = $memberID;
        if($type == "avatar"){

            if(qiniu_exists($tmpMember["avatar"])){
                qiniu_delete($tmpMember["avatar"]);
            }

            $member["avatar"] = $newImagePath;
            $res = $this -> member_model -> editMember($member);
            if($res["status"] == "success"){
                $this->session->set_userdata("avatar", $newImagePath);
                echo json_encode(array("status" => "success", "message" => "", "code" => "", "data" =>  $newImagePath));
            }
            else{
                echo json_encode($res);
            }
        }
        else if($type == "banner"){

            if(qiniu_exists($tmpMember["banner"])){
                qiniu_delete($tmpMember["banner"]);
            }

            $member["banner"] = $newImagePath;

            $res = $this -> member_model -> editMember($member);
            if($res["status"] == "success"){
                $this->session->set_userdata("banner", $newImagePath);
                echo json_encode(array("status" => "success", "message" => "", "code" => "", "data" =>  $newImagePath));
            }
            else{
                echo json_encode($res);
            }
        }
        else{
            echo json_encode(array("status" => "failed", "message" => "type not found!", "code" => ""));
        }
    }

    public function uploadUserPicture(){

        if(!isLogin(false)){
            echo json_encode(array('status'=>'failed', 'message'=>$this->lang->line('member_not_login_error'), 'code'=>'M0001'), JSON_UNESCAPED_UNICODE);
            return;
        }

        $memberID = $this->session->userdata('member_id');

        if(!isset($memberID) || (int)$memberID == 0){
            echo json_encode(array(
                    'status' => 'failed',
                    'message' => $this->lang->line('post_no_member_id'),
                    'code' => 'P0001')
            );
            exit;
        }

        $ext = pathinfo($_FILES["picture"]["name"], PATHINFO_EXTENSION);
        $config['file_name'] = $memberID . "_avatar_" . date("YmdHis") . "_" . uniqid() . "." . $ext;
        // $config['upload_path'] = dirname(BASEPATH) . '/member_data/avatar/';
        $config['upload_path'] = dirname(BASEPATH) . '/temp/';
        $config['allowed_types'] = '*';
        $config['max_size']	= '0';
        $config['max_width']  = '0';
        $config['max_height']  = '0';
        // $filePath = '/member_data/avatar/'.$config['file_name'];

        $this->load->library('upload', $config);
        $this->upload->do_upload("picture");

        $this -> load -> model("member_model");
        $tmpMember = $this -> member_model -> getMember($memberID) -> row_array();

        $data = $this->upload->data();
        if(in_array(strtolower($data["file_ext"]),array(".jpg",".jpeg",".png",".gif"))){

            if(qiniu_exists($tmpMember["banner"])){
                qiniu_delete($tmpMember["banner"]);
            }

            if(!qiniu_exists($config['upload_path'] . $config['file_name'])){
                upload_to_qiniu($config['upload_path'] . $config['file_name']);
            }
            unlink($config['upload_path'] . $config['file_name']);

            $qiniuSetting = get_qiniu_oss_setting();
            $newImagePath = $qiniuSetting["baseUrl"] . "/" . basename($config['file_name']);

            $member["member_id"] = $memberID;
            $member["avatar"] = $newImagePath;
            $res = $this -> member_model -> editMember($member);
            if($res["status"] == "success"){
                $this->session->set_userdata("avatar", $newImagePath);
                echo json_encode(array("status" => "success", "message" => "", "code" => "", "data" =>  $newImagePath));
            }
            else{
                echo json_encode($res);
            }
        }
        else{
            unlink($data["full_path"]);
            echo json_encode(array(
                "status" => "failed",
                "code" => "P0010",
                'message' => "The filetype you are attempting to upload is not allowed"
            ));
        }

        // }

        exit;
    }


    public function uploadBannerPicture(){

        if(!isLogin(false)){
            echo json_encode(array('status'=>'failed', 'message'=>$this->lang->line('member_not_login_error'), 'code'=>'M0001'), JSON_UNESCAPED_UNICODE);
            return;
        }

        $memberID = $this->session->userdata('member_id');

        if(!isset($memberID) || (int)$memberID == 0){
            echo json_encode(array(
                    'status' => 'failed',
                    'message' => $this->lang->line('post_no_member_id'),
                    'code' => 'P0001')
            );
            exit;
        }

        $ext = pathinfo($_FILES["picture"]["name"], PATHINFO_EXTENSION);
        $config['file_name'] = $memberID . "_avatar_" . date("YmdHis") . "_" . uniqid() . "." . $ext;
        // $config['upload_path'] = dirname(BASEPATH) . '/member_data/banner/';
        $config['upload_path'] = dirname(BASEPATH) . '/temp/';
        $config['allowed_types'] = '*';
        $config['max_size']	= '0';
        $config['max_width']  = '0';
        $config['max_height']  = '0';
        // $filePath = '/member_data/banner/'.$config['file_name'];

        $this->load->library('upload', $config);
        $this->upload->do_upload("picture");

        $this -> load -> model("member_model");
        $tmpMember = $this -> member_model -> getMember($memberID) -> row_array();

        $data = $this->upload->data();
        if(in_array(strtolower($data["file_ext"]),array(".jpg",".jpeg",".png",".gif"))){

            if(qiniu_exists($tmpMember["banner"])){
                qiniu_delete($tmpMember["banner"]);
            }

            if(!qiniu_exists($config['upload_path'] . $config['file_name'])){
                upload_to_qiniu($config['upload_path'] . $config['file_name']);
            }
            unlink($config['upload_path'] . $config['file_name']);

            $qiniuSetting = get_qiniu_oss_setting();
            $newImagePath = $qiniuSetting["baseUrl"] . "/" . basename($config['file_name']);


            $member["member_id"] = $memberID;
            $member["banner"] = $newImagePath;
            $res = $this -> member_model -> editMember($member);
            if($res["status"] == "success"){
                $this->session->set_userdata("banner", $newImagePath);
                echo json_encode(array("status" => "success", "message" => "", "code" => "", "data" =>  $newImagePath));
            }
            else{
                echo json_encode($res);
            }
        }
        else{
            unlink($data["full_path"]);
            echo json_encode(array(
                "status" => "failed",
                "code" => "P0010",
                'message' => "The filetype you are attempting to upload is not allowed"
            ));
        }

        // }

        exit;
    }


}
