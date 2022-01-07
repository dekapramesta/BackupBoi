<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Fasilitas_pendukung extends CI_Controller {
	
	public function __construct() {
		parent::__construct();
		$this->load->model('Mdl_pendukung');
		$this->auth->restrict();
		date_default_timezone_set("Asia/Jakarta");
		$this->load->library("session");
	}
	
	function index(){
       // $this->mdl_home->getsqurity();
        $data['view_file']    = "moduls/fasilitas_pendukung";
        $this->load->view('admin_view',$data);
    }
	
	public function ajax_list() {
		$list = $this->Mdl_pendukung->get_datatables();
		$data = array();
		$no = $_REQUEST['start'];
		foreach ($list as $pendukung) {
			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $pendukung->faspen_nama;
			$row[] = $pendukung->faspen_icon;	  
			$row[] = '
			<div class="btn-group">
                        <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">Aksi <span class="caret"></span></button>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="javascript:void(0)" onclick="update('."'".$pendukung->faspen_id."'".')">Edit</a></li>
                            <li><a href="javascript:void(0)" onclick="hapus('."'".$pendukung->faspen_id."'".')">Delete</a></li>
                        </ul>
            </div>';
			$data[] = $row;
		}

		$output = array(
						"draw" => $_REQUEST['draw'],
						"recordsTotal" => $this->Mdl_pendukung->count_all(),
						"recordsFiltered" => $this->Mdl_pendukung->count_filtered(),
						"data" => $data,
				);
		echo json_encode($output);
	}
	
	public function ajax_add() {
		$data = array(
				'faspen_nama'         => $this->input->post('faspen_nama'),
				'faspen_icon'         => $this->input->post('faspen_icon'),
			);
		$insert = $this->Mdl_pendukung->add($data);
		//print_r($this->db->last_query());
		echo json_encode(array('status' => TRUE));
	}
	
	public function ajax_edit($id) {
		$data = $this->Mdl_pendukung->get_by_id($id);
		echo json_encode($data);
	}
	
	public function ajax_update() {
		$data = array(
				'faspen_nama'         => $this->input->post('faspen_nama'),
				'faspen_icon'         => $this->input->post('faspen_icon'),
			);
		$this->Mdl_pendukung->update(array('faspen_id' => $this->input->post('faspen_id')), $data);
		echo json_encode(array("status" => TRUE));
    }
	
	public function ajax_delete($id) {
      $this->Mdl_pendukung->delete_by_id($id);
      echo json_encode(array("status" => TRUE));
    }

}