<?php
class User extends Admin_Controller {

public function __construct() {
    parent::__construct();
    $this->load->model('userModel');
    $this->load->model('RegionModel');
    $this->load->library('session');

    $region = $this->session->userdata('region');
    if($region != 0){
        redirect("coupon");
    }
  
}
/*
function for manage User.
return all Users.
created by your name
created at 25-02-21.
santosh salve
*/
public function index() { 
    $region = $this->session->userdata('region');
    if($region == 0){
        $data['users'] = $this->userModel->getAll();
    }else{
        //$data['users'] = $this->userModel->getDataByRegion($region);
        redirect("coupon");
    }
    //$data['users'] = $this->userModel->getAll();
    
    foreach($data['users'] as $user){
        if($user->region == 0){
            $user->region = array((object) array('id' => 0, 'name' => 'All'));
        }else{
            $user->region = $this->RegionModel->getDataById($user->region);
        }
        
    }
    $this->render('user/index', $data);
}
/*
function for  add User get
created by your name
created at 25-02-21.
*/
public function add() {
    $region = $this->session->userdata('region');
    if($region != 0){
        redirect("coupon");
    }
    $data['region'] = $this->RegionModel->getAll();
    $this->render('user/add', $data);
}
/*
function for add User post
created by your name
created at 25-02-21.
*/
public function addUserPost() {
    $data['username'] = $this->input->post('username');
    $data['password'] = md5($this->input->post('password'));
    $data['email'] = $this->input->post('email');
    $data['firstname'] = $this->input->post('firstname');
    $data['lastname'] = $this->input->post('lastname');
    $data['region'] = $this->input->post('region');
    $data['active'] = $this->input->post('active') == 'checked' ? 1 : 0; 


    $this->form_validation->set_rules('username', 'Username', 'required|is_unique[users.username]',
    array(
        'required'      => 'You have not provided %s.',
        'is_unique'     => 'This %s already exists.'
    ));
    $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[4]');
    $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|is_unique[users.email]',
    array(
        'required'      => 'You have not provided %s.',
        'is_unique'     => 'This %s already exists.'
    ));
    $this->form_validation->set_rules('firstname', 'Firstname', 'trim|required');
    if ($this->form_validation->run() == TRUE) {
        $this->userModel->insert($data);
        $this->session->set_flashdata('success', 'User added Successfully');
        redirect('user');
    } else {
        $this->session->set_flashdata('error', validation_errors());
        redirect('user/add', $data);
    }
}
/*
function for edit User get
returns  User by id.
created by your name
created at 25-02-21.
*/
public function edit($user_id) {
   

    $data['user_id'] = $user_id;
    $data['user'] = $this->userModel->getDataById($user_id);
    $data['region'] = $this->RegionModel->getAll();
    $this->render('user/edit', $data);    
    
}
/*
function for edit User post
created by your name
created at 25-02-21.
*/
public function editUserPost() {
    $user_id = $this->input->post('user_id');
    $data['firstname'] = $this->input->post('firstname');
    $data['lastname'] = $this->input->post('lastname');
    $data['region'] = $this->input->post('region');
    $data['active'] = $this->input->post('active') == 'checked' ? 1 : 0;
    $password = $this->input->post('password');

    if($password){
        if(strlen($password) > 4){
            $data['password'] = md5($password);
        }else{
            $this->session->set_flashdata('error', "The password is invalid.");
            redirect('user/edit/'.$user_id, $data);
        }
    }
   
    $this->form_validation->set_rules('firstname', 'Firstname', 'trim|required');
    if ($this->form_validation->run() == TRUE) {
        $edit = $this->userModel->update($user_id,$data);
        if ($edit) {
            $this->session->set_flashdata('success', 'User Updated');
            redirect('user');
        }
    }else {
        $this->session->set_flashdata('error', validation_errors());
        redirect('user/edit/'.$user_id, $data);
    }
}
/*
function for view User get
created by your name
created at 25-02-21.
*/
public function view($user_id) {
    $data['user_id'] = $user_id;
    $data['user'] = $this->userModel->getDataById($user_id);
    $data['region'] = $this->RegionModel->getAll();
    $this->render('user/view', $data);
}
/*
function for delete User    created by your name
created at 25-02-21.
*/
public function delete($user_id) {
    $delete = $this->userModel->delete($user_id);
    $this->session->set_flashdata('success', 'user deleted');
    redirect('user');
}
/*
function for activation and deactivation of User.
created by your name
created at 25-02-21.
*/
public function changeStatusUser($user_id) {
    $edit = $this->userModel->changeStatus($user_id);
    $this->session->set_flashdata('success', 'User '.$edit.' Successfully');
    redirect('manage-user');
}

}