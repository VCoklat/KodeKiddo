<?php

class Student_Model extends MY_Model
{
    protected $table = "student";
    protected $id="1"; // ini saya coba dengan memaksa variabel id=1
    
    public function by_id($id)
    {
<<<<<<< HEAD
        return $this->get(array('studentid' => $id));
=======
        return $this->get(array('studentId' => $id));
    }


    public function get_list_student()
    {
        //return $this->get(array());
>>>>>>> origin/master
    }
}
