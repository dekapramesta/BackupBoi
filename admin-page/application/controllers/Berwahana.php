<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Berwahana extends CI_Controller {
	
	public function __construct() {
		parent::__construct();
		$this->load->model('Mdl_berwahana');
		$this->auth->restrict();
		date_default_timezone_set("Asia/Jakarta");
		$this->load->library("session");
	}
	
	function index(){
       // $this->mdl_home->getsqurity();
	   // $data['fasilitas']=$this->Mdl_berwahana->fasilitas();
        $data['view_file']    = "moduls/wisata_wahana";
        $this->load->view('admin_view',$data);
    }
	
	public function ajax_listid() {
		$kdWah = $this->uri->segment(3);
		$list = $this->Mdl_berwahana->get_datatablesid($kdWah);
		//print_r($this->db->last_query());
		$data = array();
		$no = $_REQUEST['start'];
		foreach ($list as $det) {
			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $det->wahana_nama;
			$row[] = $det->wahwis_htm;
			$row[] = '
			<a href="javascript:void(0)" onclick="edit('."'".$det->wahwis_id."'".')">
			<button class="btn btn-white btn-info btn-bold">
				<i class="ace-icon fa fa-pencil bigger-120 blue"></i>
			</button>
			</a>
			<a href="javascript:void(0)" onclick="hapus('."'".$det->wahwis_id."'".')">
			<button class="btn btn-white btn-danger btn-bold">
				<i class="ace-icon fa fa-remove bigger-120 red"></i>
			</button>
			</a>
			';
			$data[] = $row;
		}

		$output = array(
						"draw" => $_REQUEST['draw'],
						"recordsTotal" => $this->Mdl_berwahana->count_allid($kdWah),
						"recordsFiltered" => $this->Mdl_berwahana->count_filteredid($kdWah),
						"data" => $data,
				);
		echo json_encode($output);
	}
	
	public function ajax_listid_en() {
		$kdWah = $this->uri->segment(3);
		$list = $this->Mdl_berwahana->get_datatablesid_en($kdWah);
		//print_r($this->db->last_query());
		$data = array();
		$no = $_REQUEST['start'];
		foreach ($list as $det) {
			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $det->wahana_nama;
			$row[] = $det->wahwis_htm;
			$row[] = '
			<a href="javascript:void(0)" onclick="edit('."'".$det->wahwis_id."'".')">
			<button class="btn btn-white btn-info btn-bold">
				<i class="ace-icon fa fa-pencil bigger-120 blue"></i>
			</button>
			</a>
			<a href="javascript:void(0)" onclick="hapus('."'".$det->wahwis_id."'".')">
			<button class="btn btn-white btn-danger btn-bold">
				<i class="ace-icon fa fa-remove bigger-120 red"></i>
			</button>
			</a>
			';
			$data[] = $row;
		}

		$output = array(
						"draw" => $_REQUEST['draw'],
						"recordsTotal" => $this->Mdl_berwahana->count_allid_en($kdWah),
						"recordsFiltered" => $this->Mdl_berwahana->count_filteredid_en($kdWah),
						"data" => $data,
				);
		echo json_encode($output);
	}
	
	public function ajax_add() {
		$data = array(
				'wisata_id'         => $this->input->post('wisata_id'),
				'wahana_id'       		 => $this->input->post('wahana_id'),
				'wahwis_htm'       		 => $this->input->post('wahwis_htm')
			);
			
		if ($this->session->userdata('current_language')=='english'){
 			$insert = $this->Mdl_berwahana->add_en($data);
 		}else{
 			$insert = $this->Mdl_berwahana->add($data);
 		}	
		
		//print_r($this->db->last_query());
		echo json_encode(array('status' => TRUE));
	}
	
	public function ajax_edit_wah($id) {
		$data = $this->Mdl_berwahana->get_by_id($id);
		echo json_encode($data);
	}
	
	public function ajax_edit_wah_en($id) {
		$data = $this->Mdl_berwahana->get_by_id_en($id);
		echo json_encode($data);
	}
	
	public function ajax_update() {
		$data = array(
				'wahana_id'       		 => $this->input->post('wahana_id'),
				'wahwis_htm'       		 => $this->input->post('wahwis_htm'),
			);
		if ($this->session->userdata('current_language')=='english'){
 			$this->Mdl_berwahana->update_en(array('wahwis_id' => $this->input->post('wahwis_id')), $data);
 		}else{
 			$this->Mdl_berwahana->update(array('wahwis_id' => $this->input->post('wahwis_id')), $data);
 		}	
		
		//print_r($this->db->last_query());
		echo json_encode(array("status" => TRUE));
    }
	
	public function ajax_delete($id) {
	   if ($this->session->userdata('current_language')=='english'){
 			$this->Mdl_berwahana->delete_by_id_en($id);
 	   }else{
 			$this->Mdl_berwahana->delete_by_id($id);
 	   }	
      
      echo json_encode(array("status" => TRUE));
    }
}	