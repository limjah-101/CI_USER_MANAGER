<?php

class User_model extends CI_Model{

    public $table = "users";
    
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    /**
     * CREATE A SINGLE USER
     */
    public function createUser($data)
    {        
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }

    /**
     * FETCH ALL USERS
     */
    public function getAllUsers()
    {
        $this->db->from('users');
        $users = $this->db->get();
        return $users->result();
    }

    /**
     *  FETCH A SINGLE USER
     */
    public function getUser($id)
    {
        $this->db->from($this->table);
        $this->db->where("id", $id);
        $user = $this->db->get();
        return $user->row();
    }

    /**
     *  UPDATE A SINGLE USER
     */
    public function updateUser($id, $user)
    {
        $this->db->update($this->table, $user, $id);
        return $this->db->affected_rows();
    }

    /**
     *  DELETE A SINGLE USER
     */
    public function deleteUser($id)
    {
        $this->db->where("id", $id);
        $this->db->delete($this->table);        
    }


}