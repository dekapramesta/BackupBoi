<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Berita extends CI_Controller
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
		$this->output->set_header('Cache-Control: no-cache, must-revalidate, max-age=0');
		$this->output->set_header('Cache-Control: post-check=0, pre-check=0', false);

		$this->output->set_header('Pragma: no-cache');

		$this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');

		$this->output->set_header('Pragma: no-cache');
		$this->output->set_header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
		date_default_timezone_set("Asia/Jakarta");
	}

	public function detail_berita($id)
	{
		$linkslug = $this->uri->segment(2);
		// var_dump($linkslug);die;
		$title = str_replace("-", " ", $linkslug);
		// var_dump($title);die;
		$id = $this->input->post('id_artikel');
		if ($id != null) {
			// session_start();
			$_SESSION["id_artikel"] = $id;
		} else {
			$id = $_SESSION["id_artikel"];
		}
		$data_header['title'] = $this->Model->berita($id)->row()->berita_judul;
		$data_header['menu_kategori'] = $this->Model->menu_kategori()->result_array();
		$data_header['menu_produk'] = $this->Model->menu_produk()->result_array();
		$this->load->view('headerberita', $data_header);
		$data['penulis_berita'] = $this->Model->penulis_berita($id)->row();
		$data['penulis_berita_en'] = $this->Model->penulis_berita_en($id)->row();
		$data['penulis_wisata'] = $this->Model->penulis_wisata($id)->row();
		$data['penulis_wisata_en'] = $this->Model->penulis_wisata_en($id)->row();
		$penulis_id = $this->Model->berita($id)->row()->penulis_id;
		$data['berita_count'] = $this->Model->get_penulis_berita_count($penulis_id);
		$data['wisata_count'] = $this->Model->get_penulis_wisata_count($penulis_id);
		$data['tampil_slider'] = $this->Model->tampil_slider()->result_array();
		$data['detail'] = $this->Model->berita($id)->result_array();
		$data['detail_berita'] = $this->Model->berita($id)->row();
		$data['detail_en'] = $this->Model->berita_en($id)->result_array();
		$data['detail_berita_en'] = $this->Model->berita_en($id)->row();
		$data['kategori'] = $this->Model->berita()->result_array();
		$data['tahun']	 = $this->Model->sitemap()->result_array();
		$data['artikel_lain'] = $this->Model->berita_artikel()->result();
		// var_dump($data['detail_berita']);die;
		$this->load->view('single_berita', $data);

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
	public function detail_penulis($id)
	{
		$data_header['menu_produk'] = $this->Model->menu_produk()->result_array();
		$param = $this->uri->segment(2);

		$title = str_replace("-", " ", $param);
		$id = $this->Model->get_data_from_name_writer('penulis', $title)->row();
		$id = $id->penulis_id;
		//$id = $this->input->post('penulis_id', true);
		// var_dump($id);
		// die;
		// $penulis_nama = $this->Model->penulis_berita($id)->row()->_berita_nama;
		// $penulis_tahun_bergabung = $this->Model->penulis_berita($id)->row()->penulis_tahun_bergabung;
		// $penulis_profesi = $this->Model->penulis_berita($id)->row()->penulis_profesi;
		// $penulis_deskripsi = $this->Model->penulis_berita($id)->row()->penulis_deskripsi;
		// $data['penulis_nama'] = $this->Model->ambil_berita_penulisku($penulis_nama);
		// $data['tahun_gabung'] = $this->Model->ambil_berita_penulisku($penulis_tahun_bergabung);
		// $data['profesi'] = $this->Model->ambil_berita_penulisku($penulis_profesi);
		// $data['deskripsi_penulis'] = $this->Model->ambil_berita_penulisku($penulis_deskripsi);

		$data['penulis'] = $this->Model->penulis($id)->row();
		// var_dump($data['penulis']);
		// die;
		// $data['tahun_gabung'] = $this->Model->penulis($id)->row()->penulis_tahun_bergabung;
		// $data['profesi'] = $this->Model->penulis($id)->row()->penulis_profesi;
		// $data['deskripsi_penulis'] = $this->Model->penulis($id)->row()->penulis_deskripsi;

		$data['tampil_slider'] = $this->Model->tampil_slider()->result_array();
		$data['berita'] = $this->Model->berita()->result_array();

		$data_header['menu_kategori'] = $this->Model->menu_kategori()->result_array();
		$this->load->view('headerberita', $data_header);
		$jml = $this->Model->berita();

		$config['base_url'] = base_url() . 'Berita/detail_penulis';
		$config['total_rows'] = $jml->num_rows();
		$config['per_page'] = '0';
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

		//inisialisasi config
		$this->pagination->initialize($config);

		//buat pagination
		$data['halaman'] = $this->pagination->create_links();

		//tamplikan data
		$data['query'] = $this->Model->ambil_berita_penulisku($id);
		//$data['query'] = $this->Model->ambil_berita($config['per_page'], $id);
		$data['query2'] = $this->Model->ambil_berita_penulisku($id);
		if ($this->session->userdata('current_language') == 'english') {
			$data['kategori'] = $this->Model->berita_en()->result_array();
		} else {
			$data['kategori'] = $this->Model->berita()->result_array();
		}
		// $data['kategori'] = $this->Model->berita()->result_array();
		$data['terbaru'] = $this->Model->post_berita(2)->result_array();
		$data['tahun']	 = $this->Model->sitemap()->result_array();
		$this->db->where('fc_kode', '2');
		$this->db->where('fc_param', 'HEADER');
		$data['bg_icon'] = $this->db->get('t_setup')->row();
		//$data['penulis'] = $this->Model->penulis($id);
		$this->load->view('single_penulis', $data);

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

	public function index($id = NULL)
	{
		$data_header['menu_produk'] = $this->Model->menu_produk()->result_array();
		$data['tampil_slider'] = $this->Model->tampil_slider()->result_array();
		$data['berita'] = $this->Model->berita()->result_array();

		$data_header['menu_kategori'] = $this->Model->menu_kategori()->result_array();
		$this->load->view('headerberita', $data_header);
		$jml = $this->Model->berita();

		$config['base_url'] = base_url() . 'Berita/index';
		$config['total_rows'] = $jml->num_rows();
		$config['per_page'] = '2';
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

		//inisialisasi config
		$this->pagination->initialize($config);

		//buat pagination
		$data['halaman'] = $this->pagination->create_links();

		//tamplikan data
		$data['query'] = $this->Model->ambil_berita($config['per_page'], $id);
		$data['query2'] = $this->Model->ambil_berita_en($config['per_page'], $id);
		if ($this->session->userdata('current_language') == 'english') {
			$data['kategori'] = $this->Model->berita_en()->result_array();
		} else {
			$data['kategori'] = $this->Model->berita()->result_array();
		}
		// $data['kategori'] = $this->Model->berita()->result_array();
		$data['terbaru'] = $this->Model->post_berita(2)->result_array();
		$data['tahun']	 = $this->Model->sitemap()->result_array();
		$this->db->where('fc_kode', '2');
		$this->db->where('fc_param', 'HEADER');
		$data['bg_icon'] = $this->db->get('t_setup')->row();
		$this->load->view('berita', $data);

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

	function search()
	{
		$data_header['menu_produk'] = $this->Model->menu_produk()->result_array();
		$search = ($this->input->post("cari")) ? $this->input->post("cari") : "NIL";
		$search = ($this->uri->segment(3)) ? $this->uri->segment(3) : $search;
		$data_header['title'] = "Artikel Dengan Kata Kunci \"" . $search . "\" | BeautyOfIndonesia.com";
		$data_header['menu_kategori'] = $this->Model->menu_kategori()->result_array();
		$this->load->view('headerberita', $data_header);



		// pagination settings
		$config = array();
		$config['base_url'] = site_url("Berita/search/$search");
		$config['total_rows'] = $this->Model->get_berita_count($search);
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
		// get books list
		$data['query'] = $this->Model->get_berita($config['per_page'], $data['page'], $search);
		$data['query_en'] = $this->Model->get_berita_en($config['per_page'], $data['page'], $search);

		$data['halaman'] = $this->pagination->create_links();

		$data['kategori'] = $this->Model->berita(5, $search)->row();
		$data['tahun']	 = $this->Model->sitemap()->result_array();
		$data['kata_kunci'] = $this->uri->segment(3);
		$this->load->view('result', $data);

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

	function tag_berita()
	{
		$data_header['menu_produk'] = $this->Model->menu_produk()->result_array();

		$data_header['menu_kategori'] = $this->Model->menu_kategori()->result_array();
		$data_header['tag_artikel'] = $this->uri->segment(3);
		$this->load->view('headerberita', $data_header);

		$search = $this->uri->segment(3);

		$search = ($this->uri->segment(3)) ? $this->uri->segment(3) : $search;

		// pagination settings
		$config = array();
		$config['base_url'] = site_url("Artikel/tag_berita/$search");
		$config['total_rows'] = $this->Model->get_tag_berita_count($search);
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
		// get books list
		$data['tag_berita'] = $this->Model->get_tag_berita($config['per_page'], $data['page'], $search);
		$data['tag_berita_en'] = $this->Model->get_tag_berita_en($config['per_page'], $data['page'], $search);

		$data['halaman'] = $this->pagination->create_links();
		if ($this->session->userdata('current_language') == 'english') {
			$data['kategori'] = $this->Model->berita_en()->row();
		} else {
			$data['kategori'] = $this->Model->berita(5, $search)->row();
		}
		// $data['kategori'] = $this->Model->berita(5, $search)->row();
		$data['tahun']	 = $this->Model->sitemap()->result_array();
		$data['namatag'] = $this->uri->segment(3);
		$this->load->view('tag_berita', $data);

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

	function berita_thn()
	{
		$data_header['menu_produk'] = $this->Model->menu_produk()->result_array();
		$data_header['menu_kategori'] = $this->Model->menu_kategori()->result_array();
		$data_header['tahun'] = $this->uri->segment(2);
		$data_header['bulan'] = $this->uri->segment(3);
		$this->load->view('headerberita', $data_header);

		$search = $this->uri->segment(3);
		$search = ($this->uri->segment(3)) ? $this->uri->segment(3) : $search;

		// pagination settings
		$config = array();
		$config['base_url'] = site_url("Berita/berita_thn/$search");
		$config['total_rows'] = $this->Model->get_thn_berita_count($search);
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
		// get books list
		$data['berita_thn'] = $this->Model->get_thn_berita($config['per_page'], $data['page'], $search);
		$data['berita_thn_en'] = $this->Model->get_thn_berita_en($config['per_page'], $data['page'], $search);

		$data['halaman'] = $this->pagination->create_links();

		$data['kategori']  = $this->Model->menu_kategori()->result_array();
		$data['tahun']	 = $this->Model->sitemap()->result_array();
		$data['kategori'] = $this->Model->berita(5, $search)->row();
		$this->load->view('berita_thn', $data);

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
}
