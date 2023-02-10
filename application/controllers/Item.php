<?php
defined('BASEPATH') or exit('No direct script access allowed');

use Endroid\QrCode\Color\Color;
use Endroid\QrCode\Encoding\Encoding;
use Endroid\QrCode\ErrorCorrectionLevel\ErrorCorrectionLevelLow;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\Label\Label;
use Endroid\QrCode\Logo\Logo;
use Endroid\QrCode\RoundBlockSizeMode\RoundBlockSizeModeMargin;
use Endroid\QrCode\Writer\PngWriter;
use Endroid\QrCode\Writer\ValidationException;

class Item extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        check_not_login();
        $this->load->model(['item_m', 'category_m', 'pemilik_m', 'range_m', 'akurasi_m']);
    }

    public function index()
    {
        $this->load->library('ciqrcode');
        $link = "123";
        $params['data'] = $link;
        $params['level'] = 'H';
        $params['size'] = 10;
        $params['savename'] = FCPATH . "/assets/logo/$link.png";
        $this->ciqrcode->generate($params);

        $data['row'] = $this->item_m->get();
        $this->template->load('template', 'masterdata/item_data', $data);
    }

    public function add()
    {

        $item = new stdClass();
        $item->item_id = null;
        $item->code_barang = null;
        $item->no_seri = null;
        $item->nama_alat_ukur = null;
        $item->jenisalat = null;
        $item->merk = null;
        $item->fungsi = null;
        $item->range = null;
        $item->akurasi = null;


        $query_category = $this->category_m->get();
        $category[null] = '- Pilih -';
        foreach ($query_category->result() as $ctg) {
            $category[$ctg->category_id] = $ctg->jenisalat;
        }
        $query_pemilik = $this->pemilik_m->get();
        $pemilik[null] = '- Pilih -';
        foreach ($query_pemilik->result() as $pmlk) {
            $pemilik[$pmlk->pemilik_id] = $pmlk->name;
        }
        $query_category = $this->category_m->get();
        $fungsi[null] = '- Pilih -';
        foreach ($query_category->result() as $fgs) {
            $fungsi[$fgs->fungsi] = $fgs->fungsi;
        }
        $query_range = $this->range_m->get();
        $range[null] = '- Pilih -';
        foreach ($query_range->result() as $rng) {
            $range[$rng->range_id] = $rng->name;
        }
        $query_akurasi = $this->akurasi_m->get();
        $akurasi[null] = '- Pilih -';
        foreach ($query_akurasi->result() as $akr) {
            $akurasi[$akr->akurasi_id] = $akr->name;
        }
        $data = array(
            'page' => 'add',
            'row' => $item,
            'category' => $category, 'selectedcategory' => null,
            'pemilik' => $pemilik, 'selectedpemilik' => null,
            'fungsi' => $fungsi, 'selectedfungsi' => null,
            'range' => $range, 'selectedrange' => null,
            'akurasi' => $akurasi, 'selectedakurasi' => null,
        );
        $this->template->load('template', 'masterdata/item_form', $data);
    }

    public function edit($id)
    {
        $query = $this->item_m->get($id);
        if ($query->num_rows() > 0) {
            $item = $query->row();

            $query_category = $this->category_m->get();
            $category[null] = '- Pilih -';
            foreach ($query_category->result() as $ctg) {
                $category[$ctg->category_id] = $ctg->jenisalat;
            }

            $query_pemilik = $this->pemilik_m->get();
            $pemilik[null] = '- Pilih -';
            foreach ($query_pemilik->result() as $pmlk) {
                $pemilik[$pmlk->pemilik_id] = $pmlk->name;
            }

            $query_category = $this->category_m->get();
            $fungsi[null] = '- Pilih -';
            foreach ($query_category->result() as $fgs) {
                $fungsi[$fgs->fungsi] = $fgs->fungsi;
            }
            $query_range = $this->range_m->get();
            $range[null] = '- Pilih -';
            foreach ($query_range->result() as $rng) {
                $range[$rng->range_id] = $rng->name;
            }
            $query_akurasi = $this->akurasi_m->get();
            $akurasi[null] = '- Pilih -';
            foreach ($query_akurasi->result() as $akr) {
                $akurasi[$akr->akurasi_id] = $akr->name;
            }

            $data = array(
                'page' => 'edit',
                'row' => $item,
                'category' => $category, 'selectedcategory' => $item->category_id,
                'pemilik' => $pemilik, 'selectedpemilik' => $item->pemilik_id,
                'fungsi' => $fungsi, 'selectedfungsi' => $item->fungsi,
                'range' => $range, 'selectedrange' => $item->range_id,
                'akurasi' => $akurasi, 'selectedakurasi' => $item->akurasi_id,
            );
            $this->template->load('template', 'masterdata/item_form', $data);
        } else {
            echo "<script> alert('Data tidak ditemukan');";
            echo "window.location='" . site_url('user') . "';</script>";
        }
    }

    public function process()
    {

        $config['upload_path']    =  './uploads/product/';
        $config['allowed_types']  =  'gif|jpg|png|jpeg';
        $config['max_size']       =  2048;
        $config['file_name']      = 'item-' . date('ymd') . '-' . substr(md5(rand()), 0, 10);
        $this->load->library('upload', $config);

        $post = $this->input->post(null, TRUE);
        if (isset($_POST['add'])) {
            if ($this->item_m->check_barcode($post['no_seri'])->num_rows() > 0) {
                $this->session->set_flashdata('error', "barcode $post[barcode] sudah dipakai barang lain");
                redirect('item/add');
            } else {
                $this->load->library('ciqrcode');
                $link = $this->input->post('no_seri');
                $params['data'] = $link;
                $params['level'] = 'H';
                $params['size'] = 10;
                $params['savename'] = FCPATH . "/assets/logo/$link.png";
                $this->ciqrcode->generate($params);

                if (@$_FILES['image']['name'] != null) {
                    if ($this->upload->do_upload('image')) {
                        $post['image'] = $this->upload->data('file_name');
                        $this->item_m->add($post);
                        if ($this->db->affected_rows() > 0) {
                            $this->session->set_flashdata('success', 'Data berhasil disimpan');
                        }
                        redirect('item');
                    } else {
                        $eror == $this->upload->display_errors();
                        $this->session->set_flashdata('error',  $error);
                        redirect('item/add');
                    }
                } else {
                    $post['image'] = null;
                    $this->item_m->add($post);
                    if ($this->db->affected_rows() > 0) {
                        $this->session->set_flashdata('success', 'Data berhasil disimpan');
                    }
                    redirect('item');
                }
            }
        } else if (isset($_POST['edit'])) {
            if ($this->item_m->check_barcode($post[''], $post['id'])->num_rows() > 0) {
                $this->session->set_flashdata('error', "barcode $post[barcode] sudah dipakai barang lain");
                redirect('item/edit/' . $post['id']);
                // yang kedua ini
            } else {
                if (@$_FILES['image']['name'] != null) {
                    if ($this->upload->do_upload('image')) {

                        $item = $this->item_m->get($post['id'])->row();
                        if ($item->image != null) {
                            $target_file = './uploads/masterdata/' . $item->image;
                            unlink($target_file);
                        }

                        $post['image'] = $this->upload->data('file_name');
                        $this->item_m->edit($post);
                        if ($this->db->affected_rows() > 0) {
                            $this->session->set_flashdata('success', 'Data berhasil disimpan');
                        }
                        redirect('item');
                    } else {
                        $eror == $this->upload->display_errors();
                        $this->session->set_flashdata('error',  $error);
                        redirect('item/add');
                    }
                } else {
                    $post['image'] = null;
                    $this->item_m->edit($post);
                    if ($this->db->affected_rows() > 0) {
                        $this->session->set_flashdata('success', 'Data berhasil disimpan');
                    }
                    redirect('item');
                }
            }
        }
    }

    public function del($id)
    {
        $item = $this->item_m->get($id)->row();
        if ($item->image != null) {
            $target_file = './uploads/masterdata/' . $item->image;
            unlink($target_file);
        }

        $this->item_m->del($id);
        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('success', 'Data berhasil dihapus');
        }
        redirect('item');
    }

    function barcode_qrcode($id)
    {
        $data['row'] = $this->item_m->get($id)->row();
        $this->template->load('template', 'masterdata/barcode_qrcode', $data);
    }
}
