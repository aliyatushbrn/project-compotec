<?php
defined('BASEPATH') or exit('No direct script access allowed');

class History extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        check_not_login();
        $this->load->model('history_m');
        $this->load->model('category_m');
    }

    public function index()
    {
        if (isset($_POST['btn_search'])) {
            $id = $this->input->post('category_id');
            $data['row'] = $this->history_m->getbycategoryid($id);
        } else {
            # code...
            $data['row'] = $this->history_m->get();
        }
        $data['category'] = $this->category_m->get();
        $this->template->load('template', 'report/history_data', $data);
    }
}
