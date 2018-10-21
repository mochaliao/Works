<?php

class Like_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }


    /**
     * 貼文按讚
     * @param $memberID 會員識別碼
     * @param $postID 貼文識別碼
     * @return array 新增/收回貼文讚結果
     */
    function togglePostLike($memberID, $postID){
        // 會員是否存在
        $this->load->model('member_model');
        $member = $this->member_model->getMember($memberID)->row_array();
        if (is_null($member)) {
            return array('status' => 'failed', 'message' => $this->lang->line('post_member_not_found'), 'code' => 'P0004');
        }

        // 貼文是否存在
        $this->load->model('post_model');
        if (!$this->post_model->isPostExists($postID)) {
            return array('status' => 'failed', 'message' => $this->lang->line('post_not_found'), 'code' => 'P0007');
        }

        // 貼文讚是否存在
        if($this -> isPostLikeExists($memberID, $postID)){
            $this->db->delete('likes', array('post_id' => $postID, "member_id" => $memberID));
            return array('status' => 'success', 'message' => $this->lang->line('list_del_post_success'), 'code' => '', "data" => "no");
        }
        else{

            $like = array(
                // "sn" => "Auto Increment",
                "member_id" => $memberID,
                "post_id" => $postID,
                "create_time" => date("Y-m-d H:i:s")
            );

            $this->db->insert('likes', $like);
            if ($this->db->affected_rows() == 0) {
                return array('status' => 'failed', 'message' => $this->lang->line('like_post_failed'), 'code' => 'L0001');
            } else {
                $this->load->model('post_model');
                $pure_post = $this -> post_model -> getPurePost($postID);
                $this -> addNotify($memberID, $pure_post["member_id"], "Thumb", ("/page/main?post_id=" . $postID));

                return array('status' => 'success', 'message' => $this->lang->line('like_post_success'), 'code' => '', 'id' => $this->db->insert_id(), "data" => "yes");
            }
        }
    }

    /**
     * 貼文讚是否存在
     * @param $memberID 會員識別碼
     * @param $postID 貼文識別碼
     * @return bool 是否存在
     */
    function isPostLikeExists($memberID, $postID)
    {
        $params = array();
        $sql = "SELECT sn FROM likes WHERE post_id = ? AND member_id = ?";
        array_push($params, $postID);
        array_push($params, $memberID);

        return !is_null($this->db->query($sql, $params)->row_array());
    }


    /**
     * 圖片按讚
     * @param $memberID 會員識別碼
     * @param $pictureID 圖片識別碼
     * @return array 新增/收回圖片讚結果
     */
    function togglePictureLike($memberID, $pictureID){
        // 會員是否存在
        $this->load->model('member_model');
        $member = $this->member_model->getMember($memberID)->row_array();
        if (is_null($member)) {
            return array('status' => 'failed', 'message' => $this->lang->line('post_member_not_found'), 'code' => 'P0004');
        }

        // 圖片是否存在
        $this->load->model('picture_model');
        if (!$this->picture_model->isPictureExists($pictureID)) {
            return array('status' => 'failed', 'message' => $this->lang->line('picture_not_found'), 'code' => 'L0001');
        }

        // 圖片讚是否存在
        if($this -> isPictureLikeExists($memberID, $pictureID)){
            $this->db->delete('likes', array('picture_id' => $pictureID, "member_id" => $memberID));
            return array('status' => 'success', 'message' => $this->lang->line('like_del_picture_success'), 'code' => '');
        }
        else{

            $like = array(
                // "sn" => "Auto Increment",
                "member_id" => $memberID,
                "picture_id" => $pictureID,
                "create_time" => date("Y-m-d H:i:s")
            );

            $this->db->insert('likes', $like);
            if ($this->db->affected_rows() == 0) {
                return array('status' => 'failed', 'message' => $this->lang->line('like_picture_failed'), 'code' => 'L0001');
            } else {
                return array('status' => 'success', 'message' => $this->lang->line('like_picture_success'), 'code' => '', 'id' => $this->db->insert_id());
            }
        }
    }

    /**
     * 圖片讚是否存在
     * @param $memberID 會員識別碼
     * @param $pictureID 圖片識別碼
     * @return bool 是否存在
     */
    function isPictureLikeExists($memberID, $pictureID)
    {
        $params = array();
        $sql = "SELECT sn FROM likes WHERE picture_id = ? AND member_id = ?";
        array_push($params, $pictureID);
        array_push($params, $memberID);

        return !is_null($this->db->query($sql, $params)->row_array());
    }

    /**
     * 留言按讚
     * @param $memberID 會員識別碼
     * @param $commentID 留言識別碼
     * @return array 新增/收回留言讚結果
     */
    function toggleCommentLike($memberID, $commentID){
        // 會員是否存在
        $this->load->model('member_model');
        $member = $this->member_model->getMember($memberID)->row_array();
        if (is_null($member)) {
            return array('status' => 'failed', 'message' => '會員不存在 !!', 'code' => 'P0004');
        }

        // 留言是否存在
        $this->load->model('post_model');
        if (!$this->post_model->isCommentExists($commentID)) {
            return array('status' => 'failed', 'message' => '留言不存在 !!', 'code' => 'P0001');
        }

        // 留言讚是否存在
        if($this -> isCommentLikeExists($memberID, $commentID)){
            $this->db->delete('likes', array('comments_id' => $commentID, "member_id" => $memberID));
            return array('status' => 'success', 'message' => '收回留言讚成功 !!', 'code' => '', "data" => "no");
        }
        else{

            $like = array(
                // "sn" => "Auto Increment",
                "member_id" => $memberID,
                "comments_id" => $commentID,
                "create_time" => date("Y-m-d H:i:s")
            );

            $this->db->insert('likes', $like);
            if ($this->db->affected_rows() == 0) {
                return array('status' => 'failed', 'message' => '留言讚失敗，請稍後再試 !!', 'code' => 'L0001');
            } else {
                return array('status' => 'success', 'message' => '留言讚成功 !!', 'code' => '', 'id' => $this->db->insert_id(), "data" => "yes");
            }
        }
    }

    /**
     * 留言讚是否存在
     * @param $memberID 會員識別碼
     * @param $commentID 留言識別碼
     * @return bool 是否存在
     */
    function isCommentLikeExists($memberID, $commentID)
    {
        $params = array();
        $sql = "SELECT sn FROM likes WHERE comments_id = ? AND member_id = ?";
        array_push($params, $commentID);
        array_push($params, $memberID);

        return !is_null($this->db->query($sql, $params)->row_array());
    }


    /**
     * 取得貼文的讚
     * @param $postID 貼文識別碼
     * @return array 貼文資訊(status: success|failed, message: 訊息, code: 錯誤代碼 )
     */
    function getPostLikes($memberID, $postID)
    {
        $params = array();
        //$sql = "SELECT members.member_id, members.nickname, members.avatar FROM likes, members WHERE likes.post_id = ? AND members.member_id = likes.member_id ORDER BY likes.create_time DESC;";
        //$sql = "SELECT members.member_id, members.nickname, members.avatar, (SELECT COUNT(1) FROM friends WHERE (member_id = posts.member_id AND friend_id = likes.member_id) OR (member_id = likes.member_id AND friend_id = posts.member_id)) AS is_friend, (SELECT COUNT(1) FROM traces WHERE (member_id = likes.member_id AND trace_id = posts.member_id)) AS is_trace, (SELECT COUNT(1) FROM invites WHERE (member_id = likes.member_id AND invitee_id = posts.member_id)) as is_invite FROM likes , members, posts WHERE likes.post_id = ? AND members.member_id = likes.member_id AND posts.post_id = likes.post_id ORDER BY likes.create_time DESC";
		$sql = "SELECT members.member_id, members.nickname, members.avatar, (SELECT COUNT(1) FROM friends WHERE (member_id = ? AND friend_id = likes.member_id) OR (member_id = likes.member_id AND friend_id = ?)) AS is_friend, (SELECT COUNT(1) FROM traces WHERE (member_id = ? AND trace_id = likes.member_id)) AS is_trace, (SELECT COUNT(1) FROM invites WHERE (member_id = ? AND invitee_id = likes.member_id)) AS is_invite FROM likes , members, posts WHERE likes.post_id = ? AND members.member_id = likes.member_id AND posts.post_id = likes.post_id ORDER BY likes.create_time DESC";
		array_push($params, $memberID, $memberID, $memberID, $memberID, $postID);

        $members = $this->db->query($sql, $params)->result();

        return array('status'=>'success', 'message'=> '', 'code'=>'', 'data' => $members);

    }

    /**
     * 取得貼文的讚
     * @param $postID 貼文識別碼
     * @return array 貼文資訊(status: success|failed, message: 訊息, code: 錯誤代碼 )
     */
    function getPostLikesCount($postID)
    {
        $params = array();
        $sql = "SELECT members.member_id, members.nickname FROM likes, members WHERE likes.post_id = ? AND members.member_id = likes.member_id;";
        array_push($params, $postID);

        $count = $this->db->query($sql, $params)->num_rows();
        return $count;

    }

    /**
     * 取得圖片的讚
     * @param $pictureID 圖片識別碼
     * @return array 貼文資訊(status: success|failed, message: 訊息, code: 錯誤代碼 )
     */
    function getPictureLikes($pictureID)
    {
        $params = array();
        $sql = "SELECT members.member_id, members.nickname FROM likes, members WHERE likes.picture_id = ? AND members.member_id = likes.member_id;";
        array_push($params, $pictureID);

        $members = $this->db->query($sql, $params)->result();

        return array('status'=>'success', 'message'=> '', 'code'=>'', 'data' => $members);

    }

    /**
     * 取得留言的讚
     * @param $commentID 留言識別碼
     * @return array 貼文資訊(status: success|failed, message: 訊息, code: 錯誤代碼 )
     */
    function getCommentLikes($commentID)
    {
        $params = array();
        $sql = "SELECT members.member_id, members.nickname FROM likes, members WHERE likes.comments_id = ? AND members.member_id = likes.member_id;";
        array_push($params, $commentID);

        $members = $this->db->query($sql, $params)->result();

        return array('status'=>'success', 'message'=> '', 'code'=>'', 'data' => $members);

    }

    function memberQuery($keyword){
        $params = array();
        $keyword = "%" . $keyword . "%";
        $sql = "SELECT nickname, member_id, avatar,email FROM members WHERE email LIKE '{$keyword}' OR nickname LIKE '{$keyword}';";
        $members = $this->db->query($sql, $params)->result();

        return array('status'=>'success', 'message'=> '', 'code'=>'', 'data' => $members);
    }

    function recommendMembers($memberID){
        $params = array();
        $sql = "SELECT nickname, member_id, avatar, level FROM members WHERE member_id NOT IN (SELECT trace_id FROM traces WHERE member_id = ? UNION SELECT friend_id FROM friends WHERE member_id = ? UNION SELECT member_id FROM friends WHERE friend_id = ?) AND member_id <> ? ORDER BY RAND() DESC LIMIT 0, 8";
        array_push($params, $memberID, $memberID, $memberID, $memberID);
        $members = $this->db->query($sql, $params)->result();

        return array('status'=>'success', 'message'=> '', 'code'=>'', 'data' => $members);
    }

    function isTrace($memberID, $traceID){
        $params = array();
        $sql = "SELECT *
                FROM traces
                WHERE member_id = ? AND trace_id = ? ";
        array_push($params, $memberID);
        array_push($params, $traceID);
        return !is_null($this->db->query($sql, $params)->row_array());
    }

    function isInvite($memberID, $inviteeID){
        $params = array();
        $sql = "SELECT *
                FROM invites
                WHERE member_id = ? AND invitee_id = ? ";
        array_push($params, $memberID);
        array_push($params, $inviteeID);
        return !is_null($this->db->query($sql, $params)->row_array());
    }

    function isFriend($memberID, $friendID){
        $params = array();
        $sql = "SELECT *
                FROM friends
                WHERE (member_id = ? and friend_id = ?) or (member_id = ? AND friend_id = ?) ";
        array_push($params, $memberID);
        array_push($params, $friendID);
        array_push($params, $friendID);
        array_push($params, $memberID);
        return !is_null($this->db->query($sql, $params)->row_array());
    }

    function isRequest($memberID, $inviteeID){
        $params = array();
        $sql = "SELECT *
                FROM invites
                WHERE member_id = ? AND invitee_id = ? and status=2";
        array_push($params, $inviteeID);
        array_push($params, $memberID);
        return !is_null($this->db->query($sql, $params)->row_array());
    }

    function addNotify($memberID, $targetID, $text, $path){

        

        $data = array(
            "member_id" => $memberID,
            "for_who" => $targetID,
            "is_read" => "N",
            "text" => $text,
            "target_path" =>  $path,
            "createTime" => date("Y-m-d H:i:s")
        );

        $this -> db -> insert("notices", $data);

        $this->load->model('like_model');
        $push_data = array();

        $this->load->model('member_model');

        $result_notice = $this -> like_model -> getNotifies($targetID,1);

        $notices = $result_notice["data"];

        foreach($notices as $key => $notice){
            $member = $this->member_model->getMember($notice -> member_id)->row_array();
            $notices[$key] -> avatar = $member["avatar"];
            $notices[$key] -> nickname = $member["nickname"];
        }
        $result_notice["data"] = $notices;

        $data['notice'] = $result_notice;
        array_push($push_data, $data);
        if($targetID!=$memberID) {
            push_data($targetID, $push_data);
        }
        return true;
    }

    function getNotifies($targetID, $count = 5){
        $params = array();
        /*$sql = "SELECT DISTINCT p.post_id, p.content, m.nickname, n.* 
 FROM notices AS n
  INNER JOIN members AS m
   ON m.member_id = n.member_id
  LEFT OUTER JOIN posts AS p
   ON p.member_id = n.member_id
    AND p.for_who = n.for_who
 WHERE n.for_who = ? AND n.member_id <> ?
 ORDER BY n.createTime desc LIMIT 0," . $count;*/
        /*
		$sql = "SELECT DISTINCT p.post_id, p.content, m.nickname, m.avatar, n.*
 FROM notices AS n
  INNER JOIN members AS m
   ON m.member_id = n.member_id
  LEFT OUTER JOIN posts AS p
   ON p.member_id = n.member_id
    AND p.for_who = n.for_who
 WHERE n.for_who = ? AND n.member_id <> ?
 GROUP BY p.post_id, p.content

 ORDER BY p.create_time desc LIMIT 0," . $count;
        array_push($params, $targetID, $targetID);
        */
        $member_id = $this->session->userdata('member_id');
        $params = array(); 
        $sql = "SELECT * FROM notices WHERE for_who=? AND member_id<>? ORDER BY createTime DESC LIMIT 0, $count";
        array_push($params, $targetID, $targetID);
        $notices = $this->db->query($sql, $params)->result();

        $this->load->helper('common_helper');
        foreach ($notices as $key => $notice) {
            if(substr($notice -> createTime,0,10)!=date('Y-m-d')){
                $notice -> createTime = date("Y-m-d h:i",strtotime($notice -> createTime));
            }else{
                $notice -> createTime = get_time_from_now($notice -> createTime);
            }

        }
//        exit(var_dump($notices));
        return array('status'=>'success', 'message'=> '', 'code'=>'', 'data' => $notices);
    }

    function readNotifies($targetID){
        // $this->db->delete('posts', array('post_id' => $postID));
        $this->db->where('for_who', $targetID);
        $this->db->update('notices', array(
            "is_read" => "1"
        ));
        return array('status' => 'success', 'message' => '', 'code' => '');
    }

}