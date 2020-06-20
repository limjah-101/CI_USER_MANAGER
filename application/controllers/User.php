<?php

class User extends CI_Controller{

    public function __construct()
    {
        parent::__construct();
        $this->load->helpers("url");
        $this->load->model("User_model");
    }
    
    /**
     * 
     */
    public function index()
    {
        $users["users"] = $this->User_model->getAllUsers();
        $this->load->view("user_view", $users);
    }

    /**
     * 
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
     * 
     */
    public function edit($id)
    {
        $user = $this->User_model->getUser($id);
        echo json_encode($user);
    }

    /**
     * 
     */
    public function update()
    {
        $user = [        
            // 'id' => $this->input->post('user_id'),    
            'name' => $this->input->post('user_name'),
            'email' => $this->input->post('user_email'),
        ];

        $insert = $this->User_model->updateUser(["id" => $this->input->post("user_id")], $user);        
        echo json_encode(["status" => 200]);
        // echo json_encode($data);
    }

    /**
     * DELETE A SINGLE USER
     * @var
     */

     public function delete($id)
     {
         $this->User_model->deleteUser($id);
         echo json_encode(["status" => 200]);
     }
}