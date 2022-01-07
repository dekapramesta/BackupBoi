<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Tentang extends CI_Controller
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
	}

	public function index()
	{
		$data_header['menu_kategori'] = $this->Model->menu_kategori()->result_array();
		$data_header['menu_produk'] = $this->Model->menu_produk()->result_array();
		$this->load->view('headertentang', $data_header);

		$data['tentang'] = $this->Model->tentang()->row();
		$data['tentang_en'] = $this->Model->tentang_en()->row();
		$this->db->where('fc_kode', '3');
		$this->db->where('fc_param', 'HEADER');
		$data['bg_icon'] = $this->db->get('t_setup')->row();
		$this->load->view('tentang', $data);

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
