<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Fasilitas_wisata extends CI_Controller {
	
	public function __construct() {
		parent::__construct();
		$this->load->model('Mdl_fasilitas_wisata');
		$this->auth->restrict();
		date_default_timezone_set("Asia/Jakarta");
		$this->load->library("session");
	}
	
	function index(){
       // $this->mdl_home->getsqurity();
        $data['view_file']    = "moduls/fasilitas_wisata";
        $this->load->view('admin_view',$data);
    }
	
	public function ajax_list() {
		$list = $this->Mdl_fasilitas_wisata->get_datatables();
		$data = array();
		$no = $_REQUEST['start'];
		foreach ($list as $slider) {
			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $slider->faswis_nama;
			$row[] = $slider->faswis_icon;
			$row[] = '
			<div class="btn-group">
                        <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">Aksi <span class="caret"></span></button>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="javascript:void(0)" onclick="update('."'".$slider->faswis_id."'".')">Edit</a></li>
                            <li><a href="javascript:void(0)" onclick="hapus('."'".$slider->faswis_id."'".')">Delete</a></li>
                        </ul>
            </div>';
			$data[] = $row;
		}

		$output = array(
						"draw" => $_REQUEST['draw'],
						"recordsTotal" => $this->Mdl_fasilitas_wisata->count_all(),
						"recordsFiltered" => $this->Mdl_fasilitas_wisata->count_filtered(),
						"data" => $data,
				);
		echo json_encode($output);
	}
	
	public function ajax_add() {
		$data = array(
				'faswis_nama'         => $this->input->post('faswis_nama'),
				'faswis_icon'         => $this->input->post('faswis_icon'),
			);
		$insert = $this->Mdl_fasilitas_wisata->add($data);
		//print_r($this->db->last_query());
		echo json_encode(array('status' => TRUE));
	}
	
	public function ajax_edit($id) {
		$data = $this->Mdl_fasilitas_wisata->get_by_id($id);
		echo json_encode($data);
	}
	
	public function ajax_update() {
		$data = array(
				'faswis_nama'         => $this->input->post('faswis_nama'),
				'faswis_icon'         => $this->input->post('faswis_icon'),
			);
		$this->Mdl_fasilitas_wisata->update(array('faswis_id' => $this->input->post('faswis_id')), $data);
		echo json_encode(array("status" => TRUE));
    }
	
	public function ajax_delete($id) {
      $this->Mdl_fasilitas_wisata->delete_by_id($id);
      echo json_encode(array("status" => TRUE));
    }
    

}