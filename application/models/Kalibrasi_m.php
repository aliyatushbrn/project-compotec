<?php
defined('BASEPATH') or exit('No direct script access allowed');

class kalibrasi_m extends CI_Model
{

    public function get($id = null)
    {
        $this->db->select('kalibrasi.*, p_item.item_id as item_id');
        $this->db->from('kalibrasi');
        $this->db->join('p_item', 'p_item.item_id = kalibrasi.item_id');
        if ($id != null) {
            $this->db->where('frekuensi_kalibrasi', $id);
        }
        $query = $this->db->get();
        return $query;
    }

    public function add($post)
    {
        $params = [
            'durasi_kalibrasi' => $post['durasi_kalibrasi'],
            'nama_alat_ukur' => $post['item'],
            'durasi_kalibrasi' => $post['durasi_kalibrasi'],
            'pertama_kalibrasi' => $post['pertama_kalibrasi'],
            'next_kalibrasi' => $post['next_kalibrasi'],
        ];
        $this->db->insert('kalibrasi', $params);
    }

    public function edit($post)
    {
        $params = [
            'durasi_kalibrasi' => $post['durasi_kalibrasi'],
            'nama_alat_ukur' => $post['item'],
            'durasi_kalibrasi' => $post['durasi_kalibrasi'],
            'pertama_kalibrasi' => $post['pertama_kalibrasi'],
            'next_kalibrasi' => $post['next_kalibrasi'],
        ];
        $this->db->where('next_kalibrasi', $post['id']);
        $this->db->update('kalibrasi', $params);
    }

    public function del($id)
    {

        $this->db->where('durasi_kalibrasi', $id);
        $this->db->delete('kalibrasi');
    }
}
