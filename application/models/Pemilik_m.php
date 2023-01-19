<?php
defined('BASEPATH') or exit('No direct script access allowed');

class pemilik_m extends CI_Model
{

    public function get($id = null)
    {
        $this->db->from('p_pemilik');
        if ($id != null) {
            $this->db->where('pemilik_id', $id);
        }
        $query = $this->db->get();
        return $query;
    }

    public function add($post)
    {
        $params = [
            'name' => $post['pemilik_name'],
        ];
        $this->db->insert('p_pemilik', $params);
    }

    public function edit($post)
    {
        $params = [
            'name' => $post['pemilik_name'],
            'update' => date('Y-m-d H:i:s')
        ];
        $this->db->where('pemilik_id', $post['id']);
        $this->db->update('p_pemilik', $params);
    }

    public function del($id)
    {

        $this->db->where('pemilik_id', $id);
        $this->db->delete('p_pemilik');
    }
}
