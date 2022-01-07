<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Wisata extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->model('Model');
	}

	function index($id = null)
	{
		$data_header['menu_kategori'] = $this->Model->menu_kategori()->result_array();
		$data_header['menu_produk'] = $this->Model->menu_produk()->result_array();
		$this->load->view('headerwisata', $data_header);

		$jml = $this->Model->wisata();
		$config['base_url'] = base_url() . 'Wisata/index';
		$config['total_rows'] = $jml->num_rows();
		$config['per_page'] = '5';
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
		$data['query'] = $this->Model->ambil_wisata($config['per_page'], $id);
		$this->load->view('wisata_list', $data);

		$data_footer['menu_kategori'] = $this->Model->menu_kategori()->result_array();
		$data_footer['wahana']	= $this->Model->menu_wahana()->result_array();
		$this->load->view('footer', $data_footer);
	}

	function wisata($id)
	{
		$data_header['menu_kategori'] = $this->Model->menu_kategori()->result_array();

		$data['wisata_nama'] = $this->Model->tampil($id)->row();
		$data['wisata'] = $this->Model->tampil($id)->result_array();
		//print_r($this->db->last_query());
		$this->load->view('headerwisata', $data_header);
		$this->load->view('wisata', $data);

		$data_footer['menu_kategori'] = $this->Model->menu_kategori()->result_array();
		$data_footer['wahana']	= $this->Model->menu_wahana()->result_array();
		$this->load->view('footer', $data_footer);
	}

	public function detail_wisata($id)
	{
		$this->Model->wisata_baca($id);
		$data_header['menu_kategori'] = $this->Model->menu_kategori()->result_array();
		$this->load->view('headerwisata', $data_header);

		$data['wisata'] = $this->Model->tampil(4, $id)->row();
		$data['wahana'] = $this->Model->tampil_wahana(4, $id)->result_array();
		$data['sliders'] = $this->Model->tampil_wisata(4, $id)->result_array();
		$data['foto'] = $this->Model->tampil(4, $id)->result_array();
		$data['populer'] = $this->Model->populer_wisata(10)->result_array();
		$this->load->view('single_wisata', $data);

		$data_footer['menu_kategori'] = $this->Model->menu_kategori()->result_array();
		$data_footer['wahana']	= $this->Model->menu_wahana()->result_array();
		$this->load->view('footer', $data_footer);
	}

	function search_wisata()
	{
		$data_header['menu_kategori'] = $this->Model->menu_kategori()->result_array();
		$this->load->view('headerwisata', $data_header);

		$dari      = $this->uri->segment(4);

		$sampai = 4;

		$search = (trim($this->input->post('cari', true))) ? trim($this->input->post('cari', true)) : '';

		$search = ($this->uri->segment(3)) ? $this->uri->segment(3) : $search;

		$like      = '';

		//mengisi nilai variabel $like dengan variabel $search, digunakan sebagai kondisi untuk menampilkan data
		if ($search) $like = "(wisata_nama LIKE '%$search%')";

		$jumlah = $this->Model->jumlah_wisata($like);

		$batas = 3; //jlh data yang ditampilkan per halaman

		$config['page_query_string'] = TRUE; //mengaktifkan pengambilan method get pada url default
		$config['base_url'] = base_url() . 'Wisata/search_wisata/' . $search;
		$config['total_rows'] = $jumlah; // jlh total barang
		$config['per_page'] = $sampai; //batas sesuai dengan variabel batas
		$config['num_links'] = $jumlah;
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

		$data = array();

		//ambil data buku dari database
		$data['query'] = $this->Model->lihat_wisata($sampai, $dari, $like);

		//Membuat link
		$str_links = $this->pagination->create_links();
		$data["links"] = explode('&nbsp;', $str_links);

		$this->load->view('result_wisata', $data);

		$data_footer['menu_kategori'] = $this->Model->menu_kategori()->result_array();
		$data_footer['wahana']	= $this->Model->menu_wahana()->result_array();
		$this->load->view('footer', $data_footer);
	}
}
