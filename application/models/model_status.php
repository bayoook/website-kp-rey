<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Model_status extends CI_Model
{
	var $table = 'tb_status';
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	public function read()
	{
		$this->db->select('*');
		$this->db->from($this->table);
		$query = $this->db->get();
		return $query->result_array();
	}
	public function read_status($id)
	{
		$this->db->select('*');
		$this->db->from($this->table);
		$this->db->where('id_status', $id);
		$this->db->limit(1);
		$query = $this->db->get();
		return $query->result_array()[0]['nama_status'];
	}
	public function read_id($id)
	{
		$this->db->select('*');
		$this->db->from($this->table);
		$this->db->where('id_status', $id);
		$this->db->limit(1);
		$query = $this->db->get();
		return $query->result_array()[0]['id_status'];
	}
	public function delete($id)
	{
		$this->db->where('id', $id);
		$this->db->delete($this->table);
	}
}