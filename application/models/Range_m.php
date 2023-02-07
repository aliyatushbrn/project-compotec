<?php
defined('BASEPATH') or exit('No direct script access allowed');

class range_m extends CI_Model
{

    public function get($id = null)
    {
        $this->db->from('p_range');
        if ($id != null) {
            $this->db->where('range_id', $id);
        }
        $query = $this->db->get();
        return $query;
    }

    public function add($post)
    {
        $params = [
            'name' => $post['range_name'],
        ];
        $this->db->insert('p_range', $params);
    }

    public function edit($post)
    {
        $params = [
            'name' => $post['range_name'],
            'updated' => date('Y-m-d H:i:s')
        ];
        $this->db->where('range_id', $post['id']);
        $this->db->update('p_range', $params);
    }

    public function del($id)
    {

        $this->db->where('range_id', $id);
        $this->db->delete('p_range');
    }
}
