<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Produk extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->db2 = $this->load->database('pariwisata_en', TRUE);
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->model('Model');
		$this->output->set_header('Last-Modified: ' . gmdate("D, d M Y H:i:s") . ' GMT');
		$this->output->set_header('Cache-Control: no-cache, must-revalidate, max-age=0');
		$this->output->set_header('Cache-Control: post-check=0, pre-check=0', false);

		$this->output->set_header('Pragma: no-cache');

		$this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');

		$this->output->set_header('Pragma: no-cache');
		$this->output->set_header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
		date_default_timezone_set("Asia/Jakarta");
	}
	function get_city()
	{


		if ($this->input->post('provinsi') != null) {
			$provinsi = $this->input->post('provinsi');
			$city = $this->Model->get_city_where($provinsi)->result_array();
		}

		if ($this->input->post('city') != null) {
			$filterCity = $this->input->post('city');
			$filterCity = str_replace("-", " ", $filterCity);
			$drop = '<option disabled selected>Pilih Kota</option>';
			foreach ($city as $ct) {
				$drop = $drop . '<option value="' . $ct['nama_kota'] . '" ' . ($ct['nama_kota'] == $filterCity ? 'selected' : '') . ' >' . $ct['nama_kota'] . '</option>';
			}
		} else {
			$drop = '<option disabled selected>Pilih Kota</option>';
			foreach ($city as $ct) {
				$drop = $drop . '<option value="' . $ct['nama_kota'] . '">' . $ct['nama_kota'] . '</option>';
			}
		}

		// var_dump($filterCity);
		echo $drop;
	}

	public function index()
	{
		$data_header['menu_kategori'] = $this->Model->menu_kategori()->result_array();
		$data_header['menu_produk'] = $this->Model->menu_produk()->result_array();
		$this->load->view('headerproduk', $data_header);
		$provinsi = $this->uri->segment(3);
		$filterProvince = str_replace("-", " ", $provinsi);
		$city = $this->uri->segment(4);
		$filterCity = str_replace("-", " ", $city);
		$data['filterProv'] = $filterProvince;
		$data['provinsi'] = $this->Model->get_province_produk()->result_array();
		if (is_numeric($this->uri->segment(3))) {
			$config = array();
			$config['base_url'] = site_url("Produk/Semua-Jenis/");
			$config['total_rows'] = $this->Model->tampilproduk(null, null, null, null)->num_rows();
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
			$data['produk'] = $this->Model->tampilproduk(null, $data['page'], $config['per_page'], null)->result_array();
			$data['halaman'] = $this->pagination->create_links();
		} elseif (is_string($this->uri->segment(3)) && $this->uri->segment(4) == null) {
			$config = array();
			$config['base_url'] = site_url("Produk/Semua-Jenis/" . $provinsi . "/");
			$config['total_rows'] = $this->Model->filter_province_produk($filterProvince, null, null, null)->num_rows();
			$config['per_page'] = "2";
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
			$data['page'] = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
			$data['produk'] = $this->Model->filter_province_produk($filterProvince, $data['page'], $config['per_page'], null)->result_array();
			$data['halaman'] = $this->pagination->create_links();
		} elseif (is_string($this->uri->segment(3)) && is_numeric($this->uri->segment(4))) {
			$config = array();
			$config['base_url'] = site_url("Produk/Semua-Jenis/" . $provinsi . "/");
			$config['total_rows'] = $this->Model->filter_province_produk($filterProvince, null, null, null)->num_rows();
			$config['per_page'] = "2";
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
			$data['page'] = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
			$data['produk'] = $this->Model->filter_province_produk($filterProvince, $data['page'], $config['per_page'], null)->result_array();
			$data['halaman'] = $this->pagination->create_links();
		} elseif (is_string($this->uri->segment(3)) && is_string($this->uri->segment(4))) {
			$config = array();
			$config['base_url'] = site_url("Produk/Semua-Jenis/" . $provinsi . "/" . $city . "/");
			$config['total_rows'] = $this->Model->filter_city_produk($filterCity, null, null, null)->num_rows();
			$config['per_page'] = "2";
			$config["uri_segment"] = 5;
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
			$data['page'] = ($this->uri->segment(5)) ? $this->uri->segment(5) : 0;
			$data['produk'] = $this->Model->filter_city_produk($filterCity, $data['page'], $config['per_page'], null)->result_array();
			$data['halaman'] = $this->pagination->create_links();
		}


		// }elseif($filterProvince != null && $filterCity != null){
		// 	$data['produk']= $this->Model->filter_city_produk($filterCity,null)->result_array();
		else {

			$config = array();
			$config['base_url'] = site_url("Produk/Semua-Jenis/");
			$config['total_rows'] = $this->Model->tampilproduk(null, null, null, null)->num_rows();
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

			$data['page'] = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
			$data['produk'] = $this->Model->tampilproduk(null, $data['page'], $config['per_page'], null)->result_array();
			$data['halaman'] = $this->pagination->create_links();
		}

		$this->load->view('produk_all', $data);
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

	public function Jenis($id)
	{
		$data_header['menu_kategori'] = $this->Model->menu_kategori()->result_array();
		$data_header['menu_produk'] = $this->Model->menu_produk()->result_array();
		$this->load->view('headerproduk', $data_header);
		$provinsi = $this->uri->segment(4);
		$filterProvince = str_replace("-", " ", $provinsi);
		$city = $this->uri->segment(5);
		$filterCity = str_replace("-", " ", $city);
		$data['filterProv'] = $filterProvince;
		$data['provinsi'] = $this->Model->get_province_produk()->result_array();
		$data['ktg'] = json_encode($id);
		if (is_numeric($this->uri->segment(4))) {
			$config = array();
			$config['base_url'] = site_url("Produk/Jenis/" . $id);
			$config['total_rows'] = $this->Model->tampilproduk($id, null, null, null)->num_rows();
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

			$data['page'] = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
			$data['produk'] = $this->Model->tampilproduk($id, $data['page'], $config['per_page'], null)->result_array();
			$data['halaman'] = $this->pagination->create_links();
		} elseif (is_string($this->uri->segment(4)) && $this->uri->segment(5) == null) {
			$config = array();
			$config['base_url'] = site_url("Produk/Jenis/" . $id . "/" . $provinsi . "/");
			$config['total_rows'] = $this->Model->filter_province_produk($filterProvince, null, null, $id)->num_rows();
			$config['per_page'] = "2";
			$config["uri_segment"] = 5;
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
			$data['page'] = ($this->uri->segment(5)) ? $this->uri->segment(5) : 0;
			$data['produk'] = $this->Model->filter_province_produk($filterProvince, $data['page'], $config['per_page'], $id)->result_array();
			$data['halaman'] = $this->pagination->create_links();
		} elseif (is_string($this->uri->segment(4)) && is_numeric($this->uri->segment(5))) {
			$config = array();
			$config['base_url'] = site_url("Produk/Jenis/" . $id . "/" . $provinsi . "/");
			$config['total_rows'] = $this->Model->filter_province_produk($filterProvince, null, null, $id)->num_rows();
			$config['per_page'] = "2";
			$config["uri_segment"] = 5;
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
			$data['page'] = ($this->uri->segment(5)) ? $this->uri->segment(5) : 0;
			$data['produk'] = $this->Model->filter_province_produk($filterProvince, $data['page'], $config['per_page'], $id)->result_array();
			$data['halaman'] = $this->pagination->create_links();
		} elseif (is_string($this->uri->segment(4)) && is_string($this->uri->segment(5))) {
			$config = array();
			$config['base_url'] = site_url("Produk/Jenis/" . $id . "/" . $provinsi . "/" . $city . "/");
			$config['total_rows'] = $this->Model->filter_city_produk($filterCity, null, null, $id)->num_rows();
			$config['per_page'] = "2";
			$config["uri_segment"] = 6;
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
			$data['page'] = ($this->uri->segment(6)) ? $this->uri->segment(6) : 0;
			$data['produk'] = $this->Model->filter_city_produk($filterCity, $data['page'], $config['per_page'], $id)->result_array();
			$data['halaman'] = $this->pagination->create_links();
		}


		// }elseif($filterProvince != null && $filterCity != null){
		// 	$data['produk']= $this->Model->filter_city_produk($filterCity,null)->result_array();
		else {

			$config = array();
			$config['base_url'] = site_url("Produk/Jenis/" . $id);
			$config['total_rows'] = $this->Model->tampilproduk($id, null, null, null)->num_rows();
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

			$data['page'] = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
			$data['produk'] = $this->Model->tampilproduk($id, $data['page'], $config['per_page'], null)->result_array();
			$data['halaman'] = $this->pagination->create_links();
		}

		$this->load->view('produk_kategori', $data);
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

	public function detail_produk($id = NULL)
	{
		$param = $this->uri->segment(5);
		$title = str_replace("-", " ", $param);
		$title = str_replace("_", "-", $title);
		$id = $this->Model->get_dataproduk_from_name($title)->result_array();
		$id = $id[0]['id_produk'];
		$this->Model->produk_baca($id);
		$data_header['menu_produk'] = $this->Model->menu_produk()->result_array();
		$data_header['menu_kategori'] = $this->Model->menu_kategori()->result_array();
		// $prov = $this->Model->tampil(4,$id)->row()->nama_provinsi;
		// $kota = $this->Model->tampil(4,$id)->row()->nama_kota_kabupaten;
		// $nama= $this->Model->tampil(4,$id)->row()->wisata_nama;
		// $data_header['title']=$prov.' '.$kota.' '.$nama;
		$data_header['produk'] = $this->Model->tampilpro(4, $id)->row();
		$this->load->view('headerproduk', $data_header);

		$data['produk'] = $this->Model->tampilpro(4, $id)->row();
		$data['produklain'] = $this->Model->produk_lain($data['produk']->nama_kota)->result_array();



		$data['foto'] = $this->Model->tampilpro(4, $id)->result_array();
		// $data['foto_en'] = $this->Model->tampil_en(4,$id)->result_array();

		$data['foto_produk'] = $this->Model->tampil_produk(4, $id)->row();
		// $data['populer']= $this->Model->populer_wisata(10)->result_array();
		$where = array('id_produk' => $this->uri->segment(3));
		$data['record'] = $this->Model->view('komentar', $where);
		$data['sliders'] = $this->Model->tampil_produk(4, $id)->result_array();

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
		$penulis_id = $this->Model->penulis_wisata($id)->row()->penulis_id;
		$data['berita_count'] = $this->Model->get_penulis_berita_count($penulis_id);
		$data['penulis_berita'] = $this->Model->penulis_berita($id)->row();
		$data['penulis_berita_en'] = $this->Model->penulis_berita_en($id)->row();
		$data['produsen_produk'] = $this->Model->produsen_produk($id)->row();
		// $data['penulis_wisata_en'] = $this->Model->penulis_wisata_en($id)->row();
		$data['penulis_wisata'] = $this->Model->penulis_wisata($id)->row();
		$data['detail_produk'] = $this->Model->produk($id)->row();
		$data['detail_wisata'] = $this->Model->wisata($id)->row();
		// $penulis_id = $this->Model->berita($id)->row()->penulis_id;
		// $data['berita_count'] = $this->Model->get_penulis_berita_count($penulis_id);
		// $data['wisata_count'] = $this->Model->get_penulis_wisata_count($penulis_id);

		$id_produsen = $this->Model->produsen_produk($id)->row()->id_produsen;

		$data['produk_count'] = $this->Model->get_produsen_produk_count($id_produsen);
		$data['data_komentar'] = $this->Model->komentarprodukShowFirst($id)->result_array();

		if ($this->session->userdata('current_language') == 'english') {
			$komentar = $this->Model->komentar_en($id);
			$a = "Value rating his stil empty";
		} else {
			$komentar = $this->Model->komentarproduk($id);
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
		$this->load->view('single_produk', $data);

		$data_footer['menu_kategori'] = $this->Model->menu_kategori()->result_array();

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

	public function detail_produsen($id = null)
	{
		$data_header['menu_produk'] = $this->Model->menu_produk()->result_array();
		$data_header['menu_kategori'] = $this->Model->menu_kategori()->result_array();
		$this->load->view('headerproduk', $data_header);

		$param = $this->uri->segment(2);

		$title = str_replace("-", " ", $param);
		$id = $this->Model->get_data_from_name_produk('produsen', $title)->row();
		$id = $id->id_produsen;
		// var_dump($id); die;

		$data['nama_produk'] = $this->Model->tampilpro($id)->row();

		$data['wisata_en'] = $this->Model->tampil_en($id)->result_array();

		$total_data = $this->Model->get_allpro()->num_rows();
		$data['total_data'] = ceil($total_data / 8);
		$data['jenis'] = null;
		$data['nama_produsen'] = $this->Model->produsen($id)->row()->nama_produsen;
		$data['tahun_gabung'] = $this->Model->produsen($id)->row()->tgl_bergabung;
		$data['deskripsi_produsen'] = $this->Model->produsen($id)->row()->produsen_deskripsi;
		$config = array();
		$config['base_url'] = site_url("Produsen-produk/" . $param);
		$config['total_rows'] = $this->Model->tampilprodukprodusen_count($id, null)->num_rows();
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
		$data['produk'] = $this->Model->tampilprodukprodusen($id, null, $config['per_page'], $data['page'])->result_array();
		// var_dump($data['page']);die;
		$data['halaman'] = $this->pagination->create_links();
		$this->load->view("single_produsen_produk", $data);

		$data_footer['menu_kategori'] = $this->Model->menu_kategori()->result_array();
		$data_footer['menu_produk'] = $this->Model->menu_produk()->result_array();

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

	function tag_produk()
	{

		$data_header['menu_kategori'] = $this->Model->menu_kategori()->result_array();
		$data_header['menu_produk'] = $this->Model->menu_produk()->result_array();
		$data_header['tag_produk'] = $this->uri->segment(3);
		$this->load->view('headerproduk', $data_header);

		$like      = '';
		$id = $this->uri->segment(3);
		$like = "(tag_produk LIKE '%$id%')";
		$config = array();
		$config['base_url'] = site_url("Produk/tag_produk/$id");
		$config['total_rows'] = $this->Model->tag_produk_count($like);
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
		$data['produk'] = $this->Model->tampilpro(4, $id)->row();
		$data['wisata_en'] = $this->Model->tampil_en(4, $id)->row();
		$data['page'] = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
		$data['tag_produk'] = $this->Model->tag_produk($config['per_page'], $data['page'], $like);
		$data['halaman'] = $this->pagination->create_links();

		//$data['tag']  = $this->Model->tampil_wisata()->result_array();
		$this->load->view('tag_produk', $data);

		$data_footer['menu_kategori'] = $this->Model->menu_kategori()->result_array();
		$data_footer['menu_produk'] = $this->Model->menu_produk()->result_array();


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


	function search_produk()
	{

		$search = ($this->input->post("cari")) ? $this->input->post("cari") : "NIL";
		$search = ($this->uri->segment(3)) ? $this->uri->segment(3) : $search;
		$data_header['title'] = "Produk Dengan Kata Kunci \"" . $search . "\" | BeautyOfIndonesia.com";
		$data_header['menu_kategori'] = $this->Model->menu_kategori()->result_array();
		$data_header['menu_produk'] = $this->Model->menu_produk()->result_array();
		$this->load->view('headerproduk', $data_header);
		// pagination settings
		$config = array();
		$config['base_url'] = site_url("Produk/Kata-Kunci/" . $search);
		$config['total_rows'] = $this->Model->get_produk_count($search);
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
		$data['query'] = $this->Model->get_produk($config['per_page'], $data['page'], $search);
		$data['query_en'] = $this->Model->get_wisata_en($config['per_page'], $data['page'], $search);

		$data['halaman'] = $this->pagination->create_links();

		// var_dump($data['halaman']);die;

		$this->load->view('result_produk', $data);

		$data_footer['menu_kategori'] = $this->Model->menu_kategori()->result_array();
		$data_footer['menu_produk'] = $this->Model->menu_produk()->result_array();

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

	function tambah_ratingproduk()
	{
		$date = date('Y-m-d');
		$ip = $this->input->post('komentar_ip');
		$link = base_url('Produk');
		$key = $this->input->post('id_produk');
		$title = str_replace("-", " ", $key);
		$datapro = $this->Model->get_data_from_namepdk('produk', $title)->row();
		$idpdk = $datapro->id_produk;
		$provpro = $datapro->nama_provinsi;
		$kotapro = $datapro->nama_kota;
		$proktgr = $datapro->nama_kategori;
		$linkinto = base_url() . 'Produk/' .  'detail/' . url_title($provpro, "dash", false) . '/' . url_title($kotapro, "dash", false) . '/' . url_title($title, "dash", false);

		// var_dump($idwisnya);die;
		$query = $this->db->query('SELECT count(*) as jml_ada FROM komentar WHERE 
											komentar_ip="' . $ip . '" AND komentar_tgl="' . $date . '" AND id_produk="' . $idpdk . '" ');


		$ratnya = $this->input->post('rating', true);
		$namas = $this->input->post('nama', true);
		$emails = $this->input->post('email', true);
		$websites = $this->input->post('website', true);
		$comment = $this->input->post('komentar_deskripsi', true);
		$komens = $this->security->xss_clean($comment);
		// var_dump($komens); die;

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
							'komentar_deskripsi' => $komens,
							'id_produk' => $idpdk,
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

	function loadMoreKomentar()
	{
		$row = $this->input->post('row', true);
		$idkomenpro = $this->input->post('idkomenpro', true);

		// var_dump($idkomenwis);die;

		$rowperpage = 3;

		$queryloadkomentar = 'select * from komentar where id_produk =' . $idkomenpro . ' order by komentar_tgl DESC limit ' . $row . ',' . $rowperpage;
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
}
