<?php

class Country_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    function getCountry($country_id = NULL, $status = 1)
    {
        $params = array();
        $sql = "SELECT * FROM countrys WHERE status = ? ";
        array_push($params, $status);

        if (isset($country_id) && strtoupper($country_id) != 'NULL' && trim($country_id) != '') {
            $sql .= "AND country_id = ? ";
            array_push($params, $country_id);
        }

        return $this->db->query($sql, $params);
    }
}