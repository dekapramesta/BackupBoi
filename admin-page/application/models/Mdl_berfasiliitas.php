<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mdl_berfasiliitas extends CI_Model {
	
	private $db2;
	
	public function __construct(){
	  parent::__construct();
			 $this->db2 = $this->load->database('pariwisata_en', TRUE);
	}

	var $table2 = 'wisata_berfasilitas';
	var $column_orderid = array('a.wistas_id','a.wisata_id','a.faswis_id','a.wistas_status','b.faswis_nama','c.wisata_id',null); //set column field database for datatable orderable
	var $column_searchid = array('a.wistas_id','a.wisata_id','a.faswis_id','a.wistas_status','b.faswis_nama','c.wisata_id');
	var $orderid = array('a.wistas_id' => 'asc');
	
	var $column_orderid_en = array('a.wistas_id','a.wisata_id','a.faswis_id','a.wistas_status','b.faswis_nama','c.wisata_id',null); //set column field database for datatable orderable
	var $column_searchid_en = array('a.wistas_id','a.wisata_id','a.faswis_id','a.wistas_status','b.faswis_nama','c.wisata_id');
	var $orderid_en = array('a.wistas_id' => 'asc');
	
	
	public function get_datatablesid($id) {
		$this->_get_datatables_queryid();
		$this->db->where('c.wisata_id',$id);

		if ($_REQUEST['length'] != -1) {
			$this->db->limit($_REQUEST['length'], $_REQUEST['start']);
		}

		$query = $this->db->get();
		return $query->result();
	}
	
	public function get_datatablesid_en($id) {
		$this->_get_datatables_queryid_en();
		$this->db2->where('c.wisata_id',$id);

		if ($_REQUEST['length'] != -1) {
			$this->db2->limit($_REQUEST['length'], $_REQUEST['start']);
		}

		$query = $this->db2->get();
		return $query->result();
	}
	
	private function _get_datatables_queryid() {
		$this->db->select('a.*,b.*,c.*');
		$this->db->from('wisata_berfasilitas a');
		$this->db->join('fasilitas_wisata b','b.faswis_id=a.faswis_id','left outer');
		$this->db->join('wisata c','c.wisata_id=a.wisata_id','left outer');
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
		$this->db2->select('a.*,b.*,c.*');
		$this->db2->from('wisata_berfasilitas a');
		$this->db2->join('fasilitas_wisata b','b.faswis_id=a.faswis_id','left outer');
		$this->db2->join('wisata c','c.wisata_id=a.wisata_id','left outer');
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
				$this->db->group_end();
			}

			$i++;
		}

		if (isset($_REQUEST['order'])) {
			$this->db2->order_by($this->column_orderid[$_REQUEST['order']['0']['column']], $_REQUEST['order']['0']['dir']);
		} else if (isset($this->orderid_en)) {
			$order = $this->orderid_en;
			$this->db2->order_by(key($order), $order[key($order)]);
		}
	}
	
	function count_filteredid($id) {
		$this->_get_datatables_queryid();
		$this->db->where('c.wisata_id',$id);
		$query = $this->db->get();
		return $query->num_rows();
	}

	function count_allid($id) {
		$this->db->from($this->table2);
		return $this->db->count_all_results();
	}
	
	function count_filteredid_en($id) {
		$this->_get_datatables_queryid_en();
		$this->db2->where('c.wisata_id',$id);
		$query = $this->db2->get();
		return $query->num_rows();
	}

	function count_allid_en($id) {
		$this->db2->from($this->table2);
		return $this->db2->count_all_results();
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
	
	public function add($data) {
		$this->db->insert($this->table2, $data);
		return $this->db->insert_id();
	}
	
	public function add_en($data) {
		$this->db2->insert($this->table2, $data);
		return $this->db2->insert_id();
	}
	
	public function delete_by_id($id) {
		$this->db->where('wistas_id', $id);
		$this->db->delete($this->table2);
	}
	
	public function delete_by_id_en($id) {
		$this->db->where('wistas_id', $id);
		$this->db->delete($this->table2);
	}
	
	public function get_by_id($id) {
		$this->db->from($this->table2);
		$this->db->where('wistas_id',$id);
		$query = $this->db->get();
		return $query->row();
	}
	
	public function get_by_id_en($id) {
		$this->db2->from($this->table2);
		$this->db2->where('wistas_id',$id);
		$query = $this->db2->get();
		return $query->row();
	}
	
	public function update($where, $data) {
		$this->db->update($this->table2, $data, $where);
		return $this->db->affected_rows();
	}
	
	public function update_en($where, $data) {
		$this->db2->update($this->table2, $data, $where);
		return $this->db2->affected_rows();
	}
}