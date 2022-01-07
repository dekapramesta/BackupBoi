<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller
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

	public function index($id = NULL)
	{
		$data_header['menu_produk'] = $this->Model->menu_produk()->result_array();
		$data_header['title'] = $this->Model->tampil_setup()->row()->wisata_nama;
		$data_header['menu_kategori'] = $this->Model->menu_kategori()->result_array();
		$this->load->view('header', $data_header);

		$data['tampil_slider'] = $this->Model->tampil_slider()->result_array();
		$data['tampil_slider_en'] = $this->Model->tampil_slider_en()->result_array();

		$data['home'] 	   = $this->Model->tampil_setup()->result_array();
		$data['home_en'] 	   = $this->Model->tampil_en_setup()->result_array();
		if ($this->session->userdata('current_language') == 'english') {
			$data['kategori'] = $this->Model->berita_en()->result_array();
		} else {
			$data['kategori'] = $this->Model->berita()->result_array();
		}
		// $data['kategori'] = $this->Model->berita()->result_array();
		$data['foto_wisata'] = $this->Model->foto(2)->result_array();
		$data['terbaru'] = $this->Model->post_berita(2)->result_array();
		$data['tahun']	 = $this->Model->sitemap()->result_array();

		$jml = $this->Model->berita();

		$config['base_url'] = base_url() . 'Berita/index/';
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
		$this->db->where('fc_kode', '1');
		$this->db->where('fc_param', 'JUDUL');
		$data['judul_icon'] = $this->db->get('t_setup')->row();

		$this->db->select('bulan');
		$this->db->select('nilai');
		$this->db->where('kode', '0');
		$this->db->where('tahun', date('Y'));
		$data['grafik_lokal'] = $this->db->get('grafik')->result_array();

		$this->db->select('bulan');
		$this->db->select('nilai');
		$this->db->where('kode', '1');
		$this->db->where('tahun', date('Y'));
		$data['grafik_inter'] = $this->db->get('grafik')->result_array();

		$this->db->select('SUM(nilai) as sum_lokal');
		$this->db->where('kode', '0');
		$this->db->where('tahun', date('Y'));
		$data['grafik_sumlokal'] = $this->db->get('grafik')->row();

		$this->db->select('SUM(nilai) as sum_inter');
		$this->db->where('kode', '1');
		$this->db->where('tahun', date('Y'));
		$data['grafik_suminter'] = $this->db->get('grafik')->row();

		$this->db->where('info_tahun', date('Y'));
		$data['grafik_pendapatan'] = $this->db->get('info')->row();

		$this->load->view('index', $data);

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

	public function info()
	{
		$data_header['menu_produk'] = $this->Model->menu_produk()->result_array();
		$data['tampil_slider'] = $this->Model->tampil_slider()->result_array();
		$data['info'] = $this->Model->info()->row();

		$data_header['menu_kategori'] = $this->Model->menu_kategori()->result_array();
		$this->load->view('headerinfo', $data_header);
		$this->load->view('info', $data);

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
		$this->load->view('footer', $data_footer);

		$this->db2->where('fc_kode', '1');
		$this->db2->where('fc_param', 'SEKILAS');
		$data_footer['sekilas_icon_en'] = $this->db2->get('t_setup')->row();
	}


	function foto()
	{
		$data_header['menu_produk'] = $this->Model->menu_produk()->result_array();
		$data_header['menu_kategori'] = $this->Model->menu_kategori()->result_array();
		$data['foto'] = $this->Model->foto()->result_array();
		$this->load->view('headerfoto', $data_header);
		$this->load->view('foto', $data);

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
		$this->load->view('footer', $data_footer);

		$this->db2->where('fc_kode', '1');
		$this->db2->where('fc_param', 'SEKILAS');
		$data_footer['sekilas_icon_en'] = $this->db2->get('t_setup')->row();
	}

	function komentar()
	{
		$data_header['menu_produk'] = $this->Model->menu_produk()->result_array();
		$data_header['menu_kategori'] = $this->Model->menu_kategori()->result_array();
		$this->load->view('headerkomentar', $data_header);

		$this->load->view('komentar', $data);

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
		$this->load->view('footer', $data_footer);

		$this->db2->where('fc_kode', '1');
		$this->db2->where('fc_param', 'SEKILAS');
		$data_footer['sekilas_icon_en'] = $this->db2->get('t_setup')->row();
	}

	function simpan_komentar()
	{
		$data['komentar_ip'] 		   = $_SERVER["REMOTE_ADDR"];
		$data['komentar_deskripsi']    = $this->input->post('komentar_deskripsi');
		$data['komentar_tgl'] 		   = date('Y-m-d');
		$data['komentar_nilai_string'] = $this->input->post('komentar_nilai_string');
		$data['wisata_id'] 			   = $this->input->post('wisata_id');
		$this->Model->simpan_komentar($data);
		redirect(base_url('Home/komentar'));
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */