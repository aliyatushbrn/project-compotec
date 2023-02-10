<?php
defined('BASEPATH') or exit('No direct script access allowed');

class kalibrasi extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        check_not_login();
        $this->load->model(['kalibrasi_m', 'item_m', 'durasi_m', 'lembaga_m']);
    }

    public function index()
    {
        $data['row'] = $this->kalibrasi_m->get();
        $this->template->load('template', 'datakalibrasi/kalibrasi_data', $data);
    }

    public function add()
    {

        $kalibrasi = new stdClass();
        $kalibrasi->nama_alat_ukur = null;
        $kalibrasi->lembaga_kalibrasi = null;
        $kalibrasi->no_sertifikat = null;
        $kalibrasi->file_sertifikat = null;
        $kalibrasi->keterangan = null;
        $kalibrasi->durasi_kalibrasi = null;
        $kalibrasi->ext_int = null;
        $kalibrasi->tanggal_pembelian = null;
        $kalibrasi->tanggal_kalibrasi = null;
        $kalibrasi->selanjutnya = null;


        $query_item = $this->item_m->get();
        $item[null] = '- Pilih -';
        foreach ($query_item->result() as $itm) {
            $item[$itm->item_id] = $itm->nama_alat_ukur;
        }

        $query_lembaga = $this->lembaga_m->get();
        $lembaga[null] = '- Pilih -';
        foreach ($query_lembaga->result() as $lbg) {
            $lembaga[$lbg->lembaga_id] = $lbg->name;
        }


        $data = array(
            'page' => 'add',
            'row' => $kalibrasi,
            'durasi_kalibrasi' => $this->durasi_m->get(),
            'item' => $item, 'selecteditem' => null,
            'lembaga' => $lembaga, 'selectedlembaga' => null,
        );
        $this->template->load('template', 'datakalibrasi/kalibrasi_form', $data);
    }

    public function edit($id)
    {
        $query = $this->kalibrasi_m->get($id);
        if ($query->num_rows() > 0) {
            $kalibrasi = $query->row();
            $kalibrasi->nama_alat_ukur = null;
            $kalibrasi->lembaga_kalibrasi = null;
            $kalibrasi->no_sertifikat = null;
            $kalibrasi->file_sertifikat = null;
            $kalibrasi->keterangan = null;
            $kalibrasi->durasi_kalibrasi = null;
            $kalibrasi->tanggal_pembelian = null;
            $kalibrasi->tanggal_kalibrasi = null;
            $kalibrasi->selanjutnya = null;


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
            $this->template->load('template', 'datakalibrasi/kalibrasi_form', $data);
        } else {
            echo "<script> alert('Data tidak ditemukan');";
            echo "window.location='" . site_url('user') . "';</script>";
        }
    }

    public function process()
    {
        $post = $this->input->post(null, TRUE);
        if (isset($_POST['add'])) {
            $config['upload_path']       = './uploads/file_sertifikat/';
            $config['allowed_types']     = 'pdf|xls|doc|docx|ppt|png|jpg|jpeg';
            $config['max_size']          = 0;
            $config['file_name']         = 'kalibrasi-' . date('ymd') . '-' . substr(md5(rand()), 0, 10);
            $this->load->library('upload', $config);

            if (@$_FILES['file_sertifikat']['name'] != null) {
                if ($this->upload->do_upload('file_sertifikat')) {
                    $post['file_sertifikat'] = $this->upload->data('file_name');
                    $this->kalibrasi_m->add($post);
                    if ($this->db->affected_rows() > 0) {
                        $this->session->set_flashdata('success', 'Data berhasil disimpan');
                    }
                    redirect('kalibrasi');
                } else {
                    $error = $this->upload->display_errors();
                    $this->session->set_flashdata('error', $error);
                    redirect('kalibrasi/add');
                }
            } else {
                $post['file_sertifikat'] = null;
                $this->kalibrasi_m->add($post);
                if ($this->db->affected_rows() > 0) {
                    $this->session->set_flashdata('success', 'Data berhasil disimpan');
                }
                redirect('kalibrasi');
            }
        } else if (isset($_POST['edit'])) {
            $this->kalibrasi_m->edit($post);
        }
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
