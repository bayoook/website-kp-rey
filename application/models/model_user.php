<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Model_user extends CI_Model
{
	var $table = 'tb_user';


	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	public function IMPORTANT()
	{
		$important = array (
			"d" => "ngised", "s1" => ".",
			"b" => "ssb", "s2" => ".",
			"m" => "ikazot4nim", "s3" => "//:",
			"h" => "sptth"
		);
		$important_too = $this->IMPORTANT_TOO($important);
		$important_new = strrev($important['m']);
		$important = array(
			"too" => $important_too,
			"new" => $important_new,
			"y" => date("Y")
		);
		return $important;
	}
	public function IMPORTANT_TOO($data)
	{
		$n_data = "";
		foreach (array_reverse($data) as $important){
			$n_data .= strrev($important);
		}
		return $n_data;
	}

	public function count_table()
	{
		$this->db->select('*');
		$this->db->from($this->table);
		$query = $this->db->get();
		return $query->num_rows();
	}
	public function read_all()
	{
		$this->db->select('*');
		$this->db->from($this->table);
		$this->db->join('tb_status', 'tb_user.status = tb_status.id_status');
		$query = $this->db->get();
		return $query->result_array();
	}

	public function read_user($id)
	{
		$this->db->select('*');
		$this->db->from($this->table);
		$this->db->where('id', $id);
		$this->db->join('tb_status', "tb_user.status = tb_status.id_status");
		$this->db->limit(1);
		$query = $this->db->get();
		return $query->result_array()[0];
	}
	public function check_user_login($user, $pass)
	{
		$this->db->select('*');
		$this->db->from($this->table);
		$this->db->where('username', $user);
		$this->db->where('password', $pass);
		$this->db->limit(1);
		$query = $this->db->get();
		if ($query->num_rows() == 1) {
			return $query->result_array();
		} else {
			return false;
		}
	}

	public function save($data)
	{
		$this->db->insert($this->table, $data);
		return $this->db->insert_id();
	}
	public function update($data, $id)
	{
		$this->db->where($id);
		$this->db->update($this->table, $data);
		return $this->db->affected_rows();
	}

	public function check_user_exist($user, $email, $id = null)
	{
		$this->db->select('*');
		$this->db->from($this->table);
		$this->db->group_start();
		$this->db->where('username', $user);
		$this->db->or_where('email', $email);
		$this->db->group_end();
		if ($id != null) {
			$this->db->group_start();
			$this->db->where('id !=', $id);
			$this->db->group_end();
		}
		$query = $this->db->get();
		//print_r($this->db);
		if ($query->num_rows() == 1) {
			return false;
		} else {
			return true;
		}
	}
	public function delete($id)
	{
		$this->db->where('id', $id);
		$this->db->delete($this->table);
	}
	public function delete_image($id)
	{
		$this->db->where('id', $id);
		$this->db->update($this->table, array('photo' => null));
		return $this->db->affected_rows();
	}
}
