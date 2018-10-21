<?php
class Feedback_model extends CI_Model
{
    public function addFeedback($member_id, $subject, $category, $content)
    {
        $params = array();
        $sql = "INSERT INTO feedback(member_id,subject, category,content, createTime) VALUES (?, ?, ?, ?, ?)";
        array_push($params, $member_id, $subject, $category, $content, date("Y-m-d H:i:s"));
        $this->db->query($sql, $params);
    }
}
?>