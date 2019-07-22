<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Model_history extends CI_Model
{

	var $table = 'tb_history';


	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	
	public function save($data)
	{
		$this->db->insert($this->table, $data);
		$id = $this->db->insert_id();
		return $id;
	}
	public function load()
	{
        $query = $this->db->get($this->table);
        return $query->result_array();
	}
	public function load_by_id($id)
	{
		$this->db->select('awal, akhir');
		$this->db->where('id', $id);
		$this->db->limit(1);
		return $this->db->get($this->table)->result_array()[0];
	}
	public function delete_where_id($id)
	{
		$data = $this->load_by_id($id);
		$this->db->where('id >= ', $data['awal']);
		$this->db->where('id <= ', $data['akhir']);
		$this->db->delete('tb_upload');

		$this->db->where('id', $id);
		$this->db->delete($this->table);
	}

	public function hide_table($id, $type)
	{
		$this->db->where('id', $id);
		$this->db->update($this->table, array('status' => $type));
		// return $query->result_array();
	}

}
