<?php
defined('BASEPATH') or exit('No direct script access allowed');

class kalibrasi extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        check_not_login();
        $this->load->model(['kalibrasi_m', 'item_m']);
    }

    public function index()
    {
        $data['row'] = $this->kalibrasi_m->get();
        $this->template->load('template', 'masterkalibrasi/kalibrasi_data', $data);
    }

    public function add()
    {

        $kalibrasi = new stdClass();
        $kalibrasi->durasi_kalibrasi = null;
        $kalibrasi->nama_alat_ukur = null;
        $kalibrasi->lembaga_kalibrasi = null;
        $kalibrasi->no_sertifikat = null;
        $kalibrasi->file_sertifikat = null;
        $kalibrasi->keterangan = null;
        $kalibrasi->tanggal_kalibrasi = null;

        $query_item = $this->item_m->get();
        $item[null] = '- Pilih -';
        foreach ($query_item->result() as $itm) {
            $item[$itm->item_id] = $itm->nama_alat_ukur;
        }

        $data = array(
            'page' => 'add',
            'row' => $kalibrasi,
            'item' => $item, 'selecteditem' => null,
        );
        $this->template->load('template', 'masterkalibrasi/kalibrasi_form', $data);
    }

    public function edit($id)
    {
        $query = $this->kalibrasi_m->get($id);
        if ($query->num_rows() > 0) {
            $kalibrasi = $query->row();
            $kalibrasi->durasi_kalibrasi = null;
            $kalibrasi->nama_alat_ukur = null;
            $kalibrasi->lembaga_kalibrasi = null;
            $kalibrasi->no_sertifikat = null;
            $kalibrasi->file_sertifikat = null;
            $kalibrasi->keterangan = null;
            $kalibrasi->tanggal_kalibrasi = null;

            $query_item = $this->item_m->get();
            $item[null] = '- Pilih -';
            foreach ($query_item->result() as $itm) {
                $item[$itm->item_id] = $itm->nama_alat_ukur;
            }

            $data = array(
                'page' => 'edit',
                'row' => $kalibrasi,
                'item' => $item, 'selecteditem' => null,
            );
            $this->template->load('template', 'masterkalibrasi/kalibrasi_form', $data);
        } else {
            echo "<script> alert('Data tidak ditemukan');";
            echo "window.location='" . site_url('user') . "';</script>";
        }
    }

    public function process()
    {
        $post = $this->input->post(null, TRUE);
        if (isset($_POST['add'])) {
            $this->kalibrasi_m->add($post);
        } else if (isset($_POST['edit'])) {
            $this->kalibrasi_m->edit($post);
        }
        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('success', 'Data berhasil disimpan');
        }
        redirect('kalibrasi');
    }

    public function del($id)
    {
        $this->kalibrasi_m->del($id);
        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('success', 'Data berhasil dihapus');
        }
        redirect('kalibrasi');
    }
}
