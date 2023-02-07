<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Frekuensi_m extends CI_Model
{

    public function get($id = null)
    {
        $this->db->from('k_frekuensi');
        if ($id != null) {
            $this->db->where('frekuensi_id', $id);
        }
        $query = $this->db->get();
        return $query;
    }

    public function add($post)
    {
        if ($post['frekuensi_kalibrasi'] == "1x/1y") {
            $selanjutnya = date('Y-m-d', strtotime('+1year', strtotime($post['tanggal_kalibrasi'])));
        } else {
            $selanjutnya = date('Y-m-d', strtotime('+2year', strtotime($post['tanggal_kalibrasi'])));
        }
        $params = [
            'name' => $post['frekuensi_name'],
        ];
        $this->db->insert('k_frekuensi', $params);
    }

    public function edit($post)
    {
        $params = [
            'name' => $post['frekuensi_name'],
            'updated' => date('Y-m-d H:i:s')
        ];
        $this->db->where('frekuensi_id', $post['id']);
        $this->db->update('k_frekuensi', $params);
    }

    public function del($id)
    {

        $this->db->where('frekuensi_id', $id);
        $this->db->delete('k_frekuensi');
    }
}
