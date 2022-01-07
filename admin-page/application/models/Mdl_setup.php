<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mdl_setup extends CI_Model {

	private $db2;
	
	public function __construct(){
	  parent::__construct();
			 $this->db2 = $this->load->database('pariwisata_en', TRUE);
	}
	
	var $table = 't_setup';
	
	public function get_by_id() {
		$this->db->select('a.fc_kode as set_wisata1, b.fc_kode as set_wisata2, c.fc_kode as set_wisata3, d.fc_kode as set_wisata4,e.fc_kode as set_wisata5,f.fc_isi as set_wisata6
						  ,g.fc_isi as set_wisata7,h.fc_isi as set_wisata8,i.fc_isi as set_wisata9,j.fc_isi as set_wisata10,k.fc_isi as set_wisata11,l.fc_isi as set_wisata12,m.fc_isi as set_wisata13,
						  n.fc_isi as set_wisata14,o.fc_isi as set_wisata15,p.fc_isi as set_wisata16');
		$this->db->from('t_setup a');
		$this->db->join('t_setup b ', 'b.fc_param="WISATA" AND b.ID="2"', 'left outer');
		$this->db->join('t_setup c ', 'c.fc_param="WISATA" AND c.ID="27"', 'left outer');
		$this->db->join('t_setup d ', 'd.fc_param="WISATA" AND d.ID="5"', 'left outer');
		$this->db->join('t_setup e ', 'e.fc_param="WISATA" AND e.ID="7"', 'left outer');
		$this->db->join('t_setup f ', 'f.fc_param="FACEBOOK"', 'left outer');
		$this->db->join('t_setup g ', 'g.fc_param="TWITTER"', 'left outer');
		$this->db->join('t_setup h ', 'h.fc_param="INSTAGRAM"', 'left outer');
		$this->db->join('t_setup i ', 'i.fc_param="YOUTUBE"', 'left outer');
		$this->db->join('t_setup j ', 'j.fc_param="SEKILAS"', 'left outer');
		$this->db->join('t_setup k ', 'k.fc_param="JUDUL"', 'left outer');
		$this->db->join('t_setup l ', 'l.fc_param="HEADER" AND l.fc_kode="1"', 'left outer');
		$this->db->join('t_setup m ', 'm.fc_param="HEADER" AND m.fc_kode="2"', 'left outer');
		$this->db->join('t_setup n ', 'n.fc_param="HEADER" AND n.fc_kode="3"', 'left outer');
		$this->db->join('t_setup o ', 'o.fc_param="HEADER" AND o.fc_kode="4"', 'left outer');
		$this->db->join('t_setup p ', 'p.fc_param="HEADER" AND p.fc_kode="5"', 'left outer');
		$this->db->where('a.fc_param','WISATA');
		$this->db->where('a.ID','1');
		$query = $this->db->get();
		return $query->row();
	}

	public function get_by_id_en() {
		$this->db2->select('a.fc_kode as set_wisata1, b.fc_kode as set_wisata2, c.fc_kode as set_wisata3, d.fc_kode as set_wisata4,e.fc_kode as set_wisata5,f.fc_isi as set_wisata6
						  ,g.fc_isi as set_wisata7,h.fc_isi as set_wisata8,i.fc_isi as set_wisata9,j.fc_isi as set_wisata10,k.fc_isi as set_wisata11,l.fc_isi as set_wisata12,m.fc_isi as set_wisata13,
						  n.fc_isi as set_wisata14,o.fc_isi as set_wisata15,p.fc_isi as set_wisata16');
		$this->db2->from('t_setup a');
		$this->db2->join('t_setup b ', 'b.fc_param="WISATA" AND b.ID="2"', 'left outer');
		$this->db2->join('t_setup c ', 'c.fc_param="WISATA" AND c.ID="27"', 'left outer');
		$this->db2->join('t_setup d ', 'd.fc_param="WISATA" AND d.ID="5"', 'left outer');
		$this->db2->join('t_setup e ', 'e.fc_param="WISATA" AND e.ID="7"', 'left outer');
		$this->db2->join('t_setup f ', 'f.fc_param="FACEBOOK"', 'left outer');
		$this->db2->join('t_setup g ', 'g.fc_param="TWITTER"', 'left outer');
		$this->db2->join('t_setup h ', 'h.fc_param="INSTAGRAM"', 'left outer');
		$this->db2->join('t_setup i ', 'i.fc_param="YOUTUBE"', 'left outer');
		$this->db2->join('t_setup j ', 'j.fc_param="SEKILAS"', 'left outer');
		$this->db2->join('t_setup k ', 'k.fc_param="JUDUL"', 'left outer');
		$this->db2->join('t_setup l ', 'l.fc_param="HEADER" AND l.fc_kode="1"', 'left outer');
		$this->db2->join('t_setup m ', 'm.fc_param="HEADER" AND m.fc_kode="2"', 'left outer');
		$this->db2->join('t_setup n ', 'n.fc_param="HEADER" AND n.fc_kode="3"', 'left outer');
		$this->db2->join('t_setup o ', 'o.fc_param="HEADER" AND o.fc_kode="4"', 'left outer');
		$this->db2->join('t_setup p ', 'p.fc_param="HEADER" AND p.fc_kode="5"', 'left outer');
		$this->db2->where('a.fc_param','WISATA');
		$this->db2->where('a.ID','1');
		$query = $this->db2->get();
		return $query->row();
	}
	
	public function update_link($data1,$data2,$data3,$data4) {
		$this->db->update($this->table, $data1, $data2, $data3, $data4);
		return $this->db->affected_rows();
	}

	public function update_link_en($data1,$data2,$data3,$data4) {
		$this->db2->update($this->table, $data1, $data2, $data3, $data4);
		return $this->db2->affected_rows();
	}
	
	public function update_sekilas($data1,$data2) {
		$this->db->update($this->table, $data1, $data2);
		return $this->db->affected_rows();
	}

	public function update_sekilas_en($data1,$data2) {
		$this->db2->update($this->table, $data1, $data2);
		return $this->db2->affected_rows();
	}
	
	public function update_data($data, $data2) {
		$this->db->update($this->table, $data, $data2);
		return $this->db->affected_rows();
	}
	
	public function update_data_en($data, $data2) {
		$this->db2->update($this->table, $data, $data2);
		return $this->db2->affected_rows();
	}
	
	public function update_event($data, $data2) {
		$this->db->update($this->table, $data, $data2);
		return $this->db->affected_rows();
	}
	
	public function update_event_en($data, $data2) {
		$this->db2->update($this->table, $data, $data2);
		return $this->db2->affected_rows();
	}
	
	public function update_berita($data, $data2) {
		$this->db->update($this->table, $data, $data2);
		return $this->db->affected_rows();
	}
	
	public function update_berita_en($data, $data2) {
		$this->db2->update($this->table, $data, $data2);
		return $this->db2->affected_rows();
	}
	
	public function update_about($data, $data2) {
		$this->db->update($this->table, $data, $data2);
		return $this->db->affected_rows();
	}
	
	public function update_about_en($data, $data2) {
		$this->db2->update($this->table, $data, $data2);
		return $this->db2->affected_rows();
	}
	
	public function upload_kontak($data, $data2) {
		$this->db->update($this->table, $data, $data2);
		return $this->db->affected_rows();
	}
	
	public function upload_kontak_en($data, $data2) {
		$this->db2->update($this->table, $data, $data2);
		return $this->db2->affected_rows();
	}	
	public function update_wisata($data1, $where, $data2, $where2, $data3, $where3, $data4, $where4, $data5, $where5) {
		$this->db->update($this->table, $data1, $where, $data2, $where2, $data3, $where3, $data4, $where4, $data5, $where5);
		print_r($this->db->last_query());
		return $this->db->affected_rows();
	}

	public function update_wisata_en($data1, $where, $data2, $where2, $data3, $where3, $data4, $where4, $data5, $where5) {
		$this->db2->update($this->table, $data1, $where, $data2, $where2, $data3, $where3, $data4, $where4, $data5, $where5);
		print_r($this->db2->last_query());
		return $this->db2->affected_rows();
	}
}	