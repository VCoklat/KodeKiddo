<?php

class Student_Model extends MY_Model
{
    protected $table = "student";

    public function by_id($id)
    {
        return $this->get(array('id' => $id));
    }
}