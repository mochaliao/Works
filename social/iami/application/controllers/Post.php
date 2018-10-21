<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Post extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('post_model');
        $this->load->model('picture_model');
    }

    public function doPost()
    {
        if(!isLogin(false)){
            echo json_encode(array('status'=>'failed', 'message'=>$this->lang->line('member_not_login_error'), 'code'=>'M0001'), JSON_UNESCAPED_UNICODE);
            return;
        }
        if (!empty($this->input->get_post('member_id'))) {
            $memberID = $this->input->get_post('member_id');
        } else {
            $memberID = $this->session->userdata('member_id');
        }
        
        $targetID = trim($this->input->get_post('target'));
        $postType = trim($this->input->get_post('post_type'));
        if($postType=="share"){
            $targetID=$memberID;//分享好友贴文后，贴文才不会出现在好友贴文里。
        }

        $content = trim($this->input->get_post('content'));
        $sharePostID = trim($this->input->get_post('share_id'));
        $tags = $this->input->get_post('tags');
        $pictures = $this->input->get_post('pictures');
        $movie = $this->input->get_post('movie');

        // 是否輸入會員識別碼
        if ((int)$memberID == 0) {
            echo json_encode(array(
                    'status' => 'failed',
                    'message' => $this->lang->line('post_no_member_id'),
                    'code' => 'P0001')
            );
            exit;
        }

        // 是否輸入貼文型態
        if ($postType == "") {
            echo json_encode(array(
                    'status' => 'failed',
                    'message' => $this->lang->line('post_invalid_post_type'),
                    'code' => 'P0002')
            );
            exit;
        }

        $res = $this->post_model->doPost($memberID, $targetID, $postType, $content, $tags, $sharePostID, $pictures, $movie, $targetID);
        echo json_encode($res);
    }

    public function getPost()
    {

        $postID = trim($this->input->get_post('post_id'));

        // 是否輸入貼文識別碼
        if ((int)$postID == 0) {
            echo json_encode(array(
                    'status' => 'failed',
                    'message' => $this->lang->line('post_no_post_id'),
                    'code' => 'P0009')
            );
            exit;
        }

        $res = $this->post_model->getPost($postID);
        echo json_encode($res);
    }

    public function getPosts()
    {
        if(!isLogin(false)){
            echo json_encode(array('status'=>'failed', 'message'=>$this->lang->line('member_not_login_error'), 'code'=>'M0001'), JSON_UNESCAPED_UNICODE);
            return;
        }
        $memberID = trim($this->input->get_post('member_id'));
        $PostID = $this->input->get_post('post_id');
        // $PostID = 330;
        $perPage = $this->input->get_post('perPage');
        $Page = $this->input->get_post('Page');
        $isTotal = $this->input->get_post('isTotal');
        // 是否輸入會員識別碼
        if ((int)$memberID == 0) {
            echo json_encode(array(
                    'status' => 'failed',
                    'message' => $this->lang->line('post_no_member_id'),
                    'code' => 'P0001')
            );
            exit;
        }

        $res = $this->post_model->getPosts($memberID, $PostID, $perPage, $Page);
        echo json_encode($res,JSON_UNESCAPED_UNICODE);
    }

    public function getSelfPosts()
    {
        if(!isLogin(false)){
            echo json_encode(array('status'=>'failed', 'message'=>$this->lang->line('member_not_login_error'), 'code'=>'M0001'), JSON_UNESCAPED_UNICODE);
            return;
        }
        $memberID = trim($this->input->get_post('member_id'));
        $PostID = $this->input->get_post('post_id');
        // $PostID = "330";
        $perPage = $this->input->get_post('perPage');
        $Page = $this->input->get_post('Page');
        // 是否輸入會員識別碼
        if ((int)$memberID == 0) {
            echo json_encode(array(
                    'status' => 'failed',
                    'message' => $this->lang->line('post_no_member_id'),
                    'code' => 'P0001')
            );
            exit;
        }

        $res = $this->post_model->getSelfPosts($memberID, $PostID, $perPage, $Page);
        echo json_encode($res,JSON_UNESCAPED_UNICODE);
    }

    public function getCollections()
    {

        if(!isLogin(false)){
            echo json_encode(array('status'=>'failed', 'message'=>$this->lang->line('member_not_login_error'), 'code'=>'M0001'), JSON_UNESCAPED_UNICODE);
            return;
        }
        if (!empty($this->input->get_post('member_id'))) {
            $memberID = $this->input->get_post('member_id');
        } else {
            $memberID = $this->session->userdata('member_id');
        }

        // 是否輸入會員識別碼
        if ((int)$memberID == 0) {
            echo json_encode(array(
                    'status' => 'failed',
                    'message' => $this->lang->line('post_no_member_id'),
                    'code' => 'P0001')
            );
            exit;
        }

        $res = $this->post_model->getCollections($memberID);
        echo json_encode($res);
    }

    public function delPost()
    {
        if(!isLogin(false)){
            echo json_encode(array('status'=>'failed', 'message'=>$this->lang->line('member_not_login_error'), 'code'=>'M0001'), JSON_UNESCAPED_UNICODE);
            return;
        }
        if (!empty($this->input->get_post('member_id'))) {
            $memberID = $this->input->get_post('member_id');
        } else {
            $memberID = $this->session->userdata('member_id');
        }
        $postID = trim($this->input->get_post('post_id'));

        // 是否輸入貼文識別碼
        if ((int)$postID == 0) {
            echo json_encode(array(
                    'status' => 'failed',
                    'message' => $this->lang->line('post_no_post_id'),
                    'code' => 'P0009')
            );
            exit;
        }

        $res = $this->post_model->delPost($postID, $memberID);
        echo json_encode($res);
    }

    public function editPost(){

        if(!isLogin(false)){
            echo json_encode(array('status'=>'failed', 'message'=>$this->lang->line('member_not_login_error'), 'code'=>'M0001'), JSON_UNESCAPED_UNICODE);
            return;
        }
        if (!empty($this->input->get_post('member_id'))) {
            $memberID = $this->input->get_post('member_id');
        } else {
            $memberID = $this->session->userdata('member_id');
        }
        $postID = trim($this->input->get_post('post_id'));
        $content = nl2br(trim($this->input->get_post('content')));

        // 是否輸入貼文識別碼
        if ((int)$postID == 0) {
            echo json_encode(array(
                    'status' => 'failed',
                    'message' => $this->lang->line('post_no_post_id'),
                    'code' => 'P0009')
            );
            exit;
        }

        $res = $this->post_model->editPost($postID, $memberID, $content);
        echo json_encode($res);

    }

    public function getPicturesInPost()
    {

        $postID = trim($this->input->get_post('post_id'));

        // 是否輸入貼文識別碼
        if ((int)$postID == 0) {
            echo json_encode(array(
                    'status' => 'failed',
                    'message' => $this->lang->line('post_no_post_id'),
                    'code' => 'P0009')
            );
            exit;
        }

        $res = $this->post_model->getPicturesInPost($postID);
        echo json_encode($res);
    }

    public function doComment()
    {
        if(!isLogin(false)){
            echo json_encode(array('status'=>'failed', 'message'=>$this->lang->line('member_not_login_error'), 'code'=>'M0001'), JSON_UNESCAPED_UNICODE);
            return;
        }
        if (!empty($this->input->get_post('member_id'))) {
            $memberID = $this->input->get_post('member_id');
        } else {
            $memberID = $this->session->userdata('member_id');
        }
        $postID = trim($this->input->get_post('post_id'));
        $content = trim($this->input->get_post('content'));

        // 是否輸入會員識別碼
        if ((int)$memberID == 0) {
            echo json_encode(array(
                    'status' => 'failed',
                    'message' => $this->lang->line('post_no_member_id'),
                    'code' => 'P0001')
            );
            exit;
        }

        // 是否輸入貼文識別碼
        if ((int)$postID == 0) {
            echo json_encode(array(
                    'status' => 'failed',
                    'message' => $this->lang->line('post_no_post_id'),
                    'code' => 'P0009')
            );
            exit;
        }

        // 是否輸入貼文識別碼
        if ($content == "") {
            echo json_encode(array(
                    'status' => 'failed',
                    'message' => $this->lang->line('post_no_comment_content'),
                    'code' => 'P0010')
            );
            exit;
        }

        $res = $this->post_model->doComment($memberID, $postID, $content);
        echo json_encode($res);
    }

    public function getComments()
    {

        $postID = trim($this->input->get_post('post_id'));

        // 是否輸入貼文識別碼
        if ((int)$postID == 0) {
            echo json_encode(array(
                    'status' => 'failed',
                    'message' => $this->lang->line('post_no_post_id'),
                    'code' => 'P0009')
            );
            exit;
        }

        $res = $this->post_model->getComments($postID);
        echo json_encode($res);
    }

    public function collectPost()
    {
        if(!isLogin(false)){
            echo json_encode(array('status'=>'failed', 'message'=>$this->lang->line('member_not_login_error'), 'code'=>'M0001'), JSON_UNESCAPED_UNICODE);
            return;
        }
        if (!empty($this->input->get_post('member_id'))) {
            $memberID = $this->input->get_post('member_id');
        } else {
            $memberID = $this->session->userdata('member_id');
        }
        $postID = trim($this->input->get_post('post_id'));

        // 是否輸入會員識別碼
        if ((int)$memberID == 0) {
            echo json_encode(array(
                    'status' => 'failed',
                    'message' => $this->lang->line('post_no_member_id'),
                    'code' => 'P0001')
            );
            exit;
        }

        // 是否輸入貼文識別碼
        if ((int)$postID == 0) {
            echo json_encode(array(
                    'status' => 'failed',
                    'message' => $this->lang->line('post_no_post_id'),
                    'code' => 'P0009')
            );
            exit;
        }
        $res = $this->post_model->collectPost($memberID, $postID);
        echo json_encode($res);
    }

    public function getShares()
    {
        $postID = trim($this->input->get_post('post_id'));

        // 是否輸入貼文識別碼
        if ((int)$postID == 0) {
            echo json_encode(array(
                    'status' => 'failed',
                    'message' => $this->lang->line('post_no_post_id'),
                    'code' => 'P0009')
            );
            exit;
        }
        $res = $this->post_model->getShares($postID);
        echo json_encode($res);
    }

    public function delComment()
    {
        if(!isLogin(false)){
            echo json_encode(array('status'=>'failed', 'message'=>$this->lang->line('member_not_login_error'), 'code'=>'M0001'), JSON_UNESCAPED_UNICODE);
            return;
        }
        if (!empty($this->input->get_post('member_id'))) {
            $memberID = $this->input->get_post('member_id');
        } else {
            $memberID = $this->session->userdata('member_id');
        }
        $commentID = trim($this->input->get_post('comment_id'));

        // 是否輸入留言識別碼
        if ((int)$commentID == 0) {
            echo json_encode(array(
                    'status' => 'failed',
                    'message' => $this->lang->line('post_no_comment_id'),
                    'code' => 'PIC0004')
            );
            exit;
        }

        $res = $this->post_model->delComment($commentID, $memberID);
        echo json_encode($res);
    }

    public function editComment()
    {
        if(!isLogin(false)){
            echo json_encode(array('status'=>'failed', 'message'=>$this->lang->line('member_not_login_error'), 'code'=>'M0001'), JSON_UNESCAPED_UNICODE);
            return;
        }
        if (!empty($this->input->get_post('member_id'))) {
            $memberID = $this->input->get_post('member_id');
        } else {
            $memberID = $this->session->userdata('member_id');
        }
        $commentID = trim($this->input->get_post('comment_id'));
        $content = trim($this->input->get_post('content'));

        // 是否輸入留言識別碼
        if ((int)$commentID == 0) {
            echo json_encode(array(
                    'status' => 'failed',
                    'message' => $this->lang->line('post_no_comment_id'),
                    'code' => 'PIC0004')
            );
            exit;
        }

        $res = $this->post_model->editComment($commentID, $content);
        echo json_encode($res);
    }

    public function uploadPicture(){

        if(!isLogin(false)){
            echo json_encode(array('status'=>'failed', 'message'=>$this->lang->line('member_not_login_error'), 'code'=>'M0001'), JSON_UNESCAPED_UNICODE);
            return;
        }
        if (!empty($this->input->get_post('member_id'))) {
            $memberID = $this->input->get_post('member_id');
        } else {
            $memberID = $this->session->userdata('member_id');
        }
        if(!isset($memberID) || (int)$memberID == 0){
            echo json_encode(array(
                    'status' => 'failed',
                    'message' => $this->lang->line('post_no_member_id'),
                    'code' => 'P0001')
            );
            exit;
        }

        $ext = pathinfo($_FILES["picture"]["name"], PATHINFO_EXTENSION);

        // 檔案名稱
        $config['file_name'] = $memberID . "_picture_" . date("YmdHis") . "_" . uniqid() . "." . $ext;

        // 檔案路徑( 因應 OSS 及 Loading Balance 機制，因此檔案在上傳至OSS之後不保留在本機，故設定一個「臨時位置」上傳 )
        // $config['upload_path'] = dirname(BASEPATH) . '/member_data/picture/';
        $config['upload_path'] = dirname(BASEPATH) . '/temp/';

        $config['allowed_types'] = '*';
        $config['max_size']	= '0';
        $config['max_width']  = '0';
        $config['max_height']  = '0';

        // $TargetfilePath = $config['upload_path'].'resize/'.$config['file_name'];

        $this->load->library('upload', $config);
        $this->upload->do_upload("picture");

        // 上傳檔案
        $data = $this->upload->data();

        $filePath = $config['upload_path'].$config['file_name'];

        // 圖檔
        if(in_array(strtolower($data["file_ext"]),array(".jpg",".jpeg",".png", ".gif"))){

            // 確認是否需要翻轉圖片
            if(in_array(strtolower($data["file_ext"]),array(".jpg",".jpeg"))) {
                image_fix_orientation($filePath);
            }
            // 原檔

            upload_to_qiniu($filePath);

            if(in_array(strtolower($data["file_ext"]),array(".jpg",".jpeg", ".png"))) {
                // 壓縮
                $this->load->library('ResizeImage');
                $image = new ResizeImage();

                // 壓縮比70%
                $image->load($filePath);
                $image->scale(70);
                $image->save($config['upload_path'] . '70p/' . $config['file_name']);
                upload_to_qiniu($config['upload_path'] . '70p/' . $config['file_name'], "70p/");

                // 壓縮尺寸10x10
                $image->load($filePath);
                $image->resizeToFit(10, 10);
                $image->save($config['upload_path'] . '10x10/' . $config['file_name']);
                upload_to_qiniu($config['upload_path'] . '10x10/' . $config['file_name'], "10x10/");

                unlink($config['upload_path'] . '70p/' . $config['file_name']);
                unlink($config['upload_path'] . '10x10/' . $config['file_name']);
            }

            unlink($filePath);

            $res = $this -> picture_model -> addPicture($memberID, $config['file_name'], $data);

            echo json_encode($res);
        }
        else {
            if(file_exists($filePath)){
                unlink($filePath);
            }
            echo json_encode(array(
                "status" => "failed",
                "code" => "P0010",
                'message' => "The filetype you are attempting to upload is not allowed"
            ));
        }

        // $filePath = $basePath.$config['file_name'];
        // $TargetfilePath = $basePath.'resize/'.$fileName;


        
        // if (! $this->upload->do_upload("picture")){
        //     echo json_encode(array(
        //         "status" => "failed",
        //         'message' => $this->upload->display_errors()
        //     ));
        // }
        // else{

        /*

            if(in_array(strtolower($data["file_ext"]),array(".jpg",".jpeg",".png"))){
                $res = $this -> picture_model -> addPicture($memberID, '/member_data/picture/' . $config['file_name'], $data);
                $fullfilename = 'member_data/picture/'.$config['file_name'];
                if(in_array(strtolower($data["file_ext"]),array(".jpg",".jpeg"))) {
                    image_fix_orientation($fullfilename);
                }

                $this->load->library('ResizeImage');
                $image = new ResizeImage();
                $image -> load($config['upload_path'].$config['file_name']);

                $image -> scale(70);
                $image -> save($config['upload_path'].'70p/'.$config['file_name']);

                $image -> load($config['upload_path'].$config['file_name']);

                $image->resizeToFit(10,10);
                $image -> save($config['upload_path'].'10x10/'.$config['file_name']);

                upload_to_qiniu('70p/'. $config['file_name']);
                upload_to_qiniu('10x10/'. $config['file_name']);
                upload_to_qiniu($config['file_name']);

                echo json_encode($res);
            }elseif(in_array(strtolower($data["file_ext"]),array(".gif"))){
                $res = $this -> picture_model -> addPicture($memberID, '/member_data/picture/' . $config['file_name'], $data);
                upload_to_qiniu($config['file_name']);
                echo json_encode($res);
            }else{
                unlink($data["full_path"]);
                echo json_encode(array(
                    "status" => "failed",
                    "code" => "P0010",
                    'message' => "The filetype you are attempting to upload is not allowed"
                ));
            }

        // }

        // $fullfilename = 'member_data/picture/'.$config['file_name'];
        */

        exit;
    }

    public function uploadMovie(){

        if(!isLogin(false)){
            echo json_encode(array('status'=>'failed', 'message'=>$this->lang->line('member_not_login_error'), 'code'=>'M0001'), JSON_UNESCAPED_UNICODE);
            return;
        }
        if (!empty($this->input->get_post('member_id'))) {
            $memberID = $this->input->get_post('member_id');
        } else {
            $memberID = $this->session->userdata('member_id');
        }
        if(!isset($memberID) || (int)$memberID == 0){
            echo json_encode(array(
                    'status' => 'failed',
                    'message' => $this->lang->line('post_no_member_id'),
                    'code' => 'P0001')
            );
            exit;
        }

        $ext = pathinfo($_FILES["movie"]["name"], PATHINFO_EXTENSION);
        $config['file_name'] = $memberID . "_picture_" . date("YmdHis") . "_" . uniqid() . "." . $ext;
        // $config['upload_path'] = dirname(BASEPATH) . '/member_data/picture/';
        $config['upload_path'] = dirname(BASEPATH) . '/temp/';
        $config['allowed_types'] = '*';
        $config['max_size']	= '0';
        $config['max_width']  = '0';
        $config['max_height']  = '0';

        $this->load->library('upload', $config);
        if (! $this->upload->do_upload("movie")){
            echo json_encode(array(
                "status" => "failed",
                'message' => $this->upload->display_errors()
            ));
        }
        else{

            // 上傳檔案
            $data = $this->upload->data();

            $filePath = $config['upload_path'] . $config['file_name'];

            if(in_array(strtolower($data["file_ext"]),array(".webm",".ogv",".mp4",".mov",".3gp"))){
                // $fullfilename = 'member_data/picture/'.$config['file_name'];
                upload_to_qiniu($filePath);
                $res = $this -> picture_model -> addMovie($memberID, $config['file_name'], $data);
                echo json_encode($res);
                unlink($filePath);
            }
            else{
                unlink($data["full_path"]);
                echo json_encode(array(
                    "status" => "failed",
                    "code" => "P0010",
                    'message' => "The filetype you are attempting to upload is not allowed"
                ));
            }

        }

        

        exit;
    }

    public function uploadPictureAndMovie()
    {
        if(!isLogin(false)){
            echo json_encode(array('status'=>'failed', 'message'=>$this->lang->line('member_not_login_error'), 'code'=>'M0001'), JSON_UNESCAPED_UNICODE);
            return;
        }
        if (!empty($this->input->get_post('member_id'))) {
            $memberID = $this->input->get_post('member_id');
        } else {
            $memberID = $this->session->userdata('member_id');
        }
        if(!isset($memberID) || (int)$memberID == 0){
            echo json_encode(array(
                    'status' => 'failed',
                    'message' => $this->lang->line('post_no_member_id'),
                    'code' => 'P0001')
            );
            exit;
        }
        if(isset($_FILES['media']['name'])){
            $ext = pathinfo($_FILES["media"]["name"], PATHINFO_EXTENSION);
            $config['file_name'] = $memberID . "_picture_" . date("YmdHis") . "_" . uniqid() . "." . $ext;
            // $config['upload_path'] = dirname(BASEPATH) . '/member_data/picture/';
            $config['upload_path'] = dirname(BASEPATH) . '/temp/';
            $config['allowed_types'] = '*';
            $config['max_size'] = '0';
            $config['max_width']  = '0';
            $config['max_height']  = '0';
            $filePath = $config['upload_path'].$config['file_name'];
            $TargetfilePath = $config['upload_path'].'resize/'.$config['file_name'];

            $this->load->library('upload', $config);
            $this->upload->do_upload("media");




        
        // if (! $this->upload->do_upload("picture")){
        //     echo json_encode(array(
        //         "status" => "failed",
        //         'message' => $this->upload->display_errors()
        //     ));
        // }
        // else{

            $data = $this->upload->data();

            $filePath =  $config['upload_path'] . $config['file_name'];

            // 圖檔
            if(in_array(strtolower($data["file_ext"]),array(".jpg",".jpeg",".png", ".gif"))){



                // 確認是否需要翻轉圖片
                if(in_array(strtolower($data["file_ext"]),array(".jpg",".jpeg"))) {
                    image_fix_orientation($filePath);
                }
                // 原檔

                upload_to_qiniu($filePath);

                if(in_array(strtolower($data["file_ext"]),array(".jpg",".jpeg", ".png"))) {
                    // 壓縮
                    $this->load->library('ResizeImage');
                    $image = new ResizeImage();

                    // 壓縮比70%
                    $image->load($filePath);
                    $image->scale(70);
                    $image->save($config['upload_path'] . '70p/' . $config['file_name']);
                    upload_to_qiniu($config['upload_path'] . '70p/' . $config['file_name'], "70p/");

                    // 壓縮尺寸10x10
                    $image->load($filePath);
                    $image->resizeToFit(10, 10);
                    $image->save($config['upload_path'] . '10x10/' . $config['file_name']);
                    upload_to_qiniu($config['upload_path'] . '10x10/' . $config['file_name'], "10x10/");

                    unlink($config['upload_path'] . '70p/' . $config['file_name']);
                    unlink($config['upload_path'] . '10x10/' . $config['file_name']);
                }

                unlink($filePath);

                $res = $this -> picture_model -> addPicture($memberID, $config['file_name'], $data);

                echo json_encode($res);
            }
            elseif(in_array(strtolower($data["file_ext"]),array(".webm",".ogv",".mp4",".mov",".3gp"))){
                // $fullfilename = 'member_data/picture/'.$config['file_name'];
                upload_to_qiniu($filePath);
                $res = $this -> picture_model -> addMovie($memberID,  $config['file_name'], $data);
                unlink($filePath);
                echo json_encode($res);
            }
            else{
                unlink($data["full_path"]);

                echo json_encode(array(
                    "status" => "failed",
                    "code" => "P0010",
                    'message' => "The filetype you are attempting to upload is not allowed"
                ));
            }
            // echo json_encode($res);
        // }
            // echo "success!!";

        }else{
            // echo "failed!!";
        }


        
        exit;
    }

}
