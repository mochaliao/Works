<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Order extends CI_Controller{
    
    public function __construct(){
        parent::__construct();
        // 讀取語系檔
        $this->lang->load('back', LANG);
    }
    
    // 取得訂單列表
    public function get_order(){
        
        foreach($this->input->post() as $k => $v) ${$k} = $v;
        
        $search = trim($search['value']) != '' ? $this->db->escape_like_str($search['value']) : false;
        $where  = '';
        
        $order = array(
            'col' => $columns[$order[0]['column']]['name'],
            'dir' => $order[0]['dir']
        );
        
        if($search){
            $where .= "WHERE (
                name            LIKE '%$search%' OR 
                pname           LIKE '%$search%' OR 
                team_name       LIKE '%$search%' OR 
                product_name    LIKE '%$search%' OR 
                price           LIKE '%$search%' OR 
                pay_type        LIKE '%$search%' OR 
                pay_name        LIKE '%$search%' OR 
                sys_member_name LIKE '%$search%'
            ) ";
        }
        
        $sql  = "SELECT *, CONCAT('admin/order/order_upd/', id) AS action FROM v_order ";
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