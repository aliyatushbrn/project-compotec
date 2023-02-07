<?php
defined('BASEPATH') or exit('No direct script access allowed');

class item_m extends CI_Model
{

    public function get($id = null)
    {
        $this->db->select('p_item.*, p_category.jenisalat as jenisalat, p_pemilik.name as pemilik_name, p_range.name as range_name, p_akurasi.name as akurasi_name ');
        $this->db->from('p_item');
        $this->db->join('p_category', 'p_category.category_id = p_item.category_id', 'p_category.fungsi = p_item.fungsi');
        $this->db->join('p_pemilik', 'p_pemilik.pemilik_id = p_item.pemilik_id');
        $this->db->join('p_range', 'p_range.range_id = p_item.range_id');
        $this->db->join('p_akurasi', 'p_akurasi.akurasi_id = p_item.akurasi_id');

        if ($id != null) {
            $this->db->where('item_id', $id);
        }
        $this->db->order_by('no_seri', 'asc');
        $query = $this->db->get();
        return $query;
    }

    public function add($post)
    {
        $params = [
            'no_seri' => $post['no_seri'],
            'nama_alat_ukur' => $post['nama_alat_ukur'],
            'merk' => $post['merk'],
            'category_id' => $post['category'],
            'pemilik_id' => $post['pemilik'],
            'fungsi' => $post['fungsi'],
            'range_id' => $post['range'],
            'akurasi_id' => $post['akurasi'],
            'image' => $post['image'],
        ];
        $this->db->insert('p_item', $params);
    }

    public function edit($post)
    {
        $params = [
            'nama_alat_ukur' => $post['nama_alat_ukur'],
            'merk' => $post['merk'],
            'category_id' => $post['category'],
            'pemilik_id' => $post['pemilik'],
            'fungsi' => $post['fungsi'],
            'range_id' => $post['range'],
            'akurasi_id' => $post['akurasi'],
            'updated' => date('Y-m-d H:i:s')
        ];
        if ($post['image'] != null) {
            $params['image'] = $post['image'];
        }
        $this->db->where('item_id', $post['id']);
        $this->db->update('p_item', $params);
    }

    function check_barcode($code, $id = null)
    {
        $this->db->from('p_item');
        $this->db->where('no_seri', $code);
        if ($id != null) {
            $this->db->where('item_id !=', $id);
        }
        $query = $this->db->get();
        return $query;
    }

    public function del($id)
    {

        $this->db->where('item_id', $id);
        $this->db->delete('p_item');
    }
}
