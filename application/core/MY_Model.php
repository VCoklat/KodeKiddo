<?php

class MY_Model extends CI_Model
{
    protected $table = "";

    public function __construct()
    {
        $this->load->database();
    }
    public function get_list($limit = 0, $size = 0, $condition = null, $order = null)
    {
        $this->db->start_cache();

        $this->db->from($this->table);
        $this->join();
        if ($condition !== null)
        {
            $this->db->where($condition);
        }
        $this->db->stop_cache();

        $this->select();
        if ($limit)
        {
            if (!$size)
                $size = null;
            $this->db->limit($limit, $size);
        }
        $query = $this->db->get();
        $result = $query->result();
        $query->free_result();

        $count = $this->db->count_all_results();

        $this->db->flush_cache();

        return array($result, $count);
    }

    public function get($condition)
    {
        $this->select();
        $this->db->from($this->table);
        $this->join();
        $this->db->where($condition);
        $query = $this->db->get();
        //testing
        return $query->unbuffered_row();
        //testing2
    }

    public function get_all()
    {
        $this->select('*');
        $this->db->from($this->table);
        $query = $this->db->get();
        //testing
        return $query->result_array();
        //testing2
    }

    protected function select()
    {
        $this->db->select("{$this->table}.*");
    }
    protected function join()
    {
    }
    protected function generate_id()
    {
    }

    public function save($data, $condition = null)
    {
        if (empty($data))
            return false;

        $is_new = true;
        if (!empty($condition))
            $is_new = $this->db->where($condition)->get($this->table)->count_all_result() < 1;

        if ($is_new)
        {
            $this->generate_id();
            $result = $this->db->insert($this->table, $data);
        }
        else
            $result = $this->db->update($this->table, $data, $condition);

        return $result;
    }

    public function delete($condition)
    {
        return $this->db->delete($this->table, $condition);
    }

    public function insert_id()
    {
        return $this->db->insert_id();
    }
}
