<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pendapatan extends CI_Controller {
	
	public function __construct() {
		parent::__construct();
		$this->db2 = $this->load->database('pariwisata_en', TRUE);
		$this->load->model('Mdl_pendapatan');
		$this->auth->restrict();
		date_default_timezone_set("Asia/Jakarta");
		$this->load->library("session");
	
	}
	
	function index(){
		$data['view_file']    = "moduls/pendapatan";
        $this->load->view('admin_view',$data);
	}	
	
	function ajax_list(){
		$list = $this->Mdl_pendapatan->get_datatables();
		$data = array();
		$no = $_REQUEST['start'];
		foreach ($list as $pend) {
			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $pend->info_tahun;
			$row[] = $pend->info_jum_lokal;
			$row[] = $pend->info_jum_manca;
			$row[] = $pend->info_pendapatan;
			$row[] = '
			<div class="btn-group">
                        <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">Aksi <span class="caret"></span></button>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="javascript:void(0)" onclick="edit('."'".$pend->info_tahun."'".')">Edit</a></li>
                            <li><a href="javascript:void(0)" onclick="hapus('."'".$pend->info_tahun."'".')">Delete</a></li>
                        </ul>
            </div>';
			$data[] = $row;
		}

		$output = array(
						"draw" => $_REQUEST['draw'],
						"recordsTotal" => $this->Mdl_pendapatan->count_all(),
						"recordsFiltered" => $this->Mdl_pendapatan->count_filtered(),
						"data" => $data,
				);
		echo json_encode($output);
	}	
	
	public function ajax_add() {
		$data = array(
				'info_tahun'         => $this->input->post('info_tahun'),
				'info_jum_lokal' 	     => $this->input->post('info_jum_lokal'),
				'info_jum_manca' 	     => $this->input->post('info_jum_manca'),
				'info_pendapatan'        	 => $this->input->post('info_pendapatan')
			);
		$insert = $this->Mdl_pendapatan->add($data);
		//print_r($this->db->last_query());
		echo json_encode(array('status' => TRUE));
	}
	
	public function ajax_edit($id) {
		$data = $this->Mdl_pendapatan->get_by_id($id);
		//print_r($this->db->last_query());
		echo json_encode($data);
	}
	
	public function ajax_update() {
		$data = array(
				'info_tahun'         => $this->input->post('info_tahun'),
				'info_jum_lokal' 	     => $this->input->post('info_jum_lokal'),
				'info_jum_manca' 	     => $this->input->post('info_jum_manca'),
				'info_pendapatan'        	 => $this->input->post('info_pendapatan')
			);
		$this->Mdl_pendapatan->update(array('info_tahun' => $this->input->post('info_tahun')), $data);
		echo json_encode(array("status" => TRUE));
    }
	
	public function ajax_delete($id) {
      $this->Mdl_pendapatan->delete_by_id($id);
      echo json_encode(array("status" => TRUE));
    }
}