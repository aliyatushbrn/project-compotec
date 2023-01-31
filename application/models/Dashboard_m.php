<?php
defined('BASEPATH') or exit('No direct script access allowed');

class dashboard_m extends CI_Model
{

    public function get($id = null)
    {

        $this->db->select('dashboard.*, p_item.no_seri as no_seri, p_item.nama_alat_ukur as nama_alat_ukur');
        $this->db->from('dashboard');
        $this->db->join('p_item', 'p_item.no_seri = dashboard.no_seri');
        if ($id != null) {
            $this->db->where('dashboard_id', $id);
        }
        $query = $this->db->get();
        return $query;
    }

    public function del($id)
    {

        $this->db->where('dashboard_id', $id);
        $this->db->delete('dashboard');
    }
}
