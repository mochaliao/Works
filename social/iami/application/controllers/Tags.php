<?php
class Tags extends CI_Controller
{
    public function getTags()
    {
        $member_id = $this->session->userdata('member_id');
        $this->load->model('tags_model');
        $result = $this->tags_model->getTags($member_id);

        echo json_encode(array('status'=>'success', 'data'=> $result),JSON_UNESCAPED_UNICODE);
    }

    public function addTags()
    {
        $post_id = $this->input->get_post('post_id');
        $member_id = $this->session->userdata('member_id');
//        $friend_id = $this->input->get_post('friend_id');
//        $post_id = 1;
//        $member_id = 13;
//        $friend_id = 19;
        if(isset($post_id)&&isset($member_id)) {
            $this->load->model('tags_model');
            $this->tags_model->addTags($post_id, $member_id);
            echo json_encode(array('status' => 'success', 'message' => '新增成功'));
        }else{
            echo json_encode(array('status'=> 'failed', 'message'=> '新增失敗'));
        }
    }

    //會員通知(寫在通知裡面)
    //1.通知會員





}