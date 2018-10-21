<?php
class Tags_model extends CI_Model
{
    public function getTags($member_id)
    {
        $params = array();
//        $sql = "SELECT friends.*, members.nickname FROM friends INNER JOIN members ON members.member_id=friends.friend_id WHERE friends.member_id = ? UNION SELECT friends.*, members.nickname FROM friends INNER JOIN members ON members.member_id=friends.member_id WHERE friends.friend_id = ?";
        $sql = "SELECT m.* FROM (SELECT friend_id FROM friends WHERE member_id = ? UNION SELECT member_id FROM friends WHERE friend_id = ?) AS f INNER JOIN v_members AS m ON m.member_id = f.friend_id WHERE m.member_id <> ?";
        array_push($params, $member_id, $member_id, $member_id);
        $result = $this->db->query($sql, $params)->result();

        return $result;
    }

    public function addTags($post_id, $member_id, $friend_id)
    { 
        $params = array();
        $sql = "INSERT INTO tags (post_id,member_id, friend_id) VALUES ( ?, ?, ?)";
        array_push($params, $post_id, $member_id, $friend_id);
        $this->db->query($sql, $params);
        $this->load->model('like_model');
        $this -> like_model -> addNotify($member_id, $friend_id, "Tag", ("/page/main?post_id=" . $post_id));
    }

    public function getTagsbyID($member_id)
    {
        $params = array();
//        $sql = "SELECT friends.*, members.nickname FROM friends INNER JOIN members ON members.member_id=friends.friend_id WHERE friends.member_id = ? UNION SELECT friends.*, members.nickname FROM friends INNER JOIN members ON members.member_id=friends.member_id WHERE friends.friend_id = ?";
        $sql = "SELECT friend_id from tags WHERE member_id = ?";
        array_push($params, $member_id);
        $result = $this->db->query($sql, $params)->result();

        return $result;
    }
}
?>