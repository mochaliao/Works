<?php

class Post_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    /**
     * 新增貼文
     *
     * @param string $memberID 會員識別碼
     * @param string $postType 貼文類型 (text: 文字貼文, picture: 圖片貼文, video: 影片貼文, share: 分享貼文, quote:引用貼文)
     * @param string $content 貼文內容(文字敘述)
     * @param array $tags 標註好友(識別碼)
     * @param array $pictures 圖片路徑
     * @param int $sharePostID 分享貼文的識別碼
     * @return array 發文結果 (status: success|failed, message: 訊息, code: 錯誤代碼 )
     */
    function doPost($memberID, $targetID = 0, $postType = "text", $content = "", $tags = array(), $sharePostID = 0, $pictures = array(), $movie = 0)
    {
        // 是否輸入會員識別碼
        if ((int)$memberID == 0) {
            return array('status' => 'failed', 'message' => $this->lang->line('post_no_member_id'), 'code' => 'P0001');
        }

        // 貼文型態是否正確
        if (!in_array($postType, array("text", "picture", "video", "share", "quote"))) {
            return array('status' => 'failed', 'message' => $this->lang->line('post_invalid_post_type'), 'code' => 'P0002');
        }

        // 貼文類型為分享貼文，卻沒指定從哪篇貼文分享過來的
        if ($postType == "share" && (int)$sharePostID == 0) {
            return array('status' => 'failed', 'message' => $this->lang->line('post_no_share_post_id'), 'code' => 'P0003');
        }

        // 會員是否存在
        $this->load->model('member_model');
        $member = $this->member_model->getMember($memberID)->row_array();
        if (is_null($member)) {
            return array('status' => 'failed', 'message' => $this->lang->line('post_member_not_found'), 'code' => 'P0004');
        }

        // 如貼文型態不為分享貼文，則sharePostID 歸零
        if ($postType != "share") {
            $sharePostID = 0;
        }
        else{
            $sharePost = $this -> getPost($sharePostID);
            while(($sharePostID = $sharePost["data"]["from_post_id"]) != 0){
                $sharePost = $this -> getPost($sharePostID);
            }
            $sharePostID = $sharePost["data"]["post_id"];
        }

//        $tmp = 0;
//        if($targetID!=0){
//            $tmp = $targetID;
//            $targetID = $memberID;
//            $memberID = $tmp;
//        }
        $post = array(
            // "post_id" => "Auto Increment",
            "member_id" => $memberID,
            "for_who" => $targetID,
            "content" => nl2br(htmlentities($content)),
            "post_type" => $postType,
            "post_ip" => $_SERVER['REMOTE_ADDR'],
            "from_post_id" => $sharePostID,
            "create_time" => date("Y-m-d H:i:s"),
            /////////////////////////////////
            ///  以後如有打卡功能，可能會用到
            "longitude" => 0,
            "latitude" => 0
            /////////////////////////////////
        );

        $this->db->insert('posts', $post);
        if ($this->db->affected_rows() == 0) {
            return array('status' => 'failed', 'message' => $this->lang->line('post_add_failed'), 'code' => 'P0005');
        }

        $postID = $this->db->insert_id();

        if ($postType == "picture") {
            $this->addPictures($memberID, $postID, $pictures);
        }

        if ($postType == "video") {
            $this->addMovie($memberID, $postID, $movie);
        }

        if (count($tags) > 0) {
            $this->addTags($memberID, $postID, $tags);
        }

        // 貼文是給其他人的
        if($targetID != $memberID){
            $this->load->model('like_model');
            $this -> like_model -> addNotify($memberID, $targetID, "Wall", ("/page/main?post_id=" . $postID));
        }


        return array('status' => 'success', 'message' => $this->lang->line('post_add_success'), 'code' => '', 'id' => $postID);

    }


    /**
     * 貼文與圖片關聯
     * @param $memberID  會員識別碼
     * @param $postID 貼文識別碼
     * @param array $pictures 圖片識別碼
     */
    function addPictures($memberID, $postID, $pictures = array())
    {
        $this->load->model('picture_model');

        foreach ($pictures as $pictureID) {
            // $res = $this->picture_model->addPicture($memberID, $picture);
            // if ($res["status"] == "success") {
            //     $pictureID = $res["id"];

            $post_pictures = array(
                // "sn" => "Auto Increment",
                "post_id" => $postID,
                "picture_id" => $pictureID,
                "create_time" => date("Y-m-d H:i:s")
            );

            $this->db->insert('post_pictures', $post_pictures);
            // }
        }


    }

    /**
     * 貼文與影片關聯
     * @param $memberID  會員識別碼
     * @param $postID 貼文識別碼
     * @param array $movie 影片識別碼
     */
    function addMovie($memberID, $postID, $movieID)
    {
        $this->load->model('picture_model');

        // foreach ($pictures as $pictureID) {
        // $res = $this->picture_model->addPicture($memberID, $picture);
        // if ($res["status"] == "success") {
        //     $pictureID = $res["id"];

        $post_pictures = array(
            // "sn" => "Auto Increment",
            "post_id" => $postID,
            "picture_id" => $movieID,
            "create_time" => date("Y-m-d H:i:s")
        );

        $this->db->insert('post_pictures', $post_pictures);



    }


    /**
     * 貼文與標註者關聯
     * @param $memberID  會員識別碼
     * @param $postID 貼文識別碼
     * @param array $tags 標註會員識別碼
     */
    function addTags($memberID, $postID, $tags = array())
    {

        $this->load->model('member_model');
        foreach ($tags as $tag) {
            // 標註者不可為貼文者
            if ($memberID == $tag) {
                continue;
            }

            // 檢查被標註的會員是否存在
            $member = $this->member_model->getMember($tag)->row_array();

            if (!is_null($member)) {
                $post_tag = array(
                    // "sn" => "Auto Increment",
                    "post_id" => $postID,
                    "member_id" => $tag,
                    "create_time" => date("Y-m-d H:i:s")
                );

                $this->db->insert('post_tags', $post_tag);
            }
        }


    }


    /**
     * 新增留言
     * @param $memberID 會員識別碼
     * @param $postID 貼文識別碼
     * @param string $content 留言內容
     * @return array 留言結果 (status: success|failed, message: 訊息, code: 錯誤代碼 )
     */
    function doComment($memberID, $postID, $content = "")
    {
//        $friendID = $this->input->get_post('member_id');
        $friend_id = "";
        if(!empty($this->input->get_post('friend_id'))) {
            $friend_id = $this->input->get_post('friend_id');
        }
        // 是否輸入會員識別碼
        if ((int)$memberID == 0) {
            return array('status' => 'failed', 'message' => $this->lang->line('post_no_member_id'), 'code' => 'P0001');
        }

        // 是否輸入貼文識別碼
        if ((int)$postID == 0) {
            return array('status' => 'failed', 'message' => $this->lang->line('post_no_post_id'), 'code' => 'P0006');
        }

        // 會員是否存在
        $this->load->model('member_model');
        $member = $this->member_model->getMember($memberID)->row_array();
        if (is_null($member)) {
            return array('status' => 'failed', 'message' => $this->lang->line('post_member_not_found'), 'code' => 'P0004');
        }

        // 貼文是否存在
        if (!$this->isPostExists($postID)) {
            return array('status' => 'failed', 'message' => $this->lang->line('post_not_found'), 'code' => 'P0007');
        }


        $post = array(
            // "sn" => "Auto Increment",
            "member_id" => $memberID,
            "post_id" => $postID,
            "content" => $content,
            "comment_ip" => $_SERVER['REMOTE_ADDR'],
            "create_time" => date("Y-m-d H:i:s"),
            "friend_tags" => $friend_id
        );

        

        $this->db->insert('comments', $post);
        if ($this->db->affected_rows() == 0) {
            return array('status' => 'failed', 'message' => $this->lang->line('post_add_comment_failed'), 'code' => 'P0005');
        } else {

            $lasi_id = $this->db->insert_id();

            $pure_post = $this -> getPurePost($postID);

            $this->load->model('like_model');
            $this -> like_model -> addNotify($memberID, $pure_post["member_id"], "Comment", ("/page/main?post_id=" . $postID));
//            $friend_id = array('13','246');
//            $friend_id = '{"no1":13}';

            if(!empty($friend_id)) {
                $friend_id = json_decode($friend_id);
                $this->load->model('tags_model');
                foreach($friend_id as $key=>$value) {
                    $this->tags_model->addTags($postID, $memberID, $key);
                }
            }
            return array('status' => 'success', 'message' => $this->lang->line('post_add_comment_success'), 'code' => '', 'id' => $lasi_id);


        }
    }

    /**
     * 貼文是否存在
     * @param $postID 貼文識別碼
     * @return boolean
     */
    function isPostExists($postID)
    {
        $params = array();
        $sql = "SELECT post_id FROM posts WHERE post_id = ? ";
        array_push($params, $postID);

        return !is_null($this->db->query($sql, $params)->row_array());
    }

    /**
     * 取得純貼文資料
     * @param $postID 貼文識別碼
     * @return boolean
     */
    function getPurePost($postID)
    {
        $params = array();
        $sql = "SELECT * FROM posts WHERE post_id = ? ";
        array_push($params, $postID);

        return $this->db->query($sql, $params)->row_array();
    }



    /**
     * 取得貼文
     * @param $postID 貼文識別碼
     * @return array 貼文資訊 (status: success|failed, message: 訊息, code: 錯誤代碼 )
     */
    function getPost($postID)
    {
        $params = array();
        $sql = "SELECT * FROM posts WHERE post_id = ? AND (is_deleted IS NULL OR is_deleted = 'N' OR is_deleted = '')";
        array_push($params, $postID);

        $post = $this->db->query($sql, $params)->row_array();
        if (is_null($post)) {
            return array('status' => 'failed', 'message' => $this->lang->line('post_not_found'), 'code' => 'P0007');
        }


        $this->load->model('member_model');
        $member = $this->member_model->getMember($post["member_id"])->row_array();
        if (is_null($member)) {
            return array('status' => 'failed', 'message' => $this->lang->line('post_member_not_found'), 'code' => 'P0004');
        }

        $post["member"] = $member;

        if ($post["from_post_id"] > 0) {
            $sharePost = $this->getPost($post["from_post_id"]);
            $post["share_post"] = $sharePost;
        }

        if($post["post_type"] == "picture"){
            $res = $this -> getPicturesInPost($post["post_id"]);
            if($res["status"] == "success"){
                $post["pictures"] = $res["data"];
            }
        }

        if($post["post_type"] == "video"){
            $res = $this -> getPicturesInPost($post["post_id"]);
            if($res["status"] == "success"){
                $post["video"] = $res["data"];
            }
        }

        $post["create_time"] = get_time_from_now($post["create_time"]);


        return array('status' => 'success', 'message' => '', 'code' => '', 'data' => $post);
    }

    /**
     * 取得指定會員的多筆貼文
     * @param $memberID 會員識別碼
     * @return array 貼文資訊(status: success|failed, message: 訊息, code: 錯誤代碼 )
     */
    function getPosts($memberID, $postID, $perPage, $Page)
    {

        // 檢查會員是否存在
        $this->load->model('member_model');
        $member = $this->member_model->getMember($memberID)->row_array();
        if (is_null($member)) {
            return array('status' => 'failed', 'message' => $this->lang->line('post_member_not_found'), 'code' => 'P0004');
        }

        // 取得指定會員的多筆貼文(之後需要做分頁)

        $params = array();
        $sql = "SELECT trace_id FROM traces WHERE member_id = ? ";
        array_push($params, $memberID);
        $traces = $this->db->query($sql, $params)->result();
        // print_r($traces);
        $members = array();
        $members[]  = $memberID;
        foreach($traces as $trace){
            $members[] = $trace -> trace_id;
        }
        
        $param = array();
        $member_ids = implode(",",$members);
        $sql_count = "SELECT * FROM posts WHERE (member_id IN (" . $member_ids . ") OR for_who  IN (" . $member_ids . ")) AND (is_deleted IS NULL OR is_deleted = 'N' OR is_deleted = '') ORDER BY create_time DESC ";
        $postsCount = $this->db->query($sql_count, $param)->result();
        
        $postCount = count($postsCount);
        // var_dump($postsCount);
        // $page = ceil($postsCount/$perPage);
        if(!isset($perPage)){
            $perPage= '10';
        }
        $pageTotal=ceil(count($postsCount)/$perPage);
        if (!isset($Page)){ //假如$_GET["page"]未設置
            $Page=1; //則在此設定起始頁數
        }
        $start = ($Page-1)*$perPage;
        
        $params = array();
        if(!isset($postID)){
        $sql = "SELECT p.* FROM posts p LEFT JOIN posts pp ON p.from_post_id=pp.post_id WHERE (p.member_id IN (" . $member_ids . ") OR p.for_who  IN (" . $member_ids . ")) AND (p.is_deleted IS NULL OR p.is_deleted = 'N' OR p.is_deleted = '') AND (pp.is_deleted IS NULL OR pp.is_deleted = 'N' OR pp.is_deleted = '') ORDER BY p.create_time DESC LIMIT $start, $perPage";
        }else{
        $sql = "SELECT p.* FROM posts p LEFT JOIN posts pp ON p.from_post_id=pp.post_id WHERE (p.member_id IN (" . $member_ids . ") OR p.for_who  IN (" . $member_ids . ")) AND (p.is_deleted IS NULL OR p.is_deleted = 'N' OR p.is_deleted = '') AND (pp.is_deleted IS NULL OR pp.is_deleted = 'N' OR pp.is_deleted = '') AND p.post_id = $postID ORDER BY p.create_time DESC";
        }
        if(isset($postID)){
            $pageTotal = 1;
        }
       // array_push($params, $memberID);
       // array_push($params, $memberID);

        $posts = $this->db->query($sql, $params)->result();

        $this->load->model('like_model');
        $this->load->helper('common_helper');

        foreach ($posts as $key => $post) {
            $posts[$key]->member = $this->member_model->getMember($post -> member_id)->row_array();
            $posts[$key]->for_who = $this->member_model->getMember($post -> for_who)->row_array();
            if ($post->from_post_id > 0) {
                $sharePost = $this->getPost($post->from_post_id);
                $posts[$key]->share_post = $sharePost;
            }

            if($post -> post_type == "picture"){
                $res = $this -> getPicturesInPost($post -> post_id);
                if($res["status"] == "success"){
                    $posts[$key] -> pictures = $res["data"];
                }
            }

            if($post -> post_type == "video"){
                $res = $this -> getPicturesInPost($post -> post_id);
                if($res["status"] == "success"){
                    $posts[$key] -> video = $res["data"];
                }
            }

            $posts[$key] -> create_time = get_time_from_now($post -> create_time);

            $posts[$key] -> isLike = $this -> like_model -> isPostLikeExists($memberID, $post -> post_id) ? "Y":"N";
            $posts[$key] -> isCollect = $this -> isCollectionExists($memberID, $post -> post_id) ? "Y":"N";

            $posts[$key] -> likeCount = $this -> like_model -> getPostLikesCount($post -> post_id);
            $posts[$key] -> commentCount = $this -> getCommentCount($post -> post_id);
            $posts[$key] -> shareCount = $this -> getShareCount($post -> post_id);
        }
        return array('status' => 'success', 'message' => '', 'code' => '', 'data' => $posts, 'pageTotal'=> $pageTotal, 'postTotal'=>$postCount);
    }

    /**
     * 取得指定會員的多筆貼文
     * @param $memberID 會員識別碼
     * @return array 貼文資訊(status: success|failed, message: 訊息, code: 錯誤代碼 )
     */
    function getSelfPosts($memberID, $postID, $perPage, $Page)
    {



        // 檢查會員是否存在
        $this->load->model('member_model');
        $member = $this->member_model->getMember($memberID)->row_array();
        if (is_null($member)) {
            return array('status' => 'failed', 'message' => $this->lang->line('post_member_not_found'), 'code' => 'P0004');
        }

        // 取得指定會員的多筆貼文(之後需要做分頁)

        $param = array();
        // $member_ids = implode(",",$members);

        $sql_count = "SELECT * FROM posts WHERE (member_id = ? OR for_who = ? ) AND (is_deleted IS NULL OR is_deleted = 'N' OR is_deleted = '') ORDER BY create_time";
        array_push($param, $memberID);
        array_push($param, $memberID);
        $postsCount = $this->db->query($sql_count, $param)->result();
        $postCount = count($postsCount);


        if(!isset($perPage)){
            $perPage= '10';
        }
        $pageTotal=ceil(count($postsCount)/$perPage);
        if (!isset($Page)){ //假如$_GET["page"]未設置
            $Page=1; //則在此設定起始頁數
        }
        $start = ($Page-1)*$perPage;

        
        $params = array();
        if(!isset($postID)){
        $sql = "SELECT p.* FROM posts p LEFT JOIN posts pp ON p.from_post_id=pp.post_id WHERE (p.member_id = ? OR p.for_who = ? ) AND (p.is_deleted IS NULL OR p.is_deleted = 'N' OR p.is_deleted = '') AND (pp.is_deleted IS NULL OR pp.is_deleted = 'N' OR pp.is_deleted = '') ORDER BY p.create_time DESC LIMIT $start, $perPage";
        }else{
        $sql = "SELECT p.* FROM posts p LEFT JOIN posts pp ON p.from_post_id=pp.post_id WHERE (p.member_id = ? OR p.for_who = ? ) AND (p.is_deleted IS NULL OR p.is_deleted = 'N' OR p.is_deleted = '') AND p.post_id = $postID ORDER BY p.create_time DESC";
        }
        array_push($params, $memberID);
        array_push($params, $memberID);

        $posts = $this->db->query($sql, $params)->result();

        $this->load->model('like_model');
        $this->load->helper('common_helper');

        foreach ($posts as $key => $post) {
            $posts[$key]->member = $this->member_model->getMember($post -> member_id)->row_array();
            $posts[$key]->for_who = $this->member_model->getMember($post -> for_who)->row_array();
            if ($post->from_post_id > 0) {
                $sharePost = $this->getPost($post->from_post_id);
                $posts[$key]->share_post = $sharePost;
            }

            if($post -> post_type == "picture"){
                $res = $this -> getPicturesInPost($post -> post_id);
                if($res["status"] == "success"){
                    $posts[$key] -> pictures = $res["data"];
                }
            }

            if($post -> post_type == "video"){
                $res = $this -> getPicturesInPost($post -> post_id);
                if($res["status"] == "success"){
                    $posts[$key] -> video = $res["data"];
                }
            }

            $posts[$key] -> create_time = get_time_from_now($post -> create_time);

            $selfID = $this -> session -> userdata("member_id");

            $posts[$key] -> isLike = $this -> like_model -> isPostLikeExists($selfID, $post -> post_id) ? "Y":"N";
            $posts[$key] -> isCollect = $this -> isCollectionExists($selfID, $post -> post_id) ? "Y":"N";

            $posts[$key] -> likeCount = $this -> like_model -> getPostLikesCount($post -> post_id);
            $posts[$key] -> commentCount = $this -> getCommentCount($post -> post_id);
            $posts[$key] -> shareCount = $this -> getShareCount($post -> post_id);
        }
        return array('status' => 'success', 'message' => '', 'code' => '', 'data' => $posts, 'pageTotal'=> $pageTotal, 'postTotal'=>$postCount);


    }

    /**
     * 貼除貼文
     * @param $postID 貼文識別碼
     * @return array 刪除結果
     */
    function delPost($postID, $memberID)
    {
        // $this->db->delete('posts', array('post_id' => $postID));
        $this->db->where('member_id', $memberID);
        $this->db->where('post_id', $postID);
        $this->db->update('posts', array(
            "is_deleted" => "Y",
            "delete_time" => date("Y-m-d H:i:s")
        ));
        return array('status' => 'success', 'message' => $this->lang->line('post_del_success'), 'code' => '');
    }

    /**
     *  編輯貼文
     * @param $postID 貼文識別碼
     * @param $memberID 會員識別碼
     * @param $content 編輯內容
     */
    function editPost($postID, $memberID, $content){
        $this->db->where('member_id', $memberID);
        $this->db->where('post_id', $postID);
        $this->db->update('posts', array(
            "content" => $content
        ));
        return array('status' => 'success', 'message' => $this->lang->line('post_edit_success'), 'code' => '');
    }

    /**
     * 貼除留言
     * @param $postID 留言識別碼
     * @return array 刪除結果
     */
    function delComment($commentID, $memberID)
    {
        $this->db->where('sn', $commentID);
        $this->db->update('comments', array(
            "is_deleted" => "Y",
            "delete_time" => date("Y-m-d H:i:s")
        ));
        return array('status' => 'success', 'message' => $this->lang->line('post_del_comment_success'), 'code' => '');
    }

    /**
     * 編輯留言
     * @param $postID 留言識別碼
     * @return array 編輯結果
     */
    function editComment($commentID, $content)
    {
        $this->db->where('sn', $commentID);
        $this->db->update('comments', array(
            "content" => $content
        ));
        return array('status' => 'success', 'message' => $this->lang->line('post_edit_comment_success'), 'code' => '');
    }

    /**
     * 留言是否存在
     * @param $commentID 留言識別碼
     * @return boolean
     */
    function isCommentExists($commentID)
    {
        $params = array();
        $sql = "SELECT sn FROM comments WHERE sn = ? ";
        array_push($params, $commentID);

        return !is_null($this->db->query($sql, $params)->row_array());
    }

    /**
     * 取得指定貼文的多筆留言
     * @param $postID 貼文識別碼
     * @return array 留言資訊(status: success|failed, message: 訊息, code: 錯誤代碼 )
     */
    function getComments($postID)
    {
        // 取得指定會員的多筆貼文(之後需要做分頁)
        $params = array();
        $sql = "SELECT * FROM comments WHERE post_id = ? AND (is_deleted IS NULL OR is_deleted = 'N' OR is_deleted = '') ORDER BY create_time ASC";
        array_push($params, $postID);

        $comments = $this->db->query($sql, $params)->result();

        // 檢查會員是否存在
        $this->load->model('member_model');
        $this->load->model('like_model');
        foreach ($comments as $key => $comment) {
            $comments[$key]->member = $this->member_model->getMember($comment -> member_id)->row_array();
            $comments[$key] -> isLike = $this -> like_model -> isCommentLikeExists($comment -> member_id, $comment -> sn) ? "Y":"N";
        }
//        $this->load->model('tags_model');
//        $member_id = $this->session->userdata('member_id');
//        $friend_id = $this->tags_model->getTagsbyID($member_id);
        return array('status' => 'success', 'message' => '', 'code' => '', 'data' => $comments);
    }

    /**
     * 取得指定貼文的留言數量
     * @param $postID 貼文識別碼
     * @return integer 數量
     */
    function getCommentCount($postID)
    {
        // 取得指定會員的多筆貼文(之後需要做分頁)
        $params = array();
        $sql = "SELECT * FROM comments WHERE post_id = ? AND (is_deleted IS NULL OR is_deleted = 'N' OR is_deleted = '') ORDER BY create_time ASC";
        array_push($params, $postID);

        $count = $this->db->query($sql, $params)->num_rows();

        return $count;
    }

    /**
     * 取得指定貼文數量
     * @param $postID 貼文識別碼
     * @return integer 數量
     */
    function getPostCount($memberID)
    {
        // 取得指定會員的多筆貼文(之後需要做分頁)
        $params = array();
        $sql = "SELECT p.* FROM posts p LEFT JOIN posts pp ON p.from_post_id=pp.post_id WHERE (p.member_id = ? OR p.for_who = ?) AND (p.is_deleted IS NULL OR p.is_deleted = 'N' OR p.is_deleted = '') AND (pp.is_deleted IS NULL OR pp.is_deleted = 'N' OR pp.is_deleted = '')";
        array_push($params, $memberID);
        array_push($params, $memberID);

        $count = $this->db->query($sql, $params)->num_rows();

        return $count;
    }


    /**
     * 取得指定貼文的所有圖片
     * @param $postID
     * @return array 圖片
     */
    function getPicturesInPost($postID)
    {
        // 貼文是否存在
        if (!$this->isPostExists($postID)) {
            return array('status' => 'failed', 'message' => $this->lang->line('post_not_found'), 'code' => 'P0007');
        }

        // 取得指定會員的多筆貼文(之後需要做分頁)
        $params = array();
        $sql = "SELECT pictures.* FROM post_pictures, pictures WHERE post_pictures.post_id = ? AND (pictures.is_deleted IS NULL OR pictures.is_deleted = 'N' OR pictures.is_deleted = '') AND post_pictures.picture_id = pictures.picture_id ";
        array_push($params, $postID);

        $pictures = $this->db->query($sql, $params)->result();

        $oss_setting = get_qiniu_oss_setting();

        foreach($pictures as $key => $picture){
            //if(qiniu_exists($picture -> filename)){

                $ext = pathinfo($picture -> filename, PATHINFO_EXTENSION);

                if($picture -> fileType == "picture" && in_array(strtolower($ext), array("png","jpg","jpeg"))){
                    $pictures[$key] -> path = $oss_setting["baseUrl"] . "70p/" . basename($picture -> filename);
                    $pictures[$key] -> small_path = $oss_setting["baseUrl"] . "10x10/" . basename($picture -> filename);
                }
                else{
                    $pictures[$key] -> path = $oss_setting["baseUrl"] . basename($picture -> filename);
                }
            //}
        }

        return array('status' => 'success', 'message' => '', 'code' => '', 'data' => $pictures);
    }

    /**
     * 收藏貼文
     * @param $memberID 會員識別碼
     * @param $postID 貼文識別碼
     * @return array 收藏/刪除收藏貼文結果
     */
    function collectPost($memberID, $postID)
    {
        // 會員是否存在
        $this->load->model('member_model');
        $member = $this->member_model->getMember($memberID)->row_array();
        if (is_null($member)) {
            return array('status' => 'failed', 'message' => $this->lang->line('post_member_not_found'), 'code' => 'P0004');
        }

        // 貼文是否存在
        if (!$this->isPostExists($postID)) {
            return array('status' => 'failed', 'message' => $this->lang->line('post_not_found'), 'code' => 'P0007');
        }

        if ($this->isCollectionExists($memberID, $postID)) {
            $this->db->delete('collections', array('post_id' => $postID, "member_id" => $memberID));
            return array('status' => 'success', 'message' => $this->lang->line('post_del_collect_success'), 'code' => '', "data" => "no");
        } else {

            $collection = array(
                // "sn" => "Auto Increment",
                "member_id" => $memberID,
                "post_id" => $postID,
                "create_time" => date("Y-m-d H:i:s")
            );

            $this->db->insert('collections', $collection);
            if ($this->db->affected_rows() == 0) {
                return array('status' => 'failed', 'message' => $this->lang->line('post_collect_failed'), 'code' => 'P0008');
            } else {
                return array('status' => 'success', 'message' => $this->lang->line('post_collect_success'), 'code' => '', 'id' => $this->db->insert_id(), "data" => "yes");
            }
        }
    }

    /**
     * 取得指定會員的多筆收藏貼文
     * @param $memberID 會員識別碼
     * @return array 貼文資訊(status: success|failed, message: 訊息, code: 錯誤代碼 )
     */
    function getCollections($memberID)
    {

        // 檢查會員是否存在
        $this->load->model('member_model');
        $member = $this->member_model->getMember($memberID)->row_array();
        if (is_null($member)) {
            return array('status' => 'failed', 'message' => $this->lang->line('post_member_not_found'), 'code' => 'P0004');
        }

        // 取得指定會員的多筆貼文(之後需要做分頁)
        $params = array();
        $sql = "SELECT posts.* FROM collections, posts LEFT JOIN posts pp ON posts.from_post_id=pp.post_id WHERE collections.member_id = ? AND (posts.is_deleted IS NULL OR posts.is_deleted = 'N' OR posts.is_deleted = '') AND (pp.is_deleted IS NULL OR pp.is_deleted = 'N' OR pp.is_deleted = '') AND collections.post_id = posts.post_id ORDER BY posts.create_time DESC ";
        array_push($params, $memberID);

        $posts = $this->db->query($sql, $params)->result();

        $this->load->model('like_model');
        $this->load->helper('common_helper');

        foreach ($posts as $key => $post) {
            $posts[$key]->member = $this->member_model->getMember($post -> member_id)->row_array();
            $posts[$key]->for_who = $this->member_model->getMember($post -> for_who)->row_array();
            if ($post->from_post_id > 0) {
                $sharePost = $this->getPost($post->from_post_id);
                $posts[$key]->share_post = $sharePost;
            }

            if($post -> post_type == "picture"){
                $res = $this -> getPicturesInPost($post -> post_id);
                if($res["status"] == "success"){
                    $posts[$key] -> pictures = $res["data"];
                }
            }

            if($post -> post_type == "video"){
                $res = $this -> getPicturesInPost($post -> post_id);
                if($res["status"] == "success"){
                    $posts[$key] -> video = $res["data"];
                }
            }

            $posts[$key] -> create_time = get_time_from_now($post -> create_time);

            $posts[$key] -> isLike = $this -> like_model -> isPostLikeExists($memberID, $post -> post_id) ? "Y":"N";
            $posts[$key] -> isCollect = $this -> isCollectionExists($memberID, $post -> post_id) ? "Y":"N";

            $posts[$key] -> likeCount = $this -> like_model -> getPostLikesCount($post -> post_id);
            $posts[$key] -> commentCount = $this -> getCommentCount($post -> post_id);
            $posts[$key] -> shareCount = $this -> getShareCount($post -> post_id);
        }
        return array('status' => 'success', 'message' => '', 'code' => '', 'data' => $posts);
    }

    function getCollectionCount($memberID)
    {

        // 檢查會員是否存在
        $this->load->model('member_model');
        $member = $this -> member_model -> getMember($memberID)->row_array();
        if (is_null($member)) {
            return array('status' => 'failed', 'message' => $this->lang->line('post_member_not_found'), 'code' => 'P0004');
        }

        // 取得指定會員的多筆貼文(之後需要做分頁)
        $params = array();
        $sql = "SELECT posts.* FROM collections, posts LEFT JOIN posts pp ON posts.from_post_id=pp.post_id WHERE collections.member_id = ? AND (posts.is_deleted IS NULL OR posts.is_deleted = 'N' OR posts.is_deleted = '') AND (pp.is_deleted IS NULL OR pp.is_deleted = 'N' OR pp.is_deleted = '') AND collections.post_id = posts.post_id ORDER BY posts.create_time DESC ";
        array_push($params, $memberID);

        $count = $this->db->query($sql, $params)->num_rows();


        return $count;
    }

    /**
     * 收藏是否存在
     * @param $memberID 會員識別碼
     * @param $postID 貼文識別碼
     * @return bool 是否存在
     */
    function isCollectionExists($memberID, $postID)
    {
        $params = array();
        $sql = "SELECT post_id FROM collections WHERE post_id = ? AND member_id = ?";
        array_push($params, $postID);
        array_push($params, $memberID);

        return !is_null($this->db->query($sql, $params)->row_array());
    }

    /**
     * 取得指定貼文的被分享的數量
     * @param $postID 貼文識別碼
     * @return integer 數量
     */
    function getShareCount($postID)
    {
        // 取得指定會員的多筆貼文(之後需要做分頁)
        $params = array();
        $sql = "SELECT * FROM posts WHERE from_post_id = ? AND (is_deleted IS NULL OR is_deleted = 'N' OR is_deleted = '')";
        array_push($params, $postID);

        $count = $this->db->query($sql, $params)->num_rows();

        return $count;
    }

    /**
     * 取得指定貼文的被分享的數量
     * @param $postID 貼文識別碼
     * @return integer 數量
     */
    function getShares($postID)
    {
        // 取得指定會員的多筆貼文(之後需要做分頁)
        $params = array();
        $sql = "SELECT * FROM posts WHERE from_post_id = ? AND (is_deleted IS NULL OR is_deleted = 'N' OR is_deleted = '')";
        array_push($params, $postID);

        $shares = $this->db->query($sql, $params)->result();

        $this->load->model('like_model');
        $this->load->model('member_model');

        foreach ($shares as $key => $share) {
            $shares[$key]->member = $this->member_model->getMember($share -> member_id)->row_array();
            $shares[$key]->for_who = $this->member_model->getMember($share -> for_who)->row_array();
        }

        return array('status' => 'success', 'message' => '', 'code' => '', 'data' => $shares);
    }

    //貼文可以標註好友
    function getTags($member_id)
    {
        $params = array();
        $sql = "SELECT * FROM friends WHERE member_id=? OR friend_id=?";
        array_push($params, $member_id);
        $result = $this->db->query($sql, $params);

        return $result;
    }
}