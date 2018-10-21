<?php

class Picture_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    function getPictures($memberID, $type="NULL"){
        // 是否輸入會員識別碼
        if((int)$memberID == 0){
            return array('status'=>'failed', 'message'=>$this->lang->line('post_no_member_id'), 'code'=>'P0001');
        }

        // 會員是否存在
        $this->load->model('member_model');
        $member = $this -> member_model -> getMember($memberID)->row_array();
        if(is_null($member)){
            return array('status'=>'failed', 'message'=>$this->lang->line('post_member_not_found'), 'code'=>'P0002');
        }
		if(!isset($type)){
			$params = array();
			$sql = "SELECT * FROM pictures WHERE member_id = ? AND (is_deleted IS NULL OR is_deleted = 'N') AND (fileType='picture' OR fileType='movie') ORDER BY create_time DESC";
			array_push($params, $memberID);
			$pictures = $this->db->query($sql, $params)->result();
		}else if($type=="media"){
			$params = array();
			$sql = "SELECT * FROM pictures WHERE member_id = ? AND (is_deleted IS NULL OR is_deleted = 'N') AND fileType='picture' ORDER BY create_time DESC LIMIT 9";
			array_push($params, $memberID);
			$pictures = $this->db->query($sql, $params)->result();
		}else if($type=="lightbox"){
			$params = array();
			$sql = "SELECT * FROM pictures WHERE member_id = ? AND (is_deleted IS NULL OR is_deleted = 'N') AND fileType='picture' ORDER BY create_time DESC";
			array_push($params, $memberID);
			$pictures = $this->db->query($sql, $params)->result();
		}

        foreach($pictures as $key => $picture){
            //if(qiniu_exists($picture -> filename)){
                $oss_setting = get_qiniu_oss_setting();
                $ext = pathinfo($picture -> filename, PATHINFO_EXTENSION);

                if($picture -> fileType == "picture" && in_array($ext, array("png","jpg","jpeg"))){
                    $pictures[$key] -> path = $oss_setting["baseUrl"] . "70p/" . basename($picture -> filename);
                    $pictures[$key] -> small_path = $oss_setting["baseUrl"] . "10x10/" . basename($picture -> filename);
                }
                else{
                    $pictures[$key] -> path = $oss_setting["baseUrl"] . basename($picture -> filename);
                }
            //}
        }


        return array('status'=>'success', 'message'=>'', 'code'=>'', 'data' => $pictures);
    }


    /**
     * @param $memberID 倉類識別碼
     * @param $filePath 檔案路徑
     * @return array 圖片新增結果 (status: success|failed, message: 訊息, code: 錯誤代碼 )
     */
    function test($memberID, $filePath, $ext = array())
    {


        $picture = array(
            // "picture_id" => "Auto Increment",
            "member_id" => $memberID,
            "path" => $filePath,
            "filename" => basename($filePath),
            "length" => 0,
            "fileType" => "picture",
            "width" => isset($ext["image_width"]) ? $ext["image_width"] : 0,
            "height" => isset($ext["image_height"]) ? $ext["image_height"] : 0,
            "size" => isset($ext["file_size"]) ? $ext["file_size"] : 0,
            "create_time" => date("Y-m-d H:i:s")
        );

        $this->db->insert('pictures', $picture);
        if ($this->db->affected_rows() > 0){
            return  json_decode('{"status":"success","message":false,"code":"","id":693}');
        }else{
            return json_decode('{"status":"success","message":false,"code":"","id":693}');
        }
    }

    function addPicture($memberID, $filePath, $ext = array())
    {
        // 是否輸入會員識別碼
        if((int)$memberID == 0){
            return array('status'=>'failed', 'message'=>$this->lang->line('post_no_member_id'), 'code'=>'P0001');
        }

        // 會員是否存在
        $this->load->model('member_model');
        $member = $this -> member_model -> getMember($memberID)->row_array();
        if(is_null($member)){
            return array('status'=>'failed', 'message'=>$this->lang->line('post_member_not_found'), 'code'=>'P0002');
        }

        $picture = array(
            // "picture_id" => "Auto Increment",
            "member_id" => $memberID,
            "path" => $filePath,
            "filename" => basename($filePath),
            "length" => 0,
            "fileType" => "picture",
            "width" => isset($ext["image_width"]) ? $ext["image_width"] : 0,
            "height" => isset($ext["image_height"]) ? $ext["image_height"] : 0,
            "size" => isset($ext["file_size"]) ? $ext["file_size"] : 0,
            "create_time" => date("Y-m-d H:i:s")
        );

        $this->db->insert('pictures', $picture);
        if ($this->db->affected_rows() > 0){
            return array('status'=>'success', 'message'=>$this->lang->line('picture_add_success'), 'code'=>'', 'id' => $this->db->insert_id(),'path'=>$picture['path']);
        }else{
            return array('status'=>'failed', 'message'=>$this->lang->line('picture_add_failed'), 'code'=>'PIC0001');
        }
    }

    /**
     * @param $memberID 倉類識別碼
     * @param $filePath 檔案路徑
     * @return array 影片新增結果 (status: success|failed, message: 訊息, code: 錯誤代碼 )
     */
    function addMovie($memberID, $filePath, $ext = array())
    {
        // 是否輸入會員識別碼
        if((int)$memberID == 0){
            return array('status'=>'failed', 'message'=>$this->lang->line('post_no_member_id'), 'code'=>'P0001');
        }

        // 會員是否存在
        $this->load->model('member_model');
        $member = $this -> member_model -> getMember($memberID)->row_array();
        if(is_null($member)){
            return array('status'=>'failed', 'message'=>$this->lang->line('post_member_not_found'), 'code'=>'P0002');
        }

        $picture = array(
            // "picture_id" => "Auto Increment",
            "member_id" => $memberID,
            "path" => $filePath,
            "filename" => basename($filePath),
            "length" => 0,
            "fileType" => "movie",
            "width" => isset($ext["image_width"]) ? $ext["image_width"] : 0,
            "height" => isset($ext["image_height"]) ? $ext["image_height"] : 0,
            "size" => isset($ext["file_size"]) ? $ext["file_size"] : 0,
            "create_time" => date("Y-m-d H:i:s")
        );

        $this->db->insert('pictures', $picture);
        if ($this->db->affected_rows() > 0){
            return array('status'=>'success', 'message'=>$this->lang->line('picture_add_success'), 'code'=>'', 'id' => $this->db->insert_id(), 'path' => $picture["path"]);
        }else{
            return array('status'=>'failed', 'message'=>$this->lang->line('picture_add_failed'), 'code'=>'PIC0001');
        }
    }

    /**
     * 圖片是否存在
     * @param $pictureID 圖片識別碼
     * @return boolean
     */
    function isPictureExists($pictureID)
    {
        $params = array();
        $sql = "SELECT picture_id FROM pictures WHERE picture_id = ? ";
        array_push($params, $pictureID);

        return !is_null($this->db->query($sql, $params)->row_array());
    }

    /**
     * 刪除圖片
     * @param $pictureID 圖片識別碼
     * @return boolean
     */
    function delPicture($pictureID, $memberID)
    {
        $this->db->where('picture_id', $pictureID);
        $this->db->update('pictures', array(
            "is_deleted" => "Y",
            "delete_time" => date("Y-m-d H:i:s")
        ));
        return array('status' => 'success', 'message' => '', 'code' => '');
    }
}