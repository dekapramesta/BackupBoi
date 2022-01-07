<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mdl_Kategori extends CI_Model {

	private $db2;
	
	public function __construct(){
	  parent::__construct();
			 $this->db2 = $this->load->database('pariwisata_en', TRUE);
	}
	
	var $table = 'kategori';
	var $column_order = array('kategori_id','kategori_nama','kategori_icon',null); //set column field database for datatable orderable
	var $column_search = array('kategori_id','kategori_nama','kategori_icon'); //set column field database for datatable searchable just title , author , category are searchable
	var $order = array('kategori_id' => 'asc'); // default order

	var $column_order_en = array('kategori_id','kategori_nama','kategori_icon',null); //set column field database for datatable orderable
	var $column_search_en = array('kategori_id','kategori_nama','kategori_icon'); //set column field database for datatable searchable just title , author , category are searchable
	var $order_en = array('kategori_id' => 'asc'); // default order
	
	var $table2 = 'wisata';
	var $column_orderid = array('wisata_nama','wisata_deskripsi','penulis_nama','penulis_profesi','wisata_tag','wisata_latitude','wisata_longitude','wisata_htm_lokal','wisata_htm_intl',null); //set column field database for datatable orderable
	var $column_searchid = array('wisata_nama','wisata_deskripsi','penulis_nama','penulis_profesi','wisata_tag','wisata_latitude','wisata_longitude','wisata_htm_lokal','wisata_htm_intl');
	var $orderid = array('wisata_id' => 'asc');

	//var $table2 = 'wisata';
	var $column_orderid_en = array('wisata_nama','wisata_deskripsi','penulis_nama','penulis_profesi','wisata_tag','wisata_latitude','wisata_longitude','wisata_htm_lokal','wisata_htm_intl',null); //set column field database for datatable orderable
	var $column_searchid_en = array('wisata_nama','wisata_deskripsi','penulis_nama','penulis_profesi','wisata_tag','wisata_latitude','wisata_longitude','wisata_htm_lokal','wisata_htm_intl');
	var $orderid_en = array('wisata_id' => 'asc');
	
	private function _get_datatables_query() {
		$this->db->from($this->table);
		$i = 0;
		foreach ($this->column_search as $item) {
			if ($_REQUEST['search']["value"]) {
				if ($i===0) {
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

	private function _get_datatables_query_en() {
		$this->db2->from($this->table);
		$i = 0;
		foreach ($this->column_search_en as $item) {
			if ($_REQUEST['search']["value"]) {
				if ($i===0) {
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

	public function penulis_wisata()
	{
		$this->db->select('*')->from('penulis');
		return $this->db->get();
	}

	public function penulis_wisata_en()
	{
		$this->db->select('*')->from('penulis');
		return $this->db->get();
	}

	function count_filtered() {
		$this->_get_datatables_query();
		$query = $this->db->get();
		return $query->num_rows();
	}

	function count_all() {
		$this->db->from($this->table);
		return $this->db->count_all_results();
	}

	public function get_datatables() {
		$this->_get_datatables_query();

		if ($_REQUEST['length'] != -1) {
			$this->db->limit($_REQUEST['length'], $_REQUEST['start']);
		}

		$query = $this->db->get();
		return $query->result();
	}

	function count_filtered_en() {
		$this->_get_datatables_query_en();
		$query = $this->db2->get();
		return $query->num_rows();
	}

	function count_all_en() {
		$this->db2->from($this->table);
		return $this->db2->count_all_results();
	}

	public function get_datatables_en() {
		$this->_get_datatables_query_en();

		if ($_REQUEST['length'] != -1) {
			$this->db2->limit($_REQUEST['length'], $_REQUEST['start']);
		}

		$query = $this->db2->get();
		return $query->result();
	}
	
	public function add($data) {
		$this->db->insert($this->table, $data);
		return $this->db->insert_id();
	}

	public function add_en($data) {
		$this->db2->insert($this->table, $data);
		return $this->db2->insert_id();
	}
	
	public function get_by_id($id) {
		$this->db->from($this->table);
		$this->db->where('kategori_id',$id);
		$query = $this->db->get();
		return $query->row();
	}

	public function get_by_id_en($id) {
		$this->db2->from($this->table);
		$this->db2->where('kategori_id',$id);
		$query = $this->db2->get();
		return $query->row();
	}
	
	public function update($where, $data) {
		$this->db->update($this->table, $data, $where);
		return $this->db->affected_rows();
	}

	public function update_en($where, $data) {
		$this->db2->update($this->table, $data, $where);
		return $this->db2->affected_rows();
	}
	
	function update_data($where,$data,$table){
		$this->db->where($where);
		$this->db->update($table,$data);
	}

	function update_data_en($where,$data,$table){
		$this->db2->where($where);
		$this->db2->update($table,$data);
	}
	
	public function delete_by_id($id) {
		$this->db->where('kategori_id', $id);
		$this->db->delete($this->table);
	}

	public function delete_by_id_en($id) {
		$this->db2->where('kategori_id', $id);
		$this->db2->delete($this->table);
	}
	
	public function get_by($key) {
		$this->db->where('kategori_id', $key);
        return $this->db->get('wisata')->row();
	}
	
	public function get_by_det($key) {
		$this->db->where('wisata_id', $key);
        return $this->db->get('wisata_berfasilitas')->row();
	}
	
	public function get_by_wah($key) {
		$this->db->where('wisata_id', $key);
        return $this->db->get('wahana_wisata')->row();
	}
	
	public function get_by_foto($key) {
		$this->db->where('wisata_id', $key);
        return $this->db->get('foto')->row();
	}
	
	public function get_by_pend($key) {
		$this->db->where('wisata_id', $key);
        return $this->db->get('wisata_berpendukung')->row();
	}
	
	public function get_datatablesid($id) {
		$this->_get_datatables_queryid();
		$this->db->where('kategori_id',$id);

		if ($_REQUEST['length'] != -1) {
			$this->db->limit($_REQUEST['length'], $_REQUEST['start']);
		}

		$query = $this->db->get();
		return $query->result();
	}

	public function get_datatablesid_en($id) {
		$this->_get_datatables_queryid_en();
		$this->db2->where('kategori_id',$id);

		if ($_REQUEST['length'] != -1) {
			$this->db2->limit($_REQUEST['length'], $_REQUEST['start']);
		}

		$query = $this->db2->get();
		return $query->result();
	}
	
	private function _get_datatables_queryid() {
		$this->db->from($this->table2);
		$this->db->join('penulis', 'penulis.penulis_id = wisata.penulis_id', 'left');
		$i = 0;
		foreach ($this->column_searchid as $item) {
			if ($_REQUEST['search']["value"]) {
				if ($i===0) {
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

	private function _get_datatables_queryid_en() {
		$this->db2->from($this->table2);
		$this->db->join('penulis', 'penulis.penulis_id = wisata.penulis_id', 'left');
		$i = 0;
		foreach ($this->column_searchid_en as $item) {
			if ($_REQUEST['search']["value"]) {
				if ($i===0) {
					$this->db2->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
					$this->db2->like($item, $_REQUEST['search']["value"]);
				} else {
					$this->db2->or_like($item, $_REQUEST['search']["value"]);
			}
			
			if (count($this->column_searchid_en) - 1 == $i)
				$this->db2->group_end();
			}

			$i++;
		}

		if (isset($_REQUEST['order'])) {
			$this->db2->order_by($this->column_orderid_en[$_REQUEST['order']['0']['column']], $_REQUEST['order']['0']['dir']);
		} else if (isset($this->orderid_en)) {
			$order = $this->orderid_en;
			$this->db2->order_by(key($order), $order[key($order)]);
		}
	}
	
	function count_filteredid($id) {
		$this->_get_datatables_queryid();
		$this->db->where('kategori_id',$id);
		$query = $this->db->get();
		return $query->num_rows();
	}

	function count_allid($id) {
		$this->db->from($this->table2);
		return $this->db->count_all_results();
	}

	function count_filteredid_en($id) {
		$this->_get_datatables_queryid_en();
		$this->db2->where('kategori_id',$id);
		$query = $this->db2->get();
		return $query->num_rows();
	}

	function count_allid_en($id) {
		$this->db2->from($this->table2);
		return $this->db2->count_all_results();
	}
	
	public function add_detail($data) {
		$this->db->insert($this->table2, $data);
		return $this->db->insert_id();
	}

	public function add_detail_en($data) {
		$this->db2->insert($this->table2, $data);
		return $this->db2->insert_id();
	}
	
	public function get_by_detail($id) {
		$this->db->from($this->table2);
		$this->db->where('wisata_id',$id);
		$query = $this->db->get();
		return $query->row();
	}

	public function get_by_detail_en($id) {
		$this->db2->from($this->table2);
		$this->db2->where('wisata_id',$id);
		$query = $this->db2->get();
		return $query->row();
	}
	
	public function update_detail($where, $data) {
		$this->db->update($this->table2, $data, $where);
		return $this->db->affected_rows();
	}

	public function update_detail_en($where, $data) {
		$this->db2->update($this->table2, $data, $where);
		return $this->db2->affected_rows();
	}
	
	public function delete_by_det($id) {
		$this->db->where('wisata_id', $id);
		$this->db->delete($this->table2);
	}

	public function delete_by_det_en($id) {
		$this->db2->where('wisata_id', $id);
		$this->db2->delete($this->table2);
	}
	
	public function fasilitas()
	{
		$hasil = $this->db->get('fasilitas_wisata');
		if($hasil->num_rows() > 0){
			return $hasil->result();
		} else {
			return array();
		}
	}
	
	public function tampil($id=null, $status=null){
		if($id==null){
			$this->db->limit(5);
		}else{
			if($status==null){
				$this->db->where('kategori.kategori_id', $id);
			}else{
				$this->db->where('wisata.wisata_id', $status);
				$this->db->where('wisata_berfasilitas.wistas_status', 'Y');
				$this->db->order_by('kategori.kategori_id', 'DESC');
				$this->db->select('wisata.*, kategori.*,wisata_berfasilitas.wistas_id, wisata_berfasilitas.wisata_id as wisata2, wisata_berfasilitas.faswis_id as faswis1 , wisata_berfasilitas.wistas_status,
								fasilitas_wisata.*
								');
				$this->db->from('wisata');
				$this->db->join('kategori','kategori.kategori_id=wisata.kategori_id','left outer');
				$this->db->join('wisata_berfasilitas','wisata_berfasilitas.wisata_id=wisata.wisata_id','left outer');
				$this->db->join('fasilitas_wisata','fasilitas_wisata.faswis_id=wisata_berfasilitas.faswis_id','left outer');
				return $this->db->get();
			}
		}
		
		$this->db->order_by('kategori.kategori_id', 'DESC');
		$this->db->group_by('wisata.wisata_id');
		$this->db->select('wisata.*, kategori.*, foto.wisata_id as wisata4, foto.url_file_foto, foto.foto_id');
		$this->db->from('wisata');
		$this->db->join('kategori','kategori.kategori_id=wisata.kategori_id','left outer');
		$this->db->join('foto','foto.wisata_id=wisata.wisata_id','left outer');
		return $this->db->get();
	}
}