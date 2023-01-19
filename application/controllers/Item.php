<?php
defined('BASEPATH') or exit('No direct script access allowed');

class item extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        check_not_login();
        $this->load->model(['item_m', 'category_m', 'pemilik_m']);
    }

    public function index()
    {
        $data['row'] = $this->item_m->get();
        $this->template->load('template', 'product/item/item_data', $data);
    }

    public function add()
    {

        $item = new stdClass();
        $item->item_id = null;
        $item->no_seri = null;
        $item->nama_alat_ukur = null;
        $item->category_id = null;

        $query_category = $this->category_m->get();
        $category[null] = '- Pilih -';
        foreach ($query_category->result() as $ctg) {
            $category[$ctg->category_id] = $ctg->jenisalat;
        }

        $query_pemilik = $this->pemilik_m->get();
        $pemilik[null] = '- Pilih -';
        foreach ($query_pemilik->result() as $unt) {
            $pemilik[$unt->pemilik_id] = $unt->name;
        }

        $data = array(
            'page' => 'add',
            'row' => $item,
            'category' => $category, 'selectedcategory' => null,
            'pemilik' => $pemilik, 'selectedpemilik' => null,
        );
        $this->template->load('template', 'product/item/item_form', $data);
    }

    public function edit($id)
    {
        $query = $this->item_m->get($id);
        if ($query->num_rows() > 0) {
            $item = $query->row();
            $query_category = $this->category_m->get();

            $query_pemilik = $this->pemilik_m->get();
            $pemilik[null] = '- Pilih -';
            foreach ($query_pemilik->result() as $unt) {
                $pemilik[$unt->pemilik_id] = $unt->name;
            }

            $data = array(
                'page' => 'edit',
                'row' => $item,
                'category' => $query_category,
                'pemilik' => $pemilik, 'selectedpemilik' => $item->pemilik_id,
            );
            $this->template->load('template', 'product/item/item_form', $data);
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
            if ($this->item_m->check_barcode($post['barcode'])->num_rows() > 0) {
                $this->session->set_flashdata('error', "barcode $post[barcode] sudah dipakai barang lain");
                redirect('item/add');
            } else {

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
            if ($this->item_m->check_barcode($post['barcode'], $post['id'])->num_rows() > 0) {
                $this->session->set_flashdata('error', "barcode $post[barcode] sudah dipakai barang lain");
                redirect('item/edit/' . $post['id']);
                // yang kedua ini
            } else {
                if (@$_FILES['image']['name'] != null) {
                    if ($this->upload->do_upload('image')) {

                        $item = $this->item_m->get($post['id'])->row();
                        if ($item->image != null) {
                            $target_file = './uploads/product/' . $item->image;
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
            $target_file = './uploads/product/' . $item->image;
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
        $this->template->load('template', 'product/item/barcode_qrcode', $data);
    }
}
