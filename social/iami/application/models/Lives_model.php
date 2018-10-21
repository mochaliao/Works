<?php
class Lives_model extends CI_Model
{
    public function getStreamData($member_id)
    {
        $params = array();
        $sql = "SELECT * FROM members WHERE member_id =?";
        array_push($params, $member_id);
        $result = $this->db->query($sql, $params);

        return $result;
    }

    public function RegisterStreamer($member_id)
    {
        $params = array();
        $sql = "UPDATE members SET streamer=2 WHERE member_id=?";
        array_push($params, $member_id);
        $this->db->query($sql, $params);
    }
}