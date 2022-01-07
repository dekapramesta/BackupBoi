<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Berpendukung extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('Mdl_berpendukung');
		$this->auth->restrict();
		date_default_timezone_set("Asia/Jakarta");
		$this->load->library("session");
	}
	
	function index(){
       // $this->mdl_home->getsqurity();
	   // $data['fasilitas']=$this->Mdl_berwahana->fasilitas();
        $data['view_file']    = "moduls/wisata_berpendukung";
        $this->load->view('admin_view',$data);
    }
	
	public function ajax_listid() {
		$kdPen = $this->uri->segment(3);
		$list = $this->Mdl_berpendukung->get_datatablesid($kdPen);
		//print_r($this->db->last_query());
		$data = array();
		$no = $_REQUEST['start'];
		foreach ($list as $det) {
			if($det->wiskung_url_foto==''){ $cover = 'no_image.jpg'; }else{ $cover = $det->wiskung_url_foto; }
			$row3 = '<img src="'.base_url().'../uploads/fasilitas_pendukung/'.$cover.'" style="height: 500px; width: 600px;">';
			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $det->wiskung_nama;
			$row[] = $det->wiskung_alamat;
			$row[] = $det->wiskung_telp;
			$row[] = $det->wiskung_website;
			$row[] = '
					  <a href="#modal-table'.$det->wiskung_id.'" data-toggle="modal" class="tooltip-success" data-rel="tooltip" title="Edit">
						<span class="green">
							<i class="ace-icon fa fa-eye bigger-120"></i>
						</span>
					  </a>
					  <div id="modal-table'.$det->wiskung_id.'" class="modal fade" tabindex="-1">
						<div class="modal-dialog">
							<div class="modal-content">
								<div class="modal-header no-padding">
									<div class="table-header">
									<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
										<span class="white">&times;</span>
									</button>
									Gambar
									</div>
								</div>

								<div class="modal-body no-padding">
								<div align="center">
									'.$row3.'
								</div>		
								</div>
							</div><!-- /.modal-content -->
						</div><!-- /.modal-dialog -->
						</div>
					  ';
			$row[] = '
			<a href="javascript:void(0)" onclick="edit('."'".$det->wiskung_id."'".')">
			<button class="btn btn-white btn-info btn-bold">
				<i class="ace-icon fa fa-pencil bigger-120 blue"></i>
			</button>
			</a>
			<a href="javascript:void(0)" onclick="hapus('."'".$det->wiskung_id."'".')">
			<button class="btn btn-white btn-danger btn-bold">
				<i class="ace-icon fa fa-remove bigger-120 red"></i>
			</button>
			</a>
			';
			$data[] = $row;
		}

		$output = array(
						"draw" => $_REQUEST['draw'],
						"recordsTotal" => $this->Mdl_berpendukung->count_allid($kdPen),
						"recordsFiltered" => $this->Mdl_berpendukung->count_filteredid($kdPen),
						"data" => $data,
				);
		echo json_encode($output);
	}
	
	public function ajax_listid_en() {
		$kdPen = $this->uri->segment(3);
		$list = $this->Mdl_berpendukung->get_datatablesid_en($kdPen);
		//print_r($this->db->last_query());
		$data = array();
		$no = $_REQUEST['start'];
		foreach ($list as $det) {
			if($det->wiskung_url_foto==''){ $cover = 'no_image.jpg'; }else{ $cover = $det->wiskung_url_foto; }
			$row3 = '<img src="'.base_url().'../uploads/fasilitas_pendukung/'.$cover.'" style="height: 500px; width: 600px;">';
			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $det->wiskung_nama;
			$row[] = $det->wiskung_alamat;
			$row[] = $det->wiskung_telp;
			$row[] = $det->wiskung_website;
			$row[] = '
					  <a href="#modal-table'.$det->wiskung_id.'" data-toggle="modal" class="tooltip-success" data-rel="tooltip" title="Edit">
						<span class="green">
							<i class="ace-icon fa fa-eye bigger-120"></i>
						</span>
					  </a>
					  <div id="modal-table'.$det->wiskung_id.'" class="modal fade" tabindex="-1">
						<div class="modal-dialog">
							<div class="modal-content">
								<div class="modal-header no-padding">
									<div class="table-header">
									<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
										<span class="white">&times;</span>
									</button>
									Gambar
									</div>
								</div>

								<div class="modal-body no-padding">
								<div align="center">
									'.$row3.'
								</div>		
								</div>
							</div><!-- /.modal-content -->
						</div><!-- /.modal-dialog -->
						</div>
					  ';
			$row[] = '
			<a href="javascript:void(0)" onclick="edit('."'".$det->wiskung_id."'".')">
			<button class="btn btn-white btn-info btn-bold">
				<i class="ace-icon fa fa-pencil bigger-120 blue"></i>
			</button>
			</a>
			<a href="javascript:void(0)" onclick="hapus('."'".$det->wiskung_id."'".')">
			<button class="btn btn-white btn-danger btn-bold">
				<i class="ace-icon fa fa-remove bigger-120 red"></i>
			</button>
			</a>
			';
			$data[] = $row;
		}

		$output = array(
						"draw" => $_REQUEST['draw'],
						"recordsTotal" => $this->Mdl_berpendukung->count_allid_en($kdPen),
						"recordsFiltered" => $this->Mdl_berpendukung->count_filteredid_en($kdPen),
						"data" => $data,
				);
		echo json_encode($output);
	}
	
	function ajax_add(){
		$olah = explode('.', $_FILES['userfile']['name']);
		$nama_file = $this->input->post('wiskung_nama').'.'.$olah[1];
		
		$gambar = str_replace(' ', '_', $nama_file);

		$config['upload_path'] = realpath('../uploads/fasilitas_pendukung');
		$config['allowed_types']        = 'gif|jpg|png';
		$config['max_size'] = '2000000';
        $config['max_width'] = '2024';
        $config['max_height']= '1468';
		$config['file_name'] = $nama_file;	
		
		$this->load->library('upload', $config);
 		$this->upload->initialize($config);
		$this->upload->do_upload('userfile');

		if(empty($gambar)){
 			$data = array(
			'wisata_id' => $this->input->post('wisata_id'),
			'faspen_id' => $$this->input->post('faspen_id'),
			'wiskung_nama' => $this->input->post('wiskung_nama'),
			'wiskung_alamat' => $this->input->post('wiskung_alamat'),
			'wiskung_telp' => $this->input->post('wiskung_telp'),
			'wiskung_website' => $$this->input->post('wiskung_website'),
			'wiskung_latitude' => $this->input->post('wiskung_latitude'),
			'wiskung_longitude' => $this->input->post('wiskung_longitude'),
			);
 		}else{
 			//unlink('../assets/galeri/'.$this->input->post('terserah'));
 			
			$data = array(
			'wisata_id' => $this->input->post('wisata_id'),
			'faspen_id' => $this->input->post('faspen_id'),
			'wiskung_nama' => $this->input->post('wiskung_nama'),
			'wiskung_alamat' => $this->input->post('wiskung_alamat'),
			'wiskung_telp' => $this->input->post('wiskung_telp'),
			'wiskung_website' => $this->input->post('wiskung_website'),
			'wiskung_latitude' => $this->input->post('wiskung_latitude'),
			'wiskung_longitude' => $this->input->post('wiskung_longitude'),
			'wiskung_url_foto' => $gambar
			); 			
 		}	
 		
		if ($this->session->userdata('current_language')=='english'){
 			$this->Mdl_berpendukung->add_en($data);
 		}else{
 			$this->Mdl_berpendukung->add($data);
 		}

		
		echo json_encode(array('status' => TRUE));

	}
	
	public function ajax_edit($id) {
		$data = $this->Mdl_berpendukung->get_by_id($id);
		echo json_encode($data);
	}
	
	public function ajax_edit_en($id) {
		$data = $this->Mdl_berpendukung->get_by_id_en($id);
		echo json_encode($data);
	}
	
	public function update() {
		$data = array(
			'faspen_id' => $this->input->post('faspen_id'),
			'wiskung_nama' => $this->input->post('wiskung_nama'),
			'wiskung_alamat' => $this->input->post('wiskung_alamat'),
			'wiskung_telp' => $this->input->post('wiskung_telp'),
			'wiskung_website' => $this->input->post('wiskung_website'),
			'wiskung_latitude' => $this->input->post('wiskung_latitude'),
			'wiskung_longitude' => $this->input->post('wiskung_longitude'),
			);
		if ($this->session->userdata('current_language')=='english'){
 			$this->Mdl_berpendukung->update_en(array('wiskung_id' => $this->input->post('wiskung_id')), $data);
 		}else{
 			$this->Mdl_berpendukung->update(array('wiskung_id' => $this->input->post('wiskung_id')), $data);
 		}	
		
		echo json_encode(array("status" => TRUE));
    }
	
	public function upload() {
        //if(!$modul){$this->session->set_userdata('err_msg', 'Anda Harus pilih salah satu Modul.'); redirect('admin');}
		$gambar = $_FILES['file-upload']['name'];
		//$nama_file = $this->input->post('slider_judul').'.'.$olah[1];

		$nama = $this->input->post('berita_judul');
		$deskripsi = $this->input->post('slider_deskripsi');
		//$gambar = str_replace(' ', '_', $nama_file);

		$config['upload_path'] = realpath('../uploads/fasilitas_pendukung');
		$config['allowed_types']        = 'gif|jpg|png';
		$config['max_size'] = '2000000';
        $config['max_width'] = '2024';
        $config['max_height']= '1468';
		$config['file_name'] = $gambar;	
		
		$this->load->library('upload', $config);
 		$this->upload->initialize($config);
		$this->upload->do_upload('file-upload');
 			
			$data = array(
			'wiskung_url_foto' => $gambar,
			); 			
 		
 		

		$where = array('wiskung_id' => $this->input->post('wiskung_id'));		

		if ($this->session->userdata('current_language')=='english'){
 			$this->Mdl_berpendukung->update_data_en($where,$data,'wisata_berpendukung');	
 		}else{
 			$this->Mdl_berpendukung->update_data($where,$data,'wisata_berpendukung');	
 		}	
		
		
		echo json_encode(array('status' => TRUE));
    }
	
	public function ajax_delete($id) {
	    if ($this->session->userdata('current_language')=='english'){
 			$this->Mdl_berpendukung->delete_by_id_en($id);
 		}else{
 			$this->Mdl_berpendukung->delete_by_id($id);	
 		}	
      
      echo json_encode(array("status" => TRUE));
    }
}