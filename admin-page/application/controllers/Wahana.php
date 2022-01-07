<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Wahana extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('Mdl_wahana');
		$this->auth->restrict();
		date_default_timezone_set("Asia/Jakarta");
		$this->load->library("session");
	}
	
	function index(){
       // $this->mdl_home->getsqurity();
        $data['view_file']    = "moduls/wahana";
        $this->load->view('admin_view',$data);
    }
	
	public function ajax_list() {
		$list = $this->Mdl_wahana->get_datatables();
		$data = array();
		$no = $_REQUEST['start'];
		foreach ($list as $wahana) {
			if($wahana->wahana_icon==''){ $cover = 'no_image.jpg'; }else{ $cover = $wahana->wahana_icon; }
			$row2 = '<img src="'.base_url().'../uploads/wahana/'.$cover.'" style="height: 100%; width: 100%;">';
			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $wahana->wahana_nama;
			$row[] = '
					  <a href="#modal-table'.$wahana->wahana_id.'" data-toggle="modal" class="tooltip-success" data-rel="tooltip" title="Lihat Gambar">
						<span class="green">
							<i class="ace-icon fa fa-eye bigger-120"></i>
						</span>
					  </a>
					  <div id="modal-table'.$wahana->wahana_id.'" class="modal fade" tabindex="-1">
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
			$row[] = $wahana->wahana_deskripsi;
			$row[] = '
			<div class="btn-group">
                        <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">Aksi <span class="caret"></span></button>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="javascript:void(0)" onclick="update('."'".$wahana->wahana_id."'".')">Edit</a></li>
                            <li><a href="javascript:void(0)" onclick="hapus('."'".$wahana->wahana_id."'".')">Delete</a></li>
                        </ul>
            </div>';
			$data[] = $row;
		}

		$output = array(
						"draw" => $_REQUEST['draw'],
						"recordsTotal" => $this->Mdl_wahana->count_all(),
						"recordsFiltered" => $this->Mdl_wahana->count_filtered(),
						"data" => $data,
				);
		echo json_encode($output);
	}

	public function ajax_list_en() {
		$list = $this->Mdl_wahana->get_datatables_en();
		$data = array();
		$no = $_REQUEST['start'];
		foreach ($list as $wahana) {
			if($wahana->wahana_icon==''){ $cover = 'no_image.jpg'; }else{ $cover = $wahana->wahana_icon; }
			$row2 = '<img src="'.base_url().'../uploads/wahana/'.$cover.'" style="height: 100%; width: 100%;">';
			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $wahana->wahana_nama;
			$row[] = '
					  <a href="#modal-table'.$wahana->wahana_id.'" data-toggle="modal" class="tooltip-success" data-rel="tooltip" title="Lihat Gambar">
						<span class="green">
							<i class="ace-icon fa fa-eye bigger-120"></i>
						</span>
					  </a>
					  <div id="modal-table'.$wahana->wahana_id.'" class="modal fade" tabindex="-1">
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
			$row[] = $wahana->wahana_deskripsi;
			$row[] = '
			<div class="btn-group">
                        <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">Aksi <span class="caret"></span></button>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="javascript:void(0)" onclick="update('."'".$wahana->wahana_id."'".')">Edit</a></li>
                            <li><a href="javascript:void(0)" onclick="hapus('."'".$wahana->wahana_id."'".')">Delete</a></li>
                        </ul>
            </div>';
			$data[] = $row;
		}

		$output = array(
						"draw" => $_REQUEST['draw'],
						"recordsTotal" => $this->Mdl_wahana->count_all_en(),
						"recordsFiltered" => $this->Mdl_wahana->count_filtered_en(),
						"data" => $data,
				);
		echo json_encode($output);
	}

	function ajax_add(){

		$olah = explode('.', $_FILES['userfile']['name']);
		$nama_file = $this->input->post('wahana_nama').'.'.$olah[1];

		$nama = $this->input->post('wahana_nama');
		$deskripsi = $this->input->post('wahana_deskripsi');
		$gambar = str_replace(' ', '_', $nama_file);

		$config['upload_path'] = realpath('../uploads/wahana/');
		$config['allowed_types']        = 'gif|jpg|png';
		$config['max_size'] = '2000000';
        $config['max_width'] = '2024';
        $config['max_height']= '1468';
		$config['file_name'] = $nama_file;	
		
		$this->load->library('upload', $config);
 		$this->upload->initialize($config);
		$this->upload->do_upload('userfile');
		// if($this->upload->do_upload('userfile')){

		if(empty($gambar)){
			
			$data = array(
			'wahana_nama' => $nama,
			'wahana_deskripsi' => $deskripsi,
			);
			
 			
 		}else{
 			//unlink('../assets/galeri/'.$this->input->post('terserah'));
 			
			$data = array(
			'wahana_nama' => $nama,
			'wahana_icon' => $gambar,
			'wahana_deskripsi' => $deskripsi
			); 			
			
 		}	
 		
 		if ($this->session->userdata('current_language')=='english'){
 			$this->Mdl_wahana->add_en($data);
 		}else{
 			$this->Mdl_wahana->add($data);
 		}

 		
		
		echo json_encode(array('status' => TRUE));
	// }else{
	// 	echo $this->upload->display_errors();
	// 	echo realpath('../uploads/fasilitas_wisata/');

	// }
}
	
	public function ajax_edit($id) {
		$data = $this->Mdl_wahana->get_by_id($id);
		echo json_encode($data);
	}

	public function ajax_edit_en($id) {
		$data = $this->Mdl_wahana->get_by_id_en($id);
		echo json_encode($data);
	}
	
	public function ajax_update() {
		$data = array(
				'wahana_nama'         => $this->input->post('wahana_nama'),
				'wahana_icon'         => $this->input->post('wahana_icon'),
				'wahana_deskripsi'    => $this->input->post('wahana_deskripsi'),
			);
		$this->Mdl_wahana->update(array('wahana_id' => $this->input->post('wahana_id')), $data);
		echo json_encode(array("status" => TRUE));
    }

    public function update() {
		$data = array(
				'wahana_nama'         => $this->input->post('wahana_nama'),
				'wahana_deskripsi'    => $this->input->post('wahana_deskripsi')
			);

		if ($this->session->userdata('current_language')=='english'){
 			$this->Mdl_wahana->update_en(array('wahana_id' => $this->input->post('wahana_id')), $data);
 		}else{
 			$this->Mdl_wahana->update(array('wahana_id' => $this->input->post('wahana_id')), $data);
 		}
		
		echo json_encode(array("status" => TRUE));
    }
	
	public function upload() {
        //if(!$modul){$this->session->set_userdata('err_msg', 'Anda Harus pilih salah satu Modul.'); redirect('admin');}
		$gambar = $_FILES['file-upload']['name'];
		//$nama_file = $this->input->post('slider_judul').'.'.$olah[1];

		//$nama = $this->input->post('berita_judul');
		//$deskripsi = $this->input->post('slider_deskripsi');
		//$gambar = str_replace(' ', '_', $nama_file);

		$config['upload_path'] = realpath('../uploads/wahana');
		$config['allowed_types']        = 'gif|jpg|png';
		$config['max_size'] = '2000000';
        $config['max_width'] = '2024';
        $config['max_height']= '1468';
		$config['file_name'] = $gambar;	
		
		$this->load->library('upload', $config);
 		$this->upload->initialize($config);
		$this->upload->do_upload('file-upload');
 			
			$data = array(
			'wahana_icon' => $gambar,
			); 			
 		
		$where = array('wahana_id' => $this->input->post('wahana_id'));	

		if ($this->session->userdata('current_language')=='english'){
 			$this->Mdl_wahana->update_data_en($where,$data,'wahana');		
 		}else{
 			$this->Mdl_wahana->update_data($where,$data,'wahana');	
 		}
		
		echo json_encode(array('status' => TRUE));
    }
	
	public function ajax_delete($id) {
	if ($this->session->userdata('current_language')=='english'){
 		$this->Mdl_wahana->delete_by_id_en($id);
 	}else{
 		$this->Mdl_wahana->delete_by_id($id);
 	}	
      
      echo json_encode(array("status" => TRUE));
    }

}