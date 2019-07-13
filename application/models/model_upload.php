<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Model_upload extends CI_Model
{

	var $table = 'tb_upload';


	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	public function count_all_a()
	{
		$data['Nama'] = "SEMUA";
		$data['Nick'] = "all";
		$data['DBS'] = $this->count_a("DBS");
		$data['DES'] = $this->count_a("DES");
		$data['DGS'] = $this->count_a("DGS");
		$data['AVG_DBS'] = number_format($this->avg_a("AVG_DBS", "DBS"), 2);
		$data['AVG_DES'] = number_format($this->avg_a("AVG_DES", "DES"), 2);
		$data['AVG_DGS'] = number_format($this->avg_a("AVG_DGS", "DGS"), 2);
		$data['COMPLY'] = $this->count_com_a("COMPLY");
		$data['NOT_COMPLY'] = $this->count_com_a("NOT COMPLY");
		return $data;
	}
	public function read_nama($city)
	{
		$this->db->select($this->table . '.witel as `' . $city . '`');
		$this->db->like('witel', $city);
		$this->db->from($this->table);
		$query = $this->db->get();
		return $query->result_array()[0][$city];
	}

	public function count_all($city, $nick)
	{
		$data['Nama'] = $this->read_nama($city);
		$data['Nick'] = $nick;
		$data['DBS'] = $this->count("DBS", $city);
		$data['DES'] = $this->count("DES", $city);
		$data['DGS'] = $this->count("DGS", $city);
		$data['AVG_DBS'] = number_format($this->avg("AVG_DBS", "DBS", $city), 2);
		$data['AVG_DES'] = number_format($this->avg("AVG_DES", "DES", $city), 2);
		$data['AVG_DGS'] = number_format($this->avg("AVG_DGS", "DGS", $city), 2);
		$data['COMPLY'] = $this->count_com("COMPLY", $city);
		$data['NOT_COMPLY'] = $this->count_com("NOT COMPLY", $city);
		return $data;
	}
	public function count($type, $city)
	{
		$this->db->select('COUNT(*) as `' . $type . '`');
		$this->db->like('witel', $city);
		$this->db->where('cust_segment', $type);
		$this->db->from($this->table);
		return $this->db->get()->result_array()[0][$type];
	}
	public function avg($type, $name, $city)
	{
		$this->db->select('AVG(ttr_cust) as `' . $type . '`');
		$this->db->like('witel', $city);
		$this->db->where('cust_segment', $name);
		$this->db->from($this->table);
		return $this->db->get()->result_array()[0][$type];
	}
	public function count_com($type, $city)
	{
		$this->db->select('COUNT(*) as `' . $type . '`');
		$this->db->like('witel', $city);
		$this->db->where('compliance', $type);
		$this->db->from($this->table);
		return $this->db->get()->result_array()[0][$type];
	}
	public function count_a($type)
	{
		$this->db->select('COUNT(*) as `' . $type . '`');
		$this->db->where('cust_segment', $type);
		$this->db->where('regional', '3');
		$this->db->from($this->table);
		return $this->db->get()->result_array()[0][$type];
	}

	public function avg_a($type, $name)
	{
		$this->db->select('AVG(ttr_cust) as `' . $type . '`');
		$this->db->where('cust_segment', $name);
		$this->db->where('regional', '3');
		$this->db->from($this->table);
		return $this->db->get()->result_array()[0][$type];
	}
	public function count_com_a($type)
	{
		$this->db->select('COUNT(*) as `' . $type . '`');
		$this->db->where('compliance', $type);
		$this->db->where('regional', '3');
		$this->db->from($this->table);
		return $this->db->get()->result_array()[0][$type];
	}

	public function delete_all()
	{
		$this->db->truncate($this->table); 
	}

	public function save($data)
	{
		$this->db->insert($this->table, $data);
	}

	function olah_data($data) {
		
	}
}