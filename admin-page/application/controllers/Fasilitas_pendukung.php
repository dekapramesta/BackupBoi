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
			if($pendukung->faspen_icon==''){ $cover = 'no_image.jpg'; }else{ $cover = $pendukung->faspen_icon; }
			$row2 = '<img src="'.base_url().'../uploads/fasilitas_wisata/'.$cover.'" style="height: 100%; width: 100%;">';
			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $pendukung->faspen_nama;
			$row[] = '
					  <a href="#modal-table'.$pendukung->faspen_id.'" data-toggle="modal" class="tooltip-success" data-rel="tooltip" title="Lihat Gambar">
						<span class="green">
							<i class="ace-icon fa fa-eye bigger-120"></i>
						</span>
					  </a>
					  <div id="modal-table'.$pendukung->faspen_id.'" class="modal fade" tabindex="-1">
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
									'.$row2.'
								</div>		
								</div>
							</div><!-- /.modal-content -->
						</div><!-- /.modal-dialog -->
						</div>
					  ';	  
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

	public function ajax_list_en() {
		$list = $this->Mdl_pendukung->get_datatables_en();
		$data = array();
		$no = $_REQUEST['start'];
		foreach ($list as $pendukung) {
			if($pendukung->faspen_icon==''){ $cover = 'no_image.jpg'; }else{ $cover = $pendukung->faspen_icon; }
			$row2 = '<img src="'.base_url().'../uploads/fasilitas_wisata/'.$cover.'" style="height: 100%; width: 100%;">';
			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $pendukung->faspen_nama;
			$row[] = '
					  <a href="#modal-table'.$pendukung->faspen_id.'" data-toggle="modal" class="tooltip-success" data-rel="tooltip" title="Lihat Gambar">
						<span class="green">
							<i class="ace-icon fa fa-eye bigger-120"></i>
						</span>
					  </a>
					  <div id="modal-table'.$pendukung->faspen_id.'" class="modal fade" tabindex="-1">
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
									'.$row2.'
								</div>		
								</div>
							</div><!-- /.modal-content -->
						</div><!-- /.modal-dialog -->
						</div>
					  ';	  
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
						"recordsTotal" => $this->Mdl_pendukung->count_all_en(),
						"recordsFiltered" => $this->Mdl_pendukung->count_filtered_en(),
						"data" => $data,
				);
		echo json_encode($output);
	}
	
	function ajax_add(){

		$olah = explode('.', $_FILES['userfile']['name']);
		$nama_file = $this->input->post('faspen_nama').'.'.$olah[1];

		$nama = $this->input->post('faspen_nama');
		$gambar = str_replace(' ', '_', $nama_file);

		$config['upload_path'] = realpath('../uploads/fasilitas_wisata/');
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
			'faspen_nama' => $nama,
			);
			
 			
 		}else{
 			//unlink('../assets/galeri/'.$this->input->post('terserah'));
 			
			$data = array(
			'faspen_nama' => $nama,
			'faspen_icon' => $gambar
			); 			
			
 		}	
 		
 		if ($this->session->userdata('current_language')=='english'){
 			$this->Mdl_pendukung->add_en($data);
 		}else{
 			$this->Mdl_pendukung->add($data);
 		}

 		
		
		echo json_encode(array('status' => TRUE));

	}
	
	public function ajax_edit($id) {
		$data = $this->Mdl_pendukung->get_by_id($id);
		echo json_encode($data);
	}

	public function ajax_edit_en($id) {
		$data = $this->Mdl_pendukung->get_by_id_en($id);
		echo json_encode($data);
	}
	
	public function update() {
		$data = array(
				'faspen_nama' => $this->input->post('faspen_nama'),
			);

		if ($this->session->userdata('current_language')=='english'){
 			$this->Mdl_pendukung->update_en(array('faspen_id' => $this->input->post('faspen_id')), $data);
 		}else{
 			$this->Mdl_pendukung->update(array('faspen_id' => $this->input->post('faspen_id')), $data);
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

		$config['upload_path'] = realpath('../uploads/fasilitas_wisata');
		$config['allowed_types']        = 'gif|jpg|png';
		$config['max_size'] = '2000000';
        $config['max_width'] = '2024';
        $config['max_height']= '1468';
		$config['file_name'] = $gambar;	
		
		$this->load->library('upload', $config);
 		$this->upload->initialize($config);
		$this->upload->do_upload('file-upload');
 			
			$data = array(
			'faspen_icon' => $gambar,
			); 			
 		
		$where = array('faspen_id' => $this->input->post('faspen_id'));	

		if ($this->session->userdata('current_language')=='english'){
 			$this->Mdl_pendukung->update_data_en($where,$data,'fasilitas_pendukung');		
 		}else{
 			$this->Mdl_pendukung->update_data($where,$data,'fasilitas_pendukung');	
 		}
		
		echo json_encode(array('status' => TRUE));
    }
	
	public function ajax_delete($id) {
	if ($this->session->userdata('current_language')=='english'){
 		$this->Mdl_pendukung->delete_by_id_en($id);
 	}else{
 		$this->Mdl_pendukung->delete_by_id($id);
 	}	
      
      echo json_encode(array("status" => TRUE));
    }

}