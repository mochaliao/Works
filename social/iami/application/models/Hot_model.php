<?php
class hot_model extends CI_Model
{
    public function getPost($member_id, $start, $perPage, $mulThumb, $mulComments, $mulShare)
    {


//        $member_id = $this->session->userdata('member_id');
        $this->load->model('like_model');
        $this->load->model('post_model');
        $this->load->helper('common_helper');

        // 取得指定會員的多筆貼文(之後需要做分頁)

        $params = array();
        $sql = "SELECT trace_id FROM traces WHERE member_id = ? ";
        array_push($params, $member_id);
        $traces = $this->db->query($sql, $params)->result();


        // print_r($traces);
        $members = array();
        $members[]  = $member_id;
        foreach($traces as $trace){
            $members[] = $trace -> trace_id;
        }

        
        $sql = "SELECT friend_id FROM friends WHERE member_id = ? ";
        
        $friends = $this->db->query($sql, $params)->result();

        foreach($friends as $friend){
            $members[] = $friend -> friend_id;
        }

        $sql = "SELECT member_id FROM friends WHERE friend_id = ? ";
        
        $friends = $this->db->query($sql, $params)->result();

        foreach($friends as $friend){
            $members[] = $friend -> member_id;
        }

        $member_ids = implode(",",$members);



        $params = array();
        
        $sql = "SELECT (SELECT COUNT(*) FROM likes WHERE likes.post_id=p.post_id AND member_id <> p.member_id)*? AS Thumb, (SELECT COUNT(*) FROM comments WHERE comments.post_id=p.post_id AND member_id <> p.member_id)*? AS Comments, (SELECT COUNT(*) FROM posts WHERE posts.post_type=? AND posts.from_post_id=p.post_id AND member_id <> p.member_id)*? AS Share,  p.* FROM posts p 



        WHERE p.post_type <> 'video' AND (is_deleted IS NULL OR is_deleted = 'N' OR is_deleted = '') ORDER BY Thumb+Comments+Share DESC LIMIT ?, ?";
        
        array_push($params, $mulThumb, $mulComments, 'share', $mulShare, $start, $perPage);

        
        
        $postsCount = $this->db->query($sql, $params)->result();
        
        $postCount = count($postsCount);
        $pageTotal=ceil(count($postsCount)/$perPage);
        $posts = $this->db->query($sql, $params)->result();



        foreach ($posts as $key => $post) {
            $posts[$key]->member = $this->member_model->getMember($post -> member_id)->row_array();
            $posts[$key]->for_who = $this->member_model->getMember($post -> for_who)->row_array();
            if ($post->from_post_id > 0) {
                $sharePost = $this->post_model->getPost($post->from_post_id);
                $posts[$key]->share_post = $sharePost;
            }

            if($post -> post_type == "picture"){
                $res = $this -> post_model->getPicturesInPost($post -> post_id);
                if($res["status"] == "success"){
                    $posts[$key] -> pictures = $res["data"];
                }
            }

            if($post -> post_type == "video"){
                $res = $this -> post_model->getPicturesInPost($post -> post_id);
                if($res["status"] == "success"){
                    $posts[$key] -> video = $res["data"];
                }
            }

            $posts[$key] -> create_time = get_time_from_now($post -> create_time);

            $posts[$key] -> isLike = $this -> like_model -> isPostLikeExists($member_id, $post -> post_id) ? "Y":"N";
            $posts[$key] -> isCollect = $this -> post_model->isCollectionExists($member_id, $post -> post_id) ? "Y":"N";

            $posts[$key] -> likeCount = $this -> like_model -> getPostLikesCount($post -> post_id);
            $posts[$key] -> commentCount = $this -> post_model->getCommentCount($post -> post_id);
            $posts[$key] -> shareCount = $this -> post_model->getShareCount($post -> post_id);
        }
        return array('status' => 'success', 'message' => '', 'code' => '', 'data' => $posts, 'pageTotal'=> $pageTotal, 'postTotal'=>$postCount);
        // $this->load->view('hot_post');
    }

