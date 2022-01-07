<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mdl_user extends CI_Model {
	
	var $table = 'admin';
	var $column_order = array('a.admin_id','a.admin_username','a.admin_password','a.admin_view_password','b.user_type_name',null); //set column field database for datatable orderable
	var $column_search = array('a.admin_id','a.admin_username','a.admin_password','a.admin_view_password','b.user_type_name'); //set column field database for datatable searchable just title , author , category are searchable
	var $order = array('a.admin_id' => 'asc'); // default order
	
	var $table2 = 'user_type';
	var $column_order_level = array('user_type_id','user_type_name',null); //set column field database for datatable orderable
	var $column_search_level = array('user_type_id','user_type_name'); //set column field database for datatable searchable just title , author , category are searchable
	var $order_level = array('user_type_id' => 'asc'); // default order
	
	var $table3 = 'tab_akses_mainmenu';
	var $column_order_main = array('e.idmenu','e.nama_menu','d.id_menu','d.id_level',null); //set column field database for datatable orderable
	var $column_search_main = array('e.idmenu','e.nama_menu','d.id_menu','d.id_level'); //set column field database for datatable searchable just title , author , category are searchable
	var $order_main = array('e.idmenu' => 'asc'); // default order
	
	var $table4 = 'tab_akses_submenu';
	var $column_order_sub = array('f.id_sub_menu','f.id_level','g.id_sub','g.nama_sub',null); //set column field database for datatable orderable
	var $column_search_sub = array('f.id_sub_menu','f.id_level','g.id_sub','g.nama_sub'); //set column field database for datatable searchable just title , author , category are searchable
	var $order_sub = array('f.id_sub_menu' => 'asc'); // default order
	
	private function _get_datatables_query() {
		$this->db->select('a.*,b.user_type_id,b.user_type_name');
		$this->db->from('admin a');
		$this->db->join('user_type b','b.user_type_id=a.admin_hak_akses','left outer');
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
	
	private function _get_datatables_query_level() {
		$this->db->from($this->table2);
		$i = 0;
		foreach ($this->column_search_level as $item) {
			if ($_REQUEST['search']["value"]) {
				if ($i===0) {
					$this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
					$this->db->like($item, $_REQUEST['search']["value"]);
				} else {
					$this->db->or_like($item, $_REQUEST['search']["value"]);
			}
			
			if (count($this->column_search_level) - 1 == $i)
				$this->db->group_end();
			}

			$i++;
		}

		if (isset($_REQUEST['order'])) {
			$this->db->order_by($this->column_order_level[$_REQUEST['order']['0']['column']], $_REQUEST['order']['0']['dir']);
		} else if (isset($this->order_level)) {
			$order = $this->order_level;
			$this->db->order_by(key($order), $order[key($order)]);
		}
	}
	
	private function _get_datatables_query_main() {
		$this->db->select('d.*, e.*');
		$this->db->from('tab_akses_mainmenu d');
		$this->db->join('mainmenu e','e.idmenu=d.id_menu');
		$i = 0;
		foreach ($this->column_search_main as $item) {
			if ($_REQUEST['search']["value"]) {
				if ($i===0) {
					$this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
					$this->db->like($item, $_REQUEST['search']["value"]);
				} else {
					$this->db->or_like($item, $_REQUEST['search']["value"]);
			}
			
			if (count($this->column_search_main) - 1 == $i)
				$this->db->group_end();
			}

			$i++;
		}

		if (isset($_REQUEST['order'])) {
			$this->db->order_by($this->column_order_main[$_REQUEST['order']['0']['column']], $_REQUEST['order']['0']['dir']);
		} else if (isset($this->order_main)) {
			$order = $this->order_main;
			$this->db->order_by(key($order), $order[key($order)]);
		}
	}
	
	private function _get_datatables_query_sub() {
		$this->db->select('f.*, g.*');
		$this->db->from('tab_akses_submenu f');
		$this->db->join('submenu g','g.id_sub=f.id_sub_menu');
		$i = 0;
		foreach ($this->column_search_sub as $item) {
			if ($_REQUEST['search']["value"]) {
				if ($i===0) {
					$this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
					$this->db->like($item, $_REQUEST['search']["value"]);
				} else {
					$this->db->or_like($item, $_REQUEST['search']["value"]);
			}
			
			if (count($this->column_search_sub) - 1 == $i)
				$this->db->group_end();
			}

			$i++;
		}

		if (isset($_REQUEST['order'])) {
			$this->db->order_by($this->column_order_sub[$_REQUEST['order']['0']['column']], $_REQUEST['order']['0']['dir']);
		} else if (isset($this->order_sub)) {
			$order = $this->order_sub;
			$this->db->order_by(key($order), $order[key($order)]);
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
	
	function count_filtered_level() {
		$this->_get_datatables_query_level();
		$query = $this->db->get();
		return $query->num_rows();
	}

	function count_all_level() {
		$this->db->from($this->table2);
		return $this->db->count_all_results();
	}

	public function get_datatables_level() {
		$this->_get_datatables_query_level();

		if ($_REQUEST['length'] != -1) {
			$this->db->limit($_REQUEST['length'], $_REQUEST['start']);
		}

		$query = $this->db->get();
		return $query->result();
	}
	
	public function get_datatables_main($id) {
		$this->_get_datatables_query_main();
		$this->db->where('d.id_level',$id);

		if ($_REQUEST['length'] != -1) {
			$this->db->limit($_REQUEST['length'], $_REQUEST['start']);
		}

		$query = $this->db->get();
		return $query->result();
	}
	
	function count_filtered_main($id) {
		$this->_get_datatables_query_main();
		$this->db->where('d.id_level',$id);
		$query = $this->db->get();
		return $query->num_rows();
	}

	function count_all_main($id) {
		$this->db->from($this->table3);
		return $this->db->count_all_results();
	}
	
	public function get_datatables_sub($id) {
		$this->_get_datatables_query_sub();
		$this->db->where('f.id_level',$id);

		if ($_REQUEST['length'] != -1) {
			$this->db->limit($_REQUEST['length'], $_REQUEST['start']);
		}

		$query = $this->db->get();
		return $query->result();
	}
	
	function count_filtered_sub($id) {
		$this->_get_datatables_query_sub();
		$this->db->where('f.id_level',$id);
		$query = $this->db->get();
		return $query->num_rows();
	}

	function count_all_sub($id) {
		$this->db->from($this->table4);
		return $this->db->count_all_results();
	}
	
	function get_level() {
	  	$query = $this->db->get('user_type');
	  	return $query->result();
    }
	
	
	public function add($data) {
		$this->db->insert($this->table, $data);
		return $this->db->insert_id();
	}
	
	public function get_by_id($id) {
		$this->db->from($this->table);
		$this->db->where('admin_id',$id);
		$query = $this->db->get();
		return $query->row();
	}
	
	public function update($where, $data) {
		$this->db->update($this->table, $data, $where);
		return $this->db->affected_rows();
	}
	
	public function delete_by_id($id) {
		$this->db->where('admin_id', $id);
		$this->db->delete($this->table);
	}
	
	public function add_level($data) {
		$this->db->insert($this->table2, $data);
		return $this->db->insert_id();
	}
	
	public function get_by_level($id) {
		$this->db->from($this->table2);
		$this->db->where('user_type_id',$id);
		$query = $this->db->get();
		return $query->row();
	}
	
	public function update_level($where, $data) {
		$this->db->update($this->table2, $data, $where);
		return $this->db->affected_rows();
	}
	
	public function delete_by_level($id) {
		$this->db->where('user_type_id', $id);
		$this->db->delete($this->table2);
	}
	
	public function get_by_menu($key) {
		$this->db->select('user_type.*, tab_akses_mainmenu.*, tab_akses_submenu.*');
		$this->db->join('tab_akses_mainmenu','tab_akses_mainmenu.id_level=user_type.user_type_id','left outer');
		$this->db->join('tab_akses_submenu', 'tab_akses_submenu.id_level=user_type.user_type_id');
		$this->db->where('user_type_id', $key);
        return $this->db->get('user_type')->row();
	}
	
	public function get_by_submenu($id) {
    	$this->db->select('submenu.*, tab_akses_submenu.*');
		$this->db->from('submenu');
		$this->db->join('tab_akses_submenu','tab_akses_submenu.id_sub_menu=submenu.id_sub','left outer');
		$this->db->where('id_sub',$id);
		$query = $this->db->get();
		return $query->row();
	}
	
	public function update_submenu($where, $data_update1) {
		$this->db->update('submenu', $data_update1, $where);
		return $this->db->affected_rows();
	}

	public function update_submenu2($where, $data_update2) {
		$this->db->update('tab_akses_submenu', $data_update2, $where);
		return $this->db->affected_rows();
	}
	
	public function get_by_mainmenu($id) {
    	$this->db->select('mainmenu.*, tab_akses_mainmenu.*');
		$this->db->from('mainmenu');
		$this->db->join('tab_akses_mainmenu','tab_akses_mainmenu.id_menu=mainmenu.idmenu','left outer');
		$this->db->where('idmenu',$id);
		$query = $this->db->get();
		return $query->row();
	}
	
	public function update_menu1($where, $data_mainupdate1) {
		$this->db->update('mainmenu', $data_mainupdate1, $where);
		return $this->db->affected_rows();
	}

	public function update_menu2($where, $data_mainupdate2) {
		$this->db->update('tab_akses_mainmenu', $data_mainupdate2, $where);
		return $this->db->affected_rows();
	}
	
	function input_menu2($data_subinsert){
        $this->db->insert('tab_akses_mainmenu', $data_subinsert);
    }
	
	 function input_sub2($data_sub2){
        $this->db->insert('tab_akses_submenu', $data_sub2);
    }
}