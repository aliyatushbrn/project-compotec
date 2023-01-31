<?php
defined('BASEPATH') or exit('No direct script access allowed');

class kalibrasi_m extends CI_Model
{

    public function get($id = null)
    {
        $this->db->select('kalibrasi.*, p_item.item_id as item_id, p_item.nama_alat_ukur as nama_alat_ukur,');
        $this->db->from('kalibrasi');
        $this->db->join('p_item', 'p_item.item_id = kalibrasi.item_id');
        if ($id != null) {
            $this->db->where('kalibrasi_id', $id);
        }
        $this->db->order_by('nama_alat_ukur', 'asc');
        $query = $this->db->get();
        return $query;
    }

    public function add($post)
    {
        $params = [
            'item_id' => $post['item'],
            'lembaga_kalibrasi' => $post['lembaga_kalibrasi'],
            'no_sertifikat' => $post['no_sertifikat'],
            'file_sertifikat' => $post['file_sertifikat'],
            'keterangan' => $post['keterangan'],
            'tanggal_kalibrasi' => $post['tanggal_kalibrasi'],
            'selanjutnya' => $post['selanjutnya'],
        ];
        $this->db->insert('kalibrasi', $params);
    }

    public function edit($post)
    {
        $params = [
            'durasi_kalibrasi' => $post['durasi_kalibrasi'],
            'item_id' => $post['item'],
            'lembaga_kalibrasi' => $post['lembaga_kalibrasi'],
            'no_sertifikat' => $post['no_sertifikat'],
            'file_sertifikat' => $post['file_sertifikat'],
            'keterangan' => $post['keterangan'],
            'tanggal_kalibrasi' => $post['tanggal_kalibrasi'],
            'selanjutnya' => $post['selanjutnya'],
            'updated' => $post['updated'],

        ];
        $this->db->where('kalibrasi_id', $post['id']);
        $this->db->update('kalibrasi', $params);
    }

    public function del($id)
    {

        $this->db->where('kalibrasi_id', $id);
        $this->db->delete('kalibrasi');
    }
}
