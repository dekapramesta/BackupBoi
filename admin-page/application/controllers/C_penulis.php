<?php
defined('BASEPATH') or exit('No direct script access allowed');

class C_penulis extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Mdl_penulis');
		$this->auth->restrict();
		date_default_timezone_set("Asia/Jakarta");
		$this->load->library("session");
	}

	function index()
	{
		// $this->mdl_home->getsqurity();
		$data['view_file']    = "moduls/penulis";
		$this->load->view('admin_view', $data);
	}

	public function ajax_list()
	{
		$list = $this->Mdl_penulis->get_datatables();
		$data = array();
		$no = $_REQUEST['start'];
		foreach ($list as $penulis) {
			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $penulis->penulis_nama;
			$row[] = $penulis->penulis_profesi;
			$row[] = $penulis->penulis_tahun_bergabung;
			$row[] = $penulis->penulis_deskripsi;
			$row[] = '<div class="btn-group">
                        <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">Aksi <span class="caret"></span></button>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="javascript:void(0)" onclick="update(' . "'" . $penulis->penulis_id . "'" . ')">Edit</a></li>
                            <li><a href="javascript:void(0)" onclick="hapus(' . "'" . $penulis->penulis_id . "'" . ')">Delete</a></li>
                        </ul>
            </div>';
			$data[] = $row;
		}

		$output = array(
			"draw" => $_REQUEST['draw'],
			"recordsTotal" => $this->Mdl_penulis->count_all(),
			"recordsFiltered" => $this->Mdl_penulis->count_filtered(),
			"data" => $data,
		);
		echo json_encode($output);
	}

	public function ajax_list_en()
	{
		$list = $this->Mdl_penulis->get_datatables_en();
		$data = array();
		$no = $_REQUEST['start'];
		foreach ($list as $penulis) {
			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $penulis->penulis_nama;
			$row[] = $penulis->penulis_profesi;
			$row[] = $penulis->penulis_tahun_bergabung;
			$row[] = $penulis->penulis_deskripsi;
			$row[] = '<div class="btn-group">
                        <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">Aksi <span class="caret"></span></button>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="javascript:void(0)" onclick="update(' . "'" . $penulis->penulis_id . "'" . ')">Edit</a></li>
                            <li><a href="javascript:void(0)" onclick="hapus(' . "'" . $penulis->penulis_id . "'" . ')">Delete</a></li>
                        </ul>
            </div>';
			$data[] = $row;
		}

		$output = array(
			"draw" => $_REQUEST['draw'],
			"recordsTotal" => $this->Mdl_penulis->count_all_en(),
			"recordsFiltered" => $this->Mdl_penulis->count_filtered_en(),
			"data" => $data,
		);
		echo json_encode($output);
	}

	function ajax_add()
	{
		$penulis_nama = $this->input->post('penulis_nama');
		$penulis_profesi = $this->input->post('penulis_profesi');
		$penulis_deskripsi = $this->input->post('penulis_deskripsi');
		$data = array(
			'penulis_nama' => $penulis_nama,
			'penulis_profesi' => $penulis_profesi,
			'penulis_deskripsi' => $penulis_deskripsi,
			'penulis_tahun_bergabung' => date('Y-m-d'),
		);

		if ($this->session->userdata('current_language') == 'english') {
			$this->Mdl_penulis->add_en($data);
		} else {
			$this->Mdl_penulis->add($data);
		}

		echo json_encode(array('status' => TRUE));
	}

	public function ajax_edit($id)
	{
		$data = $this->Mdl_penulis->get_by_id($id);
		echo json_encode($data);
	}

	public function ajax_edit_en($id)
	{
		$data = $this->Mdl_penulis->get_by_id_en($id);
		echo json_encode($data);
	}

	public function update()
	{
		$data = array(
			'penulis_nama' => $this->input->post('penulis_nama'),
			'penulis_profesi' => $this->input->post('penulis_profesi'),
			'penulis_deskripsi' => $this->input->post('penulis_deskripsi'),
		);

		if ($this->session->userdata('current_language') == 'english') {
			$this->Mdl_penulis->update_en(array('penulis_id' => $this->input->post('penulis_id')), $data);
		} else {
			$this->Mdl_penulis->update(array('penulis_id' => $this->input->post('penulis_id')), $data);
		}

		echo json_encode(array("status" => TRUE));
	}

	// public function upload() {
	//     //if(!$modul){$this->session->set_userdata('err_msg', 'Anda Harus pilih salah satu Modul.'); redirect('admin');}
	// 	$gambar = $_FILES['file-upload']['name'];
	// 	//$nama_file = $this->input->post('slider_penulis_nama').'.'.$olah[1];

	// 	$nama = $this->input->post('penulis_nama');
	// 	$penulis_profesi = $this->input->post('slider_penulis_profesi');
	// 	//$gambar = str_replace(' ', '_', $nama_file);

	// 	$config['upload_path'] = realpath('../uploads/penulis');
	// 	$config['allowed_types']        = 'gif|jpg|png';
	// 	$config['max_size'] = '2000000';
	//     $config['max_width'] = '2024';
	//     $config['max_height']= '1468';
	// 	$config['file_name'] = $gambar;	

	// 	$this->load->library('upload', $config);
	// 	$this->upload->initialize($config);
	// 	$this->upload->do_upload('file-upload');

	// 		$data = array(
	// 		); 			



	// 	$where = array('penulis_id' => $this->input->post('penulis_id'));	

	// 	if ($this->session->userdata('current_language')=='english'){
	// 		$this->Mdl_penulis->update_data_en($where,$data,'penulis');	
	// 	}else{
	// 		$this->Mdl_penulis->update_data($where,$data,'penulis');	
	// 	}

	// 	echo json_encode(array('status' => TRUE));
	// }

	public function ajax_delete($id)
	{
		if ($this->session->userdata('current_language') == 'english') {
			$this->Mdl_penulis->delete_by_id_en($id);
		} else {
			$this->Mdl_penulis->delete_by_id($id);
		}

		echo json_encode(array("status" => TRUE));
	}
}
