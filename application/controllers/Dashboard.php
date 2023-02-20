<?php
defined('BASEPATH') or exit('No direct script access allowed');

class dashboard extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		check_not_login();
		$this->load->model(['dashboard_m', 'item_m', 'kalibrasi_m']);
	}

	public function index()
	{
		$now = date('Y-m-d');
		$data['row'] = $this->item_m->kadaluarsa($now);
		$data['kalibrasi'] = $this->item_m->monitoring($now)->result();

		$this->template->load('template', 'dashboard/dashboard_data', $data);
	}

	public function reminder()
	{
		// mengambil data dari database
		$no    = 0;
		$query    = mysqli_query($conn, "SELECT * FROM item WHERE next_kalibrasi < '$sekarang' AND status IS NULL ORDER BY next_kalibrasi");
		while ($data    = mysqli_fetch_array($query));
	}

	public function del($id)
	{

		$this->dashboard_m->del($id);
		if ($this->db->affected_rows() > 0) {

			$this->session->set_flashdata('success', 'Data berhasil dihapus');
		}
		redirect('dashboard');
	}
}
