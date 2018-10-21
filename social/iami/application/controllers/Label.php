<?php
class Label extends CI_Controller
{
    public function addLabel()
    {
        $params = array();
        $label = $this->input->get_post('label');
        $self_id = $this->session->userdata('member_id');

        $sql = "INSERT INTO labels(self_id, labelname) VALUES (?, ?)";
        array_push($params, $self_id, $label);
        $this->db->query($sql, $params);

        $params = array();
        $sql = "SELECT * FROM labels WHERE labelname=?";
        array_push($params, $label);
        $result = $this->db->query($sql, $params)->row_array();

        if($result) {
            echo json_encode(array('status'=>'success', 'message'=>'新增成功', 'data'=> $result));
        }else{
            echo json_encode(array('status'=>'failed', 'message'=>'新增失敗'));
        }
    }

    public function delLabel()
    {
        if (!isLogin(FALSE)){
            $result = array('status'=>'failed', 'message'=>$this->lang->line('member_not_login_error'), 'code'=>'M0001');
            echo json_encode($result, JSON_UNESCAPED_UNICODE);
            return FALSE;
        }
        $member_id = $this->session->userdata('member_id');
        $label_id = $this->input->get_post('id');
        $params = array();
        $sql = "DELETE FROM member_labels WHERE label=? AND member_id=?";
        array_push($params, $label_id, $member_id);
        $result = $this->db->query($sql, $params);

        if($result) {
            echo json_encode(array('status'=>'success', 'message'=>'刪除成功'));
        }else{
            echo json_encode(array('status'=>'failed', 'message'=>'刪除失敗'));
        }
    }
}
?>