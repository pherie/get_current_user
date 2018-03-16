<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mdl_hit extends CI_Model{

    public function get()
    {
        return $this->db->count_all_results('tbl_hit');
    }

    public function insert($ip)
    {
        $data = array(
            'ip_addres' => $ip
        );
        $this->db->insert('tbl_hit', $data);
    }

    public function clear()
    {
        $this->db->truncate('tbl_hit');
    }

    public function check_ip($ip)
    {
        $this->db->where('ip_addres', $ip);
        $query = $this->db->get('tbl_hit');
        if ($query->num_rows() > 0) {
            return TRUE;
        }else{
            return FALSE;
        }
    }
}