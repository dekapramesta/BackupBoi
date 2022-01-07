<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Event extends CI_Controller {

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
	
	function coba(){
		echo 'halo';
	}

	public function index($id=NULL){
		$data['tampil_slider'] = $this->Model->tampil_slider()->result_array();
		$data['event'] = $this->Model->event()->result_array();
		
		$data_header['menu_kategori'] = $this->Model->menu_kategori()->result_array();
		$this->load->view('headerevent', $data_header);
		$jml = $this->Model->event();
		
		$config['base_url'] = base_url().'Event/index';
		$config['total_rows'] = $jml->num_rows();
		$config['per_page'] = '3';
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
		$data['query'] = $this->Model->ambil_event($config['per_page'], $id);
		$data['query_en'] = $this->Model->ambil_event_en($config['per_page'], $id);
		$data['terbaru'] = $this->Model->post_baru(2)->result_array();
		$data['kategori']  = $this->Model->menu_kategori()->result_array();
		// $data['tag']  = $this->Model->event()->result_array();
		$data['halaman'] = $this->pagination->create_links();
			if ($this->session->userdata('current_language')=='english'){ 
				// $data['kategori'] = $this->Model->event_en(5)->result_array();	
				$data['tag']  = $this->Model->event_en()->result_array();
			}else{ 
				// $data['kategori'] = $this->Model->event(5)->result_array();	
				$data['tag']  = $this->Model->event()->result_array();
			}
		$data['tahun_event']	 = $this->Model->sitemap_event()->result_array();	
		$this->db->where('fc_kode', '1');
		$this->db->where('fc_param', 'HEADER');
		$data['bg_icon'] = $this->db->get('t_setup')->row();
		$this->load->view('event', $data);
		
		
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
	
	public function event_detail($id){
		$data_header['menu_kategori'] = $this->Model->menu_kategori()->result_array();
		$this->load->view('headerevent', $data_header);
		
		$data['tampil_slider'] = $this->Model->tampil_slider()->result_array();
		$data['detail_event'] = $this->Model->event($id)->row();
		$data['detail_event_en'] = $this->Model->event_en($id)->row();
		// $data['tag']  = $this->Model->event()->result_array();
		$data['halaman'] = $this->pagination->create_links();
			if ($this->session->userdata('current_language')=='english'){ 
				// $data['kategori'] = $this->Model->event_en(5)->result_array();	
				$data['tag']  = $this->Model->event_en()->result_array();
			}else{ 
				// $data['kategori'] = $this->Model->event(5)->result_array();	
				$data['tag']  = $this->Model->event()->result_array();
			}
		$data['tahun_event']	 = $this->Model->sitemap_event()->result_array();
		$this->load->view('single_event', $data);
		
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
	
	function event_thn($id){
		$data_header['menu_kategori'] = $this->Model->menu_kategori()->result_array();
		$this->load->view('headerevent', $data_header);
		
		$search = $this->uri->segment(3);

        $search = ($this->uri->segment(3)) ? $this->uri->segment(3) : $search;

        // pagination settings
        $config = array();
        $config['base_url'] = site_url("Event/event_thn/$search");
        $config['total_rows'] = $this->Model->get_thn_event_count($search);
        $config['per_page'] = "2";
        $config["uri_segment"] = 4;
        $choice = $config["total_rows"]/$config["per_page"];
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
        $data['event_thn'] = $this->Model->get_thn_event($config['per_page'], $data['page'], $search);
		$data['event_thn_en'] = $this->Model->get_thn_event_en($config['per_page'], $data['page'], $search);

        $data['halaman'] = $this->pagination->create_links();
		
		$data['kategori']  = $this->Model->menu_kategori()->result_array();
		$data['tampil_slider'] = $this->Model->tampil_slider()->result_array();
		$data['tahun_event']	 = $this->Model->sitemap_event()->result_array();	
		// $data['tag']  = $this->Model->event(5, $search)->result_array();
			if ($this->session->userdata('current_language')=='english'){ 
				// $data['kategori'] = $this->Model->event_en(5)->result_array();	
				$data['tag']  = $this->Model->event_en(5, $search)->result_array();
			}else{ 
				// $data['kategori'] = $this->Model->event(5)->result_array();	
				$data['tag']  = $this->Model->event(5, $search)->result_array();
			}
		$data['halaman'] = $this->pagination->create_links();
		$this->load->view('event_thn', $data);
		
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
	
	function search_event()
    {
		$data_header['menu_kategori'] = $this->Model->menu_kategori()->result_array();
		$this->load->view('headerevent', $data_header);
		
        $search = ($this->input->post("cari"))? $this->input->post("cari") : "NIL";

        $search = ($this->uri->segment(3)) ? $this->uri->segment(3) : $search;

        // pagination settings
        $config = array();
        $config['base_url'] = site_url("Event/search_event/$search");
        $config['total_rows'] = $this->Model->get_event_count($search);
        $config['per_page'] = "2";
        $config["uri_segment"] = 4;
        $choice = $config["total_rows"]/$config["per_page"];
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
        $data['query'] = $this->Model->get_event($config['per_page'], $data['page'], $search);
		$data['query_en'] = $this->Model->get_event_en($config['per_page'], $data['page'], $search);

        $data['halaman'] = $this->pagination->create_links();
		
		$data['kategori']  = $this->Model->menu_kategori()->result_array();
		// $data['tag']  = $this->Model->event(5, $search)->result_array();
			if ($this->session->userdata('current_language')=='english'){ 
				// $data['kategori'] = $this->Model->event_en(5)->result_array();	
				$data['tag']  = $this->Model->event_en(5, $search)->result_array();
			}else{ 
				// $data['kategori'] = $this->Model->event(5)->result_array();	
				$data['tag']  = $this->Model->event(5, $search)->result_array();
			}
		$data['tahun_event']	 = $this->Model->sitemap_event()->result_array();
        $this->load->view('result_event',$data);
		
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
	
	function tag_event(){
		
		$data_header['menu_kategori'] = $this->Model->menu_kategori()->result_array();
		$this->load->view('headerevent', $data_header);
		
		$search = $this->uri->segment(3);

        $search = ($this->uri->segment(3)) ? $this->uri->segment(3) : $search;

        // pagination settings
        $config = array();
        $config['base_url'] = site_url("Event/tag_event/$search");
        $config['total_rows'] = $this->Model->get_tag_event_count($search);
        $config['per_page'] = "2";
        $config["uri_segment"] = 4;
        $choice = $config["total_rows"]/$config["per_page"];
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
        $data['tag_event'] = $this->Model->get_tag_event($config['per_page'], $data['page'], $search);
		$data['tag_event_en'] = $this->Model->get_tag_event_en($config['per_page'], $data['page'], $search);

        $data['halaman'] = $this->pagination->create_links();
			if ($this->session->userdata('current_language')=='english'){ 
				$data['kategori'] = $this->Model->event_en(5)->result_array();	
				$data['tag']  = $this->Model->event_en()->result_array();
			}else{ 
				$data['kategori'] = $this->Model->event(5)->result_array();	
				$data['tag']  = $this->Model->event()->result_array();
			}
		
		$data['tahun']	 = $this->Model->sitemap_event()->result_array();	
		$data['tahun_event']	 = $this->Model->sitemap_event()->result_array();
		$this->load->view('tag_event', $data);
		
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