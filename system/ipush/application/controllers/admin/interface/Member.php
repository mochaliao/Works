<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Member extends CI_Controller{
    
    public function __construct(){
        parent::__construct();
        // 讀取語系檔
        $this->lang->load('back', LANG);
    }
    
    // 取得介紹人
    public function get_member_by_pid(){
        $pid = $this->input->post('pid');
        $res = $this->member_md->get_member_by_pid($pid);
        echo json_encode( $res->result_array() );
    }
    
    // 取得會員
    public function get_member(){
        
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
                team_name      LIKE '%$search%' OR 
                account          LIKE '%$search%' OR 
                email          LIKE '%$search%' OR 
                certificate_id LIKE '%$search%'
            ) ";
        }
        
        $sql  = "SELECT *, CONCAT('admin/member/member_upd/', id) AS action 
                FROM v_member ";
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
    
    // 取得待實名驗證審核會員
    public function get_wait_member(){
        
        foreach($this->input->post() as $k => $v) ${$k} = $v;
        
        $search = trim($search['value']) != '' ? $this->db->escape_like_str($search['value']) : false;
        $where  = 'WHERE is_certified = 2 ';
        
        $order = array(
            'col' => $columns[$order[0]['column']]['name'],
            'dir' => $order[0]['dir']
        );
        
        if($search){
            $where .= " AND (
                name           LIKE '%$search%' OR 
                email          LIKE '%$search%'
            ) ";
        }
        
        $sql  = "SELECT *,
                    CONCAT('" . base_url('admin/member/member_upd/') . "', id) AS is_certified,
                    CONCAT('". HTTP_UPLOAD_ROOT ."/', SUBSTR(create_date, 1, 10), '/', account, '/certificate/', certificate_file1) AS certificate_file1,
                    CONCAT('". HTTP_UPLOAD_ROOT ."/', SUBSTR(create_date, 1, 10), '/', account, '/certificate/', certificate_file2) AS certificate_file2 
                 FROM v_member ";
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