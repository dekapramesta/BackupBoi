<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_berita extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('Mdl_berita');
		$this->auth->restrict();
		date_default_timezone_set("Asia/Jakarta");
		$this->load->library("session");
	}
	
	function index(){
       // $this->mdl_home->getsqurity();
        $data['view_file']    = "moduls/berita";
		$data['penulis_berita'] = $this->Mdl_berita->penulis_berita()->result_array();
		$data['penulis_berita_en'] = $this->Mdl_berita->penulis_berita_en()->result_array();
        $this->load->view('admin_view',$data);
    }
	
	public function ajax_list() {
		$list = $this->Mdl_berita->get_datatables();
		$data = array();
		$no = $_REQUEST['start'];
		foreach ($list as $berita) {
			if($berita->berita_foto==''){ $cover = 'no_image.jpg'; }else{ $cover = $berita->berita_foto; }
			$row5 = '<img src="'.base_url().'../uploads/berita/'.$cover.'" style="height: 500px; width: 600px;">';
			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $berita->berita_judul;
			$row[] = $berita->berita_deskripsi;
			$row[] = $berita->berita_tgl;
			$row[] = $berita->penulis_nama.' - '. $berita->penulis_profesi;
			$row[] = '
					  <a href="#modal-table'.$berita->berita_id.'" data-toggle="modal" class="tooltip-success" data-rel="tooltip" title="Lihat Gambar">
						<span class="green">
							<i class="ace-icon fa fa-eye bigger-120"></i>
						</span>
					  </a>
					  <div id="modal-table'.$berita->berita_id.'" class="modal fade" tabindex="-1">
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
									'.$row5.'
								</div>		
								</div>
							</div><!-- /.modal-content -->
						</div><!-- /.modal-dialog -->
						</div>
					  ';
			$row[] = $berita->berita_tag;		  
			$row[] = '
			<div class="btn-group">
                        <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">Aksi <span class="caret"></span></button>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="javascript:void(0)" onclick="update('."'".$berita->berita_id."'".')">Edit</a></li>
                            <li><a href="javascript:void(0)" onclick="hapus('."'".$berita->berita_id."'".')">Delete</a></li>
                        </ul>
            </div>';
			$data[] = $row;
		}

		$output = array(
						"draw" => $_REQUEST['draw'],
						"recordsTotal" => $this->Mdl_berita->count_all(),
						"recordsFiltered" => $this->Mdl_berita->count_filtered(),
						"data" => $data,
				);
		echo json_encode($output);
	}
	
	public function ajax_list_en() {
		$list = $this->Mdl_berita->get_datatables_en();
		$data = array();
		$no = $_REQUEST['start'];
		foreach ($list as $berita) {
			if($berita->berita_foto==''){ $cover = 'no_image.jpg'; }else{ $cover = $berita->berita_foto; }
			$row5 = '<img src="'.base_url().'../uploads/berita/'.$cover.'" style="height: 500px; width: 600px;">';
			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $berita->berita_judul;
			$row[] = $berita->berita_deskripsi;
			$row[] = $berita->berita_tgl;
			$row[] = $berita->penulis_nama.' - '. $berita->penulis_profesi;
			$row[] = '
					  <a href="#modal-table'.$berita->berita_id.'" data-toggle="modal" class="tooltip-success" data-rel="tooltip" title="Lihat Gambar">
						<span class="green">
							<i class="ace-icon fa fa-eye bigger-120"></i>
						</span>
					  </a>
					  <div id="modal-table'.$berita->berita_id.'" class="modal fade" tabindex="-1">
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
									'.$row5.'
								</div>		
								</div>
							</div><!-- /.modal-content -->
						</div><!-- /.modal-dialog -->
						</div>
					  ';
			$row[] = $berita->berita_tag;
			$row[] = '
			<div class="btn-group">
                        <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">Aksi <span class="caret"></span></button>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="javascript:void(0)" onclick="update('."'".$berita->berita_id."'".')">Edit</a></li>
                            <li><a href="javascript:void(0)" onclick="hapus('."'".$berita->berita_id."'".')">Delete</a></li>
                        </ul>
            </div>';
			$data[] = $row;
		}

		$output = array(
						"draw" => $_REQUEST['draw'],
						"recordsTotal" => $this->Mdl_berita->count_all_en(),
						"recordsFiltered" => $this->Mdl_berita->count_filtered_en(),
						"data" => $data,
				);
		echo json_encode($output);
	}

	function ajax_add(){
		$olah = explode('.', $_FILES['userfile']['name']);
		$nama_file = $this->input->post('berita_judul').'.'.$olah[1];

		$judul = $this->input->post('berita_judul');
		$penulis = $this->input->post('penulis_id');
		$deskripsi = $this->input->post('berita_deskripsi');
		$tag = $this->input->post('berita_tag');
		$gambar = str_replace(' ', '_', $nama_file);

		$config['upload_path'] = realpath('../uploads/berita');
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
			'berita_judul' => $judul,
			'penulis_id' => $penulis,
			'berita_deskripsi' => $deskripsi,
			'berita_tgl' => date('Y-m-d'),
			'berita_tag' => $tag,
			);
 		}else{
 			//unlink('../assets/galeri/'.$this->input->post('terserah'));
 			
			$data = array(
			'berita_judul' => $judul,
			'penulis_id' => $penulis,
			'berita_deskripsi' => $deskripsi,
			'berita_tgl' => date('Y-m-d'),
			'berita_tag' => $tag,
			'berita_foto' => $gambar
			); 			
 		}	
 		
 		if ($this->session->userdata('current_language')=='english'){
 			$this->Mdl_berita->add_en($data);
 		}else{
 			$this->Mdl_berita->add($data);
 		}
		
		echo json_encode(array('status' => TRUE));

	}
	
	public function ajax_edit($id) {
		$data = $this->Mdl_berita->get_by_id($id);
		echo json_encode($data);
	}

	public function ajax_edit_en($id) {
		$data = $this->Mdl_berita->get_by_id_en($id);
		echo json_encode($data);
	}
	
	public function update() {
		$data = array(
				'berita_judul' => $this->input->post('berita_judul'),
				'penulis_id' => $this->input->post('penulis_id'),
				'berita_deskripsi' => $this->input->post('berita_deskripsi'),
				'berita_tag' => $this->input->post('berita_tag'),
			);
		
		if ($this->session->userdata('current_language')=='english'){
 			$this->Mdl_berita->update_en(array('berita_id' => $this->input->post('berita_id')), $data);
 		}else{
 			$this->Mdl_berita->update(array('berita_id' => $this->input->post('berita_id')), $data);
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

		$config['upload_path'] = realpath('../uploads/berita');
		$config['allowed_types']        = 'gif|jpg|png';
		$config['max_size'] = '2000000';
        $config['max_width'] = '2024';
        $config['max_height']= '1468';
		$config['file_name'] = $gambar;	
		
		$this->load->library('upload', $config);
 		$this->upload->initialize($config);
		$this->upload->do_upload('file-upload');
 			
			$data = array(
			'berita_foto' => $gambar,
			); 			
 		
 		

		$where = array('berita_id' => $this->input->post('berita_id'));	

		if ($this->session->userdata('current_language')=='english'){
 			$this->Mdl_berita->update_data_en($where,$data,'berita');	
 		}else{
 			$this->Mdl_berita->update_data($where,$data,'berita');	
 		}

		echo json_encode(array('status' => TRUE));
    }
	
	public function ajax_delete($id) {
	  if ($this->session->userdata('current_language')=='english'){
 			$this->Mdl_berita->delete_by_id_en($id);
 		}else{
 			$this->Mdl_berita->delete_by_id($id);
 		}	

      echo json_encode(array("status" => TRUE));
    }
}