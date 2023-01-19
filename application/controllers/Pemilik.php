<?php
defined('BASEPATH') or exit('No direct script access allowed');

class pemilik extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        check_not_login();
        $this->load->model('pemilik_m');
    }

    public function index()
    {
        $data['row'] = $this->pemilik_m->get();
        $this->template->load('template', 'product/pemilik/pemilik_data', $data);
    }

    public function add()
    {
        $pemilik = new stdClass();
        $pemilik->pemilik_id = null;
        $pemilik->pemilik_name = null;
        $data = array(
            'page' => 'add',
            'row' => $pemilik
        );
        $this->template->load('template', 'product/pemilik/pemilik_form', $data);
    }

    public function edit($id)
    {
        $query = $this->pemilik_m->get($id);
        if ($query->num_rows() > 0) {
            $pemilik = $query->row();
            $data = array(
                'page' => 'edit',
                'row' => $pemilik
            );
            $this->template->load('template', 'product/pemilik/pemilik_form', $data);
        } else {
            echo "<script> alert('Data tidak ditemukan');";
            echo "window.location='" . site_url('user') . "';</script>";
        }
    }

    public function process()
    {
        $post = $this->input->post(null, TRUE);
        if (isset($_POST['add'])) {
            $this->pemilik_m->add($post);
        } else  if (isset($_POST['edit'])) {
            $this->pemilik_m->edit($post);
        }
        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('success', 'data berhasil disimpan');
        }
        redirect('pemilik');
    }

    public function del($id)
    {
        $this->pemilik_m->del($id);
        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('success', 'data berhasil dihapus');
        }
        redirect('pemilik');
    }
}