    public function getVideo($member_id, $start, $perPage, $mulThumb, $mulComments, $mulShare)
    {
        $member_id = $this->session->userdata('member_id');
        $params = array();
        $sql = "SELECT trace_id FROM traces WHERE member_id = ? ";
        array_push($params, $member_id);
        $traces = $this->db->query($sql, $params)->result();


        // print_r($traces);
        $members = array();
        $members[]  = $member_id;
        foreach($traces as $trace){
            $members[] = $trace -> trace_id;
        }

        
        $sql = "SELECT friend_id FROM friends WHERE member_id = ? ";
        
        $friends = $this->db->query($sql, $params)->result();

        foreach($friends as $friend){
            $members[] = $friend -> friend_id;
        }

        $sql = "SELECT member_id FROM friends WHERE friend_id = ? ";
        
        $friends = $this->db->query($sql, $params)->result();

        foreach($friends as $friend){
            $members[] = $friend -> member_id;
        }
        
        $param = array();
        $member_ids = implode(",",$members);


        $params = array();

        $sql = "SELECT (SELECT COUNT(*) FROM likes WHERE likes.post_id=p.post_id AND p.post_type='video' AND member_id <> p.member_id)*? AS Thumb, (SELECT COUNT(*) FROM comments WHERE comments.post_id=p.post_id AND p.post_type='video' AND member_id <> p.member_id)*? AS Comments, (SELECT COUNT(*) FROM posts WHERE posts.post_type=? AND posts.from_post_id=p.post_id AND member_id <> p.member_id)*? AS Share,  p.*, pp.*, pi.* FROM posts p 

        INNER JOIN post_pictures pp ON pp.post_id=p.post_id
        INNER JOIN pictures pi ON pi.picture_id=pp.picture_id

        WHERE p.post_type='video' AND (p.is_deleted IS NULL OR p.is_deleted = 'N' OR p.is_deleted = '' AND p.post_type='video') GROUP BY p.post_id ORDER BY Thumb+Comments+Share DESC LIMIT ?, ?";
        array_push($params, $mulThumb, $mulComments, 'share', $mulShare, $start, $perPage);
        
        $postsCount = $this->db->query($sql, $params)->result();
        $postCount = count($postsCount);
        $pageTotal=ceil(count($postsCount)/$perPage);
        $posts = $this->db->query($sql, $params)->result();



        foreach ($posts as $key => $post) {
            $posts[$key]->member = $this->member_model->getMember($post -> member_id)->row_array();
            $posts[$key]->for_who = $this->member_model->getMember($post -> for_who)->row_array();
            if ($post->from_post_id > 0) {
                $sharePost = $this->post_model->getPost($post->from_post_id);
                $posts[$key]->share_post = $sharePost;
            }

            if($post -> post_type == "picture"){
                $res = $this -> post_model->getPicturesInPost($post -> post_id);
                if($res["status"] == "success"){
                    $posts[$key] -> pictures = $res["data"];
                }
            }

            if($post -> post_type == "video"){
                $res = $this -> post_model->getPicturesInPost($post -> post_id);
                if($res["status"] == "success"){
                    if($res["data"] == array()){
                        unset($posts[$key]);
                        continue;
                    }
                    $posts[$key] -> video = $res["data"];
                }
                else{
                    unset($posts[$key]);
                    continue;
                }
            }

            $posts[$key] -> create_time = get_time_from_now($post -> create_time);

            $posts[$key] -> isLike = $this -> like_model -> isPostLikeExists($member_id, $post -> post_id) ? "Y":"N";
            $posts[$key] -> isCollect = $this -> post_model->isCollectionExists($member_id, $post -> post_id) ? "Y":"N";

            $posts[$key] -> likeCount = $this -> like_model -> getPostLikesCount($post -> post_id);
            $posts[$key] -> commentCount = $this -> post_model->getCommentCount($post -> post_id);
            $posts[$key] -> shareCount = $this -> post_model->getShareCount($post -> post_id);
        }
       // $result = $this->db->query($sql, $params)->result();
        $posts = array_values($posts);
        return array('status' => 'success', 'message' => '', 'code' => '', 'data' => $posts, 'pageTotal'=> $pageTotal, 'postTotal'=>$postCount);
    }

    public function initPost($member_id, $start, $perPage, $mulThumb, $mulComments, $mulShare){

        // 取得指定會員的多筆貼文(之後需要做分頁)

        $params = array();
        $sql = "SELECT trace_id FROM traces WHERE member_id = ? ";
        array_push($params, $member_id);
        $traces = $this->db->query($sql, $params)->result();


        // print_r($traces);
        $members = array();
        $members[]  = $member_id;
        foreach($traces as $trace){
            $members[] = $trace -> trace_id;
        }

        
        $sql = "SELECT friend_id FROM friends WHERE member_id = ? ";
        
        $friends = $this->db->query($sql, $params)->result();

        foreach($friends as $friend){
            $members[] = $friend -> friend_id;
        }

        $sql = "SELECT member_id FROM friends WHERE friend_id = ? ";
        
        $friends = $this->db->query($sql, $params)->result();

        foreach($friends as $friend){
            $members[] = $friend -> member_id;
        }

        


        // $params = array();
        // $sql = "SELECT member_id FROM friends WHERE friend_id = ? ";
        // array_push($params, $member_id);
        // $friends = $this->db->query($sql, $params)->result();

        
        // // print_r($traces);
        // $members = array();
        // $members[]  = $member_id;
        // foreach($friends as $friend){
        //     $members[] = $friend -> member_id;
        // }

       




        $param = array();
        $member_ids = implode(",",$members);


        // die($member_ids);

        $params = array();
        if(!is_null($member_id)){
        $sql = "SELECT (SELECT COUNT(*) FROM likes WHERE likes.post_id=p.post_id)*? AS Thumb, (SELECT COUNT(*) FROM comments WHERE comments.post_id=p.post_id AND comments.member_id<>$member_id)*? AS Comments, (SELECT COUNT(*) FROM posts WHERE posts.post_type=? AND posts.from_post_id=p.post_id)*? AS Share,  p.*, m.* FROM posts p 

        INNER JOIN members m ON m.member_id=p.member_id
        -- INNER JOIN likes l ON m.member_id=l.member_id
        -- INNER JOIN comments c ON c.member_id=l.member_id
        -- INNER JOIN collections ON collections.post_id=p.post_id

        WHERE p.member_id IN (" . $member_ids . ") OR p.for_who  IN (" . $member_ids . ") AND p.post_type <> 'video' AND (is_deleted IS NULL OR is_deleted = 'N' OR is_deleted = '') ORDER BY Thumb+Comments+Share DESC LIMIT ?, ?";

        array_push($params, $mulThumb, $mulComments, 'share', $mulShare,  $start, $perPage);

        }else{
        $sql = "SELECT (SELECT COUNT(*) FROM likes WHERE likes.post_id=p.post_id)*? AS Thumb, (SELECT COUNT(*) FROM comments WHERE comments.post_id=p.post_id)*? AS Comments, (SELECT COUNT(*) FROM posts WHERE posts.post_type=? AND posts.from_post_id=p.post_id)*? AS Share,  p.* FROM posts p 

        -- INNER JOIN members m ON m.member_id=p.member_id
        -- INNER JOIN likes l ON m.member_id=l.member_id
        -- INNER JOIN comments c ON c.member_id=l.member_id
        -- INNER JOIN collections ON collections.post_id=p.post_id

        WHERE p.post_type <> 'video' AND (is_deleted IS NULL OR is_deleted = 'N' OR is_deleted = '') ORDER BY Thumb+Comments+Share DESC LIMIT ?, ?";
        
        array_push($params, $mulThumb, $mulComments, 'share', $mulShare, $start, $perPage);
        }
        
        $result = $this->db->query($sql, $params)->result();

// var_dump($result);
        return $result;

    }

