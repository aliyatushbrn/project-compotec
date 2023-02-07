<?php
defined('BASEPATH') or exit('No direct script access allowed');

class frekuensi extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        check_not_login();
        $this->load->model('frekuensi_m');
    }

    public function index()
    {
        $data['row'] = $this->frekuensi_m->get();
        $this->template->load('template', 'masterkalibrasi/frekuensi_data', $data);
    }

    public function add()
    {

        $frekuensi = new stdClass();
        $frekuensi->frekuensi_id = null;
        $frekuensi->name = null;
        $data = array(
            'page' => 'add',
            'row' => $frekuensi
        );
        $this->template->load('template', 'masterkalibrasi/frekuensi_form', $data);
    }

    public function edit($id)
    {
        $query = $this->frekuensi_m->get($id);
        if ($query->num_rows() > 0) {
            $frekuensi = $query->row();
            $data = array(
                'page' => 'edit',
                'row' => $frekuensi
            );
            $this->template->load('template', 'masterkalibrasi/frekuensi_form', $data);
        } else {
            echo "<script> alert('Data tidak ditemukan');";
            echo "window.location='" . site_url('user') . "';</script>";
        }
    }

    public function process()
    {
        $post = $this->input->post(null, TRUE);
        if (isset($_POST['add'])) {
            $this->frekuensi_m->add($post);
        } else if (isset($_POST['edit'])) {
            $this->frekuensi_m->edit($post);
        }
        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('success', 'Data berhasil disimpan');
        }
        redirect('frekuensi');
    }

    public function del($id)
    {

        $this->frekuensi_m->del($id);
        if ($this->db->affected_rows() > 0) {

            $this->session->set_flashdata('success', 'Data berhasil dihapus');
        }
        redirect('frekuensi');
    }
}
