<?php
class Label_model extends CI_Model
{
    public function getLabel($member_id)
    {
        $params = array();
        $sql = "SELECT * FROM member_labels INNER JOIN labels ON labels.id = member_labels.label WHERE member_id=? GROUP BY label";
        array_push($params, $member_id);
        $result = $this->db->query($sql, $params);

        return $result;
    }

    public function getLabelALL($member_id)
    {
        $params = array();
//        $sql = "SELECT * FROM member_labels INNER JOIN labels ON labels.id = member_labels.label ORDER BY create_time GROUP BY label HAVING member_id <> $member_id ";
        $sql = "SELECT * FROM labels WHERE is_default = ?";
        array_push($params, 1);
        $result = $this->db->query($sql, $params);

        return $result;
    }

    public function getLabelSelf($member_id)
    {
        $params = array();
//        $sql = "SELECT * FROM member_labels INNER JOIN labels ON labels.id = member_labels.label ORDER BY create_time GROUP BY label HAVING member_id <> $member_id ";
        $sql = "SELECT * FROM labels WHERE is_default = ? AND self_id = ? LIMIT 45";
        array_push($params, 0, $member_id);
        $result = $this->db->query($sql, $params);

        return $result;
    }

    public function delLabel($memberID, $labelID){
        /*

        $sql = "DELETE FROM labels WHERE is_default = 0 AND self_id = ? AND id = ?";
        array_push($params, $memberID, $labelID);
        $result = $this->db->query($sql, $params);
        */
        $params = array();
        $sql = "DELETE FROM member_labels WHERE member_id = ? AND label = ?";
        array_push($params, $memberID, $labelID);
        $this->db->query($sql, $params);
    }

    public function delLabels($memberID){
        /*

        $sql = "DELETE FROM labels WHERE is_default = 0 AND self_id = ? AND id = ?";
        array_push($params, $memberID, $labelID);
        $result = $this->db->query($sql, $params);
        */
        $params = array();
        $sql = "DELETE FROM member_labels WHERE member_id = ?";
        array_push($params, $memberID);
        return $this->db->query($sql, $params);
    }
}
?>