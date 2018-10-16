<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Product_md extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    // 取得方案資料
    public function get_product($id = NULL, $status = null)
    {
        $this->db->select('*')->from('product');
        if (!empty($id)){
            $this->db->where('id', $id);
        }
        
        if($status !== null){
            $this->db->where('status', $status);
        }

        return $this->db->get();
    }

    // 新增方案
    public function add_product($product)
    {
        return $this->db->insert('product', $product);
    }

    // 修改方案
    public function update_product($product)
    {
        return $this->db->where('id', $product['id'])->update('product', $product);
    }

}