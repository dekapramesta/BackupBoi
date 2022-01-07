<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kategori_produk extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->db2 = $this->load->database('pariwisata_en', TRUE);
		$this->load->model('Mdl_Kategori_produk');
		$this->auth->restrict();
		date_default_timezone_set("Asia/Jakarta");
		$this->load->library("session");
	}

	function index()
	{
		// $this->mdl_home->getsqurity();
		$data['view_file']    = "moduls/kategori_produk";

		$this->load->view('admin_view', $data);
	}

	public function ajax_list()
	{
		$list = $this->Mdl_Kategori_produk->get_datatables();
		$data = array();
		$no = $_REQUEST['start'];
		foreach ($list as $kat) {
			if ($kat->logo_kategori == '') {
				$cover = 'no_image.jpg';
			} else {
				$cover = $kat->logo_kategori;
			}
			$row2 = '<img src="' . base_url() . '../uploads/icon/' . $cover . '" style="height: 100%; width: 100%;">';
			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $kat->nama_kategori;
			$row[] = '
					  <a href="#modal-table' . $kat->id_kategori_produk. '" data-toggle="modal" class="tooltip-success" data-rel="tooltip" title="Lihat Gambar">
						<span class="green">
							<i class="ace-icon fa fa-eye bigger-120"></i>
						</span>
					  </a>
					  <div id="modal-table' . $kat->id_kategori_produk . '" class="modal fade" tabindex="-1">
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
                            <li><a href="javascript:void(0)" onclick="update(' . "'" . $kat->id_kategori_produk . "'" . ')">Edit</a></li>
                            <li><a href="javascript:void(0)" onclick="hapus(' . "'" . $kat->id_kategori_produk . "'" . ')">Delete</a></li>
							<li class="divider"></li>
							<li><a href="kategori_produk/' . $kat->id_kategori_produk . '/detail">Detail</a></li>
                        </ul>
            </div>';
			$data[] = $row;
		}

		$output = array(
			"draw" => $_REQUEST['draw'],
			"recordsTotal" => $this->Mdl_Kategori_produk->count_all(),
			"recordsFiltered" => $this->Mdl_Kategori_produk->count_filtered(),
			"data" => $data,
		);
		echo json_encode($output);
	}

	

	function ajax_add()
	{
		$olah = explode('.', $_FILES['userfile']['name']);
		$nama_file = $this->input->post('nama_kategori') . '.' . $olah[1];

		$judul = $this->input->post('nama_kategori');
		$gambar = str_replace(' ', '_', $nama_file);

		$config['upload_path'] = realpath('../uploads/icon');
		$config['allowed_types']        = 'gif|jpg|png';
		$config['max_size'] = '2000000';
		$config['max_width'] = '4024';
		$config['max_height'] = '2468';
		$config['file_name'] = $nama_file;

		$this->load->library('upload', $config);
		$this->upload->initialize($config);
		$this->upload->do_upload('userfile');

		if (empty($gambar)) {
			$data = array(
				'nama_kategori' => $judul
			);
		} else {
			//unlink('../assets/galeri/'.$this->input->post('terserah'));

			$data = array(
				'nama_kategori' => $judul,
				'logo_kategori' => $gambar
			);
		}
		if ($this->session->userdata('current_language') == 'english') {
			$this->Mdl_Kategori_produk->add_en($data);
		} else {
			$this->Mdl_Kategori_produk->add($data);
		}


		echo json_encode(array('status' => TRUE));
	}

	public function ajax_edit($id)
	{
		$data = $this->Mdl_Kategori_produk->get_by_id($id);
		echo json_encode($data);
	}

	public function ajax_edit_en($id)
	{
		$data = $this->Mdl_Kategori_produk->get_by_id_en($id);
		echo json_encode($data);
	}

	public function update()
	{
		$data = array(
			'nama_kategori' => $this->input->post('nama_kategori'),
		);

		if ($this->session->userdata('current_language') == 'english') {
			$this->Mdl_Kategori_produk->update_en(array('id_kategori_produk' => $this->input->post('id_kategori_produk')), $data);
		} else {
			$this->Mdl_Kategori_produk->update(array('id_kategori_produk' => $this->input->post('id_kategori_produk')), $data);
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
		$config['max_width'] = '4024';
		$config['max_height'] = '2468';
		$config['file_name'] = $gambar;

		$this->load->library('upload', $config);
		$this->upload->initialize($config);
		$this->upload->do_upload('file-upload');

		$data = array(
			'logo_kategori' => $gambar,
		);

		$where = array('id_kategori_produk' => $this->input->post('id_kategori_produk'));

		if ($this->session->userdata('current_language') == 'english') {
			$this->Mdl_Kategori_produk->update_data_en($where, $data, 'kategori_produk');
		} else {
			$this->Mdl_Kategori_produk->update_data($where, $data, 'kategori_produk');
		}

		echo json_encode(array('status' => TRUE));
	}

	public function ajax_delete($id)
	{
		if ($this->session->userdata('current_language') == 'english') {
			$this->Mdl_Kategori_produk->delete_by_id_en($id);
		} else {
			$this->Mdl_Kategori_produk->delete_by_id($id);
		}

		$this->Mdl_Kategori_produk->delete_by_id($id);
		echo json_encode(array("status" => TRUE));
	}

	function kategori_detail($key)
	{
		$row = $this->Mdl_Kategori_produk->get_by($key);
		if (!empty($row)) {
			$data = array(
				'id_kategori_produk' => $row->id_kategori_produk,
				'id_produk' => $row->id_produk
			);
			$data['view_file']  = "moduls/detail_produk";
			$data['produsen'] = $this->Mdl_Kategori_produk->produsen_produk()->result_array();
			$data['provinces'] = $this->Mdl_Kategori_produk->get_province()->result_array();
			$this->load->view('admin_view', $data);
		} else {
			$data['view_file']  = "moduls/detail_produk";
			$data['produsen'] = $this->Mdl_Kategori_produk->produsen_produk()->result_array();
			$data['provinces'] = $this->Model_Kategori_produk->get_province()->result_array();
			$this->load->view('admin_view', $data);
		}
	}

	
	function get_towns(){

        $province=$this->input->post('province');
        $data=$this->Model->get_towns_where($province);
        echo json_encode($data);
    }


	public function ajax_listid()
	{
		$kdKat = $this->uri->segment(3);
		$list = $this->Mdl_Kategori_produk->get_datatablesid($kdKat);
		//print_r($this->db->last_query());
		$data = array();
		$no = $_REQUEST['start'];
		foreach ($list as $det) {
			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $det->nama_produk;
			$row[] = $det->deskripsi_produk;
			$row[] = $det->nama_produsen;
			$row[] = $det->tag_produk;
			$row[] = $det->slug_produk;
			$row[] = '
			<div class="btn-group">
                        <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">Aksi <span class="caret"></span></button>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="javascript:void(0)" onclick="edite(' . "'" . $det->id_produk . "'" . ')">Edit</a></li>
                            <li><a href="javascript:void(0)" onclick="hapuse(' . "'" . $det->id_produk . "'" . ')">Delete</a></li>
							<li class="divider"></li>
							<li><a href="detail/' . $det->id_produk . '/foto">Foto</a></li>
                        </ul>
            </div>';
			$data[] = $row;
		}

		$output = array(
			"draw" => $_REQUEST['draw'],
			"recordsTotal" => $this->Mdl_Kategori_produk->count_allid($kdKat),
			"recordsFiltered" => $this->Mdl_Kategori_produk->count_filteredid($kdKat),
			"data" => $data,
		);
		echo json_encode($output);
	}

	// public function ajax_listid_en()
	// {
	// 	$kdKat = $this->uri->segment(3);
	// 	$list = $this->Mdl_Kategori->get_datatablesid_en($kdKat);
	// 	//print_r($this->db->last_query());
	// 	$data = array();
	// 	$no = $_REQUEST['start'];
	// 	foreach ($list as $det) {
	// 		$no++;
	// 		$row = array();
	// 		$row[] = $no;
	// 		$row[] = $det->wisata_nama;
	// 		$row[] = $det->wisata_deskripsi;
	// 		$row[] = $det->penulis_nama.' - '.$det->penulis_profesi;
	// 		$row[] = $det->wisata_tag;
	// 		$row[] = $det->wisata_latitude;
	// 		$row[] = $det->wisata_longitude;
	// 		$row[] = $det->wisata_htm_lokal;
	// 		$row[] = $det->wisata_htm_intl;
	// 		$row[] = '
	// 		<div class="btn-group">
    //                     <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">Aksi <span class="caret"></span></button>
    //                     <ul class="dropdown-menu" role="menu">
    //                         <li><a href="javascript:void(0)" onclick="edite(' . "'" . $det->wisata_id . "'" . ')">Edit</a></li>
    //                         <li><a href="javascript:void(0)" onclick="hapuse(' . "'" . $det->wisata_id . "'" . ')">Delete</a></li>
	// 						<li class="divider"></li>
	// 						<li><a href="detail/' . $det->wisata_id . '/foto">Foto</a></li>
	// 						<li><a href="detail/' . $det->wisata_id . '/fasilitas">Fasilitas</a></li>
	// 						<li><a href="detail/' . $det->wisata_id . '/pendukung">Pendukung</a></li>
	// 						<li><a href="detail/' . $det->wisata_id . '/wahana">Wahana</a></li>
    //                     </ul>
    //         </div>';
	// 		$data[] = $row;
	// 	}

	// 	$output = array(
	// 		"draw" => $_REQUEST['draw'],
	// 		"recordsTotal" => $this->Mdl_Kategori->count_allid_en($kdKat),
	// 		"recordsFiltered" => $this->Mdl_Kategori->count_filteredid_en($kdKat),
	// 		"data" => $data,
	// 	);
	// 	echo json_encode($output);
	// }

	// public function fasilitas_wisata($id1)
	// {
	// 	$row = $this->Mdl_Kategori_->get_by_det($id1);
	// 	if (!empty($row)) {
	// 		$data = array(
	// 			'wisata_id' => $row->wisata_id
	// 		);

	// 		$data['view_file']  = "moduls/wisata_berfasilitas";
	// 		$this->load->view('admin_view', $data);
	// 	} else {
	// 		$data['view_file']  = "moduls/wisata_berfasilitas";
	// 		$this->load->view('admin_view', $data);
	// 	}
	// }

	// public function wahana_wisata($id1)
	// {
	// 	$row = $this->Mdl_Kategori->get_by_wah($id1);

	// 	if (!empty($row)) {
	// 		$data = array(
	// 			'wisata_id' => $row->wisata_id
	// 		);
	// 		$data['view_file']  = "moduls/wisata_wahana";
	// 		$this->load->view('admin_view', $data);
	// 	} else {
	// 		$data['view_file']  = "moduls/wisata_wahana";
	// 		$this->load->view('admin_view', $data);
	// 	}
	// }

	public function produk_foto($id1)
	{
		$row = $this->Mdl_Kategori_produk->get_by_foto($id1);

		if (!empty($row)) {
			$data = array(
				'id_produk' => $row->id_produk 
			);
			$data['view_file']  = "moduls/produk_foto";
			$this->load->view('admin_view', $data);
		} else {
			$data['view_file']  = "moduls/produk_foto";
			$this->load->view('admin_view', $data);
		}
	}

	// public function fasilitas_pendukung($id1)
	// {
	// 	$row = $this->Mdl_Kategori->get_by_pend($id1);

	// 	if (!empty($row)) {
	// 		$data = array(
	// 			'wisata_id' => $row->wisata_id
	// 		);
	// 		$data['view_file']  = "moduls/wisata_berpendukung";
	// 		$this->load->view('admin_view', $data);
	// 	} else {
	// 		$data['view_file']  = "moduls/wisata_berpendukung";
	// 		$this->load->view('admin_view', $data);
	// 	}
	// }

	public function ajax_adddet()
	{
		$data = array(
			'id_kategori_produk'       		 => $this->input->post('id_kategori_produk'),
			'nama_produk'       		 => $this->input->post('nama_produk'),
			'deskripsi_produk'         => $this->input->post('deskripsi_produk'),
			'tag_produk'       		 => $this->input->post('tag_produk'),
			'slug_produk'       		 => $this->input->post('slug_produk'),
			'id_produsen'       		 => $this->input->post('id_produsen'),
			'nama_provinsi' => $this->input->post('provinsiprd'),
			'nama_kota' => $this->input->post('cityprd')
		);

		if ($this->session->userdata('current_language') == 'english') {
			$insert = $this->Mdl_Kategori_produk->add_detail_en($data);
		} else {
			$insert = $this->Mdl_Kategori_produk->add_detail($data);
		}
		echo json_encode(array('status' => TRUE));
	}

	public function ajax_editdet($id)
	{
		$data = $this->Mdl_Kategori_produk->get_by_detail($id);
		echo json_encode($data);
	}

	// public function ajax_editdet_en($id)
	// {
	// 	$data = $this->Mdl_Kategori->get_by_detail_en($id);
	// 	echo json_encode($data);
	// }

	public function ajax_updatedet()
	{
		$data = array(
			'nama_produk'       		 => $this->input->post('nama_produk'),
			'deskripsi_produk'         => $this->input->post('deskripsi_produk'),
			'tag_produk'       		 => $this->input->post('tag_produk'),
			'slug_produk'       		 => $this->input->post('slug_produk'),
			'id_produsen'       		 => $this->input->post('id_produsen'),
			'nama_provinsi'       		 => $this->input->post('provinsiprd'),
			'nama_kota'       		 => $this->input->post('cityprd')
		);
		if ($this->session->userdata('current_language') == 'english') {
			$this->Mdl_Kategori_produk->update_detail_en(array('id_produk' => $this->input->post('id_produk')), $data);
		} else {
			$this->Mdl_Kategori_produk->update_detail(array('id_produk' => $this->input->post('id_produk')), $data);
		}

		echo json_encode(array("status" => TRUE));
	}

	public function ajax_delete_det($id)
	{
		if ($this->session->userdata('current_language') == 'english') {
			$this->Mdl_Kategori_produk->delete_by_det_en($id);
		} else {
			$this->Mdl_Kategori_produk->delete_by_det($id);
		}

		echo json_encode(array("status" => TRUE));
	}
	public function getCity()
	{
		if ($this->input->post('nama_provinsi') != null) {
			$provinsi = $this->input->post('nama_provinsi');
			$city = $this->Mdl_Kategori_produk->get_city_produk($provinsi)->result_array();
			$drop = '<option disabled selected>Pilih Kota</option>';
			foreach ($city as $ct) {
				$drop = $drop . '<option value="' . $ct['nama_kota_kabupaten'] . '">' . $ct['nama_kota_kabupaten'] . '</option>';
			}
			echo $drop;
		}

		// var_dump($filterCity);

	}
}
