<?php

class User extends CI_Controller{

    public function __construct()
    {
        parent::__construct();
        $this->load->helpers("url");
        $this->load->model("User_model");
    }
    
    /**
     * FETCH ALL USERS
     * @return Obj
     */
    public function index()
    {
        $users["users"] = $this->User_model->getAllUsers();
        $this->load->view("user_view", $users);
    }

    /**
     *  CREATE A NEW USER
     * @return Json
     */
    public function create()
    {
        $data = [            
            'name' => $this->input->post('user_name'),
            'email' => $this->input->post('user_email'),
        ];
        $insert = $this->User_model->createUser($data);        
        echo json_encode(["status" => TRUE]);
    }

    /**
     *  EDIT A SINGLE USER
     * @var int
     */
    public function edit($id)
    {
        $user = $this->User_model->getUser($id);
        echo json_encode($user);
    }

    /**
     *  UPDATE A SINGLE USER
     * @return obj
     */
    public function update()
    {
        $user = [                     
            'name' => $this->input->post('user_name'),
            'email' => $this->input->post('user_email'),
        ];

        $insert = $this->User_model->updateUser(["id" => $this->input->post("user_id")], $user);        
        echo json_encode(["status" => 200]);        
    }

    /**
     * DELETE A SINGLE USER
     * @var int
     */

     public function delete($id)
     {
         $this->User_model->deleteUser($id);
         echo json_encode(["status" => 200]);
     }
}