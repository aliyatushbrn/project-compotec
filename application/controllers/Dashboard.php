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

		date_default_timezone_set("Asia/Jakarta");
		// var_dump(date('Y-m-d') >= notiflist('2023-03-15'));
		// exit;
		$data['now'] = date('Y-m-d');
		if (isset($_POST['now'])) {
			$now = $this->input->post('now');
			// var_dump($now);
			// exit;
			$data['monitoring'] = $this->item_m->monitoring($now);
		} else {
			$data['monitoring'] = $this->item_m->monitoring();
		}
		// $data['kadaluarsa'] = $this->item_m->kadaluarsa($now);
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
