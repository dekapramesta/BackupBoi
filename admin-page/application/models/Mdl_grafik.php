<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mdl_grafik extends CI_Model {
	
	var $table2 = 'grafik';
	var $column_orderid = array('id','bulan','nilai','kode','tahun',null); //set column field database for datatable orderable
	var $column_searchid = array('id','bulan','nilai','kode','tahun');
	var $orderid = array('id' => 'asc');
	
	public function get_datatables($id) {
		$this->_get_datatables_query();
		$this->db->where('kode',$id);

		if ($_REQUEST['length'] != -1) {
			$this->db->limit($_REQUEST['length'], $_REQUEST['start']);
		}

		$query = $this->db->get();
		return $query->result();
	}
	
	private function _get_datatables_query() {
		$this->db->from($this->table2);
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
	
	function count_filtered($id) {
		$this->_get_datatables_query();
		$this->db->where('kode',$id);
		$query = $this->db->get();
		return $query->num_rows();
	}

	function count_all($id) {
		$this->db->from($this->table2);
		return $this->db->count_all_results();
	}
	
	public function add($data) {
		$this->db->insert($this->table2, $data);
		return $this->db->insert_id();
	}
	
	public function get_by_id($id) {
		$this->db->from($this->table2);
		$this->db->where('id',$id);
		$query = $this->db->get();
		return $query->row();
	}
	
	public function update($where, $data) {
		$this->db->update($this->table2, $data, $where);
		return $this->db->affected_rows();
	}
	
	public function delete_by_id($id) {
		$this->db->where('id', $id);
		$this->db->delete($this->table2);
	}

}