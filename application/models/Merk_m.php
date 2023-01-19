<?php
defined('BASEPATH') or exit('No direct script access allowed');

class merk_m extends CI_Model
{

    public function get($id = null)
    {
        $this->db->from('p_merk');
        if ($id != null) {
            $this->db->where('merk_id', $id);
        }
        $query = $this->db->get();
        return $query;
    }

    public function add($post)
    {
        $params = [
            'name' => $post['merk_name'],
        ];
        $this->db->insert('p_merk', $params);
    }

    public function edit($post)
    {
        $params = [
            'name' => $post['merk_name'],
            'update' => date('Y-m-d H:i:s')
        ];
        $this->db->where('merk_id', $post['id']);
        $this->db->update('p_merk', $params);
    }

    public function del($id)
    {

        $this->db->where('merk_id', $id);
        $this->db->delete('p_merk');
    }
}
