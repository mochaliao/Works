<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Like extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('like_model');
    }

    public function togglePostLike()
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


        $res = $this->like_model->togglePostLike($memberID, $postID);
        echo json_encode($res);
    }

    public function togglePictureLike()
    {
        if(!isLogin(false)){
            echo json_encode(array('status'=>'failed', 'message'=>$this->lang->line('member_not_login_error'), 'code'=>'M0001'), JSON_UNESCAPED_UNICODE);
            return;
        }
        // $memberID = trim($this->input->get_post('member_id'));
        if (!empty($this->input->get_post('member_id'))) {
            $memberID = $this->input->get_post('member_id');
        } else {
            $memberID = $this->session->userdata('member_id');
        }
        $pictureID = trim($this->input->get_post('picture_id'));

        // 是否輸入會員識別碼
        if ((int)$memberID == 0) {
            echo json_encode(array(
                    'status' => 'failed',
                    'message' => $this->lang->line('post_no_member_id'),
                    'code' => 'P0001')
            );
            exit;
        }

        // 是否輸入圖片識別碼
        if ((int)$pictureID == 0) {
            echo json_encode(array(
                    'status' => 'failed',
                    'message' => $this->lang->line('picture_no_picture_id'),
                    'code' => 'PIC0004')
            );
            exit;
        }
        $res = $this->like_model->togglePictureLike($memberID, $pictureID);
        echo json_encode($res);
    }

    public function toggleCommentLike()
    {
        if(!isLogin(false)){
            echo json_encode(array('status'=>'failed', 'message'=>$this->lang->line('member_not_login_error'), 'code'=>'M0001'), JSON_UNESCAPED_UNICODE);
            return;
        }
        // $memberID = trim($this->input->get_post('member_id'));
        if (!empty($this->input->get_post('member_id'))) {
            $memberID = $this->input->get_post('member_id');
        } else {
            $memberID = $this->session->userdata('member_id');
        }
        $commentID = trim($this->input->get_post('comment_id'));

        // 是否輸入會員識別碼
        if ((int)$memberID == 0) {
            echo json_encode(array(
                    'status' => 'failed',
                    'message' => $this->lang->line('post_no_member_id'),
                    'code' => 'P0001')
            );
            exit;
        }

        // 是否輸入留言識別碼
        if ((int)$commentID == 0) {
            echo json_encode(array(
                    'status' => 'failed',
                    'message' => $this->lang->line('post_no_comment_id'),
                    'code' => 'PIC0004')
            );
            exit;
        }

        $res = $this->like_model->toggleCommentLike($memberID, $commentID);
        echo json_encode($res);
    }

    public function getPostLikes()
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

        $res = $this->like_model->getPostLikes($memberID, $postID);
        echo json_encode($res);
    }

    public function getPictureLikes()
    {

        $pictureID = trim($this->input->get_post('post_id'));

        // 是否輸入圖片識別碼
        if ((int)$pictureID == 0) {
            echo json_encode(array(
                    'status' => 'failed',
                    'message' => $this->lang->line('picture_no_picture_id'),
                    'code' => 'PIC0004')
            );
            exit;
        }

        $res = $this->like_model->getPictureLikes($pictureID);
        echo json_encode($res);
    }

    public function getCommentLikes()
    {

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

        $res = $this->like_model->getCommentLikes($commentID);
        echo json_encode($res);
    }


}