    public function initVideo($member_id, $start, $perPage, $mulThumb, $mulComments, $mulShare){


        $params = array();
        $sql = "SELECT trace_id FROM traces WHERE member_id = ? ";
        array_push($params, $member_id);
        $traces = $this->db->query($sql, $params)->result();


        // print_r($traces);
        $members = array();
        $members[]  = $member_id;
        foreach($traces as $trace){
            $members[] = $trace -> trace_id;
        }

        
        $sql = "SELECT friend_id FROM friends WHERE member_id = ? ";
        
        $friends = $this->db->query($sql, $params)->result();

        foreach($friends as $friend){
            $members[] = $friend -> friend_id;
        }

        $sql = "SELECT member_id FROM friends WHERE friend_id = ? ";
        
        $friends = $this->db->query($sql, $params)->result();

        foreach($friends as $friend){
            $members[] = $friend -> member_id;
        }
        
        $param = array();
        $member_ids = implode(",",$members);


        $params = array();
        if(!is_null($member_id)){
        $sql = "SELECT (SELECT COUNT(*) FROM likes WHERE likes.post_id=p.post_id AND p.post_type='video')*? AS Thumb, (SELECT COUNT(*) FROM comments WHERE comments.post_id=p.post_id AND p.post_type='video')*? AS Comments, (SELECT COUNT(*) FROM posts WHERE posts.post_type=? AND posts.from_post_id=p.post_id)*? AS Share,  p.*, pp.*, pi.*, m.* FROM posts p 

        INNER JOIN post_pictures pp ON pp.post_id=p.post_id
        INNER JOIN pictures pi ON pi.picture_id=pp.picture_id
        INNER JOIN members m ON m.member_id=pi.member_id

        WHERE p.member_id IN (" . $member_ids . ") OR p.for_who  IN (" . $member_ids . ") AND p.post_type='video' AND (p.is_deleted IS NULL OR p.is_deleted = 'N' OR p.is_deleted = '') ORDER BY Thumb+Comments+Share DESC LIMIT ?, ?";
        array_push($params, $mulThumb, $mulComments, 'share', $mulShare, $start, $perPage);
        }else{
        $sql = "SELECT (SELECT COUNT(*) FROM likes WHERE likes.post_id=p.post_id AND p.post_type='video')*? AS Thumb, (SELECT COUNT(*) FROM comments WHERE comments.post_id=p.post_id AND p.post_type='video')*? AS Comments, (SELECT COUNT(*) FROM posts WHERE posts.post_type=? AND posts.from_post_id=p.post_id)*? AS Share,  p.*, pp.*, pi.* FROM posts p 

        INNER JOIN post_pictures pp ON pp.post_id=p.post_id
        INNER JOIN pictures pi ON pi.picture_id=pp.picture_id

        WHERE p.post_type='video' AND (p.is_deleted IS NULL OR p.is_deleted = 'N' OR p.is_deleted = '') ORDER BY Thumb+Comments+Share DESC LIMIT ?, ?";
        array_push($params, $mulThumb, $mulComments, 'share', $mulShare, $start, $perPage);
        }
        $result = $this->db->query($sql, $params)->result();

        
// var_dump($result);
        return $result;

    }
}
?>