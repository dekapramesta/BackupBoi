<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Berfasilitas extends CI_Controller {
	
	
	public function __construct() {
		parent::__construct();
		$this->load->model('Mdl_berfasiliitas');
		$this->auth->restrict();
		date_default_timezone_set("Asia/Jakarta");
		$this->load->library("session");
	}
	
	function index(){
       // $this->mdl_home->getsqurity();
	    $data['berfasilitas'] = $this->Mdl_berfasiliitas->fasilitas();
        $data['view_file']    = "moduls/wisata_berfasilitas";
        $this->load->view('admin_view',$data);
    }
	
	function cek_cson(){
		echo json_encode($this->Mdl_berfasiliitas->fasilitas());
	}
	
	public function ajax_listid() {
		$kdFas = $this->uri->segment(3);
		$list = $this->Mdl_berfasiliitas->get_datatablesid($kdFas);
		//print_r($this->db->last_query());
		$data = array();
		$no = $_REQUEST['start'];
		foreach ($list as $det) {
			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $det->faswis_nama;
			$row[] = $det->wistas_status;
			$row[] = '
			<a href="javascript:void(0)" onclick="edit('."'".$det->wistas_id."'".')">
			<button class="btn btn-white btn-info btn-bold">
				<i class="ace-icon fa fa-pencil bigger-120 blue"></i>
			</button>
			</a>
			<a href="javascript:void(0)" onclick="hapus('."'".$det->wistas_id."'".')">
			<button class="btn btn-white btn-danger btn-bold">
				<i class="ace-icon fa fa-remove bigger-120 red"></i>
			</button>
			</a>
			';
			$data[] = $row;
		}

		$output = array(
						"draw" => $_REQUEST['draw'],
						"recordsTotal" => $this->Mdl_berfasiliitas->count_allid($kdFas),
						"recordsFiltered" => $this->Mdl_berfasiliitas->count_filteredid($kdFas),
						"data" => $data,
				);
		echo json_encode($output);
	}
	
	public function ajax_listid_en() {
		$kdFas = $this->uri->segment(3);
		$list = $this->Mdl_berfasiliitas->get_datatablesid_en($kdFas);
		//print_r($this->db->last_query());
		$data = array();
		$no = $_REQUEST['start'];
		foreach ($list as $det) {
			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $det->faswis_nama;
			$row[] = $det->wistas_status;
			$row[] = '
			<a href="javascript:void(0)" onclick="edit('."'".$det->wistas_id."'".')">
			<button class="btn btn-white btn-info btn-bold">
				<i class="ace-icon fa fa-pencil bigger-120 blue"></i>
			</button>
			</a>
			<a href="javascript:void(0)" onclick="hapus('."'".$det->wistas_id."'".')">
			<button class="btn btn-white btn-danger btn-bold">
				<i class="ace-icon fa fa-remove bigger-120 red"></i>
			</button>
			</a>
			';
			$data[] = $row;
		}

		$output = array(
						"draw" => $_REQUEST['draw'],
						"recordsTotal" => $this->Mdl_berfasiliitas->count_allid_en($kdFas),
						"recordsFiltered" => $this->Mdl_berfasiliitas->count_filteredid_en($kdFas),
						"data" => $data,
				);
		echo json_encode($output);
	}
	
	public function ajax_add() {
		$data = array(
				'wisata_id'         => $this->input->post('wisata_id'),
				'faswis_id'       		 => $this->input->post('faswis_id'),
				'wistas_status'       		 => $this->input->post('wistas_status')
			);
			
		if ($this->session->userdata('current_language')=='english'){
 			$insert = $this->Mdl_berfasiliitas->add_en($data);
 		}else{
 			$insert = $this->Mdl_berfasiliitas->add($data);
 		}	
		
		//print_r($this->db->last_query());
		echo json_encode(array('status' => TRUE));
	}
	
	public function ajax_delete($id) {
	  if ($this->session->userdata('current_language')=='english'){
 			$this->Mdl_berfasiliitas->delete_by_id_en($id);
 	  }else{
 			$this->Mdl_berfasiliitas->delete_by_id($id);
 	  }	
      
      echo json_encode(array("status" => TRUE));
    }
	
	public function ajax_edit_fas($id) {
		$data = $this->Mdl_berfasiliitas->get_by_id($id);
		echo json_encode($data);
	}
	
	public function ajax_edit_fas_en($id) {
		$data = $this->Mdl_berfasiliitas->get_by_id_en($id);
		echo json_encode($data);
	}
	
	public function ajax_update() {
		$data = array(
				'wistas_status'       		 => $this->input->post('wistas_status'),
			);
			
		if ($this->session->userdata('current_language')=='english'){
 			$this->Mdl_berfasiliitas->update_en(array('wistas_id' => $this->input->post('wistas_id')), $data);
 		}else{
 			$this->Mdl_berfasiliitas->update(array('wistas_id' => $this->input->post('wistas_id')), $data);
 		}	
		
		//print_r($this->db->last_query());
		echo json_encode(array("status" => TRUE));
    }
	
}