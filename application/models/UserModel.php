<?php
/**
 * Created by PhpStorm.
 * User: oussema
 * Date: 12/1/2019
 * Time: 11:50
 */

class userModel extends CI_Model
{
    public function __construct()
    {
        $this->load->database();
    }
    public function getUsers(){
        $query= $this->db->get('users');
        return $query->result_array();
    }
    public function addUser(){
        $data=array(
            'name'=> $this->input->post('name'),
            'email'=> $this->input->post('email')
        );
        return $this->db->insert('users',$data);
    }
}