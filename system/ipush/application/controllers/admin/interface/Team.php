<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Team extends CI_Controller{
    
    public function __construct(){
        parent::__construct();
        // 讀取語系檔
        $this->lang->load('back', LANG);
        // 讀取團隊 Model
        $this->load->model('team_md');
    }
    
    // 取得團隊
    public function get_team_by_pid(){
        $pid = $this->input->post('pid');
        echo json_encode( $this->team_md->get_team_by_pid($pid)->result_array() );
    }
    
    // 取得團隊列表用
    public function get_team(){
        
        foreach($this->input->post() as $k => $v) ${$k} = $v;
        
        $search = trim($search['value']) != '' ? $this->db->escape_like_str($search['value']) : false;
        $where  = '';
        
        $order = array(
            'col' => $columns[$order[0]['column']]['name'],
            'dir' => $order[0]['dir']
        );
        
        if($search){
            $where .= "WHERE (
                name           LIKE '%$search%' OR 
                pname          LIKE '%$search%' OR 
                leader_name      LIKE '%$search%'
            ) ";
        }
        
        $sql  = "SELECT *, CONCAT('admin/team/team_upd/', id) AS action FROM v_team ";
        $sql .= $where;
        $sql .= 'ORDER BY ' . $order['col'] . ' ' . $order['dir'] . ' ';
        
        $res = $this->db->query(str_replace('*', 'id', $sql));
        $all_rows = $res->num_rows();
        
        $sql .= "LIMIT $start, $length;";
        
        $res = $this->db->query($sql);
        
        $response = array(
            'draw'            => $this->input->post('draw'),
            'recordsTotal'    => $all_rows,
            'recordsFiltered' => $all_rows,
            'data' => $res->result_array()
        );
        
        echo json_encode($response);
    }
    
}

?>