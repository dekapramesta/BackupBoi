<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mdl_kontak extends CI_Model {
	
	private $db2;
	
	public function __construct(){
	  parent::__construct();
			 $this->db2 = $this->load->database('pariwisata_en', TRUE);
	}
	
	public function get_by_id() {
		$this->db->from('kontak');
		$this->db->where('id_kontak','1');
		$query = $this->db->get();
		return $query->row();
	}
	
	public function get_by_id_en() {
		$this->db2->from('kontak');
		$this->db2->where('id_kontak','1');
		$query = $this->db2->get();
		return $query->row();
	}
	
	public function update($where, $data) {
		$this->db->update('kontak', $data, $where);
		return $this->db->affected_rows();
	}
	
	public function update_en($where, $data) {
		$this->db2->update('kontak', $data, $where);
		return $this->db2->affected_rows();
	}
	
}