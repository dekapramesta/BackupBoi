<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Wisata extends CI_Controller
{

	private $db2;

	public function __construct()
	{
		parent::__construct();
		$this->db2 = $this->load->database('pariwisata_en', TRUE);
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->model('Model');
		$this->output->set_header('Last-Modified: ' . gmdate("D, d M Y H:i:s") . ' GMT');

		$this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');

		$this->output->set_header('Pragma: no-cache');

		$this->output->set_header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
		date_default_timezone_set("Asia/Jakarta");
	}

	function index($id = null)
	{
		// var_dump($id);die;
		$data_header['menu_kategori'] = $this->Model->menu_kategori()->result_array();
		$data_header['menu_produk'] = $this->Model->menu_produk()->result_array();
		$this->load->view('headerwisata', $data_header);

		$total_data = $this->Model->get_all()->num_rows();
		$data['total_data'] = ceil($total_data / 8);
		$data['provinces'] = $this->Model->get_province()->result_array();
		$data['jenis'] = null;
		$data['wisata_en'] = $this->Model->tampil_en(null)->result_array();

		$config = array();
		$config['base_url'] = site_url("Tempat-Wisata");
		$config['total_rows'] = $total_data;
		$config['per_page'] = "12";
		$config["uri_segment"] = 2;
		$choice = $config["total_rows"] / $config["per_page"];
		$config["num_links"] = floor($choice);
		$config['next_page'] = '&laquo;';
		$config['full_tag_open'] = '<div class="page__pagination">';
		$config['full_tag_close'] = '</div>';
		$config['first_link']    = 'First';
		$config['last_link']    = 'Last';
		$config['next_link']	= 'Next';
		$config['prev_link']	= 'Prev';
		$config['cur_tag_open']  = '<span class="current"></a>';
		$config['cur_tag_close']  = '</a></span>';
		$config['prev_page'] = '&raquo;';

		$this->pagination->initialize($config);

		$data['page'] = ($this->uri->segment(2)) ? $this->uri->segment(2) : 0;
		// $data['wisata']= $this->Model->get_wisata_all($config['per_page'], $data['page']);
		$data['wisata'] = $this->Model->tampilwisata(null, null, $config['per_page'], $data['page'])->result_array();
		// var_dump($data['page']);die;
		$data['halaman'] = $this->pagination->create_links();

		// var_dump($data['wisata']);die;

		$this->load->view("vw_list_wisata", $data);

		$data_footer['menu_kategori'] = $this->Model->menu_kategori()->result_array();
		$data_footer['wahana']	= $this->Model->menu_wahana()->result_array();

		$this->db->where('fc_kode', '1');
		$this->db->where('fc_param', 'FACEBOOK');
		$data_footer['facebook_icon'] = $this->db->get('t_setup')->row();

		$this->db->where('fc_kode', '1');
		$this->db->where('fc_param', 'TWITTER');
		$data_footer['twitter_icon'] = $this->db->get('t_setup')->row();

		$this->db->where('fc_kode', '1');
		$this->db->where('fc_param', 'INSTAGRAM');
		$data_footer['instagram_icon'] = $this->db->get('t_setup')->row();

		$this->db->where('fc_kode', '1');
		$this->db->where('fc_param', 'YOUTUBE');
		$data_footer['youtube_icon'] = $this->db->get('t_setup')->row();

		$this->db->where('fc_kode', '1');
		$this->db->where('fc_param', 'SEKILAS');
		$data_footer['sekilas_icon'] = $this->db->get('t_setup')->row();

		$this->db2->where('fc_kode', '1');
		$this->db2->where('fc_param', 'SEKILAS');
		$data_footer['sekilas_icon_en'] = $this->db2->get('t_setup')->row();
		$data_footer['kategori'] = "Semua-Kategori";

		$this->load->view('footer_wisata', $data_footer);
	}

	public function load_wisata($jenis = null)
	{
		$offset = ceil($this->input->post('offset') * 8);
		if (empty($jenis)) {
			if ($this->session->userdata('current_language') == 'english') {
				$data['wisata'] = $this->Model->get_all_wisata_en(8, 0);
			} else {
				$data['wisata'] = $this->Model->get_all_wisata(8, 0);
			}
		} else {
			if ($this->session->userdata('current_language') == 'english') {
				$data['wisata'] = $this->Model->get_all_wisata_whe_en(8, 0, $jenis);
			} else {
				$data['wisata'] = $this->Model->get_all_wisata_whe(8, 0, $jenis);
			}
		}
		$this->load->view('load_wisata', $data);
	}

	function get_town()
	{


		if ($this->input->post('province') != null) {
			$province = $this->input->post('province');
			$towns = $this->Model->get_town_where($province)->result_array();
		}

		if ($this->input->post('towns') != null) {
			$filterTown = $this->input->post('towns');
			$filterTown = str_replace("-", " ", $filterTown);
			$html = '<option disabled selected>Pilih Kota</option>';
			foreach ($towns as $town) {
				$html = $html . '<option value="' . $town['nama_kota_kabupaten'] . '" ' . ($town['nama_kota_kabupaten'] == $filterTown ? 'selected' : '') . ' >' . $town['nama_kota_kabupaten'] . '</option>';
			}
		} else {
			$html = '<option disabled selected>Pilih Kota</option>';
			foreach ($towns as $town) {
				$html = $html . '<option value="' . $town['nama_kota_kabupaten'] . '">' . $town['nama_kota_kabupaten'] . '</option>';
			}
		}

		// var_dump($towns);die;
		echo $html;
	}

	function wisata($id = null)
	{
		$id = $this->uri->segment(2);
		$data_header['menu_kategori'] = $this->Model->menu_kategori()->result_array();
		$data_header['kategori'] = $this->uri->segment(2);
		$filterProvinceOri = $this->uri->segment(3);
		$filterProvince = str_replace("-", " ", $filterProvinceOri);
		@$filterProvinceCheck = $filterProvince . null;
		if ($filterProvinceCheck != null) {
			@$filterProvince . null;
		}

		$filterTownOri = $this->uri->segment(4);
		if (is_numeric($this->uri->segment(4))) {
			$filterTown = (int) $this->uri->segment(4);
		} elseif (is_string($this->uri->segment(4))) {
			$filterTown = str_replace("-", " ", $filterTownOri);
		}

		// var_dump($filterTown);die;
		// $data['wisata_nama']= $this->Model->tampil($id)->row();
		$data['provinces'] = $this->Model->get_province()->result_array();
		$data['wisata_en'] = $this->Model->tampil_en($id)->result_array();
		$data['filterProvince'] = $filterProvince;

		// $config = array();

		// $config['per_page'] = "12";

		// $config['next_page'] = '&laquo;';
		// $config['full_tag_open'] = '<div class="page__pagination">';
		// $config['full_tag_close'] = '</div>';
		// $config['first_link']    = 'First';
		// $config['last_link']    = 'Last';
		// $config['next_link']	= 'Next';
		// $config['prev_link']	= 'Prev';
		// $config['cur_tag_open']  = '<span class="current"></a>';
		// $config['cur_tag_close']  = '</a></span>';
		// $config['prev_page'] = '&raquo;';

		if ($this->uri->segment(4) != null) {
			if (is_string($filterTown)) {
				$data['page'] = ($this->uri->segment(5)) ? $this->uri->segment(5) : 0;
				$config["uri_segment"] = 5;
				$config['base_url'] = site_url("Tempat-Wisata") . "/" . $data_header['kategori'] . "/" . $filterProvinceOri . "/" . $filterTownOri;
				if ($data_header['kategori'] == "Semua-Kategori") {
					$config = array();

					$config['per_page'] = "5";

					$config['next_page'] = '&laquo;';
					$config['full_tag_open'] = '<div class="page__pagination">';
					$config['full_tag_close'] = '</div>';
					$config['first_link']    = 'First';
					$config['last_link']    = 'Last';
					$config['next_link']	= 'Next';
					$config['prev_link']	= 'Prev';
					$config['cur_tag_open']  = '<span class="current"></a>';
					$config['cur_tag_close']  = '</a></span>';
					$config['prev_page'] = '&raquo;';
					$config['base_url'] = site_url("Tempat-Wisata") . "/" . $data_header['kategori'] . "/" . $filterProvinceOri . "/" . $filterTownOri;
					$config["uri_segment"] = 5;
					$config['total_rows'] = $this->Model->filter_city($filterTown, null, null, null)->num_rows();
					$choice = $config["total_rows"] / $config["per_page"];
					$data['page'] = ($this->uri->segment(5)) ? $this->uri->segment(5) : 0;

					$config["num_links"] = floor($choice);
					$this->pagination->initialize($config);
					$data['wisata'] = $this->Model->filter_city($filterTown, null, $config['per_page'], $data['page'])->result_array();
					$data['halaman'] = $this->pagination->create_links();
					// var_dump($config['total_rows']);die;
				} else {

					// var_dump($data['page']);die;

					$config = array();

					$config['per_page'] = "5";

					$config['next_page'] = '&laquo;';
					$config['full_tag_open'] = '<div class="page__pagination">';
					$config['full_tag_close'] = '</div>';
					$config['first_link']    = 'First';
					$config['last_link']    = 'Last';
					$config['next_link']	= 'Next';
					$config['prev_link']	= 'Prev';
					$config['cur_tag_open']  = '<span class="current"></a>';
					$config['cur_tag_close']  = '</a></span>';
					$config['prev_page'] = '&raquo;';
					$config['base_url'] = site_url("Tempat-Wisata") . "/" . $data_header['kategori'] . "/" . $filterProvinceOri . "/" . $filterTownOri;
					$config["uri_segment"] = 5;
					$config['total_rows'] = $this->Model->filter_city($filterTown, $data_header['kategori'], null, null)->num_rows();
					$choice = $config["total_rows"] / $config["per_page"];
					$data['page'] = ($this->uri->segment(5)) ? $this->uri->segment(5) : 0;

					$config["num_links"] = floor($choice);
					$this->pagination->initialize($config);
					$data['wisata'] = $this->Model->filter_city($filterTown, $data_header['kategori'], $config['per_page'], $data['page'])->result_array();
					$data['halaman'] = $this->pagination->create_links();
				}
			} elseif (is_numeric($filterTown)) {
				// var_dump('jancok');
				// die;
				if ($data_header['kategori'] == "Semua-Kategori") {
					$config = array();

					$config['per_page'] = "12";

					$config['next_page'] = '&laquo;';
					$config['full_tag_open'] = '<div class="page__pagination">';
					$config['full_tag_close'] = '</div>';
					$config['first_link']    = 'First';
					$config['last_link']    = 'Last';
					$config['next_link']	= 'Next';
					$config['prev_link']	= 'Prev';
					$config['cur_tag_open']  = '<span class="current"></a>';
					$config['cur_tag_close']  = '</a></span>';
					$config['prev_page'] = '&raquo;';
					$config['base_url'] = site_url("Tempat-Wisata") . "/" . $data_header['kategori'] . "/" . $filterProvinceOri;
					$config["uri_segment"] = 4;
					$config['total_rows'] = $this->Model->filter_province($filterProvince, null, null, null)->num_rows();
					$choice = $config["total_rows"] / $config["per_page"];
					$data['page'] = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;

					$config["num_links"] = floor($choice);
					$this->pagination->initialize($config);
					$data['wisata'] = $this->Model->filter_province($filterProvince, null, $config['per_page'], $data['page'])->result_array();
					$data['halaman'] = $this->pagination->create_links();
				} else {
					$config = array();

					$config['per_page'] = "12";

					$config['next_page'] = '&laquo;';
					$config['full_tag_open'] = '<div class="page__pagination">';
					$config['full_tag_close'] = '</div>';
					$config['first_link']    = 'First';
					$config['last_link']    = 'Last';
					$config['next_link']	= 'Next';
					$config['prev_link']	= 'Prev';
					$config['cur_tag_open']  = '<span class="current"></a>';
					$config['cur_tag_close']  = '</a></span>';
					$config['prev_page'] = '&raquo;';
					$config['base_url'] = site_url("Tempat-Wisata") . "/" . $data_header['kategori'] . "/" . $filterProvinceOri;
					$config["uri_segment"] = 4;
					$config['total_rows'] = $this->Model->filter_province($filterProvince, $data_header['kategori'], null, null)->num_rows();
					$choice = $config["total_rows"] / $config["per_page"];
					$data['page'] = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;

					$config["num_links"] = floor($choice);
					$this->pagination->initialize($config);
					$data['wisata'] = $this->Model->filter_province($filterProvince, $data_header['kategori'], $config['per_page'], $data['page'])->result_array();
					$data['halaman'] = $this->pagination->create_links();
				}
			}
		} elseif ($filterProvince != null && is_numeric($filterProvince)) {
			$data['page'] = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
			$config["uri_segment"] = 4;
			$config['base_url'] = site_url("Tempat-Wisata") . "/" . $data_header['kategori'] . "/" . $filterProvinceOri;
			if ($data_header['kategori'] == "Semua-Kategori") {
				// var_dump($data['page']);die;
				$config['total_rows'] = $this->Model->filter_province($filterProvince)->num_rows();
				$choice = $config["total_rows"] / $config["per_page"];
				$config["num_links"] = floor($choice);
				$this->pagination->initialize($config);
				$data['wisata'] = $this->Model->filter_province($filterProvince, null, $config['per_page'], $data['page'])->result_array();
				$data['halaman'] = $this->pagination->create_links();
				// var_dump($data['page']);die;
			} else {
				// var_dump($data['page']);die;
				$config = array();

				$config['per_page'] = "12";

				$config['next_page'] = '&laquo;';
				$config['full_tag_open'] = '<div class="page__pagination">';
				$config['full_tag_close'] = '</div>';
				$config['first_link']    = 'First';
				$config['last_link']    = 'Last';
				$config['next_link']	= 'Next';
				$config['prev_link']	= 'Prev';
				$config['cur_tag_open']  = '<span class="current"></a>';
				$config['cur_tag_close']  = '</a></span>';
				$config['prev_page'] = '&raquo;';
				$config['base_url'] = site_url("Tempat-Wisata") . "/" . $data_header['kategori'];
				$config["uri_segment"] = 3;
				$config['total_rows'] = $this->Model->filter_province(null, $data_header['kategori'], null, null)->num_rows();
				$choice = $config["total_rows"] / $config["per_page"];
				$data['page'] = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

				$config["num_links"] = floor($choice);
				$this->pagination->initialize($config);
				$data['wisata'] = $this->Model->filter_province(null, $data_header['kategori'], $config['per_page'], $data['page'])->result_array();
				$data['halaman'] = $this->pagination->create_links();
			}
		} elseif ($filterProvince != null && is_string($filterProvince)) {
			if ($data_header['kategori'] == "Semua-Kategori") {
				// var_dump('tes');
				// die;
				$config = array();

				$config['per_page'] = "12";

				$config['next_page'] = '&laquo;';
				$config['full_tag_open'] = '<div class="page__pagination">';
				$config['full_tag_close'] = '</div>';
				$config['first_link']    = 'First';
				$config['last_link']    = 'Last';
				$config['next_link']	= 'Next';
				$config['prev_link']	= 'Prev';
				$config['cur_tag_open']  = '<span class="current"></a>';
				$config['cur_tag_close']  = '</a></span>';
				$config['prev_page'] = '&raquo;';
				$config['base_url'] = site_url("Tempat-Wisata") . "/" . $data_header['kategori'] . "/" . $filterProvinceOri;
				$config["uri_segment"] = 3;
				$config['total_rows'] = $this->Model->filter_province($filterProvince, null, null, null)->num_rows();
				// var_dump($config['total_rows']);
				// die;
				$choice = $config["total_rows"] / $config["per_page"];
				$data['page'] = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

				$config["num_links"] = floor($choice);
				$this->pagination->initialize($config);
				$data['wisata'] = $this->Model->filter_province($filterProvince, null, $config['per_page'], $data['page'])->result_array();
				// var_dump($data['wisata']);
				// die;
				$data['halaman'] = $this->pagination->create_links();
			} else {
				// var_dump('asu');
				// die;
				$config = array();

				$config['per_page'] = "12";

				$config['next_page'] = '&laquo;';
				$config['full_tag_open'] = '<div class="page__pagination">';
				$config['full_tag_close'] = '</div>';
				$config['first_link']    = 'First';
				$config['last_link']    = 'Last';
				$config['next_link']	= 'Next';
				$config['prev_link']	= 'Prev';
				$config['cur_tag_open']  = '<span class="current"></a>';
				$config['cur_tag_close']  = '</a></span>';
				$config['prev_page'] = '&raquo;';
				$config['base_url'] = site_url("Tempat-Wisata") . "/" . $data_header['kategori'] . "/" . $filterProvinceOri;
				$config["uri_segment"] = 3;
				$config['total_rows'] = $this->Model->filter_province($filterProvince, $data_header['kategori'], null, null)->num_rows();
				$choice = $config["total_rows"] / $config["per_page"];
				$data['page'] = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

				$config["num_links"] = floor($choice);
				$this->pagination->initialize($config);
				$data['wisata'] = $this->Model->filter_province($filterProvince, $data_header['kategori'], $config['per_page'], $data['page'])->result_array();
				$data['halaman'] = $this->pagination->create_links();
			}
		} else {
			$data['page'] = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
			$config["uri_segment"] = 3;
			// var_dump($data['page']);die;
			if ($data_header['kategori'] == "Semua-Kategori") {
				// var_dump($data['page']);die;
				$config['base_url'] = site_url("Tempat-Wisata") . "/" . $data_header['kategori'];
				$choice = $config["total_rows"] / $config["per_page"];
				$config["num_links"] = floor($choice);
				$this->pagination->initialize($config);
				$status = "Semua-Kategori";
				$config['total_rows'] = $this->Model->tampil($id, $status)->num_rows();
				$data['wisata'] = $this->Model->tampil($id, $status, $config['per_page'], $data['page'])->result_array();
				$data['halaman'] = $this->pagination->create_links();
			} else {
				$config = array();

				$config['per_page'] = "12";

				$config['next_page'] = '&laquo;';
				$config['full_tag_open'] = '<div class="page__pagination">';
				$config['full_tag_close'] = '</div>';
				$config['first_link']    = 'First';
				$config['last_link']    = 'Last';
				$config['next_link']	= 'Next';
				$config['prev_link']	= 'Prev';
				$config['cur_tag_open']  = '<span class="current"></a>';
				$config['cur_tag_close']  = '</a></span>';
				$config['prev_page'] = '&raquo;';
				$config['total_rows'] = $this->Model->tampil($id, null)->num_rows();
				$choice = $config["total_rows"] / $config["per_page"];
				$config["num_links"] = floor($choice);
				$config['base_url'] = site_url("Tempat-Wisata") . "/" . $data_header['kategori'];
				$this->pagination->initialize($config);
				$data['wisata'] = $this->Model->tampil($id, null, $config['per_page'], $data['page'])->result_array();
				$data['halaman'] = $this->pagination->create_links();
			}
			// var_dump($config['total_rows']);die;
		}
		// $data['wisata']= $this->Model->get_wisata_all($config['per_page'], $data['page']);
		// var_dump($data['wisata']);die;

		// var_dump($data['halaman']);die;

		$this->load->view('headerwisata', $data_header);
		$this->load->view('wisata', $data);

		$data_footer['menu_kategori'] = $this->Model->menu_kategori()->result_array();
		$data_footer['wahana']	= $this->Model->menu_wahana()->result_array();

		$this->db->where('fc_kode', '1');
		$this->db->where('fc_param', 'FACEBOOK');
		$data_footer['facebook_icon'] = $this->db->get('t_setup')->row();

		$this->db->where('fc_kode', '1');
		$this->db->where('fc_param', 'TWITTER');
		$data_footer['twitter_icon'] = $this->db->get('t_setup')->row();

		$this->db->where('fc_kode', '1');
		$this->db->where('fc_param', 'INSTAGRAM');
		$data_footer['instagram_icon'] = $this->db->get('t_setup')->row();

		$this->db->where('fc_kode', '1');
		$this->db->where('fc_param', 'YOUTUBE');
		$data_footer['youtube_icon'] = $this->db->get('t_setup')->row();

		$this->db->where('fc_kode', '1');
		$this->db->where('fc_param', 'SEKILAS');
		$data_footer['sekilas_icon'] = $this->db->get('t_setup')->row();

		$this->db2->where('fc_kode', '1');
		$this->db2->where('fc_param', 'SEKILAS');
		$data_footer['sekilas_icon_en'] = $this->db2->get('t_setup')->row();
		$data_footer['kategori'] = $this->uri->segment(2);

		$this->load->view('footer', $data_footer);
	}

	public function detail_wisata($id = NULL)
	{
		$data_header['menu_produk'] = $this->Model->menu_produk()->result_array();
		$param = $this->uri->segment(5);
		$title = str_replace("-", " ", $param);
		$title = str_replace("_", "-", $title);
		$id = $this->Model->get_data_from_name($title)->result_array();
		$id = $id[0]['wisata_id'];
		$this->Model->wisata_baca($id);
		$data_header['menu_kategori'] = $this->Model->menu_kategori()->result_array();
		// $prov = $this->Model->tampil(4,$id)->row()->nama_provinsi;
		// $kota = $this->Model->tampil(4,$id)->row()->nama_kota_kabupaten;
		// $nama= $this->Model->tampil(4,$id)->row()->wisata_nama;
		// $data_header['title']=$prov.' '.$kota.' '.$nama;
		$data_header['wisata'] = $this->Model->tampil(4, $id)->row();
		$this->load->view('headerwisata', $data_header);

		$data['wisata'] = $this->Model->tampil(4, $id)->row();
		$data['wisata_en'] = $this->Model->tampil_en(4, $id)->row();
		$data['wisatalain'] = $this->Model->wisata_lain($data['wisata']->nama_kota_kabupaten)->result_array();
		$data['produk'] = $this->Model->produk_wisata($data['wisata']->nama_kota_kabupaten)->result_array();
		$data['wahana'] = $this->Model->tampil_wahana(4, $id)->result_array();
		$data['wahana_en'] = $this->Model->tampil_wahana_en(4, $id)->result_array();

		$data['pendukung'] = $this->Model->tampil_pendukung(4, $id)->result_array();
		$data['pendukung_en'] = $this->Model->tampil_pendukung_en(4, $id)->result_array();

		$data['fasilitas_pendukung'] = $this->Model->tampil_pendukung(4, $id)->row();
		$data['pendukung_fasilitas'] = $this->Model->tampil_fasilitas_pendukung(4, $id)->result_array();
		$data['sliders'] = $this->Model->tampil_wisata(4, $id)->result_array();

		$data['foto'] = $this->Model->tampil(4, $id)->result_array();
		$data['foto_en'] = $this->Model->tampil_en(4, $id)->result_array();

		$data['foto_wisata'] = $this->Model->tampil_wisata(4, $id)->row();
		$data['populer'] = $this->Model->populer_wisata(10)->result_array();
		$where = array('wisata_id' => $this->uri->segment(3));
		$data['record'] = $this->Model->view('komentar', $where);


		//rata"rating
		// if ($this->session->userdata('current_language')=='english'){ 
		// 	$komentar = $this->Model->komentar_en($id);
		// 	$a = "Value rating his stil empty";
		// }else{
		// 	$komentar = $this->Model->komentar($id);	
		// 	$a = "Rating nilai masih kosong";
		// }
		// $jml = 0;
		// $tot = 0;
		// if ($komentar->num_rows()>0) {
		// 	foreach ($komentar->result_array() as $k) {
		// 		$jml++;
		// 		$tot += $k['komentar_nilai_rating'];
		// 	}
		// 	$data['avg_rating'] = $tot/$jml;
		// }else{
		// 	$data['avg_rating'] = $a;
		// }
		$data['penulis_berita'] = $this->Model->penulis_berita($id)->row();
		$data['penulis_berita_en'] = $this->Model->penulis_berita_en($id)->row();
		$data['penulis_wisata'] = $this->Model->penulis_wisata($id)->row();
		$data['penulis_wisata_en'] = $this->Model->penulis_wisata_en($id)->row();
		$data['detail_wisata'] = $this->Model->wisata($id)->row();
		// $penulis_id = $this->Model->berita($id)->row()->penulis_id;
		// $data['berita_count'] = $this->Model->get_penulis_berita_count($penulis_id);
		// $data['wisata_count'] = $this->Model->get_penulis_wisata_count($penulis_id);

		$penulis_id = $this->Model->penulis_wisata($id)->row()->penulis_id;
		$data['berita_count'] = $this->Model->get_penulis_berita_count($penulis_id);
		$data['wisata_count'] = $this->Model->get_penulis_wisata_count($penulis_id);
		$data['data_komentar'] = $this->Model->komentarShowFirst($id)->result_array();

		if ($this->session->userdata('current_language') == 'english') {
			$komentar = $this->Model->komentar_en($id);
			$a = "Value rating his stil empty";
		} else {
			$komentar = $this->Model->komentar($id);
			$a = "Rating nilai masih kosong";
		}
		$jml = 0;
		$tot = 0;
		if ($komentar->num_rows() > 0) {
			foreach ($komentar->result_array() as $k) {
				$jml++;
				$tot += $k['komentar_nilai_rating'];
			}
			$number = round($tot / $jml, 0);
			$data['avg_rating'] = $number;

			$data['jumlah_komentar'] = $jml;
		} else {
			$data['avg_rating'] = 0;
			$data['jumlah_komentar'] = $jml;
		}
		$data['detail_berita'] = $this->Model->berita($id)->row();
		$this->load->view('single_wisata', $data);

		$data_footer['menu_kategori'] = $this->Model->menu_kategori()->result_array();
		$data_footer['wahana']	= $this->Model->menu_wahana()->result_array();

		$this->db->where('fc_kode', '1');
		$this->db->where('fc_param', 'FACEBOOK');
		$data_footer['facebook_icon'] = $this->db->get('t_setup')->row();

		$this->db->where('fc_kode', '1');
		$this->db->where('fc_param', 'TWITTER');
		$data_footer['twitter_icon'] = $this->db->get('t_setup')->row();

		$this->db->where('fc_kode', '1');
		$this->db->where('fc_param', 'INSTAGRAM');
		$data_footer['instagram_icon'] = $this->db->get('t_setup')->row();

		$this->db->where('fc_kode', '1');
		$this->db->where('fc_param', 'YOUTUBE');
		$data_footer['youtube_icon'] = $this->db->get('t_setup')->row();

		$this->db->where('fc_kode', '1');
		$this->db->where('fc_param', 'SEKILAS');
		$data_footer['sekilas_icon'] = $this->db->get('t_setup')->row();

		$this->db2->where('fc_kode', '1');
		$this->db2->where('fc_param', 'SEKILAS');
		$data_footer['sekilas_icon_en'] = $this->db2->get('t_setup')->row();

		$this->load->view('footer', $data_footer);
	}
	function loadMoreKomentar()
	{
		$row = $this->input->post('row', true);
		$idkomenwis = $this->input->post('idkomenwis', true);

		// var_dump($idkomenwis);die;

		$rowperpage = 3;

		$queryloadkomentar = 'select * from komentar where wisata_id =' . $idkomenwis . ' order by komentar_tgl DESC limit ' . $row . ',' . $rowperpage;
		$dataloadkomen = $this->db->query($queryloadkomentar)->result_array();
		// var_dump($dataloadkomen[0]['nama']);die;

		foreach ($dataloadkomen as $dlk) {
			// echo $dlk['nama']."-";


			echo '<div class="row post-komen">';
			echo '<hr/>';
			echo '<div class="col-sm-3">';
			echo '<div class="review-block-date"><label>' . $dlk['nama'] . '</label></div>';
			echo '<div class="post-meta"><i>' . $dlk['website'] . '</i></div>';
			echo '<div class="review-block-date">' . longdate_indo($dlk['komentar_tgl']) . '</div>';
			echo '</div>';
			echo '<div class="col-sm-9">';
			echo '<div class="review-block-description">' . $dlk['komentar_deskripsi'] . '</div>';
			echo '<div>';
			echo '<p class="text-right">';
			//for perulangan buat star ndek kene tp jk bingung
			for ($i = 0; $i < $dlk['komentar_nilai_rating']; $i++) {
				echo '<span class="on"><i class="fa fa-star"></i></span>';
			}

			for ($i = 5; $i > $dlk['komentar_nilai_rating']; $i--) {
				echo '<span class="off"><i class="fa fa-star"></i></span>';
			}
			echo '</p>';
			echo '</div>';
			echo '</div>';
			echo '</div>';
		}
	}

	function search_wisata()
	{
		$data_header['menu_produk'] = $this->Model->menu_produk()->result_array();

		$search = ($this->input->post("cari")) ? $this->input->post("cari") : "NIL";
		$search = ($this->uri->segment(3)) ? $this->uri->segment(3) : $search;
		$data_header['title'] = "Tempat Wisata Dengan Kata Kunci \"" . $search . "\" | BeautyOfIndonesia.com";
		$data_header['menu_kategori'] = $this->Model->menu_kategori()->result_array();
		$this->load->view('headerwisata', $data_header);
		// pagination settings
		$config = array();
		$config['base_url'] = site_url("Tempat-Wisata/Kata-Kunci/" . $search);
		$config['total_rows'] = $this->Model->get_wisata_count($search);
		$config['per_page'] = "5";
		$config["uri_segment"] = 4;
		$choice = 9;
		$config["num_links"] = floor($choice);

		$config['next_page'] = '&laquo;';
		$config['full_tag_open'] = '<div class="page__pagination">';
		$config['full_tag_close'] = '</div>';
		$config['first_link']    = 'First';
		$config['last_link']    = 'Last';
		$config['next_link']	= 'Next';
		$config['prev_link']	= 'Prev';
		$config['cur_tag_open']  = '<span class="current"></a>';
		$config['cur_tag_close']  = '</a></span>';
		$config['prev_page'] = '&raquo;';

		$this->pagination->initialize($config);

		$data['page'] = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
		// get books list
		$data['query'] = $this->Model->get_wisata($config['per_page'], $data['page'], $search);
		$data['query_en'] = $this->Model->get_wisata_en($config['per_page'], $data['page'], $search);

		$data['halaman'] = $this->pagination->create_links();

		// var_dump($data['halaman']);die;

		$this->load->view('result_wisata', $data);

		$data_footer['menu_kategori'] = $this->Model->menu_kategori()->result_array();
		$data_footer['wahana']	= $this->Model->menu_wahana()->result_array();

		$this->db->where('fc_kode', '1');
		$this->db->where('fc_param', 'FACEBOOK');
		$data_footer['facebook_icon'] = $this->db->get('t_setup')->row();

		$this->db->where('fc_kode', '1');
		$this->db->where('fc_param', 'TWITTER');
		$data_footer['twitter_icon'] = $this->db->get('t_setup')->row();

		$this->db->where('fc_kode', '1');
		$this->db->where('fc_param', 'INSTAGRAM');
		$data_footer['instagram_icon'] = $this->db->get('t_setup')->row();

		$this->db->where('fc_kode', '1');
		$this->db->where('fc_param', 'YOUTUBE');
		$data_footer['youtube_icon'] = $this->db->get('t_setup')->row();

		$this->db->where('fc_kode', '1');
		$this->db->where('fc_param', 'SEKILAS');
		$data_footer['sekilas_icon'] = $this->db->get('t_setup')->row();

		$this->db2->where('fc_kode', '1');
		$this->db2->where('fc_param', 'SEKILAS');
		$data_footer['sekilas_icon_en'] = $this->db2->get('t_setup')->row();

		$this->load->view('footer', $data_footer);
	}

	public function detail_penulis($id = null)
	{
		$data_header['menu_produk'] = $this->Model->menu_produk()->result_array();
		$data_header['menu_kategori'] = $this->Model->menu_kategori()->result_array();
		$this->load->view('headerwisata', $data_header);

		$param = $this->uri->segment(2);

		$title = str_replace("-", " ", $param);
		$id = $this->Model->get_data_from_name_wisata('penulis', $title)->row();
		$id = $id->penulis_id;
		// var_dump($id); die;

		$data['wisata_nama'] = $this->Model->tampil($id)->row();

		$data['wisata_en'] = $this->Model->tampil_en($id)->result_array();

		$total_data = $this->Model->get_all()->num_rows();
		$data['total_data'] = ceil($total_data / 8);
		$data['jenis'] = null;
		$data['penulis_nama'] = $this->Model->penulis($id)->row()->penulis_nama;
		$data['tahun_gabung'] = $this->Model->penulis($id)->row()->penulis_tahun_bergabung;
		$data['profesi'] = $this->Model->penulis($id)->row()->penulis_profesi;
		$data['deskripsi_penulis'] = $this->Model->penulis($id)->row()->penulis_deskripsi;
		$config = array();
		$config['base_url'] = site_url("Penulis-Wisata/" . $param);
		$config['total_rows'] = $this->Model->tampilwisatapenulis_count($id, null)->num_rows();
		$config['per_page'] = "12";
		$config["uri_segment"] = 3;
		$choice = $config["total_rows"] / $config["per_page"];
		$config["num_links"] = floor($choice);
		$config['next_page'] = '&laquo;';
		$config['full_tag_open'] = '<div class="page__pagination">';
		$config['full_tag_close'] = '</div>';
		$config['first_link']    = 'First';
		$config['last_link']    = 'Last';
		$config['next_link']	= 'Next';
		$config['prev_link']	= 'Prev';
		$config['cur_tag_open']  = '<span class="current"></a>';
		$config['cur_tag_close']  = '</a></span>';
		$config['prev_page'] = '&raquo;';

		$this->pagination->initialize($config);

		$data['page'] = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		// $data['wisata']= $this->Model->get_wisata_all($config['per_page'], $data['page']);
		$data['wisata'] = $this->Model->tampilwisatapenulis($id, null, $config['per_page'], $data['page'])->result_array();
		// var_dump($data['page']);die;
		$data['halaman'] = $this->pagination->create_links();
		$this->load->view("single_penulis_wisata", $data);

		$data_footer['menu_kategori'] = $this->Model->menu_kategori()->result_array();
		$data_footer['wahana']	= $this->Model->menu_wahana()->result_array();

		$this->db->where('fc_kode', '1');
		$this->db->where('fc_param', 'FACEBOOK');
		$data_footer['facebook_icon'] = $this->db->get('t_setup')->row();

		$this->db->where('fc_kode', '1');
		$this->db->where('fc_param', 'TWITTER');
		$data_footer['twitter_icon'] = $this->db->get('t_setup')->row();

		$this->db->where('fc_kode', '1');
		$this->db->where('fc_param', 'INSTAGRAM');
		$data_footer['instagram_icon'] = $this->db->get('t_setup')->row();

		$this->db->where('fc_kode', '1');
		$this->db->where('fc_param', 'YOUTUBE');
		$data_footer['youtube_icon'] = $this->db->get('t_setup')->row();

		$this->db->where('fc_kode', '1');
		$this->db->where('fc_param', 'SEKILAS');
		$data_footer['sekilas_icon'] = $this->db->get('t_setup')->row();

		$this->db2->where('fc_kode', '1');
		$this->db2->where('fc_param', 'SEKILAS');
		$data_footer['sekilas_icon_en'] = $this->db2->get('t_setup')->row();

		$this->load->view('footer', $data_footer);
	}

	function tag_wisata()
	{
		$data_header['menu_produk'] = $this->Model->menu_produk()->result_array();

		$data_header['menu_kategori'] = $this->Model->menu_kategori()->result_array();
		$data_header['tag_wisata'] = $this->uri->segment(3);
		$this->load->view('headerwisata', $data_header);

		$like      = '';
		$id = $this->uri->segment(3);
		$like = "(wisata_tag LIKE '%$id%')";
		$data['kategori'] = $this->Model->event(5)->result_array();
		$config = array();
		$config['base_url'] = site_url("Wisata/tag_wisata/$id");
		$config['total_rows'] = $this->Model->tag_wisata_count($like);
		$config['per_page'] = "12";
		$config["uri_segment"] = 4;
		$choice = $config["total_rows"] / $config["per_page"];
		$config["num_links"] = floor($choice);
		$config['next_page'] = '&laquo;';
		$config['full_tag_open'] = '<div class="page__pagination">';
		$config['full_tag_close'] = '</div>';
		$config['first_link']    = 'First';
		$config['last_link']    = 'Last';
		$config['next_link']	= 'Next';
		$config['prev_link']	= 'Prev';
		$config['cur_tag_open']  = '<span class="current"></a>';
		$config['cur_tag_close']  = '</a></span>';
		$config['prev_page'] = '&raquo;';

		$this->pagination->initialize($config);
		$data['wisata'] = $this->Model->tampil(4, $id)->row();
		$data['wisata_en'] = $this->Model->tampil_en(4, $id)->row();
		$data['page'] = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
		$data['tag_wisata'] = $this->Model->tag_wisata($config['per_page'], $data['page'], $like);
		$data['halaman'] = $this->pagination->create_links();

		//$data['tag']  = $this->Model->tampil_wisata()->result_array();
		$this->load->view('tag_wisata', $data);

		$data_footer['menu_kategori'] = $this->Model->menu_kategori()->result_array();
		$data_footer['wahana']	= $this->Model->menu_wahana()->result_array();

		$this->db->where('fc_kode', '1');
		$this->db->where('fc_param', 'FACEBOOK');
		$data_footer['facebook_icon'] = $this->db->get('t_setup')->row();

		$this->db->where('fc_kode', '1');
		$this->db->where('fc_param', 'TWITTER');
		$data_footer['twitter_icon'] = $this->db->get('t_setup')->row();

		$this->db->where('fc_kode', '1');
		$this->db->where('fc_param', 'INSTAGRAM');
		$data_footer['instagram_icon'] = $this->db->get('t_setup')->row();

		$this->db->where('fc_kode', '1');
		$this->db->where('fc_param', 'YOUTUBE');
		$data_footer['youtube_icon'] = $this->db->get('t_setup')->row();

		$this->db->where('fc_kode', '1');
		$this->db->where('fc_param', 'SEKILAS');
		$data_footer['sekilas_icon'] = $this->db->get('t_setup')->row();

		$this->db2->where('fc_kode', '1');
		$this->db2->where('fc_param', 'SEKILAS');
		$data_footer['sekilas_icon_en'] = $this->db2->get('t_setup')->row();

		$this->load->view('footer', $data_footer);
	}

	function fasilitas_pendukung($id)
	{
		$data_header['menu_produk'] = $this->Model->menu_produk()->result_array();
		$data_header['menu_kategori'] = $this->Model->menu_kategori()->result_array();
		$this->load->view('header', $data_header);

		$data['fasilitas_pendukung'] = $this->Model->detail_pendukung(4, $id)->row();
		$this->load->view('single_pendukung', $data);

		$data_footer['menu_kategori'] = $this->Model->menu_kategori()->result_array();
		$data_footer['wahana']	= $this->Model->menu_wahana()->result_array();

		$this->db->where('fc_kode', '1');
		$this->db->where('fc_param', 'FACEBOOK');
		$data_footer['facebook_icon'] = $this->db->get('t_setup')->row();

		$this->db->where('fc_kode', '1');
		$this->db->where('fc_param', 'TWITTER');
		$data_footer['twitter_icon'] = $this->db->get('t_setup')->row();

		$this->db->where('fc_kode', '1');
		$this->db->where('fc_param', 'INSTAGRAM');
		$data_footer['instagram_icon'] = $this->db->get('t_setup')->row();

		$this->db->where('fc_kode', '1');
		$this->db->where('fc_param', 'YOUTUBE');
		$data_footer['youtube_icon'] = $this->db->get('t_setup')->row();

		$this->db->where('fc_kode', '1');
		$this->db->where('fc_param', 'SEKILAS');
		$data_footer['sekilas_icon'] = $this->db->get('t_setup')->row();

		$this->db2->where('fc_kode', '1');
		$this->db2->where('fc_param', 'SEKILAS');
		$data_footer['sekilas_icon_en'] = $this->db2->get('t_setup')->row();

		$this->load->view('footer', $data_footer);
	}

	function tambah_rating()
	{
		$date = date('Y-m-d');
		$ip = $this->input->post('komentar_ip');
		$link = base_url('Wisata');
		$key = $this->input->post('wisata_id');
		$title = str_replace("-", " ", $key);
		$datawis = $this->Model->get_data_from_namewst('wisata', $title)->row();
		$idwisnya = $datawis->wisata_id;
		$wisprovnya = $datawis->nama_provinsi;
		$wiskotanya = $datawis->nama_kota_kabupaten;
		$wisktgr = $datawis->kategori_nama;
		$linkinto = base_url() . 'Tempat-Wisata/' . url_title($wisktgr, "dash", false) . '/' . url_title($wisprovnya, "dash", false) . '/' . url_title($wiskotanya, "dash", false) . '/' . url_title($title, "dash", false);

		// var_dump($idwisnya);die;
		$query = $this->db->query('SELECT count(*) as jml_ada FROM komentar WHERE 
											komentar_ip="' . $ip . '" AND komentar_tgl="' . $date . '" AND wisata_id="' . $idwisnya . '" ');


		$ratnya = $this->input->post('rating', true);
		$namas = $this->input->post('nama', true);
		$emails = $this->input->post('email', true);
		$websites = $this->input->post('website', true);
		$komens = $this->input->post('komentar_deskripsi', true);

		// var_dump($linkinto);die;



		if (!empty($_POST['g-recaptcha-response'])) {
			$secret = $this->config->item('google_secret');
			$verifyResponse = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret=' . $secret . '&response=' . $_POST['g-recaptcha-response']);
			$responseData = json_decode($verifyResponse);
			if ($responseData->success) {
				$message = " g-recaptcha varified successfully";

				foreach ($query->result() as $val) {
					if ($val->jml_ada == "0") {
						$data = array(
							'komentar_nilai_rating' => $this->input->post('rating'),
							'nama' => $this->security->xss_clean($this->input->post('nama')),
							'email' => $this->security->xss_clean($this->input->post('email')),
							'website' => $this->security->xss_clean($this->input->post('website')),
							'komentar_deskripsi' => $this->security->xss_clean($this->input->post('komentar_deskripsi')),
							'wisata_id' => $idwisnya,
							'komentar_ip' => $this->security->xss_clean($this->input->post('komentar_ip')),
							'komentar_tgl' => $this->security->xss_clean($this->input->post('komentar_tgl'))
						);
						if ($this->session->userdata('current_language') == 'english') {
							$this->Model->add_en('komentar', $data);
						} else {
							$this->Model->add('komentar', $data);
						}
						echo "<script>
													alert('Komentar Berhasil Disimpan');
													window.location.href = '" . $linkinto . "';// your redirect path here
												</script>";
					} else {
						echo "<script>
													alert('Anda telah Melakukan Voting');
													window.location.href = '" . $linkinto . "';// your redirect path here
												</script>";
					}
				}
			} else {
				$message = " Some error in vrifying g-recaptcha";
			}
		} else {
			echo "<script>
		 			alert('Captcha belum diisi');
					window.history.back();
		 		</script>";
		}
	}
}
