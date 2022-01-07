<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mdl_fasilitas_wisata extends CI_Model {

	private $db2;
	
	public function __construct(){
	  parent::__construct();
			 $this->db2 = $this->load->database('pariwisata_en', TRUE);
	}
	
	var $table = 'fasilitas_wisata';
	var $column_order = array('faswis_id', 'faswis_nama', 'faswis_icon',null); //set column field database for datatable orderable
	var $column_search = array('faswis_id', 'faswis_nama', 'faswis_icon'); //set column field database for datatable searchable just title , author , category are searchable
	var $order = array('faswis_id' => 'asc'); // default order

	var $column_order_en = array('faswis_id', 'faswis_nama', 'faswis_icon',null); //set column field database for datatable orderable
	var $column_search_en = array('faswis_id', 'faswis_nama', 'faswis_icon'); //set column field database for datatable searchable just title , author , category are searchable
	var $order_en = array('faswis_id' => 'asc'); // default order
	
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
		$this->db->where('faswis_id',$id);
		$query = $this->db->get();
		return $query->row();
	}

	public function get_by_id_en($id) {
		$this->db2->from($this->table);
		$this->db2->where('faswis_id',$id);
		$query = $this->db2->get();
		return $query->row();
	}
	
	public function update($where, $data) {
		$this->db->update($this->table, $data, $where);
		return $this->db->affected_rows();
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
		$this->db->where('faswis_id', $id);
		$this->db->delete($this->table);
	}

	public function delete_by_id_en($id) {
		$this->db2->where('faswis_id', $id);
		$this->db2->delete($this->table);
	}
}