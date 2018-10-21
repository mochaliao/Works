<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Trace extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('trace_model');
        $this->load->model('like_model');
    }


    /**
     * 新增追踨
     *
     * @param integer $member_id 會員ID
     * @param integer $trace_id 被追踨會員ID
     * @return json 結果 (status: success|failed, message: 訊息, code: 錯誤代碼 )
     */
    public function addTrace()
    {
        if (isLogin(FALSE)){
            if (!empty($this->input->get_post('member_id'))) {
                $member_id = $this->input->get_post('member_id');
            } else {
                $member_id = $this->session->userdata('member_id');
            }
            $trace_id = trim($this->input->get_post('trace_id'));
            if ( ! empty($trace_id)){
                $result = $this->trace_model->addTrace($member_id, $trace_id);
                echo json_encode($result, JSON_UNESCAPED_UNICODE);
                return TRUE;
            }else{
                $result = array('status'=>'failed', 'message'=>$this->lang->line('trace_id_empty'), 'code'=>'T0001');
                echo json_encode($result, JSON_UNESCAPED_UNICODE);
                return FALSE;
            }
        }else{
            $result = array('status'=>'failed', 'message'=>$this->lang->line('member_not_login_error'), 'code'=>'M0001');
            echo json_encode($result, JSON_UNESCAPED_UNICODE);
            return FALSE;
        }
    }

    /**
     * 刪除追踨
     *
     * @param integer $member_id 會員ID
     * @param integer $trace_id 被追踨會員ID
     * @return json 結果 (status: success|failed, message: 訊息, code: 錯誤代碼 )
     */
    public function delTrace()
    {
        if (isLogin(FALSE)){
            if (!empty($this->input->get_post('member_id'))) {
                $member_id = $this->input->get_post('member_id');
            } else {
                $member_id = $this->session->userdata('member_id');
            }
            $trace_id = trim($this->input->get_post('trace_id'));
            if ( ! empty($trace_id)){
                $result = $this->trace_model->delTrace($member_id, $trace_id);
                echo json_encode($result, JSON_UNESCAPED_UNICODE);
                return TRUE;
            }else{
                $result = array('status'=>'failed', 'message'=>$this->lang->line('trace_id_empty'), 'code'=>'T0001');
                echo json_encode($result, JSON_UNESCAPED_UNICODE);
                return FALSE;
            }
        }else{
            $result = array('status'=>'failed', 'message'=>$this->lang->line('member_not_login_error'), 'code'=>'M0001');
            echo json_encode($result, JSON_UNESCAPED_UNICODE);
            return FALSE;
        }
    }

    /**
     * 依會員ID取得被追踨者
     *
     * @param integer $member_id 會員ID
     * @param integer $start_row 回傳筆數/指定從第幾筆開始(有$return_rows:第幾筆開始，沒有$return_rows:回傳筆數)
     * @param integer $return_rows 回傳筆數
     * @return json 被追踨者資料
     */
    public function getTraceByMember()
    {
        if (isLogin(FALSE)){
            if ( ! empty($this->input->get_post('member_id'))){
                $member_id = $this->input->get_post('member_id');
            }else{
                $member_id = $this->session->userdata('member_id');
            }
            $start_row = $this->input->get_post('start_row');
            $return_rows = $this->input->get_post('return_rows');
            $tmp_traces = $this->trace_model->getTraceByMember($member_id, $start_row, $return_rows)->result_array();
            $traces = array();
            foreach ($tmp_traces as $tmp_trace){
                $trace = $tmp_trace;
                if ( ! empty($tmp_trace['invite_status'])){
                    $trace['invite_status_name'] = $this->lang->line('invite_status')[$tmp_trace['invite_status']];
                }else{
                    $trace['invite_status_name'] = '';
                }
                array_push($traces, $trace);
            }
            $result = array('status'=>'success', 'message'=>'', 'code'=>'', 'data'=>$traces);
            echo json_encode($result, JSON_UNESCAPED_UNICODE);
            return TRUE;
        }else{
            $result = array('status'=>'failed', 'message'=>$this->lang->line('member_not_login_error'), 'code'=>'M0001');
            echo json_encode($result, JSON_UNESCAPED_UNICODE);
            return FALSE;
        }
    }

    /**
     * 依被追踨者ID取得會員
     *
     * @param integer $trace_id 被追踨者ID
     * @param integer $start_row 回傳筆數/指定從第幾筆開始(有$return_rows:第幾筆開始，沒有$return_rows:回傳筆數)
     * @param integer $return_rows 回傳筆數
     * @return json 追踨該被追踨者的會員
     */
    public function getMemberByTrace()
    {
        if (isLogin(FALSE)){
            if ( ! empty($this->input->get_post('member_id'))){
                $trace_id = $this->input->get_post('member_id');
            }else{
                $trace_id = $this->session->userdata('member_id');
            }
            $start_row = $this->input->get_post('start_row');
            $return_rows = $this->input->get_post('return_rows');
            $tmp_traces = $this->trace_model->getMemberByTrace($trace_id, $start_row, $return_rows)->result_array();
            $traces = array();
            foreach ($tmp_traces as $tmp_trace){
                $trace = $tmp_trace;
                if ( ! empty($tmp_trace['invite_status'])){
                    $trace['invite_status_name'] = $this->lang->line('invite_status')[$tmp_trace['invite_status']];
                }else{
                    $trace['invite_status_name'] = '';
                }
                array_push($traces, $trace);
            }
            $result = array('status'=>'success', 'message'=>'', 'code'=>'', 'data'=>$traces);
            echo json_encode($result, JSON_UNESCAPED_UNICODE);
            return TRUE;
        }else{
            $result = array('status'=>'failed', 'message'=>$this->lang->line('member_not_login_error'), 'code'=>'M0001');
            echo json_encode($result, JSON_UNESCAPED_UNICODE);
            return FALSE;
        }
    }

    /**
     * 取得會員的追踨數
     *
     * @param integer $member_id 會員ID
     * @return integer
     */
    public function getTraceCount(){
        if (isLogin(FALSE)) {
            if (!empty($this->input->get_post('member_id'))) {
                $member_id = $this->input->get_post('member_id');
            } else {
                $member_id = $this->session->userdata('member_id');
            }

            echo $this->trace_model->getTraceCount($member_id);
            return TRUE;
        }
    }

    /**
     * 取得會員的粉絲數
     *
     * @param integer $trace_id 被追踨者ID
     * @return integer
     */
    public function getFansCount(){
        if (isLogin(FALSE)) {
            if (!empty($this->input->get_post('member_id'))) {
                $member_id = $this->input->get_post('member_id');
            } else {
                $member_id = $this->session->userdata('member_id');
            }

            echo $this->trace_model->getFansCount($member_id);
            return TRUE;
        }
    }

    function isTrace(){
        if (isLogin(FALSE)){

            $member_id = $this->input->get_post('member_id');


            if ( ! empty($member_id)){
                $isFriend = $this -> like_model -> isTrace($this->session->userdata('member_id'), $member_id);
                $result = array('status'=>'success', 'message'=>'', 'code'=>'', 'data'=> $isFriend?"Y":"N");
                echo json_encode($result, JSON_UNESCAPED_UNICODE);
                return TRUE;
            }else{
                $result = array('status'=>'failed', 'message'=>$this->lang->line('member_id_empty'), 'code'=>'M0002');
                echo json_encode($result, JSON_UNESCAPED_UNICODE);
                return FALSE;
            }
        }else{
            $result = array('status'=>'failed', 'message'=>$this->lang->line('member_not_login_error'), 'code'=>'M0001');
            echo json_encode($result, JSON_UNESCAPED_UNICODE);
            return FALSE;
        }
    }
}