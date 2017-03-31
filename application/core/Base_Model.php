<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Base_Model extends CI_Model{

  public $db;
  protected $table;

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
  }

  //fungsi untuk memanggil semua data atau berdasarkan kondisi tertentu
  public function get_data($table="" ,$condition = "", $size = 20, $index = 0, $order = "")
  {
    $this->db->cache_on();
    $qry = $this->db->query("SELECT *");
    $qry = $qry->from($table);
    if (!empty($condition))
      $qry->where($condition);
    if (!empty($order))
        $qry->order($order);
    $this->db->cache_off();

    if ($size)
      $qry->limit($size, $index);
    $qry->select("*");
    $result = $qry->get();
    $list = $result->array();
    $result->free_result();

    $qry->select("count(*) as total");
    $result = $qry->get();
    $count = $result->row()->total;
    $result->free_result();

    $qry->flush_cache();

    return array($list, $count);
  }
  //fungsi untuk memanggil data by id
  public function get_by_id($table ,$id)
  {
    $qry = $this->db->from($table)->where('id', $id);
    $result = $qry->get();
    $data = $result->row();
    $result->free_result();
    return $data;
  }

  //fungsi untuk mengupdate/insert data baru
  public function save($table, $data)
  {
    if (empty($data['id']))
      $this->db->insert($table, $data);
    else {
      $this->db->where('id', $id);
      $this->db->update($table, $data);
    }
  }

  //fungsi untuk mendelete data
  public function save($table, $data)
  {
    if (empty($data['id']))
      $this->db->insert($table, $data);
    else {
      $this->db->where('id', $id);
      $this->db->update($table, $data);
    }
  }
}
