<?php
defined('BASEPATH') or exit('No direct script access allowed');

class History_m extends CI_Model
{

    public function get($id = null)
    {
        $this->db->from('history');
        if ($id != null) {
            $this->db->where('history', $id);
        }
        $query = $this->db->get();
        return $query;
    }
}
