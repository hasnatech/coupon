<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends My_Controller
{
	public function __construct() {
        parent::__construct();
        $this->load->model('userModel');
        $this->load->library('session');
    }
	public function index()
	{
        if (empty($this->session->userdata('logged_in'))) {
            $session_data = array('logged_in' => FALSE);
            $this->session->set_userdata($session_data);
            redirect('admin/login', 'refresh');
        }else{
			//$this->render('admin/index');
			redirect('coupon');
        }
		
	}

	public function check()
	{
		$this->load->view('check');
    }
    
    public function login()
	{
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email',
		array(
			'required'      => 'You have not provided %s.',
			'is_unique'     => 'This %s already exists.'
		));
		$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[4]');
		
		if ($this->form_validation->run() == TRUE) {
			$email = $this->input->post('email');
			$password = $this->input->post('password');
			$user = $this->userModel->get_user($email, $password);

			if(count($user) == 0){
				$this->data = array(
					'error' => 'The email or password is incorrect'
				);
				$this->render('admin/login', $this->data);
			} else{
				$login = $user[0];
				$logged_in_sess = array(
					'id' => $login->id,
					//'companyname'  => $login->companyname,
					'region'  => $login->region,
					'email'     => $login->email,
					'logged_in' => TRUE,
					'role'      =>'user'
				);
				$this->session->set_userdata($logged_in_sess);
				redirect('admin/index'); 	
			}
			//$id = $this->Model_a->insert($this->input->post());
			//$this->result = $this->Model_a->get($id);
			//redirect('ws/index'); 

		} else {
			$this->data = array(
				'error' => validation_errors()
			);
			$this->render('admin/login', $this->data);
		}
    }
    
    public function logout()
	{
		$this->session->sess_destroy();
		redirect('admin/login', 'refresh');
	}
}
