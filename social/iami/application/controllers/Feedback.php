<?php
class Feedback extends CI_Controller
{
    public function index()
    {
        $i = $this->input->get('i');
        if(isset($i)){
            $data['show_type'] = 'feedback';
        }
        $this->load->view('feedback');
    }
    public function addFeedback()
    {
        $member_id = $this->session->userdata('member_id');
        $subject = $this->input->get_post('subject');
        $category = $this->input->get_post('category');
        $content = $this->input->get_post('content');


        $validations = array();
        if(trim($subject) == ""){
            $validations["subject"] = $this->lang->line('subject_error');
        }
        if(trim($content) == ""){
            $validations["content"] = $this->lang->line('content_error');
        }
        if(count($validations) > 0){
            $this->load->view('feedback', array("data" => $validations));
            return;
        }

        $this->load->model('feedback_model');
        $this->feedback_model->addFeedback($member_id, $subject, $category, $content);
        redirect('/feedback?i=1');
    }
}
?>