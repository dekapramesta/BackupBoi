<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Model extends CI_Model
{

	private $db2;
	private $blog_vote = 'komentar';

	public function __construct()
	{
		parent::__construct();
		$this->db2 = $this->load->database('pariwisata_en', TRUE);
	}

	public function menu_kategori()
	{
		return $this->db->get('kategori');
	}
	public function menu_produk()
	{
		return $this->db->get('kategori_produk');
	}
	public function berita_artikel()
	{
		$this->db->from('berita');
		$this->db->order_by("RAND()");
		$this->db->limit(2);
		return $this->db->get();
	}
	public function wisata_lain($kota)
	{

		return $this->db->where('nama_kota_kabupaten', $kota)->from('wisata')->limit(10)->order_by('RAND()')->join('kategori', 'kategori.kategori_id=wisata.kategori_id', 'left outer')->get();
	}

	public function produk_lain($kota)
	{

		return $this->db->where('nama_kota', $kota)->from('produk')->limit(10)->order_by('RAND()')->join('kategori_produk', 'kategori_produk.id_kategori_produk=produk.id_kategori_produk', 'left outer')->get();
	}

	public function produk_wisata($kota)
	{

		return $this->db->where('nama_kota', $kota)->from('produk')->limit(10)->order_by('RAND()')->get();
	}
	public function komentarShowFirst($id = null)
	{

		$query = "select * from komentar where wisata_id = " . $id . " order by komentar_tgl DESC limit 0,3";
		return $this->db->query($query);
	}

	public function komentarprodukShowFirst($id = null)
	{

		$query = "select * from komentar where id_produk = " . $id . " order by komentar_tgl DESC limit 0,3";
		return $this->db->query($query);
	}
	public function menu_wahana()
	{
		return $this->db->get('wahana');
	}

	public function tampil_slider()
	{
		$this->db->from('event');
		$this->db->limit(5);
		return $this->db->get();
	}

	public function tampil_slider_en()
	{
		$this->db2->from('event');
		$this->db2->limit(5);
		return $this->db2->get();
	}
	public function tampilproduk($id, $start, $limit, $status = null)
	{
		if ($id == null) {
		} else {
			if ($status == null) {
				$this->db->where('kategori_produk.nama_kategori', $id);
			} else {
				$this->db->where('produk.id_produk', $status);

				$this->db->order_by('kategori_produk.id_kategori_produk', 'DESC');
				$this->db->select('produk.*, kategori_produk.*');
				$this->db->from('produk');

				return $this->db->get();
			}
		}

		$this->db->order_by('kategori_produk.id_kategori_produk', 'DESC');
		$this->db->group_by('produk.id_produk');
		$this->db->select('produk.*, kategori_produk.*, foto_produk.*');
		$this->db->from('produk');
		$this->db->join('kategori_produk', 'kategori_produk.id_kategori_produk=produk.id_kategori_produk', 'left outer');
		$this->db->join('foto_produk', 'foto_produk.id_produk=produk.id_produk', 'left outer');
		$this->db->limit($limit, $start);
		return $this->db->get();
	}
	public function tampilwisata($id = null, $status = null, $limit = null, $start = null)
	{
		if ($limit != null) {
			$this->db->limit($limit, $start);
		}
		if ($id == null) {
		} else {
			if ($status == null) {
				$this->db->where('kategori.kategori_nama', $id);
			} else {
				$this->db->where('wisata.wisata_id', $status);
				$this->db->where('wisata_berfasilitas.wistas_status', 'Y');
				$this->db->order_by('kategori.kategori_id', 'DESC');
				$this->db->select('wisata.*, kategori.*,wisata_berfasilitas.wistas_id, wisata_berfasilitas.wisata_id as wisata2, wisata_berfasilitas.faswis_id as faswis1 , wisata_berfasilitas.wistas_status,
								fasilitas_wisata.*
								');
				$this->db->from('wisata');
				$this->db->join('wisata_berfasilitas', 'wisata_berfasilitas.wisata_id=wisata.wisata_id', 'left outer');
				$this->db->join('fasilitas_wisata', 'fasilitas_wisata.faswis_id=wisata_berfasilitas.faswis_id', 'left outer');
				return $this->db->get();
			}
		}

		$this->db->order_by('kategori.kategori_id', 'DESC');
		$this->db->group_by('wisata.wisata_id');
		$this->db->select('wisata.*, kategori.*, foto.wisata_id as wisata4, foto.url_file_foto, foto.foto_id');
		$this->db->from('wisata');
		$this->db->join('kategori', 'kategori.kategori_id=wisata.kategori_id', 'left outer');
		$this->db->join('foto', 'foto.wisata_id=wisata.wisata_id', 'left outer');
		return $this->db->get();
	}
	public function tampilwisatapenulis($id = null, $status = null, $limit = null, $start = null)
	{
		if ($limit != null) {
			$this->db->limit($limit, $start);
		}
		if ($id == null) {
		} else {
			if ($status == null) {
				$this->db->where('wisata.penulis_id', $id);
			} else {
				$this->db->where('wisata.wisata_id', $status);
				$this->db->where('wisata_berfasilitas.wistas_status', 'Y');
				$this->db->order_by('kategori.kategori_id', 'DESC');
				$this->db->select('wisata.*, kategori.*,wisata_berfasilitas.wistas_id, wisata_berfasilitas.wisata_id as wisata2, wisata_berfasilitas.faswis_id as faswis1 , wisata_berfasilitas.wistas_status,
								fasilitas_wisata.*
								');
				$this->db->from('wisata');
				$this->db->join('wisata_berfasilitas', 'wisata_berfasilitas.wisata_id=wisata.wisata_id', 'left outer');
				$this->db->join('fasilitas_wisata', 'fasilitas_wisata.faswis_id=wisata_berfasilitas.faswis_id', 'left outer');
				return $this->db->get();
			}
		}

		$this->db->order_by('kategori.kategori_id', 'DESC');
		$this->db->group_by('wisata.wisata_id');
		$this->db->select('wisata.*, kategori.*, foto.wisata_id as wisata4, foto.url_file_foto, foto.foto_id');
		$this->db->from('wisata');
		$this->db->join('kategori', 'kategori.kategori_id=wisata.kategori_id', 'left outer');
		$this->db->join('foto', 'foto.wisata_id=wisata.wisata_id', 'left outer');
		return $this->db->get();
	}


	public function tampilprodukprodusen($id = null, $status = null, $limit = null, $start = null)
	{
		if ($limit != null) {
			$this->db->limit($limit, $start);
		}
		if ($id == null) {
		} else {
			if ($status == null) {
				$this->db->where('produk.id_produsen', $id);
			} else {
			}
		}

		$this->db->order_by('kategori_produk.id_kategori_produk', 'DESC');
		$this->db->group_by('produk.id_produk');
		$this->db->select('produk.*, kategori_produk.*, foto_produk.id_produk as produk4, foto_produk.url_foto, foto_produk.id_foto');
		$this->db->from('produk');
		$this->db->join('kategori_produk', 'kategori_produk.id_kategori_produk=produk.id_kategori_produk', 'left outer');
		$this->db->join('foto_produk', 'foto_produk.id_produk=produk.id_produk', 'left outer');
		return $this->db->get();
	}

	public function tampilwisatapenulis_count($id = null, $status = null)
	{
		if ($id == null) {
		} else {
			if ($status == null) {
				$this->db->where('wisata.penulis_id', $id);
			} else {
				$this->db->where('wisata.wisata_id', $status);
				$this->db->where('wisata_berfasilitas.wistas_status', 'Y');
				$this->db->order_by('kategori.kategori_id', 'DESC');
				$this->db->select('wisata.*, kategori.*,wisata_berfasilitas.wistas_id, wisata_berfasilitas.wisata_id as wisata2, wisata_berfasilitas.faswis_id as faswis1 , wisata_berfasilitas.wistas_status,
								fasilitas_wisata.*
								');
				$this->db->from('wisata');
				$this->db->join('wisata_berfasilitas', 'wisata_berfasilitas.wisata_id=wisata.wisata_id', 'left outer');
				$this->db->join('fasilitas_wisata', 'fasilitas_wisata.faswis_id=wisata_berfasilitas.faswis_id', 'left outer');
				return $this->db->get();
			}
		}

		$this->db->order_by('kategori.kategori_id', 'DESC');
		$this->db->group_by('wisata.wisata_id');
		$this->db->select('wisata.*, kategori.*, foto.wisata_id as wisata4, foto.url_file_foto, foto.foto_id');
		$this->db->from('wisata');
		$this->db->join('kategori', 'kategori.kategori_id=wisata.kategori_id', 'left outer');
		$this->db->join('foto', 'foto.wisata_id=wisata.wisata_id', 'left outer');
		return $this->db->get();
	}

	public function tampilprodukprodusen_count($id = null, $status = null)
	{
		if ($id == null) {
		} else {
			if ($status == null) {
				$this->db->where('produk.id_produsen', $id);
			}
		}

		$this->db->order_by('kategori_produk.id_kategori_produk', 'DESC');
		$this->db->group_by('produk.id_produk');
		$this->db->select('produk.*, kategori_produk.*, foto_produk.id_produk as produk4, foto_produk.url_foto, foto_produk.id_foto');
		$this->db->from('produk');
		$this->db->join('kategori_produk', 'kategori_produk.id_kategori_produk=produk.id_kategori_produk', 'left outer');
		$this->db->join('foto_produk', 'foto_produk.id_produk=produk.id_produk', 'left outer');
		return $this->db->get();
	}

	public function tampil_setup($id = null, $status = null)
	{
		if ($id == null) {
			$this->db->limit(5);
		} else {
			if ($status == null) {
				$this->db->where('kategori.kategori_nama', $id);
			} else {
				$this->db->where('wisata.wisata_id', $status);
				$this->db->where('wisata_berfasilitas.wistas_status', 'Y');
				$this->db->order_by("RAND()");

				//$this->db->order_by('kategori.kategori_id', 'DESC');
				$this->db->select('wisata.*, kategori.*,wisata_berfasilitas.wistas_id, wisata_berfasilitas.wisata_id as wisata2, wisata_berfasilitas.faswis_id as faswis1 , wisata_berfasilitas.wistas_status,
								fasilitas_wisata.*
								');
				$this->db->from('wisata');
				$this->db->join('kategori', 'kategori.kategori_id=wisata.kategori_id', 'left outer');
				$this->db->join('wisata_berfasilitas', 'wisata_berfasilitas.wisata_id=wisata.wisata_id', 'left outer');
				$this->db->join('fasilitas_wisata', 'fasilitas_wisata.faswis_id=wisata_berfasilitas.faswis_id', 'left outer');
				return $this->db->get();
			}
		}
		$this->db->order_by("RAND()");

		//$this->db->order_by('kategori.kategori_id', 'DESC');
		$this->db->group_by('wisata.wisata_id');
		$this->db->select('wisata.*, kategori.*, foto.wisata_id as wisata4, foto.url_file_foto, foto.foto_id');
		$this->db->from('wisata');
		$this->db->join('kategori', 'kategori.kategori_id=wisata.kategori_id', 'left outer');
		$this->db->join('foto', 'foto.wisata_id=wisata.wisata_id', 'left outer');
		return $this->db->get();
	}

	public function tampil_en_setup($id = null, $status = null)
	{
		if ($id == null) {
			$this->db2->limit(5);
		} else {
			if ($status == null) {
				$this->db2->where('kategori.kategori_id', $id);
			} else {
				$this->db2->where('wisata.wisata_id', $status);
				$this->db2->where('wisata_berfasilitas.wistas_status', 'Y');
				$this->db->order_by("RAND()");

				//$this->db2->order_by('kategori.kategori_id', 'DESC');
				$this->db2->select('wisata.*, kategori.*,wisata_berfasilitas.wistas_id, wisata_berfasilitas.wisata_id as wisata2, wisata_berfasilitas.faswis_id as faswis1 , wisata_berfasilitas.wistas_status,
								fasilitas_wisata.*
								');
				$this->db2->from('wisata');
				$this->db2->join('kategori', 'kategori.kategori_id=wisata.kategori_id', 'left outer');
				$this->db2->join('wisata_berfasilitas', 'wisata_berfasilitas.wisata_id=wisata.wisata_id', 'left outer');
				$this->db2->join('fasilitas_wisata', 'fasilitas_wisata.faswis_id=wisata_berfasilitas.faswis_id', 'left outer');
				return $this->db2->get();
			}
		}
		$this->db->order_by("RAND()");

		//$this->db2->order_by('kategori.kategori_id', 'DESC');
		$this->db2->group_by('wisata.wisata_id');
		$this->db2->select('wisata.*, kategori.*, foto.wisata_id as wisata4, foto.url_file_foto, foto.foto_id');
		$this->db2->from('wisata');
		$this->db2->join('kategori', 'kategori.kategori_id=wisata.kategori_id', 'left outer');
		$this->db2->join('foto', 'foto.wisata_id=wisata.wisata_id', 'left outer');
		return $this->db2->get();
	}

	public function tampil($id = null, $status = null, $limit = null, $start = null)
	{
		// var_dump($start);die;
		if ($limit != null) {
			$this->db->limit($limit, $start);
		}
		if ($id == null) {
			$this->db->limit(5);
		} else {
			if ($status == null) {
				$this->db->where('kategori.kategori_nama', $id);
			} else {
				$this->db->where('wisata.wisata_id', $status);
				// $this->db->where('wisata_berfasilitas.wistas_status', 'Y');
				// $this->db->order_by('kategori.kategori_id', 'DESC');
				// $this->db->select('wisata.*, kategori.*,wisata_berfasilitas.wistas_id, wisata_berfasilitas.wisata_id as wisata2, wisata_berfasilitas.faswis_id as faswis1 , wisata_berfasilitas.wistas_status,
				// 				fasilitas_wisata.*
				// 				');
				$this->db->from('wisata');
				// $this->db->join('kategori','kategori.kategori_id=wisata.kategori_id','left outer');
				// $this->db->join('wisata_berfasilitas','wisata_berfasilitas.wisata_id=wisata.wisata_id','left outer');
				// $this->db->join('fasilitas_wisata','fasilitas_wisata.faswis_id=wisata_berfasilitas.faswis_id','left outer');
				return $this->db->get();
			}
		}

		$this->db->order_by('kategori.kategori_id', 'DESC');
		$this->db->group_by('wisata.wisata_id');
		$this->db->select('wisata.*, kategori.*, foto.wisata_id as wisata4, foto.url_file_foto, foto.foto_id');
		$this->db->from('wisata');
		$this->db->join('kategori', 'kategori.kategori_id=wisata.kategori_id', 'left outer');
		$this->db->join('foto', 'foto.wisata_id=wisata.wisata_id', 'left outer');
		return $this->db->get();
	}

	public function tampil_en($id = null, $status = null, $limit = null, $start = null)
	{
		if ($limit != null) {
			$this->db->limit($limit, $start);
		}
		if ($id == null) {
			$this->db2->limit(5);
		} else {
			if ($status == null) {
				$this->db2->where('kategori.kategori_id', $id);
			} else {
				$this->db2->where('wisata.wisata_id', $status);
				$this->db2->where('wisata_berfasilitas.wistas_status', 'Y');
				$this->db2->order_by('kategori.kategori_id', 'DESC');
				$this->db2->select('wisata.*, kategori.*,wisata_berfasilitas.wistas_id, wisata_berfasilitas.wisata_id as wisata2, wisata_berfasilitas.faswis_id as faswis1 , wisata_berfasilitas.wistas_status,
								fasilitas_wisata.*
								');
				$this->db2->from('wisata');
				$this->db2->join('kategori', 'kategori.kategori_id=wisata.kategori_id', 'left outer');
				$this->db2->join('wisata_berfasilitas', 'wisata_berfasilitas.wisata_id=wisata.wisata_id', 'left outer');
				$this->db2->join('fasilitas_wisata', 'fasilitas_wisata.faswis_id=wisata_berfasilitas.faswis_id', 'left outer');
				return $this->db2->get();
			}
		}

		$this->db2->order_by('kategori.kategori_id', 'DESC');
		$this->db2->group_by('wisata.wisata_id');
		$this->db2->select('wisata.*, kategori.*, foto.wisata_id as wisata4, foto.url_file_foto, foto.foto_id');
		$this->db2->from('wisata');
		$this->db2->join('kategori', 'kategori.kategori_id=wisata.kategori_id', 'left outer');
		$this->db2->join('foto', 'foto.wisata_id=wisata.wisata_id', 'left outer');
		return $this->db2->get();
	}

	public function tampilpro($id = null, $status = null, $limit = null, $start = null)
	{
		// var_dump($start);die;
		if ($limit != null) {
			$this->db->limit($limit, $start);
		}
		if ($id == null) {
			$this->db->limit(5);
		} else {
			if ($status == null) {
				$this->db->where('kategori_produk.nama_kategori', $id);
			} else {
				$this->db->where('produk.id_produk', $status);
				// $this->db->where('wisata_berfasilitas.wistas_status', 'Y');
				// $this->db->order_by('kategori.kategori_id', 'DESC');
				// $this->db->select('wisata.*, kategori.*,wisata_berfasilitas.wistas_id, wisata_berfasilitas.wisata_id as wisata2, wisata_berfasilitas.faswis_id as faswis1 , wisata_berfasilitas.wistas_status,
				// 				fasilitas_wisata.*
				// 				');
				$this->db->from('produk');
				// $this->db->join('kategori','kategori.kategori_id=wisata.kategori_id','left outer');
				// $this->db->join('wisata_berfasilitas','wisata_berfasilitas.wisata_id=wisata.wisata_id','left outer');
				// $this->db->join('fasilitas_wisata','fasilitas_wisata.faswis_id=wisata_berfasilitas.faswis_id','left outer');
				return $this->db->get();
			}
		}

		$this->db->order_by('kategori_produk.id_kategori_produk', 'DESC');
		$this->db->group_by('produk.id_produk');
		$this->db->select('produk.*, kategori_produk.*, foto_produk.id_produk as produk4, foto_produk.url_foto, foto_produk.id_foto');
		$this->db->from('produk');
		$this->db->join('kategori_produk', 'kategori_produk.id_kategori_produk=produk.id_kategori_produk', 'left outer');
		$this->db->join('foto_produk', 'foto_produk.id_produk=produk.id_produk', 'left outer');
		return $this->db->get();
	}

	public function filter_province($province, $category, $limit, $start)
	{
		if ($category != null) {
			$this->db->where('kategori.kategori_nama', $category);
		}
		if ($limit != null) {
			$this->db->limit($limit, $start);
		}
		if ($province != null) {
			$this->db->where('wisata.nama_provinsi', $province);
		}

		$this->db->order_by('kategori.kategori_id', 'DESC');
		$this->db->group_by('wisata.wisata_id');
		$this->db->select('wisata.*, kategori.*, foto.wisata_id as wisata4, foto.url_file_foto, foto.foto_id');
		$this->db->from('wisata');
		$this->db->join('kategori', 'kategori.kategori_id=wisata.kategori_id', 'left outer');
		$this->db->join('foto', 'foto.wisata_id=wisata.wisata_id', 'left outer');

		return $this->db->get();
	}
	public function filter_city($city, $category, $limit, $start)
	{
		if ($category != null) {
			$this->db->where('kategori.kategori_nama', $category);
		}
		if ($limit != null) {
			$this->db->limit($limit, $start);
		}
		if ($city != null) {
			$this->db->where('wisata.nama_kota_kabupaten', $city);
		}

		$this->db->order_by('kategori.kategori_id', 'DESC');
		$this->db->group_by('wisata.wisata_id');
		$this->db->select('wisata.*, kategori.*, foto.wisata_id as wisata4, foto.url_file_foto, foto.foto_id');
		$this->db->from('wisata');
		$this->db->join('kategori', 'kategori.kategori_id=wisata.kategori_id', 'left outer');
		$this->db->join('foto', 'foto.wisata_id=wisata.wisata_id', 'left outer');

		return $this->db->get();
	}
	public function filter_province_produk($province, $start, $limit, $category)
	{
		if ($category != null) {
			$this->db->where('kategori_produk.nama_kategori', $category);
		}
		$this->db->where('produk.nama_provinsi', $province);
		// $this->db->where('produk.nama_kota', $city);
		$this->db->order_by('kategori_produk.id_kategori_produk', 'DESC');
		$this->db->group_by('produk.id_produk');
		$this->db->select('produk.*, kategori_produk.*,foto_produk.*');
		$this->db->from('produk');
		$this->db->join('kategori_produk', 'kategori_produk.id_kategori_produk=produk.id_kategori_produk', 'left outer');
		$this->db->join('foto_produk', 'foto_produk.id_produk=produk.id_produk', 'left outer');
		$this->db->limit($limit, $start);
		return $this->db->get();
	}
	public function filter_city_produk($city, $start, $limit, $category)
	{
		if ($category != null) {
			$this->db->where('kategori_produk.nama_kategori', $category);
		}
		$this->db->where('produk.nama_kota', $city);
		// $this->db->where('produk.nama_kota', $city);
		$this->db->order_by('kategori_produk.id_kategori_produk', 'DESC');
		$this->db->group_by('produk.id_produk');
		$this->db->select('produk.*, kategori_produk.*,foto_produk.*');
		$this->db->from('produk');
		$this->db->join('kategori_produk', 'kategori_produk.id_kategori_produk=produk.id_kategori_produk', 'left outer');
		$this->db->join('foto_produk', 'foto_produk.id_produk=produk.id_produk', 'left outer');
		$this->db->limit($limit, $start);
		return $this->db->get();
	}

	public function filter_town($town, $category = null)
	{
		if ($category != null) {
			$this->db->where('kategori.kategori_nama', $category);
		}
		$this->db->where('wisata.nama_kota_kabupaten', $town);
		$this->db->order_by('kategori.kategori_id', 'DESC');
		$this->db->group_by('wisata.wisata_id');
		$this->db->select('wisata.*, kategori.*, foto.wisata_id as wisata4, foto.url_file_foto, foto.foto_id');
		$this->db->from('wisata');
		$this->db->join('kategori', 'kategori.kategori_id=wisata.kategori_id', 'left outer');
		$this->db->join('foto', 'foto.wisata_id=wisata.wisata_id', 'left outer');
		return $this->db->get();
	}


	public function tampil_wisata($id = null, $status = null, $limit = null, $start = null)
	{
		// var_dump($start);die;
		if ($id == null) {
			$this->db->limit(5);
		} else {
			if ($status == null) {
				$this->db->where('kategori.kategori_id', $id);
			} else {
				$this->db->where('wisata.wisata_id', $status);
				$this->db->order_by('kategori.kategori_id', 'DESC');
				$this->db->select('wisata.*, kategori.*, foto.wisata_id as wisata4, foto.url_file_foto, foto.foto_id');
				$this->db->from('wisata');
				$this->db->join('kategori', 'kategori.kategori_id=wisata.kategori_id', 'left outer');
				$this->db->join('foto', 'foto.wisata_id=wisata.wisata_id', 'left outer');

				if ($start != null) {
					$this->db->limit($start, $limit);
				}

				return $this->db->get();
				// var_dump($this->db->last_query());die;  
			}
		}
	}

	public function tampil_produk($id = null, $status = null, $limit = null, $start = null)
	{
		// var_dump($start);die;
		if ($id == null) {
			$this->db->limit(5);
		} else {
			if ($status == null) {
				$this->db->where('kategori_produk.id_kategori_produk', $id);
			} else {
				$this->db->where('produk.id_produk', $status);
				$this->db->order_by('kategori_produk.id_kategori_produk', 'DESC');
				$this->db->select('produk.*, kategori_produk.*, foto_produk.id_produk as produk4, foto_produk.url_foto, foto_produk.id_foto');
				$this->db->from('produk');
				$this->db->join('kategori_produk', 'kategori_produk.id_kategori_produk=produk.id_kategori_produk', 'left outer');
				$this->db->join('foto_produk', 'foto_produk.id_produk=produk.id_produk', 'left outer');

				if ($start != null) {
					$this->db->limit($start, $limit);
				}

				return $this->db->get();
				// var_dump($this->db->last_query());die;  
			}
		}
	}

	function get_province()
	{
		$this->db->select('nama_provinsi');
		$this->db->group_by('nama_provinsi');
		$query = $this->db->get('wisata');

		return $query;
	}
	function get_province_produk()
	{
		$this->db->select('nama_provinsi');
		$this->db->group_by('nama_provinsi');
		$query = $this->db->get('produk');

		return $query;
	}
	function get_city_where($province)
	{
		$this->db->select('nama_kota');
		$this->db->where('nama_provinsi', $province);
		$this->db->group_by('nama_kota');
		$query = $this->db->get('produk');

		return $query;
	}


	function get_town_where($province)
	{
		$this->db->select('nama_kota_kabupaten');
		$this->db->where('nama_provinsi', $province);
		$this->db->group_by('nama_kota_kabupaten');
		$query = $this->db->get('wisata');

		return $query;
	}


	public function tampil_wahana($id = null, $status = null)
	{
		if ($id == null) {
			$this->db->limit(5);
		} else {
			if ($status == null) {
				$this->db->where('kategori.kategori_id', $id);
			} else {
				$this->db->where('wisata.wisata_id', $status);
				$this->db->select('wisata.*, wahana_wisata.wisata_id AS wisata3, wahana_wisata.wahwis_id, wahana_wisata.wahwis_htm, wahana_wisata.wahana_id, wahana.wahana_id, wahana.wahana_nama, wahana.wahana_icon, wahana.wahana_deskripsi ');
				$this->db->from('wahana_wisata');
				$this->db->join('wisata', 'wisata.wisata_id=wahana_wisata.wisata_id', 'left outer');
				$this->db->join('wahana', 'wahana.wahana_id = wahana_wisata.wahana_id', 'left outer');
				return $this->db->get();
			}
		}
	}
	function get_wisata_all($limit, $start)
	{
		$sql = "select wisata.*, foto.foto_id, foto.url_file_foto, kategori.* from wisata left outer join foto on foto.wisata_id=wisata.wisata_id join kategori on wisata.kategori_id = kategori.kategori_id GROUP BY wisata.wisata_nama limit " . $start . ", " . $limit;
		$query = $this->db->query($sql);
		return $query->result_array();
	}
	function get_wisata_all_count()
	{


		$sql = "select wisata.*,foto.* from wisata left outer join foto on foto.wisata_id=wisata.wisata_id  GROUP BY wisata.wisata_nama ";
		$query = $this->db->query($sql);
		return $query->num_rows();
	}
	function get_wisata_all_count_penulis($id)
	{

		// $this->db->where('wisata.penulis_id',$id);
		$sql = "select wisata.*,foto.* from wisata left outer join foto on foto.wisata_id=wisata.wisata_id where wisata.penulis_id = '%$id' GROUP BY wisata.wisata_nama";
		$query = $this->db->query($sql);
		return $query->num_rows();
	}

	public function tampil_wahana_en($id = null, $status = null, $start = null, $limit = null)
	{
		if ($id == null) {
			$this->db2->limit(5);
		} else {
			if ($status == null) {
				$this->db2->where('kategori.kategori_id', $id);
			} else {
				$this->db2->where('wisata.wisata_id', $status);
				$this->db2->select('wisata.*, wahana_wisata.wisata_id AS wisata3, wahana_wisata.wahwis_id, wahana_wisata.wahwis_htm, wahana_wisata.wahana_id, wahana.wahana_id, wahana.wahana_nama, wahana.wahana_icon, wahana.wahana_deskripsi ');
				$this->db2->from('wahana_wisata');
				$this->db2->join('wisata', 'wisata.wisata_id=wahana_wisata.wisata_id', 'left outer');
				$this->db2->join('wahana', 'wahana.wahana_id = wahana_wisata.wahana_id', 'left outer');
				return $this->db2->get();
			}
		}
	}

	function tampil_pendukung($id = null, $status = null)
	{
		if ($id == null) {
			$this->db->limit(5);
		} else {
			if ($status == null) {
				$this->db->where('kategori.kategori_id', $id);
			} else {
				$this->db->group_by('fasilitas_pendukung.faspen_nama');
				$this->db->where('wisata.wisata_id', $status);
				$this->db->select('wisata.*, wisata_berpendukung.wisata_id AS wisata3, wisata_berpendukung.wiskung_id, wisata_berpendukung.faspen_id, wisata_berpendukung.wiskung_nama, wisata_berpendukung.wiskung_alamat, wisata_berpendukung.wiskung_telp,
									wisata_berpendukung.wiskung_website, wisata_berpendukung.wiskung_latitude, wisata_berpendukung.wiskung_longitude,wisata_berpendukung.wiskung_url_foto,
									fasilitas_pendukung.faspen_id, fasilitas_pendukung.faspen_nama, fasilitas_pendukung.faspen_icon');
				$this->db->from('wisata_berpendukung');
				$this->db->join('wisata', 'wisata.wisata_id=wisata_berpendukung.wisata_id', 'left outer');
				$this->db->join('fasilitas_pendukung', 'fasilitas_pendukung.faspen_id = wisata_berpendukung.faspen_id', 'left outer');
				return $this->db->get();
			}
		}
	}

	function tampil_pendukung_en($id = null, $status = null)
	{
		if ($id == null) {
			$this->db2->limit(5);
		} else {
			if ($status == null) {
				$this->db2->where('kategori.kategori_id', $id);
			} else {
				$this->db2->group_by('fasilitas_pendukung.faspen_nama');
				$this->db2->where('wisata.wisata_id', $status);
				$this->db2->select('wisata.*, wisata_berpendukung.wisata_id AS wisata3, wisata_berpendukung.wiskung_id, wisata_berpendukung.faspen_id, wisata_berpendukung.wiskung_nama, wisata_berpendukung.wiskung_alamat, wisata_berpendukung.wiskung_telp,
									wisata_berpendukung.wiskung_website, wisata_berpendukung.wiskung_latitude, wisata_berpendukung.wiskung_longitude,wisata_berpendukung.wiskung_url_foto,
									fasilitas_pendukung.faspen_id, fasilitas_pendukung.faspen_nama, fasilitas_pendukung.faspen_icon');
				$this->db2->from('wisata_berpendukung');
				$this->db2->join('wisata', 'wisata.wisata_id=wisata_berpendukung.wisata_id', 'left outer');
				$this->db2->join('fasilitas_pendukung', 'fasilitas_pendukung.faspen_id = wisata_berpendukung.faspen_id', 'left outer');
				return $this->db2->get();
			}
		}
	}

	function tampil_fasilitas_pendukung($id = null, $status = null)
	{
		if ($id == null) {
			$this->db->limit(5);
		} else {
			if ($status == null) {
				$this->db->where('kategori.kategori_id', $id);
			} else {
				$this->db->where('wisata.wisata_id', $status);
				$this->db->select('wisata.*, wisata_berpendukung.wisata_id AS wisata3, wisata_berpendukung.wiskung_id, wisata_berpendukung.faspen_id, wisata_berpendukung.wiskung_nama, wisata_berpendukung.wiskung_alamat, wisata_berpendukung.wiskung_telp,
									wisata_berpendukung.wiskung_website, wisata_berpendukung.wiskung_latitude, wisata_berpendukung.wiskung_longitude,wisata_berpendukung.wiskung_url_foto,
									fasilitas_pendukung.faspen_id, fasilitas_pendukung.faspen_nama, fasilitas_pendukung.faspen_icon');
				$this->db->from('wisata_berpendukung');
				$this->db->join('wisata', 'wisata.wisata_id=wisata_berpendukung.wisata_id', 'left outer');
				$this->db->join('fasilitas_pendukung', 'fasilitas_pendukung.faspen_id = wisata_berpendukung.faspen_id', 'left outer');
				return $this->db->get();
			}
		}
	}

	function detail_pendukung($id = null, $status = null)
	{
		if ($id == null) {
			$this->db->limit(5);
		} else {
			if ($status == null) {
				$this->db->where('kategori.kategori_id', $id);
			} else {
				$this->db->where('wisata_berpendukung.wiskung_id', $status);
				$this->db->select('wisata_berpendukung.wisata_id AS wisata3, wisata_berpendukung.wiskung_id, wisata_berpendukung.faspen_id, wisata_berpendukung.wiskung_nama, wisata_berpendukung.wiskung_alamat, wisata_berpendukung.wiskung_telp,
									wisata_berpendukung.wiskung_website, wisata_berpendukung.wiskung_latitude, wisata_berpendukung.wiskung_longitude,wisata_berpendukung.wiskung_url_foto,
									fasilitas_pendukung.faspen_id, fasilitas_pendukung.faspen_nama, fasilitas_pendukung.faspen_icon');
				$this->db->from('wisata_berpendukung');
				$this->db->join('fasilitas_pendukung', 'fasilitas_pendukung.faspen_id = wisata_berpendukung.faspen_id', 'left outer');
				return $this->db->get();
			}
		}
	}

	public function berita($id = null, $status = null)
	{
		// var_dump($id);die;
		if ($id == null) {
			$this->db->limit(5);
		} else {
			if ($status == null) {
				$this->db->where('berita.berita_id', $id);
			} else {
				$this->db->limit(5);
			}
		}
		$this->db->select('*');
		$this->db->from('berita');
		$this->db->join('penulis', 'penulis.penulis_id = berita.penulis_id');
		// $this->db->order_by("RAND()");
		return $this->db->get();
	}

	public function berita_en($id = null, $status = null)
	{
		if ($id == null) {
			$this->db2->limit(5);
		} else {
			if ($status == null) {
				$this->db2->where('berita.berita_id', $id);
			} else {
				$this->db2->limit(5);
			}
		}
		$this->db2->from('berita');
		$this->db2->order_by("RAND()");
		return $this->db2->get();
	}

	public function event($id = null, $status = null)
	{
		if ($id == null) {
			$this->db->limit(5);
		} else {
			if ($status == null) {
				$this->db->where('event.event_id', $id);
			} else {
				$this->db->limit(5);
			}
		}
		$this->db->order_by("RAND()");
		$this->db->from('event');
		return $this->db->get();
	}

	public function event_en($id = null, $status = null)
	{
		if ($id == null) {
			$this->db2->limit(5);
		} else {
			if ($status == null) {
				$this->db2->where('event.event_id', $id);
			} else {
				$this->db2->limit(5);
			}
		}
		$this->db2->order_by("RAND()");
		$this->db2->from('event');
		return $this->db2->get();
	}

	public function wisata()
	{

		$this->db->select('*');
		$this->db->from('wisata');
		$this->db->join('penulis', 'penulis.penulis_id = wisata.penulis_id', 'left');
		return $this->db->get();
	}

	public function produk()
	{

		$this->db->select('*');
		$this->db->from('produk');
		$this->db->join('produsen', 'produsen.id_produsen = produk.id_produsen', 'left');
		return $this->db->get();
	}

	public function info()
	{
		return $this->db->get('info');
	}

	public function foto($status = null, $id = null)
	{
		$this->db->from('foto');
		if ($status == 1) {
			$this->db->join('wisata', 'wisata.wisata_id=foto.wisata_id');
			$this->db->where('foto.foto_id', $id);
		} else if ($status == 2) {
			$this->db->limit(5);
		}
		return $this->db->get();
	}

	public function kategori()
	{
		$this->db->from('kategori');
		return $this->db->get();
	}

	public function komentar($id = null)
	{
		$this->db->from('komentar')
			->where('wisata_id', $id);
		return $this->db->get();
	}

	public function komentarproduk($id = null)
	{
		$this->db->from('komentar')
			->where('id_produk', $id);
		return $this->db->get();
	}

	public function komentar_en($id = null)
	{
		$this->db2->from('komentar')
			->where('wisata_id', $id);
		return $this->db2->get();
	}

	public function wisata_baca($id)
	{
		$this->db->where('wisata_id', $id);
		$this->db->set('wisata_tampil', 'wisata_tampil+1', FALSE);
		$this->db->update('wisata');
	}

	public function produk_baca($id)
	{
		$this->db->where('id_produk', $id);
		$this->db->set('produk_tampil', 'produk_tampil+1', FALSE);
		$this->db->update('produk');
	}

	public function terbaru($limit)
	{
		$this->db->limit($limit);
		$this->db->order_by('id_detail', 'DESC');
		return $this->db->get('wisata');
	}

	public function simpan_komentar($data)
	{
		$this->db->insert('komentar', $data);
	}

	public function populer_wisata($no)
	{
		$this->db->limit($no);
		$this->db->order_by('wisata_tampil', 'DESC');
		$this->db->where('wisata_tampil !=', 0);
		return $this->db->get('wisata');
	}

	public function ambil_berita($num, $offset)
	{
		$this->db->order_by('berita_tgl', 'DESC');

		$data = $this->db->get('berita', $num, $offset);

		return $data->result();
	}
	public function ambil_beritaku()
	{
		$this->db->order_by('berita_tgl', 'DESC');

		$data = $this->db->get('berita');

		return $data->result();
	}


	public function ambil_berita_en($num, $offset)
	{
		$this->db2->order_by('berita_tgl', 'DESC');

		$data = $this->db2->get('berita', $num, $offset);

		return $data->result();
	}

	function ambil_berita_thn($limit, $start)
	{
		$this->db->where('YEAR(berita_tgl)', $start);
		$this->db->order_by('berita_judul', 'ASC');
		return $this->db->get('berita', $limit);
	}

	public function penulis($id = null)
	{
		$this->db->select('*');
		$this->db->from('penulis');
		$this->db->where('penulis.penulis_id', $id);
		return $this->db->get();
	}

	public function produsen($id = null)
	{
		$this->db->select('*');
		$this->db->from('produsen');
		$this->db->where('produsen.id_produsen', $id);
		return $this->db->get();
	}
	public function tampilpenulis($id = null, $status = null)
	{
		if ($id == null) {
			$this->db->limit(5);
		} else {
			if ($status == null) {
				$this->db->where('wisata.penulis_id', $id);
			} else {
				$this->db->where('wisata.wisata_id', $status);
				$this->db->where('wisata_berfasilitas.wistas_status', 'Y');
				$this->db->order_by('kategori.kategori_id', 'DESC');
				$this->db->select('wisata.*, kategori.*,wisata_berfasilitas.wistas_id, wisata_berfasilitas.wisata_id as wisata2, wisata_berfasilitas.faswis_id as faswis1 , wisata_berfasilitas.wistas_status,
								fasilitas_wisata.*
								');
				$this->db->from('wisata');
				$this->db->join('kategori', 'kategori.kategori_id=wisata.kategori_id', 'left outer');
				$this->db->join('wisata_berfasilitas', 'wisata_berfasilitas.wisata_id=wisata.wisata_id', 'left outer');
				$this->db->join('fasilitas_wisata', 'fasilitas_wisata.faswis_id=wisata_berfasilitas.faswis_id', 'left outer');
				return $this->db->get();
			}
		}

		$this->db->group_by('wisata.wisata_id');
		$this->db->select('wisata.*, foto.wisata_id as wisata4, foto.url_file_foto, foto.foto_id');
		$this->db->from('wisata');
		$this->db->join('kategori', 'kategori.kategori_id=wisata.kategori_id', 'left outer');
		$this->db->join('foto', 'foto.wisata_id=wisata.wisata_id', 'left outer');
		$this->db->join('penulis', 'penulis.penulis_id=wisata.penulis_id', 'left outer');

		return $this->db->get();
	}

	public function penulis_en($id = null, $status = null)
	{
		$this->db->select('*');
		$this->db->from('penulis');
		$this->db->where('penulis.penulis_id', $id);
		return $this->db->get();
	}

	public function penulis_berita($id = null)
	{
		$this->db->where('berita.berita_id', $id);
		$this->db->select('*');
		$this->db->from('penulis');
		$this->db->join('berita', 'berita.penulis_id = penulis.penulis_id', 'left');
		return $this->db->get();
	}
	function get_data_from_name_writer($table, $nama)
	{
		$this->db->where('penulis_nama', $nama);
		$query = $this->db->get($table);

		return $query;
	}

	function get_data_from_artikel($nama)
	{
		$this->db->like('berita_judul', $nama);
		$query = $this->db->get('berita');

		return $query;
	}

	public function penulis_berita_en($id = null)
	{
		$this->db->where('berita.berita_id', $id);
		$this->db->select('*');
		$this->db->from('penulis');
		$this->db->join('berita', 'berita.penulis_id=penulis.penulis_id', 'left');
		return $this->db->get();
	}
	public function penulis_wisata($id = null)
	{
		$this->db->where('wisata.wisata_id', $id);
		$this->db->select('*');
		$this->db->from('penulis');
		$this->db->join('wisata', 'wisata.penulis_id = penulis.penulis_id', 'left');
		return $this->db->get();
	}

	public function produsen_produk($id = null)
	{
		$this->db->where('produk.id_produk', $id);
		$this->db->select('*');
		$this->db->from('produsen');
		$this->db->join('produk', 'produk.id_produsen = produsen.id_produsen', 'left');
		return $this->db->get();
	}
	public function penulis_wisata_en($id = null)
	{
		$this->db->where('wisata.wisata_id', $id);
		$this->db->select('*');
		$this->db->from('penulis');
		$this->db->join('wisata', 'wisata.penulis_id=penulis.penulis_id', 'left');
		return $this->db->get();
	}
	public function ambil_berita_penulisku($id)
	{
		$this->db->where('berita.penulis_id', $id);
		$this->db->order_by('berita_tgl', 'ASC');

		$data = $this->db->get('berita');

		return $data->result();
	}
	public function ambil_wisata_penulisku($id)
	{
		$this->db->where('wisata.penulis_id', $id);
		//$this->db->order_by('wisata_judul', 'ASC');

		$data = $this->db->get('wisata');

		return $data->result();
	}
	function get_penulis_berita_count($id = NULL)
	{
		$this->db->where('berita.penulis_id', $id);
		$this->db->select('berita_id');
		$this->db->from('berita');
		$this->db->join('penulis', 'penulis.penulis_id=berita.penulis_id', 'left');
		$data = $this->db->get();

		return $data->result_array();
	}

	function get_penulis_wisata_count($id = NULL)
	{
		$this->db->where('wisata.penulis_id', $id);
		$this->db->select('wisata_id');
		$this->db->from('wisata');
		$this->db->join('penulis', 'penulis.penulis_id=wisata.penulis_id', 'left');
		$data = $this->db->get();

		return $data->result_array();
	}

	function get_produsen_produk_count($id = NULL)
	{
		$this->db->where('produk.id_produk', $id);
		$this->db->select('id_produk');
		$this->db->from('produk');
		$this->db->join('produsen', 'produsen.id_produsen=produk.id_produsen', 'left');
		$data = $this->db->get();

		return $data->result_array();
	}


	function total_record($page)
	{
		$this->db->from('berita');
		$this->db->where('YEAR(berita_tgl)', $page);
		return $this->db->get();
	}

	public function ambil_event($num, $offset)
	{
		$this->db->where('event_tgl_pelaksanaan >=', date("Y-m-d"));
		$this->db->order_by('event_tgl_pelaksanaan', 'ASC');

		$data = $this->db->get('event', $num, $offset);

		return $data->result();
	}

	public function ambil_event_en($num, $offset)
	{
		$this->db2->where('event_tgl_pelaksanaan >=', date("Y-m-d"));
		$this->db2->order_by('event_tgl_pelaksanaan', 'ASC');

		$data = $this->db2->get('event', $num, $offset);

		return $data->result();
	}

	public function ambil_wisata($num, $offset)
	{
		$this->db->order_by('kategori.kategori_id', 'DESC');
		$this->db->group_by('wisata.wisata_id');
		$this->db->select('wisata.*, kategori.*, foto.wisata_id as wisata4, foto.url_file_foto, foto.foto_id');
		$this->db->join('kategori', 'kategori.kategori_id=wisata.kategori_id', 'left outer');
		$this->db->join('foto', 'foto.wisata_id=wisata.wisata_id', 'left outer');

		$data = $this->db->get('wisata', $num, $offset);

		return $data->result_array();
	}


	public function post_baru($limit)
	{
		$this->db->limit($limit);
		$this->db->order_by('event_id', 'DESC');
		return $this->db->get('event');
	}

	public function post_berita($limit)
	{
		$this->db->limit($limit);
		$this->db->order_by('berita_id', 'DESC');
		return $this->db->get('berita');
	}

	function sitemap()
	{
		$this->db->select('YEAR(berita_tgl) as thn, MONTHNAME(berita_tgl) as bln, MONTH(berita_tgl) as bulan');
		$this->db->from('berita');
		$this->db->group_by('YEAR(berita_tgl)');
		return $this->db->get();
	}

	function sitemap_bulan($thn)
	{
		$this->db->select('YEAR(berita_tgl) as thn, MONTHNAME(berita_tgl) as bln, MONTH(berita_tgl) as bulan');
		$this->db->where('YEAR(berita_tgl)', $thn);
		$this->db->from('berita');
		$this->db->group_by('MONTHNAME(berita_tgl)');
		return $this->db->get();
	}

	function sitemap_event()
	{
		$this->db->select('YEAR(event_tgl_pelaksanaan) as thn, MONTHNAME(event_tgl_pelaksanaan) as bln, MONTH(event_tgl_pelaksanaan) as bulan');
		$this->db->from('event');
		$this->db->group_by('YEAR(event_tgl_pelaksanaan)');
		return $this->db->get();
	}

	function sitemap_event_bulan($tahun)
	{
		$this->db->select('YEAR(event_tgl_pelaksanaan) as thn, MONTHNAME(event_tgl_pelaksanaan) as bln, MONTH(event_tgl_pelaksanaan) as bulan');
		$this->db->from('event');
		$this->db->where('YEAR(event_tgl_pelaksanaan)', $tahun);
		$this->db->group_by('MONTHNAME(event_tgl_pelaksanaan)');
		return $this->db->get();
	}

	public function get_all()
	{
		$this->db->order_by('wisata_id', 'DESC');
		return $this->db->get('wisata');
	}

	public function get_allpro()
	{
		$this->db->order_by('id_produk', 'DESC');
		return $this->db->get('produk');
	}

	function get_all_wisata($limit, $offset)
	{
		$this->db->select("wisata.wisata_nama as wisata_nama");
		$this->db->select("wisata.wisata_deskripsi as wisata_deskripsi");
		$this->db->select("wisata.wisata_deskripsi as nama_jenis");
		$this->db->select("wisata.wisata_id as wisata_id");
		$this->db->select("foto.url_file_foto as nama_foto");
		$this->db->from("wisata")
			->join("foto", "foto.wisata_id=wisata.wisata_id", "left");
		$this->db->order_by("RAND()");
		$this->db->group_by('wisata.wisata_nama');
		$this->db->limit($limit, $offset);
		return $this->db->get()->result_array();
	}

	function get_all_wisata_en($limit, $offset)
	{
		$this->db2->select("wisata.wisata_nama as wisata_nama");
		$this->db2->select("wisata.wisata_deskripsi as wisata_deskripsi");
		$this->db2->select("wisata.wisata_deskripsi as nama_jenis");
		$this->db2->select("wisata.wisata_id as wisata_id");
		$this->db2->select("foto.url_file_foto as nama_foto");
		$this->db2->from("wisata")
			->join("foto", "foto.wisata_id=wisata.wisata_id", "left");
		$this->db2->order_by("RAND()");
		$this->db2->group_by('wisata.wisata_nama');
		$this->db2->limit($limit, $offset);
		return $this->db2->get()->result_array();
	}

	function get_all_wisata_whe($limit, $offset, $jenis)
	{
		$this->db->select("wisata.wisata_nama as wisata_nama");
		$this->db->select("wisata.wisata_deskripsi as nama_jenis");
		$this->db->select("wisata.wisata_id as wisata_id");
		$this->db->select("foto.url_file_foto as nama_foto");
		$this->db->from("wisata")->join("foto", "foto.wisata_id=wisata.wisata_id", "left");
		$this->db->where('wisata.kategori_id', $jenis);
		$this->db->order_by("RAND()");
		$this->db->group_by('wisata.wisata_nama');
		$this->db->limit($limit, $offset);
		return $this->db->get("wisata")->result();
	}

	function get_all_wisata_whe_en($limit, $offset, $jenis)
	{
		$this->db2->select("wisata.wisata_nama as wisata_nama");
		$this->db2->select("wisata.wisata_deskripsi as nama_jenis");
		$this->db2->select("wisata.wisata_id as wisata_id");
		$this->db2->select("foto.url_file_foto as nama_foto");
		$this->db2->from("wisata")->join("foto", "foto.wisata_id=wisata.wisata_id", "left");
		$this->db2->where('wisata.kategori_id', $jenis);
		$this->db2->order_by("RAND()");
		$this->db2->group_by('wisata.wisata_nama');
		$this->db2->limit($limit, $offset);
		return $this->db2->get("wisata")->result();
	}

	//hitung jumlah row
	function jumlah($like = '')
	{

		if ($like)
			$this->db->where($like);

		$query = $this->db->get('berita');
		return $query->num_rows();
	}

	//hitung jumlah row
	function jumlah_event($like = '')
	{

		if ($like)
			$this->db->where($like);

		$query = $this->db->get('event');
		return $query->num_rows();
	}

	function lihat_wisata($sampai, $dari, $like = '')
	{

		if ($like)
			$this->db->where($like);
		$this->db->select('wisata.*, foto.foto_id, foto.url_file_foto, foto.wisata_id as id_wisata');
		$this->db->join('foto', 'foto.wisata_id=wisata.wisata_id', 'left outer');
		$this->db->order_by('wisata.wisata_id', 'ASC');
		$this->db->group_by('wisata.wisata_nama');

		$query = $this->db->get('wisata', $sampai, $dari);
		return $query->result_array();
	}

	//hitung jumlah row
	function jumlah_wisata($like = '')
	{

		if ($like)
			$this->db->where($like);
		$this->db->select('wisata.*, foto.foto_id, foto.url_file_foto, foto.wisata_id as id_wisata');
		$this->db->join('foto', 'foto.wisata_id=wisata.wisata_id', 'left outer');
		$this->db->order_by('wisata.wisata_id', 'ASC');
		$this->db->group_by('wisata.wisata_nama');

		$query = $this->db->get('wisata');
		return $query->num_rows();
	}

	function tag_wisata($limit, $start, $like = '')
	{

		if ($like)
			$this->db->where($like);
		$this->db->select('wisata.*, kategori.*, foto.foto_id, foto.url_file_foto, foto.wisata_id as id_wisata');
		$this->db->join('foto', 'foto.wisata_id=wisata.wisata_id', 'left outer');
		$this->db->join('kategori', 'kategori.kategori_id=wisata.kategori_id', 'left outer');
		$this->db->order_by('wisata.wisata_id', 'ASC');
		$this->db->group_by('wisata.wisata_nama');
		$this->db->limit($limit, $start);
		$query = $this->db->get('wisata');


		return $query->result_array();
	}

	function tag_produk($limit, $start, $like = '')
	{

		if ($like)
			$this->db->where($like);
		$this->db->select('produk.*, kategori_produk.*, foto_produk.id_foto, foto_produk.url_foto, foto_produk.id_produk as id_produk');
		$this->db->join('foto_produk', 'foto_produk.id_produk=produk.id_produk', 'left outer');
		$this->db->join('kategori_produk', 'kategori_produk.id_kategori_produk=produk.id_kategori_produk', 'left outer');
		$this->db->order_by('produk.id_produk', 'ASC');
		$this->db->group_by('produk.nama_produk');
		$this->db->limit($limit, $start);
		$query = $this->db->get('produk');


		return $query->result_array();
	}
	function tag_wisata_count($like = '')
	{

		if ($like)
			$this->db->where($like);
		$this->db->select('wisata.*, foto.foto_id, foto.url_file_foto, foto.wisata_id as id_wisata');
		$this->db->join('foto', 'foto.wisata_id=wisata.wisata_id', 'left outer');
		$this->db->order_by('wisata.wisata_id', 'ASC');
		$this->db->group_by('wisata.wisata_nama');
		$query = $this->db->get('wisata');
		return $query->num_rows();
	}

	function tag_produk_count($like = '')
	{

		if ($like)
			$this->db->where($like);
		$this->db->select('produk.*, foto_produk.id_foto, foto_produk.url_foto, foto_produk.id_produk as id_produk');
		$this->db->join('foto_produk', 'foto_produk.id_produk=produk.id_produk', 'left outer');
		$this->db->order_by('produk.id_produk', 'ASC');
		$this->db->group_by('produk.nama_produk');
		$query = $this->db->get('produk');
		return $query->num_rows();
	}


	public function tentang()
	{
		return $this->db->get('about');
	}

	public function tentang_en()
	{
		return $this->db2->get('about');
	}

	public function kontak()
	{
		return $this->db->get('kontak');
	}

	public function kontak_en()
	{
		return $this->db2->get('kontak');
	}

	function get_berita($limit, $start, $st = NULL)
	{
		if ($st == "NIL") $st = "";
		$sql = "select * from berita where berita_judul like '%$st%' limit " . $start . ", " . $limit;
		$query = $this->db->query($sql);
		return $query->result_array();
	}

	function get_berita_en($limit, $start, $st = NULL)
	{
		if ($st == "NIL") $st = "";
		$sql = "select * from berita where berita_judul like '%$st%' limit " . $start . ", " . $limit;
		$query = $this->db2->query($sql);
		return $query->result_array();
	}

	function get_berita_count($st = NULL)
	{
		if ($st == "NIL") $st = "";
		$sql = "select * from berita where berita_judul like '%$st%'";
		$query = $this->db->query($sql);
		return $query->num_rows();
	}

	function get_tag_berita($limit, $start, $st = NULL)
	{
		if ($st == "NIL") $st = "";
		$sql = "select * from berita where berita_tag like '%$st%' limit " . $start . ", " . $limit;
		$query = $this->db->query($sql);
		return $query->result_array();
	}

	function get_tag_berita_en($limit, $start, $st = NULL)
	{
		if ($st == "NIL") $st = "";
		$sql = "select * from berita where berita_tag like '%$st%' limit " . $start . ", " . $limit;
		$query = $this->db2->query($sql);
		return $query->result_array();
	}

	function get_tag_berita_count($st = NULL)
	{
		if ($st == "NIL") $st = "";
		$sql = "select * from berita where berita_tag like '%$st%'";
		$query = $this->db->query($sql);
		return $query->num_rows();
	}

	function get_thn_berita($limit, $start, $st = NULL)
	{
		if ($st == "NIL") $st = "";
		$st1 = date("m", strtotime($st));
		$sql = "select * from berita where berita_tgl like '%$st1%' limit " . $start . ", " . $limit;
		$query = $this->db->query($sql);
		return $query->result_array();
	}

	function get_thn_berita_en($limit, $start, $st = NULL)
	{
		if ($st == "NIL") $st = "";
		$sql = "select * from berita where berita_tgl like '%$st%' limit " . $start . ", " . $limit;
		$query = $this->db2->query($sql);
		return $query->result_array();
	}

	function get_thn_berita_count($st = NULL)
	{
		if ($st == "NIL") $st = "";
		$sql = "select * from berita where berita_tgl like '%$st%'";
		$query = $this->db->query($sql);
		return $query->num_rows();
	}

	function get_event($limit, $start, $st = NULL)
	{
		if ($st == "NIL") $st = "";
		$sql = "select * from event where event_judul like '%$st%' limit " . $start . ", " . $limit;
		$query = $this->db->query($sql);
		return $query->result_array();
	}

	function get_event_en($limit, $start, $st = NULL)
	{
		if ($st == "NIL") $st = "";
		$sql = "select * from event where event_judul like '%$st%' limit " . $start . ", " . $limit;
		$query = $this->db2->query($sql);
		return $query->result_array();
	}

	function get_event_count($st = NULL)
	{
		if ($st == "NIL") $st = "";
		$sql = "select * from event where event_judul like '%$st%'";
		$query = $this->db->query($sql);
		return $query->num_rows();
	}

	function get_tag_event($limit, $start, $st = NULL)
	{
		if ($st == "NIL") $st = "";
		$sql = "select * from event where event_tag like '%$st%' limit " . $start . ", " . $limit;
		$query = $this->db->query($sql);
		return $query->result_array();
	}

	function get_tag_event_en($limit, $start, $st = NULL)
	{
		if ($st == "NIL") $st = "";
		$sql = "select * from event where event_tag like '%$st%' limit " . $start . ", " . $limit;
		$query = $this->db2->query($sql);
		return $query->result_array();
	}

	function get_tag_event_count($st = NULL)
	{
		if ($st == "NIL") $st = "";
		$sql = "select * from event where event_tag like '%$st%'";
		$query = $this->db->query($sql);
		return $query->num_rows();
	}

	function get_thn_event($limit, $start, $st = NULL)
	{
		if ($st == "NIL") $st = "";
		$sql = "select * from event where event_tgl_pelaksanaan like '%$st%' limit " . $start . ", " . $limit;
		$query = $this->db->query($sql);
		return $query->result_array();
	}

	function get_thn_event_en($limit, $start, $st = NULL)
	{
		if ($st == "NIL") $st = "";
		$sql = "select * from event where event_tgl_pelaksanaan like '%$st%' limit " . $start . ", " . $limit;
		$query = $this->db2->query($sql);
		return $query->result_array();
	}

	function get_thn_event_count($st = NULL)
	{
		if ($st == "NIL") $st = "";
		$sql = "select * from event where event_tgl_pelaksanaan like '%$st%'";
		$query = $this->db->query($sql);
		return $query->num_rows();
	}

	function get_wisata($limit, $start, $st = NULL)
	{
		if ($st == "NIL") $st = "";
		$sql = "select wisata.*, kategori.*, foto.foto_id, foto.url_file_foto from wisata left outer join foto on foto.wisata_id=wisata.wisata_id join kategori on wisata.kategori_id = kategori.kategori_id where wisata_nama like '%$st%' GROUP BY wisata.wisata_nama limit " . $start . ", " . $limit;
		$query = $this->db->query($sql);
		return $query->result_array();
	}

	function get_produk($limit, $start, $st = NULL)
	{
		if ($st == "NIL") $st = "";
		$sql = "select produk.*, kategori_produk.*, foto_produk.id_foto, foto_produk.url_foto from produk left outer join foto_produk on foto_produk.id_produk=produk.id_produk join kategori_produk on produk.id_kategori_produk = kategori_produk.id_kategori_produk where nama_produk like '%$st%' GROUP BY produk.nama_produk limit " . $start . ", " . $limit;
		$query = $this->db->query($sql);
		return $query->result_array();
	}

	function get_wisata_en($limit, $start, $st = NULL)
	{
		if ($st == "NIL") $st = "";
		$sql = "select wisata.*,foto.foto_id, foto.url_file_foto from wisata left outer join foto on foto.wisata_id=wisata.wisata_id join kategori on wisata.kategori_id = kategori.kategori_id where wisata_nama like '%$st%' GROUP BY wisata.wisata_nama limit " . $start . ", " . $limit;
		$query = $this->db2->query($sql);
		return $query->result_array();
	}

	function get_wisata_count($st = NULL)
	{
		if ($st == "NIL") $st = "";
		$sql = "select wisata.*,foto.* from wisata left outer join foto on foto.wisata_id=wisata.wisata_id where wisata.wisata_nama like '%$st%' GROUP BY wisata.wisata_nama ";
		$query = $this->db->query($sql);
		return $query->num_rows();
	}

	function get_produk_count($st = NULL)
	{
		if ($st == "NIL") $st = "";
		$sql = "select produk.*,foto_produk.* from produk left outer join foto_produk on foto_produk.id_produk=produk.id_produk where produk.nama_produk like '%$st%' GROUP BY produk.nama_produk ";
		$query = $this->db->query($sql);
		return $query->num_rows();
	}
	function get_data_from_name($nama)
	{
		$this->db->where('wisata_nama', $nama);
		$query = $this->db->get('wisata');

		return $query;
	}

	function get_dataproduk_from_name($nama)
	{
		$this->db->where('nama_produk', $nama);
		$query = $this->db->get('produk');

		return $query;
	}

	function get_data_from_namewst($table, $nama)
	{
		$this->db->where('wisata_nama', $nama);
		$this->db->select('*');
		$this->db->from('wisata');
		$this->db->join('kategori', 'kategori.kategori_id=wisata.kategori_id');
		$query = $this->db->get();

		return $query;
	}

	function get_data_from_namepdk($table, $nama)
	{
		$this->db->where('nama_produk', $nama);
		$this->db->select('*');
		$this->db->from('produk');
		$this->db->join('kategori_produk', 'kategori_produk.id_kategori_produk=produk.id_kategori_produk');
		$query = $this->db->get();

		return $query;
	}

	function get_data_from_name_wisata($table, $nama)
	{
		$this->db->where('penulis_nama', $nama);
		$query = $this->db->get($table);

		return $query;
	}

	function get_data_from_name_produk($table, $nama)
	{
		$this->db->where('nama_produsen', $nama);
		$query = $this->db->get($table);

		return $query;
	}
	public function view($table, $where)
	{
		return $this->db->get($table, $where);
	}

	public function add($table, $data)
	{
		$this->db->insert($table, $data);
		return $this->db->insert_id();
	}
	public function add_en($table, $data)
	{
		$this->db2->insert($table, $data);
		return $this->db2->insert_id();
	}
}
