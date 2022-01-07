<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mdl_foto extends CI_Model {
	
	var $table2 = 'foto';
	var $column_orderid = array('a.foto_id','a.url_file_foto','a.wisata_id','b.wisata_nama',null); //set column field database for datatable orderable
	var $column_searchid = array('a.foto_id','a.url_file_foto','a.wisata_id','b.wisata_nama');
	var $orderid = array('a.foto_id' => 'asc');
	
	
	public function get_datatablesid($id) {
		$this->_get_datatables_queryid();
		$this->db->where('b.wisata_id',$id);

		if ($_REQUEST['length'] != -1) {
			$this->db->limit($_REQUEST['length'], $_REQUEST['start']);
		}

		$query = $this->db->get();
		return $query->result();
	}
	
	private function _get_datatables_queryid() {
		$this->db->select('a.*,b.*');
		$this->db->from('foto a');
		$this->db->join('wisata b','b.wisata_id=a.wisata_id','left outer');
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
	
	function count_filteredid($id) {
		$this->_get_datatables_queryid();
		$this->db->where('b.wisata_id',$id);
		$query = $this->db->get();
		return $query->num_rows();
	}

	function count_allid($id) {
		$this->db->from($this->table2);
		return $this->db->count_all_results();
	}
	
	public function add($data) {
		$this->db->insert($this->table2, $data);
		return $this->db->insert_id();
	}
	
	public function get_by_id($id) {
		$this->db->from($this->table2);
		$this->db->where('foto_id',$id);
		$query = $this->db->get();
		return $query->row();
	}
	
	function update_data($where,$data,$table){
		$this->db->where($where);
		$this->db->update($table,$data);
	}
	
	public function delete_by_id($id) {
		$this->db->where('foto_id', $id);
		$this->db->delete($this->table2);
	}
}	