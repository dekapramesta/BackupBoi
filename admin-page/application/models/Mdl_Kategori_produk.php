<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Mdl_Kategori_produk extends CI_Model
{

	private $db2;

	public function __construct()
	{
		parent::__construct();
		$this->db2 = $this->load->database('pariwisata_en', TRUE);
	}

	var $table = 'kategori_produk';
	var $column_order = array('id_kategori_produk', 'nama_kategori', 'logo_kategori', null); //set column field database for datatable orderable
	var $column_search = array('id_kategori_produk', 'nama_kategori', 'logo_kategori'); //set column field database for datatable searchable just title , author , category are searchable
	var $order = array('id_kategori_produk' => 'asc'); // default order

	var $table2 = 'produk';
	var $column_orderid = array('nama_produk', 'deskripsi_produk', 'nama_produsen', 'tag_produk', 'slug_produk', null); //set column field database for datatable orderable
	var $column_searchid = array('nama_produk', 'deskripsi_produk', 'nama_produsen', 'tag_produk', 'slug_produk');
	var $orderid = array('id_produk' => 'asc');


	private function _get_datatables_query()
	{
		$this->db->from($this->table);
		$i = 0;
		foreach ($this->column_search as $item) {
			if ($_REQUEST['search']["value"]) {
				if ($i === 0) {
					$this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
					$this->db->like($item, $_REQUEST['search']["value"]);
				} else {
					$this->db->or_like($item, $_REQUEST['search']["value"]);
				}

				if (count($this->column_search) - 1 == $i)
					$this->db->group_end();
			}

			$i++;
		}

		if (isset($_REQUEST['order'])) {
			$this->db->order_by($this->column_order[$_REQUEST['order']['0']['column']], $_REQUEST['order']['0']['dir']);
		} else if (isset($this->order)) {
			$order = $this->order;
			$this->db->order_by(key($order), $order[key($order)]);
		}
	}

	private function _get_datatables_query_en()
	{
		$this->db2->from($this->table);
		$i = 0;
		foreach ($this->column_search_en as $item) {
			if ($_REQUEST['search']["value"]) {
				if ($i === 0) {
					$this->db2->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
					$this->db2->like($item, $_REQUEST['search']["value"]);
				} else {
					$this->db2->or_like($item, $_REQUEST['search']["value"]);
				}

				if (count($this->column_search_en) - 1 == $i)
					$this->db2->group_end();
			}

			$i++;
		}

		if (isset($_REQUEST['order'])) {
			$this->db2->order_by($this->column_order_en[$_REQUEST['order']['0']['column']], $_REQUEST['order']['0']['dir']);
		} else if (isset($this->order_en)) {
			$order = $this->order_en;
			$this->db2->order_by(key($order), $order[key($order)]);
		}
	}

	public function produsen_produk()
	{
		$this->db->select('*')->from('produsen');
		return $this->db->get();
	}
	function get_city_produk($province)
	{
		$this->db->select('nama_kota_kabupaten');
		$this->db->where('nama_provinsi', $province);
		$this->db->group_by('nama_kota_kabupaten');
		$query = $this->db->get('wisata');

		return $query;
	}


	function count_filtered()
	{
		$this->_get_datatables_query();
		$query = $this->db->get();
		return $query->num_rows();
	}

	function count_all()
	{
		$this->db->from($this->table);
		return $this->db->count_all_results();
	}

	public function get_datatables()
	{
		$this->_get_datatables_query();

		if ($_REQUEST['length'] != -1) {
			$this->db->limit($_REQUEST['length'], $_REQUEST['start']);
		}

		$query = $this->db->get();
		return $query->result();
	}

	// function count_filtered_en() {
	// 	$this->_get_datatables_query_en();
	// 	$query = $this->db2->get();
	// 	return $query->num_rows();
	// }

	// function count_all_en() {
	// 	$this->db2->from($this->table);
	// 	return $this->db2->count_all_results();
	// }

	// public function get_datatables_en() {
	// 	$this->_get_datatables_query_en();

	// 	if ($_REQUEST['length'] != -1) {
	// 		$this->db2->limit($_REQUEST['length'], $_REQUEST['start']);
	// 	}

	// 	$query = $this->db2->get();
	// 	return $query->result();
	// }

	public function add($data)
	{
		$this->db->insert($this->table, $data);
		return $this->db->insert_id();
	}

	// public function add_en($data) {
	// 	$this->db2->insert($this->table, $data);
	// 	return $this->db2->insert_id();
	// }

	public function get_by_id($id)
	{
		$this->db->from($this->table);
		$this->db->where('id_kategori_produk', $id);
		$query = $this->db->get();
		return $query->row();
	}

	// public function get_by_id_en($id) {
	// 	$this->db2->from($this->table);
	// 	$this->db2->where('id_kategori_produk',$id);
	// 	$query = $this->db2->get();
	// 	return $query->row();
	// }

	public function update($where, $data)
	{
		$this->db->update($this->table, $data, $where);
		return $this->db->affected_rows();
	}

	// public function update_en($where, $data) {
	// 	$this->db2->update($this->table, $data, $where);
	// 	return $this->db2->affected_rows();
	// }

	function update_data($where, $data, $table)
	{
		$this->db->where($where);
		$this->db->update($table, $data);
	}

	// function update_data_en($where,$data,$table){
	// 	$this->db2->where($where);
	// 	$this->db2->update($table,$data);
	// }

	public function delete_by_id($id)
	{
		$this->db->where('id_kategori_produk', $id);
		$this->db->delete($this->table);
	}

	// public function delete_by_id_en($id) {
	// 	$this->db2->where('id_kategori_produk', $id);
	// 	$this->db2->delete($this->table);
	// }

	public function get_by($key)
	{
		$this->db->where('id_kategori_produk', $key);
		return $this->db->get('produk')->row();
	}

	public function get_by_foto($key)
	{
		$this->db->where('id_produk', $key);
		return $this->db->get('foto_produk')->row();
	}


	public function get_datatablesid($id)
	{
		$this->_get_datatables_queryid();
		$this->db->where('id_kategori_produk', $id);

		if ($_REQUEST['length'] != -1) {
			$this->db->limit($_REQUEST['length'], $_REQUEST['start']);
		}

		$query = $this->db->get();
		return $query->result();
	}

	// public function get_datatablesid_en($id) {
	// 	$this->_get_datatables_queryid_en();
	// 	$this->db2->where('id_kategori_produk',$id);

	// 	if ($_REQUEST['length'] != -1) {
	// 		$this->db2->limit($_REQUEST['length'], $_REQUEST['start']);
	// 	}

	// 	$query = $this->db2->get();
	// 	return $query->result();
	// }

	private function _get_datatables_queryid()
	{
		$this->db->from($this->table2);
		$this->db->join('produsen', 'produsen.id_produsen = produk.id_produk', 'left');
		$i = 0;
		foreach ($this->column_searchid as $item) {
			if ($_REQUEST['search']["value"]) {
				if ($i === 0) {
					$this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
					$this->db->like($item, $_REQUEST['search']["value"]);
				} else {
					$this->db->or_like($item, $_REQUEST['search']["value"]);
				}

				if (count($this->column_searchid) - 1 == $i)
					$this->db->group_end();
			}

			$i++;
		}

		if (isset($_REQUEST['order'])) {
			$this->db->order_by($this->column_orderid[$_REQUEST['order']['0']['column']], $_REQUEST['order']['0']['dir']);
		} else if (isset($this->orderid)) {
			$order = $this->orderid;
			$this->db->order_by(key($order), $order[key($order)]);
		}
	}



	function count_filteredid($id)
	{
		$this->_get_datatables_queryid();
		$this->db->where('id_kategori_produk', $id);
		$query = $this->db->get();
		return $query->num_rows();
	}

	function count_allid($id)
	{
		$this->db->from($this->table2);
		return $this->db->count_all_results();
	}



	public function add_detail($data)
	{
		$this->db->insert($this->table2, $data);
		return $this->db->insert_id();
	}


	public function get_by_detail($id)
	{
		$this->db->from($this->table2);
		$this->db->where('id_produk', $id);
		$query = $this->db->get();
		return $query->row();
	}


	public function update_detail($where, $data)
	{
		$this->db->update($this->table2, $data, $where);
		return $this->db->affected_rows();
	}

	public function update_detail_en($where, $data)
	{
		$this->db2->update($this->table2, $data, $where);
		return $this->db2->affected_rows();
	}

	public function delete_by_det($id)
	{
		$this->db->where('id_produk', $id);
		$this->db->delete($this->table2);
	}


	public function tampil($id = null, $status = null)
	{
		if ($id == null) {
			$this->db->limit(5);
		} else {
			if ($status == null) {
				$this->db->where('kategori_produk.id_kategori_produk', $id);
			} else {
				$this->db->where('produk.id_produk', $status);
				$this->db->order_by('kategori_produk.id_kategori_produk', 'DESC');
				$this->db->select('produk.*, kategori_produk.*');
				$this->db->from('produk');
				$this->db->join('kategori_produk', 'kategori_produk.id_kategori_produk=produk.id_produk', 'left outer');
				return $this->db->get();
			}
		}

		$this->db->order_by('kategori_produk.id_kategori_produk', 'DESC');
		$this->db->group_by('produk.id_produk');
		$this->db->select('produk.*, kategori_produk.*, foto_produk.id_produk as produk4 , foto_produk.url_foto, foto_produk.id_foto');
		$this->db->from('produk');
		$this->db->join('kategori_produk', 'kategori_produk.id_kategori_produk=produk.id_produk', 'left outer');
		$this->db->join('foto_produk', 'foto_produk.id_produk=produk.id_produk', 'left outer');
		return $this->db->get();
	}

	function get_province()
	{
		$this->db->select('nama_provinsi');
		$this->db->group_by('nama_provinsi');
		return $this->db->get('wisata');
	}

	function get_towns_where($province)
	{

		$this->db->select('nama_kota_kabupaten');
		$this->db->where('nama_provinsi', $province);
		$this->db->group_by('nama_kota_kabupaten');
		$query = $this->db->get('wisata');

		return $query->result();
	}
}
