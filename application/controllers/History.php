<?php
defined('BASEPATH') or exit('No direct script access allowed');

class History extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        check_not_login();
        $this->load->model('history_m');
    }

    public function index()
    {
        $data['row'] = $this->history_m->get();
        $this->template->load('template', 'report/history_data', $data);
    }
}
