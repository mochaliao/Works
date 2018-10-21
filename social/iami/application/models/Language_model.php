<?php

class Language_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    function getLanguage($language_id = NULL, $status = 1)
    {
        $params = array();
        $sql = 'SELECT * FROM languages WHERE status = ? ';
        array_push($params, $status);

        if (isset($language_id) && strtoupper($language_id) != 'NULL' && trim($language_id) != '') {
            $sql .= 'AND language_id = ? ';
            array_push($params, $language_id);
        }

        return $this->db->query($sql, $params);
    }
}