<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Berfoto_produk extends CI_Controller {
	
	public function __construct() {
		parent::__construct();
		$this->load->model('Mdl_foto_produk');
		$this->auth->restrict();
		date_default_timezone_set("Asia/Jakarta");
		$this->load->library("session");
	}
	
	function index(){
       // $this->mdl_home->getsqurity();
	   // $data['fasilitas']=$this->Mdl_berwahana->fasilitas();
        $data['view_file']    = "moduls/produk_foto";
        $this->load->view('admin_view',$data);
    }
	
	public function ajax_listid() {
		$kdFoto = $this->uri->segment(3);
		$list = $this->Mdl_foto_produk->get_datatablesid($kdFoto);
		//print_r($this->db->last_query());
		$data = array();
		$no = $_REQUEST['start'];
		foreach ($list as $det) {
			if($det->url_foto==''){ $cover = 'no_image.jpg'; }else{ $cover = $det->url_foto; }
			$row3 = '<img src="'.base_url().'../uploads/foto_produk/'.$cover.'" style="height: 500px; width: 600px;">';
			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $det->nama_produk;
			$row[] = '
					  <a href="#modal-table'.$det->id_foto.'" data-toggle="modal" class="tooltip-success" data-rel="tooltip" title="Edit">
						<span class="green">
							<i class="ace-icon fa fa-eye bigger-120"></i>
						</span>
					  </a>
					  <div id="modal-table'.$det->id_foto.'" class="modal fade" tabindex="-1">
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
			<a href="javascript:void(0)" onclick="edit('."'".$det->id_foto."'".')">
			<button class="btn btn-white btn-info btn-bold">
				<i class="ace-icon fa fa-pencil bigger-120 blue"></i>
			</button>
			</a>
			<a href="javascript:void(0)" onclick="hapus('."'".$det->id_foto."'".')">
			<button class="btn btn-white btn-danger btn-bold">
				<i class="ace-icon fa fa-remove bigger-120 red"></i>
			</button>
			</a>
			';
			$data[] = $row;
		}

		$output = array(
						"draw" => $_REQUEST['draw'],
						"recordsTotal" => $this->Mdl_foto_produk->count_allid($kdFoto),
						"recordsFiltered" => $this->Mdl_foto_produk->count_filteredid($kdFoto),
						"data" => $data,
				);
		echo json_encode($output);
	}

	
	
	function ajax_add(){
		$gambar = $_FILES['userfile']['name'];

		$config['upload_path'] = realpath('../uploads/foto_produk');
		// $config['upload_path'] = realpath('../uploads');
		$config['allowed_types']        = 'gif|jpg|png';
		$config['max_size'] = '2000000';
        $config['max_width'] = '4024';
        $config['max_height']= '2468';
		$config['file_name'] = $gambar;	
		
		$this->load->library('upload', $config);
 		$this->upload->initialize($config);
 		$this->upload->do_upload('userfile');
		// if($this->upload->do_upload('userfile')){
 			
			$data = array(
			'id_produk'		=> $this->input->post('id_produk'),
			'url_foto' => str_replace(" ","_",$gambar)
			); 			
 			
 		

		$this->Mdl_foto_produk->add($data);
		echo json_encode(array('status' => TRUE));
// }else{
// 	echo $this->upload->display_errors();
// }
	}

	
	
	public function ajax_edit($id) {
		$data = $this->Mdl_foto_produk->get_by_id($id);
		echo json_encode($data);
	}
	
	public function upload() {
        //if(!$modul){$this->session->set_userdata('err_msg', 'Anda Harus pilih salah satu Modul.'); redirect('admin');}
		$gambar = $_FILES['file-upload']['name'];
		//$nama_file = $this->input->post('slider_judul').'.'.$olah[1];
		//$gambar = str_replace(' ', '_', $nama_file);

		$config['upload_path'] = realpath('../uploads/foto_produk');
		$config['allowed_types']        = 'gif|jpg|png';
		$config['max_size'] = '2000000';
        $config['max_width'] = '4024';
        $config['max_height']= '2468';
		$config['file_name'] = $gambar;	
		
		$this->load->library('upload', $config);
 		$this->upload->initialize($config);
		$this->upload->do_upload('file-upload');
 			
			$data = array(
			'url_foto' => str_replace(" ","_",$gambar),
			); 			
 		
 		

		$where = array('id_foto' => $this->input->post('id_foto'));			 
		$this->Mdl_foto_produk->update_data($where,$data,'foto_produk');	
		
		echo json_encode(array('status' => TRUE));
    }
	
	public function ajax_delete($id) {
      $this->Mdl_foto_produk->delete_by_id($id);
      echo json_encode(array("status" => TRUE));
    }

}