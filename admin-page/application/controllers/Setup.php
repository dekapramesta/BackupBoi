<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Setup extends CI_Controller {
	
	public function __construct() {
		parent::__construct();
		$this->db2 = $this->load->database('pariwisata_en', TRUE);
		$this->load->model('Mdl_setup');
		$this->auth->restrict();
		date_default_timezone_set("Asia/Jakarta");
		$this->load->library("session");
	}
	
	function index(){
       // $this->mdl_home->getsqurity();
        $data['view_file']    = "moduls/setup";
        $this->load->view('admin_view',$data);
    }
	
	public function ajax_edit() {
		$data = $this->Mdl_setup->get_by_id();
		//print_r($this->db->last_query());
		echo json_encode($data);
	}

	public function ajax_edit_en() {
		$data = $this->Mdl_setup->get_by_id_en();
		echo json_encode($data);
	}
	
	public function update_link() {
		$data1 = array('fc_isi' => $this->input->post('facebook'));
		$this->Mdl_setup->update_link($data1,array('fc_param' => 'FACEBOOK'));
		$data2 = array('fc_isi' => $this->input->post('twitter'));
		$this->Mdl_setup->update_link($data2,array('fc_param' => 'TWITTER'));
		$data3 = array('fc_isi' => $this->input->post('instagram'));
		$this->Mdl_setup->update_link($data3,array('fc_param' => 'INSTAGRAM'));
		$data4 = array('fc_isi' => $this->input->post('youtube'));
		$this->Mdl_setup->update_link($data4,array('fc_param' => 'YOUTUBE'));
	}

	public function update_link_en() {
		$data1 = array('fc_isi' => $this->input->post('facebook'));
		$this->Mdl_setup->update_link_en($data1,array('fc_param' => 'FACEBOOK'));
		$data2 = array('fc_isi' => $this->input->post('twitter'));
		$this->Mdl_setup->update_link_en($data2,array('fc_param' => 'TWITTER'));
		$data3 = array('fc_isi' => $this->input->post('instagram'));
		$this->Mdl_setup->update_link_en($data3,array('fc_param' => 'INSTAGRAM'));
		$data4 = array('fc_isi' => $this->input->post('youtube'));
		$this->Mdl_setup->update_link_en($data4,array('fc_param' => 'YOUTUBE'));
	}
	
	public function update_sekilas() {
		$data1 = array('fc_isi' => $this->input->post('sekilas_info'));
		$this->Mdl_setup->update_sekilas($data1,array('fc_param' => 'SEKILAS'));
		$data2 = array('fc_isi' => $this->input->post('judul'));
		$this->Mdl_setup->update_sekilas($data2,array('fc_param' => 'JUDUL'));
	}

	public function update_sekilas_en() {
		$data1 = array('fc_isi' => $this->input->post('sekilas_info'));
		$this->Mdl_setup->update_sekilas_en($data1,array('fc_param' => 'SEKILAS'));
		$data2 = array('fc_isi' => $this->input->post('judul'));
		$this->Mdl_setup->update_sekilas_en($data2,array('fc_param' => 'JUDUL'));
	}
	
	public function update_wisata() {
		$data1 = array('fc_kode' => $this->input->post('a1'));
		$this->Mdl_setup->update_wisata($data1,array('fc_param' => 'WISATA', 'ID'=>'1'));
		$data2 = array('fc_kode' => $this->input->post('a2'));
		$this->Mdl_setup->update_wisata($data2,array('fc_param' => 'WISATA', 'ID'=>'2'));
		$data3 = array('fc_kode' => $this->input->post('a3'));
		$this->Mdl_setup->update_wisata($data3,array('fc_param' => 'WISATA', 'ID'=>'27'));
		$data4 = array('fc_kode' => $this->input->post('a4'));
		$this->Mdl_setup->update_wisata($data4,array('fc_param' => 'WISATA', 'ID'=>'5'));
		$data5 = array('fc_kode' => $this->input->post('a5'));
		$this->Mdl_setup->update_wisata($data5,array('fc_param' => 'WISATA', 'ID'=>'7'));
	}

	public function update_wisata_en() {
		$data1 = array('fc_kode' => $this->input->post('a1'));
		$this->Mdl_setup->update_wisata_en($data1,array('fc_param' => 'WISATA', 'ID'=>'1'));
		$data2 = array('fc_kode' => $this->input->post('a2'));
		$this->Mdl_setup->update_wisata_en($data2,array('fc_param' => 'WISATA', 'ID'=>'2'));
		$data3 = array('fc_kode' => $this->input->post('a3'));
		$this->Mdl_setup->update_wisata_en($data3,array('fc_param' => 'WISATA', 'ID'=>'27'));
		$data4 = array('fc_kode' => $this->input->post('a4'));
		$this->Mdl_setup->update_wisata_en($data4,array('fc_param' => 'WISATA', 'ID'=>'5'));
		$data5 = array('fc_kode' => $this->input->post('a5'));
		$this->Mdl_setup->update_wisata_en($data5,array('fc_param' => 'WISATA', 'ID'=>'7'));
	}
	
	public function upload(){
		$gambar = $_FILES['file-upload']['name'];
		
		$config['upload_path'] = realpath('../assets/images/img/');
		$config['allowed_types']        = 'gif|jpg|png';
		$config['max_size'] = '2000000';
        $config['max_width'] = '2024';
        $config['max_height']= '1468';
		$config['file_name'] = $gambar;	
		
		$this->load->library('upload', $config);
 		$this->upload->initialize($config);
		$this->upload->do_upload('file-upload');	
			
		$data = array('fc_isi' => $gambar);
		if($this->session->userdata('current_language')=='english'){
			$this->Mdl_setup->update_data_en($data,array('fc_param' => 'HEADER','fc_kode' => '1'));	
		}else{
			$this->Mdl_setup->update_data($data,array('fc_param' => 'HEADER','fc_kode' => '1'));
		}		
		
		//print_r($this->db->last_query());
	}		

	public function upload_event(){
		$gambar = $_FILES['file-upload2']['name'];
		
		$config['upload_path'] = realpath('../assets/images/img/');
		$config['allowed_types']        = 'gif|jpg|png';
		$config['max_size'] = '2000000';
        $config['max_width'] = '2024';
        $config['max_height']= '1468';
		$config['file_name'] = $gambar;	
		
		$this->load->library('upload', $config);
 		$this->upload->initialize($config);
		$this->upload->do_upload('file-upload2');	
			
		$data = array('fc_isi' => $gambar);
		if($this->session->userdata('current_language')=='english'){
			$this->Mdl_setup->update_event_en($data,array('fc_param' => 'HEADER','fc_kode' => '2'));
		}else{
			$this->Mdl_setup->update_event($data,array('fc_param' => 'HEADER','fc_kode' => '2'));
		}		
		
		//print_r($this->db->last_query());
	}		
	
	public function upload_berita(){
		$gambar = $_FILES['file-upload3']['name'];
		
		$config['upload_path'] = realpath('../assets/images/img/');
		$config['allowed_types']        = 'gif|jpg|png';
		$config['max_size'] = '2000000';
        $config['max_width'] = '2024';
        $config['max_height']= '1468';
		$config['file_name'] = $gambar;	
		
		$this->load->library('upload', $config);
 		$this->upload->initialize($config);
		$this->upload->do_upload('file-upload3');	
			
		$data = array('fc_isi' => $gambar);
		if($this->session->userdata('current_language')=='english'){
			$this->Mdl_setup->update_berita_en($data,array('fc_param' => 'HEADER','fc_kode' => '3'));
		}else{
			$this->Mdl_setup->update_berita($data,array('fc_param' => 'HEADER','fc_kode' => '3'));
		}		
		
		//print_r($this->db->last_query());
	}
	
	public function upload_about(){
		$gambar = $_FILES['file-upload4']['name'];
		
		$config['upload_path'] = realpath('../assets/images/img/');
		$config['allowed_types']        = 'gif|jpg|png';
		$config['max_size'] = '2000000';
        $config['max_width'] = '2024';
        $config['max_height']= '1468';
		$config['file_name'] = $gambar;	
		
		$this->load->library('upload', $config);
 		$this->upload->initialize($config);
		$this->upload->do_upload('file-upload4');	
			
		$data = array('fc_isi' => $gambar);
		if($this->session->userdata('current_language')=='english'){
			$this->Mdl_setup->update_about_en($data,array('fc_param' => 'HEADER','fc_kode' => '4'));	
		}else{
			$this->Mdl_setup->update_about($data,array('fc_param' => 'HEADER','fc_kode' => '4'));
		}		
		
		//print_r($this->db->last_query());
	}
	
	public function upload_kontak(){
		$gambar = $_FILES['file-upload5']['name'];
		
		$config['upload_path'] = realpath('../assets/images/img/');
		$config['allowed_types']        = 'gif|jpg|png';
		$config['max_size'] = '2000000';
        $config['max_width'] = '2024';
        $config['max_height']= '1468';
		$config['file_name'] = $gambar;	
		
		$this->load->library('upload', $config);
 		$this->upload->initialize($config);
		$this->upload->do_upload('file-upload5');	
			
		$data = array('fc_isi' => $gambar);
		if($this->session->userdata('current_language')=='english'){
			$this->Mdl_setup->upload_kontak_en($data,array('fc_param' => 'HEADER','fc_kode' => '5'));	
		}else{
			$this->Mdl_setup->upload_kontak($data,array('fc_param' => 'HEADER','fc_kode' => '5'));
		}	
		
		//print_r($this->db->last_query());
	}
}	