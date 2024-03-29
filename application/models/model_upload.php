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
	public function get_maximum_date($type)
	{
		$this->db->select('MAX(report_date) as max');
		$this->db->where('type', $type);
		return $this->db->get($this->table)->result_array()[0]['max'];
	}
	public function get_minimum_date($type)
	{
		$this->db->select('MIN(report_date) as min');
		$this->db->where('type', $type);
		return $this->db->get($this->table)->result_array()[0]['min'];
	}
	public function get_all_data($type, $date_start, $date_end)
	{
		$data = array();
		$this->db->select('SUM(CASE WHEN cust_segment="DBS" THEN 1 ELSE 0 END) as dbs');
		$this->db->select('SUM(CASE WHEN cust_segment="DES" THEN 1 ELSE 0 END) as des');
		$this->db->select('SUM(CASE WHEN cust_segment="DGS" THEN 1 ELSE 0 END) as dgs');
		$this->db->select('AVG(CASE WHEN cust_segment="DBS" THEN ttr_cust END) as ttr_dbs');
		$this->db->select('AVG(CASE WHEN cust_segment="DES" THEN ttr_cust END) as ttr_des');
		$this->db->select('AVG(CASE WHEN cust_segment="DGS" THEN ttr_cust END) as ttr_dgs');
		$this->db->select('SUM(CASE WHEN top_prio="TOP20 DGS" OR top_prio="TOP20 DGS POTS" THEN 1 ELSE 0 END) as t20dgs');
		$this->db->select('SUM(CASE WHEN top_prio="TOP20 DES" OR top_prio="TOP20 DES POTS" THEN 1 ELSE 0 END) as t20des');
		$this->db->select('SUM(CASE WHEN top_prio="TOP100 DBS" OR top_prio="TOP100 DBS POTS" THEN 1 ELSE 0 END) as t100dbs');
		$this->db->select('SUM(CASE WHEN top_prio="TOP100 DGS" OR top_prio="TOP100 DGS POTS" THEN 1 ELSE 0 END) as t100dgs');
		$this->db->select('SUM(CASE WHEN top_prio="TOP200 DES" OR top_prio="TOP200 DES POTS" THEN 1 ELSE 0 END) as t200des');
		$this->db->select('SUM(CASE WHEN top_prio="OTHER DGS" OR top_prio="OTHER DGS POTS" THEN 1 ELSE 0 END) as odgs');
		$this->db->select('SUM(CASE WHEN top_prio="OTHER DES" OR top_prio="OTHER DES POTS" THEN 1 ELSE 0 END) as odes');
		$this->db->select('SUM(CASE WHEN top_prio="OTHER DBS" OR top_prio="OTHER DBS POTS" THEN 1 ELSE 0 END) as odbs');
		$this->db->select('AVG(ttr_cust) as ttr_avg');
		$this->db->select('SUM(CASE WHEN compliance="COMPLY" THEN 1 ELSE 0 END) as com');
		$this->db->select('SUM(CASE WHEN compliance="NOT_COMPLY" THEN 1 ELSE 0 END) as not_com');
		$this->db->where('type', $type);
		$this->db->where('status', 'show');
		$this->db->where('report_date >=', $date_start);
		$this->db->where('report_date <=', $date_end);
		$this->db->where('exclude', '');
		$data = $this->db->get($this->table)->result_array()[0];
		// print_r($this->db->last_query());
		$this->db->select('regional');
		$this->db->select('SUM(CASE WHEN cust_segment="DBS" THEN 1 ELSE 0 END) as dbs');
		$this->db->select('SUM(CASE WHEN cust_segment="DES" THEN 1 ELSE 0 END) as des');
		$this->db->select('SUM(CASE WHEN cust_segment="DGS" THEN 1 ELSE 0 END) as dgs');
		$this->db->select('AVG(CASE WHEN cust_segment="DBS" THEN ttr_cust END) as ttr_dbs');
		$this->db->select('AVG(CASE WHEN cust_segment="DES" THEN ttr_cust END) as ttr_des');
		$this->db->select('AVG(CASE WHEN cust_segment="DGS" THEN ttr_cust END) as ttr_dgs');
		$this->db->select('SUM(CASE WHEN top_prio="TOP20 DGS" OR top_prio="TOP20 DGS POTS" THEN 1 ELSE 0 END) as t20dgs');
		$this->db->select('SUM(CASE WHEN top_prio="TOP20 DES" OR top_prio="TOP20 DES POTS" THEN 1 ELSE 0 END) as t20des');
		$this->db->select('SUM(CASE WHEN top_prio="TOP100 DBS" OR top_prio="TOP100 DBS POTS" THEN 1 ELSE 0 END) as t100dbs');
		$this->db->select('SUM(CASE WHEN top_prio="TOP100 DGS" OR top_prio="TOP100 DGS POTS" THEN 1 ELSE 0 END) as t100dgs');
		$this->db->select('SUM(CASE WHEN top_prio="TOP200 DES" OR top_prio="TOP200 DES POTS" THEN 1 ELSE 0 END) as t200des');
		$this->db->select('SUM(CASE WHEN top_prio="OTHER DGS" OR top_prio="OTHER DGS POTS" THEN 1 ELSE 0 END) as odgs');
		$this->db->select('SUM(CASE WHEN top_prio="OTHER DES" OR top_prio="OTHER DES POTS" THEN 1 ELSE 0 END) as odes');
		$this->db->select('SUM(CASE WHEN top_prio="OTHER DBS" OR top_prio="OTHER DBS POTS" THEN 1 ELSE 0 END) as odbs');
		$this->db->select('AVG(ttr_cust) as ttr_avg');
		$this->db->select('SUM(CASE WHEN compliance="COMPLY" THEN 1 ELSE 0 END) as com');
		$this->db->select('SUM(CASE WHEN compliance="NOT_COMPLY" THEN 1 ELSE 0 END) as not_com');
		$this->db->group_by('regional');
		$this->db->where('type', $type);
		$this->db->where('status', 'show');
		$this->db->where('exclude', '');
		$this->db->where('report_date >=', $date_start);
		$this->db->where('report_date <=', $date_end);
		$data['regional_list'] = $this->db->get($this->table)->result_array();
		// print_r($this->db->last_query());
		foreach ($data['regional_list'] as $keys => $rows) {
			$this->db->select('regional, witel');
			$this->db->select('SUM(CASE WHEN cust_segment="DBS" THEN 1 ELSE 0 END) as dbs');
			$this->db->select('SUM(CASE WHEN cust_segment="DES" THEN 1 ELSE 0 END) as des');
			$this->db->select('SUM(CASE WHEN cust_segment="DGS" THEN 1 ELSE 0 END) as dgs');
			$this->db->select('AVG(CASE WHEN cust_segment="DBS" THEN ttr_cust END) as ttr_dbs');
			$this->db->select('AVG(CASE WHEN cust_segment="DES" THEN ttr_cust END) as ttr_des');
			$this->db->select('AVG(CASE WHEN cust_segment="DGS" THEN ttr_cust END) as ttr_dgs');
			$this->db->select('SUM(CASE WHEN top_prio="TOP20 DGS" OR top_prio="TOP20 DGS POTS" THEN 1 ELSE 0 END) as t20dgs');
			$this->db->select('SUM(CASE WHEN top_prio="TOP20 DES" OR top_prio="TOP20 DES POTS" THEN 1 ELSE 0 END) as t20des');
			$this->db->select('SUM(CASE WHEN top_prio="TOP100 DBS" OR top_prio="TOP100 DBS POTS" THEN 1 ELSE 0 END) as t100dbs');
			$this->db->select('SUM(CASE WHEN top_prio="TOP100 DGS" OR top_prio="TOP100 DGS POTS" THEN 1 ELSE 0 END) as t100dgs');
			$this->db->select('SUM(CASE WHEN top_prio="TOP200 DES" OR top_prio="TOP200 DES POTS" THEN 1 ELSE 0 END) as t200des');
			$this->db->select('SUM(CASE WHEN top_prio="OTHER DGS" OR top_prio="OTHER DGS POTS" THEN 1 ELSE 0 END) as odgs');
			$this->db->select('SUM(CASE WHEN top_prio="OTHER DES" OR top_prio="OTHER DES POTS" THEN 1 ELSE 0 END) as odes');
			$this->db->select('SUM(CASE WHEN top_prio="OTHER DBS" OR top_prio="OTHER DBS POTS" THEN 1 ELSE 0 END) as odbs');
			$this->db->select('AVG(ttr_cust) as ttr_avg');
			$this->db->select('SUM(CASE WHEN compliance="COMPLY" THEN 1 ELSE 0 END) as com');
			$this->db->select('SUM(CASE WHEN compliance="NOT_COMPLY" THEN 1 ELSE 0 END) as not_com');
			$this->db->group_by('regional, witel');
			$this->db->where('regional', $rows['regional']);
			$this->db->where('type', $type);
			$this->db->where('status', 'show');
			$this->db->where('report_date >=', $date_start);
			$this->db->where('report_date <=', $date_end);
			$this->db->where('exclude', '');
			$data['regional_list'][$keys]['witel_list'] = array();
			$data['regional_list'][$keys]['witel_list'] += $this->db->get($this->table)->result_array();
		}

		return $data;
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
	public function view_all_table()
	{
		$data = $this->db->get($this->table)->result_array();
		return $data;
		# code...
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

	public function delete_all($table)
	{
		$this->db->truncate($table);
	}

	public function save($data)
	{
		$this->db->insert($this->table, $data);
		$id = $this->db->insert_id();
		return $id;
	}

	function backup($table_from, $table_to)
	{
		$data = $this->read_all($table_from);
		$this->db->truncate($table_to);
		foreach ($data as $row) {
			$this->db->insert($table_to, $row);
			$this->db->from($table_from);
		}
	}
	function read_all($table)
	{
		$query = $this->db->get($table);
		return $query->result_array();
	}
	public function hide_table($data, $type)
	{
		$this->db->where($data);
		$this->db->update($this->table, array('status' => $type));
		// return $query->result_array();
	}
}
