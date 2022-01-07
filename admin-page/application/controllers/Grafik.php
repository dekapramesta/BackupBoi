<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Grafik extends CI_Controller {
	
	public function __construct() {
		parent::__construct();
		$this->db2 = $this->load->database('pariwisata_en', TRUE);
		$this->load->model('Mdl_grafik');
		$this->auth->restrict();
		date_default_timezone_set("Asia/Jakarta");
		$this->load->library("session");
	
	}
	
	function index(){
		$data['view_file']    = "moduls/grafik";
        $this->load->view('admin_view',$data);
	}	
	
	function create_load(){
        $this->load->view('moduls/view_grafik');
	}
	
	function ajax_list(){
		$kdGrafik = $this->uri->segment(3);
		$list = $this->Mdl_grafik->get_datatables($kdGrafik);
		$data = array();
		$no = $_REQUEST['start'];
		foreach ($list as $grafik) {
			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $grafik->bulan;
			$row[] = $grafik->nilai;
			$row[] = $grafik->tahun;
			$row[] = '
			<div class="btn-group">
                        <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">Aksi <span class="caret"></span></button>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="javascript:void(0)" onclick="edit('."'".$grafik->id."'".')">Edit</a></li>
                            <li><a href="javascript:void(0)" onclick="hapus('."'".$grafik->id."'".')">Delete</a></li>
                        </ul>
            </div>';
			$data[] = $row;
		}

		$output = array(
						"draw" => $_REQUEST['draw'],
						"recordsTotal" => $this->Mdl_grafik->count_all($kdGrafik),
						"recordsFiltered" => $this->Mdl_grafik->count_filtered($kdGrafik),
						"data" => $data,
				);
		echo json_encode($output);
	}	
	
	public function ajax_add() {
		$data = array(
				'kode'         => $this->input->post('kode'),
				'bulan' 	     => $this->input->post('bulan'),
				'nilai' 	     => $this->input->post('nilai'),
				'tahun'        	 => $this->input->post('tahun')
			);
		$insert = $this->Mdl_grafik->add($data);
		//print_r($this->db->last_query());
		echo json_encode(array('status' => TRUE));
	}
	
	public function ajax_edit($id) {
		$data = $this->Mdl_grafik->get_by_id($id);
		//print_r($this->db->last_query());
		echo json_encode($data);
	}
	
	public function ajax_update() {
		$data = array(
				'kode'         => $this->input->post('kode'),
				'bulan' 	     => $this->input->post('bulan'),
				'nilai' 	     => $this->input->post('nilai'),
				'tahun'        	 => $this->input->post('tahun')
			);
		$this->Mdl_grafik->update(array('id' => $this->input->post('id')), $data);
		echo json_encode(array("status" => TRUE));
    }
	
	public function ajax_delete($id) {
      $this->Mdl_grafik->delete_by_id($id);
      echo json_encode(array("status" => TRUE));
    }
}	