<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kategori extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->db2 = $this->load->database('pariwisata_en', TRUE);
		$this->load->model('Mdl_Kategori');
		$this->auth->restrict();
		date_default_timezone_set("Asia/Jakarta");
		$this->load->library("session");
	}

	function index()
	{
		// $this->mdl_home->getsqurity();
		$data['view_file']    = "moduls/kategori";

		$this->load->view('admin_view', $data);
	}

	public function ajax_list()
	{
		$list = $this->Mdl_Kategori->get_datatables();
		$data = array();
		$no = $_REQUEST['start'];
		foreach ($list as $kat) {
			if ($kat->kategori_icon == '') {
				$cover = 'no_image.jpg';
			} else {
				$cover = $kat->kategori_icon;
			}
			$row2 = '<img src="' . base_url() . '../uploads/icon/' . $cover . '" style="height: 100%; width: 100%;">';
			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $kat->kategori_nama;
			$row[] = '
					  <a href="#modal-table' . $kat->kategori_id . '" data-toggle="modal" class="tooltip-success" data-rel="tooltip" title="Lihat Gambar">
						<span class="green">
							<i class="ace-icon fa fa-eye bigger-120"></i>
						</span>
					  </a>
					  <div id="modal-table' . $kat->kategori_id . '" class="modal fade" tabindex="-1">
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
									' . $row2 . '
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
                            <li><a href="javascript:void(0)" onclick="update(' . "'" . $kat->kategori_id . "'" . ')">Edit</a></li>
                            <li><a href="javascript:void(0)" onclick="hapus(' . "'" . $kat->kategori_id . "'" . ')">Delete</a></li>
							<li class="divider"></li>
							<li><a href="kategori/' . $kat->kategori_id . '/detail">Detail</a></li>
                        </ul>
            </div>';
			$data[] = $row;
		}

		$output = array(
			"draw" => $_REQUEST['draw'],
			"recordsTotal" => $this->Mdl_Kategori->count_all(),
			"recordsFiltered" => $this->Mdl_Kategori->count_filtered(),
			"data" => $data,
		);
		echo json_encode($output);
	}

	public function ajax_list_en()
	{
		$list = $this->Mdl_Kategori->get_datatables_en();
		$data = array();
		$no = $_REQUEST['start'];
		foreach ($list as $kat) {
			if ($kat->kategori_icon == '') {
				$cover = 'no_image.jpg';
			} else {
				$cover = $kat->kategori_icon;
			}
			$row2 = '<img src="' . base_url() . '../uploads/icon/' . $cover . '" style="height: 100%; width: 100%;">';
			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $kat->kategori_nama;
			$row[] = '
					  <a href="#modal-table' . $kat->kategori_id . '" data-toggle="modal" class="tooltip-success" data-rel="tooltip" title="Lihat Gambar">
						<span class="green">
							<i class="ace-icon fa fa-eye bigger-120"></i>
						</span>
					  </a>
					  <div id="modal-table' . $kat->kategori_id . '" class="modal fade" tabindex="-1">
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
									' . $row2 . '
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
                            <li><a href="javascript:void(0)" onclick="update(' . "'" . $kat->kategori_id . "'" . ')">Edit</a></li>
                            <li><a href="javascript:void(0)" onclick="hapus(' . "'" . $kat->kategori_id . "'" . ')">Delete</a></li>
							<li class="divider"></li>
							<li><a href="kategori/' . $kat->kategori_id . '/detail">Detail</a></li>
                        </ul>
            </div>';
			$data[] = $row;
		}

		$output = array(
			"draw" => $_REQUEST['draw'],
			"recordsTotal" => $this->Mdl_Kategori->count_all_en(),
			"recordsFiltered" => $this->Mdl_Kategori->count_filtered_en(),
			"data" => $data,
		);
		echo json_encode($output);
	}

	function ajax_add()
	{
		$olah = explode('.', $_FILES['userfile']['name']);
		$nama_file = $this->input->post('kategori_nama') . '.' . $olah[1];

		$judul = $this->input->post('kategori_nama');
		$gambar = str_replace(' ', '_', $nama_file);

		$config['upload_path'] = realpath('../uploads/icon');
		$config['allowed_types']        = 'gif|jpg|png';
		$config['max_size'] = '2000000';
		$config['max_width'] = '2024';
		$config['max_height'] = '1468';
		$config['file_name'] = $nama_file;

		$this->load->library('upload', $config);
		$this->upload->initialize($config);
		$this->upload->do_upload('userfile');

		if (empty($gambar)) {
			$data = array(
				'kategori_nama' => $judul
			);
		} else {
			//unlink('../assets/galeri/'.$this->input->post('terserah'));

			$data = array(
				'kategori_nama' => $judul,
				'kategori_icon' => $gambar
			);
		}
		if ($this->session->userdata('current_language') == 'english') {
			$this->Mdl_Kategori->add_en($data);
		} else {
			$this->Mdl_Kategori->add($data);
		}


		echo json_encode(array('status' => TRUE));
	}

	public function ajax_edit($id)
	{
		$data = $this->Mdl_Kategori->get_by_id($id);
		echo json_encode($data);
	}

	public function ajax_edit_en($id)
	{
		$data = $this->Mdl_Kategori->get_by_id_en($id);
		echo json_encode($data);
	}

	public function update()
	{
		$data = array(
			'kategori_nama' => $this->input->post('kategori_nama'),
		);

		if ($this->session->userdata('current_language') == 'english') {
			$this->Mdl_Kategori->update_en(array('kategori_id' => $this->input->post('kategori_id')), $data);
		} else {
			$this->Mdl_Kategori->update(array('kategori_id' => $this->input->post('kategori_id')), $data);
		}

		echo json_encode(array("status" => TRUE));
	}

	public function upload()
	{
		//if(!$modul){$this->session->set_userdata('err_msg', 'Anda Harus pilih salah satu Modul.'); redirect('admin');}
		$gambar = $_FILES['file-upload']['name'];
		//$gambar = str_replace(' ', '_', $nama_file);

		$config['upload_path'] = realpath('../uploads/icon');
		$config['allowed_types']        = 'gif|jpg|png';
		$config['max_size'] = '2000000';
		$config['max_width'] = '2024';
		$config['max_height'] = '1468';
		$config['file_name'] = $gambar;

		$this->load->library('upload', $config);
		$this->upload->initialize($config);
		$this->upload->do_upload('file-upload');

		$data = array(
			'kategori_icon' => $gambar,
		);

		$where = array('kategori_id' => $this->input->post('kategori_id'));

		if ($this->session->userdata('current_language') == 'english') {
			$this->Mdl_Kategori->update_data_en($where, $data, 'kategori');
		} else {
			$this->Mdl_Kategori->update_data($where, $data, 'kategori');
		}

		echo json_encode(array('status' => TRUE));
	}

	public function ajax_delete($id)
	{
		if ($this->session->userdata('current_language') == 'english') {
			$this->Mdl_Kategori->delete_by_id_en($id);
		} else {
			$this->Mdl_Kategori->delete_by_id($id);
		}

		$this->Mdl_Kategori->delete_by_id($id);
		echo json_encode(array("status" => TRUE));
	}

	function kategori_detail($key)
	{
		$row = $this->Mdl_Kategori->get_by($key);
		if (!empty($row)) {
			$data = array(
				'kategori_id' => $row->kategori_id,
				'wisata_id' => $row->wisata_id
			);
			$data['view_file']  = "moduls/detail_wisata";
			$data['penulis_wisata'] = $this->Mdl_Kategori->penulis_wisata()->result_array();
			$data['penulis_wisata_en'] = $this->Mdl_Kategori->penulis_wisata_en()->result_array();
			$this->load->view('admin_view', $data);
		} else {
			$data['view_file']  = "moduls/detail_wisata";
			$data['penulis_wisata'] = $this->Mdl_Kategori->penulis_wisata()->result_array();
			$data['penulis_wisata_en'] = $this->Mdl_Kategori->penulis_wisata_en()->result_array();
			$this->load->view('admin_view', $data);
		}
	}

	public function ajax_listid()
	{
		$kdKat = $this->uri->segment(3);
		$list = $this->Mdl_Kategori->get_datatablesid($kdKat);
		//print_r($this->db->last_query());
		$data = array();
		$no = $_REQUEST['start'];
		foreach ($list as $det) {
			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $det->wisata_nama;
			$row[] = $det->wisata_deskripsi;
			$row[] = $det->penulis_nama.' - '.$det->penulis_profesi;
			$row[] = $det->wisata_tag;
			$row[] = $det->wisata_latitude;
			$row[] = $det->wisata_longitude;
			$row[] = $det->wisata_htm_lokal;
			$row[] = $det->wisata_htm_intl;
			$row[] = '
			<div class="btn-group">
                        <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">Aksi <span class="caret"></span></button>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="javascript:void(0)" onclick="edite(' . "'" . $det->wisata_id . "'" . ')">Edit</a></li>
                            <li><a href="javascript:void(0)" onclick="hapuse(' . "'" . $det->wisata_id . "'" . ')">Delete</a></li>
							<li class="divider"></li>
							<li><a href="detail/' . $det->wisata_id . '/foto">Foto</a></li>
							<li><a href="detail/' . $det->wisata_id . '/fasilitas">Fasilitas</a></li>
							<li><a href="detail/' . $det->wisata_id . '/pendukung">Pendukung</a></li>
							<li><a href="detail/' . $det->wisata_id . '/wahana">Wahana</a></li>
                        </ul>
            </div>';
			$data[] = $row;
		}

		$output = array(
			"draw" => $_REQUEST['draw'],
			"recordsTotal" => $this->Mdl_Kategori->count_allid($kdKat),
			"recordsFiltered" => $this->Mdl_Kategori->count_filteredid($kdKat),
			"data" => $data,
		);
		echo json_encode($output);
	}

	public function ajax_listid_en()
	{
		$kdKat = $this->uri->segment(3);
		$list = $this->Mdl_Kategori->get_datatablesid_en($kdKat);
		//print_r($this->db->last_query());
		$data = array();
		$no = $_REQUEST['start'];
		foreach ($list as $det) {
			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $det->wisata_nama;
			$row[] = $det->wisata_deskripsi;
			$row[] = $det->penulis_nama.' - '.$det->penulis_profesi;
			$row[] = $det->wisata_tag;
			$row[] = $det->wisata_latitude;
			$row[] = $det->wisata_longitude;
			$row[] = $det->wisata_htm_lokal;
			$row[] = $det->wisata_htm_intl;
			$row[] = '
			<div class="btn-group">
                        <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">Aksi <span class="caret"></span></button>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="javascript:void(0)" onclick="edite(' . "'" . $det->wisata_id . "'" . ')">Edit</a></li>
                            <li><a href="javascript:void(0)" onclick="hapuse(' . "'" . $det->wisata_id . "'" . ')">Delete</a></li>
							<li class="divider"></li>
							<li><a href="detail/' . $det->wisata_id . '/foto">Foto</a></li>
							<li><a href="detail/' . $det->wisata_id . '/fasilitas">Fasilitas</a></li>
							<li><a href="detail/' . $det->wisata_id . '/pendukung">Pendukung</a></li>
							<li><a href="detail/' . $det->wisata_id . '/wahana">Wahana</a></li>
                        </ul>
            </div>';
			$data[] = $row;
		}

		$output = array(
			"draw" => $_REQUEST['draw'],
			"recordsTotal" => $this->Mdl_Kategori->count_allid_en($kdKat),
			"recordsFiltered" => $this->Mdl_Kategori->count_filteredid_en($kdKat),
			"data" => $data,
		);
		echo json_encode($output);
	}

	public function fasilitas_wisata($id1)
	{
		$row = $this->Mdl_Kategori->get_by_det($id1);
		if (!empty($row)) {
			$data = array(
				'wisata_id' => $row->wisata_id
			);

			$data['view_file']  = "moduls/wisata_berfasilitas";
			$this->load->view('admin_view', $data);
		} else {
			$data['view_file']  = "moduls/wisata_berfasilitas";
			$this->load->view('admin_view', $data);
		}
	}

	public function wahana_wisata($id1)
	{
		$row = $this->Mdl_Kategori->get_by_wah($id1);

		if (!empty($row)) {
			$data = array(
				'wisata_id' => $row->wisata_id
			);
			$data['view_file']  = "moduls/wisata_wahana";
			$this->load->view('admin_view', $data);
		} else {
			$data['view_file']  = "moduls/wisata_wahana";
			$this->load->view('admin_view', $data);
		}
	}

	public function wisata_foto($id1)
	{
		$row = $this->Mdl_Kategori->get_by_foto($id1);

		if (!empty($row)) {
			$data = array(
				'wisata_id' => $row->wisata_id
			);
			$data['view_file']  = "moduls/wisata_foto";
			$this->load->view('admin_view', $data);
		} else {
			$data['view_file']  = "moduls/wisata_foto";
			$this->load->view('admin_view', $data);
		}
	}

	public function fasilitas_pendukung($id1)
	{
		$row = $this->Mdl_Kategori->get_by_pend($id1);

		if (!empty($row)) {
			$data = array(
				'wisata_id' => $row->wisata_id
			);
			$data['view_file']  = "moduls/wisata_berpendukung";
			$this->load->view('admin_view', $data);
		} else {
			$data['view_file']  = "moduls/wisata_berpendukung";
			$this->load->view('admin_view', $data);
		}
	}

	public function ajax_adddet()
	{
		$data = array(
			'kategori_id'         => $this->input->post('kategori_id'),
			'wisata_url_video'       		 => $this->input->post('wisata_url_video'),
			'wisata_nama'       		 => $this->input->post('wisata_nama'),
			'wisata_deskripsi'         => $this->input->post('wisata_deskripsi'),
			'penulis_id'       		 => $this->input->post('penulis_id'),
			'wisata_tag'       		 => $this->input->post('wisata_tag'),
			'wisata_htm_lokal'       		 => $this->input->post('wisata_htm_lokal'),
			'wisata_htm_intl'         => $this->input->post('wisata_htm_intl'),
			'wisata_latitude'       		 => $this->input->post('wisata_latitude'),
			'wisata_longitude'       		 => $this->input->post('wisata_longitude'),
		);

		if ($this->session->userdata('current_language') == 'english') {
			$insert = $this->Mdl_Kategori->add_detail_en($data);
		} else {
			$insert = $this->Mdl_Kategori->add_detail($data);
		}
		echo json_encode(array('status' => TRUE));
	}

	public function ajax_editdet($id)
	{
		$data = $this->Mdl_Kategori->get_by_detail($id);
		echo json_encode($data);
	}

	public function ajax_editdet_en($id)
	{
		$data = $this->Mdl_Kategori->get_by_detail_en($id);
		echo json_encode($data);
	}

	public function ajax_updatedet()
	{
		$data = array(
			'wisata_url_video'       		 => $this->input->post('wisata_url_video'),
			'wisata_nama'       		 => $this->input->post('wisata_nama'),
			'wisata_deskripsi'         => $this->input->post('wisata_deskripsi'),
			'penulis_id'       		 => $this->input->post('penulis_id'),
			'wisata_tag'       		 => $this->input->post('wisata_tag'),
			'wisata_htm_lokal'       		 => $this->input->post('wisata_htm_lokal'),
			'wisata_htm_intl'         => $this->input->post('wisata_htm_intl'),
			'wisata_latitude'       		 => $this->input->post('wisata_latitude'),
			'wisata_longitude'       		 => $this->input->post('wisata_longitude'),
		);
		if ($this->session->userdata('current_language') == 'english') {
			$this->Mdl_Kategori->update_detail_en(array('wisata_id' => $this->input->post('wisata_id')), $data);
		} else {
			$this->Mdl_Kategori->update_detail(array('wisata_id' => $this->input->post('wisata_id')), $data);
		}

		echo json_encode(array("status" => TRUE));
	}

	public function ajax_delete_det($id)
	{
		if ($this->session->userdata('current_language') == 'english') {
			$this->Mdl_Kategori->delete_by_det_en($id);
		} else {
			$this->Mdl_Kategori->delete_by_det($id);
		}

		echo json_encode(array("status" => TRUE));
	}
}
