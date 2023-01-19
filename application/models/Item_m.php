<?php
defined('BASEPATH') or exit('No direct script access allowed');

class item_m extends CI_Model
{

    public function get($id = null)
    {
        $this->db->select('p_item.*, p_category.jenisalat as jenisalat,p_pemilik.name as pemilik_name');
        $this->db->from('p_item');
        $this->db->join('p_category', 'p_category.category_id = p_item.category_id');
        $this->db->join('p_pemilik', 'p_pemilik.pemilik_id = p_item.pemilik_id');
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
            'category_id' => $post['category'],
            'pemilik_id' => $post['pemilik'],
            'image' => $post['image'],
        ];
        $this->db->insert('p_item', $params);
    }

    public function edit($post)
    {
        $params = [
            'no_seri' => $post['no_seri'],
            'nama_alat_ukur' => $post['nama_alat_ukur'],
            'category_id' => $post['category'],
            'pemilik_id' => $post['pemilik'],
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
