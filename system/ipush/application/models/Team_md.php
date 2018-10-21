<?php


class Team_md extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    // 取得團隊資料
    function get_team($id = NULL)
    {
        $this->db->select('*')->from('v_team');
        if (!empty($id)){
            $this->db->where('id', $id);
        }

        return $this->db->get();
    }

    // 依上層團隊ID取得團隊資料
    function get_team_by_pid($pid)
    {
        $this->db->select('*')->from('v_team');
        $this->db->where('pid', $pid);
        return $this->db->get();
    }

    // 新增團隊
    function add_team($team)
    {
        $this->db->trans_start();
        if($this->db->insert('team', $team)){
            if( $this->member_md->upd_member($this->input->post('leader_id'), array( 'team_id' => $this->db->insert_id() )) ){
                $this->db->trans_complete();
                return true;
            }
        }
        $this->db->trans_rollback();
        return false;
    }

    // 修改團隊
    function upd_team($team)
    {
        return $this->db->where('id', $team['id'])->update('team', $team);
    }

}