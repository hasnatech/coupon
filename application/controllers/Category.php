<?php


class Category extends Admin_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('CategoryModel');
        $this->load->library('session');
    }
    /*
    function for manage Category.
    return all Categorys.
    created by your name
    created at 25-02-21.
	santosh salve
    */

    /*
    function for  add Category get
    created by your name
    created at 25-02-21.
    */
    public function add() {
        $this->render('category/add');
    }
    /*
    function for add Category post
    created by your name
    created at 25-02-21.
    */
    public function addPost() {

        $data['name'] = $this->input->post('name');
        $this->form_validation->set_rules('name', 'Name', 'required');
        if ($this->form_validation->run() == TRUE) {
            $this->CategoryModel->insert($data);
            $this->session->set_flashdata('success', 'Category added Successfully');
            redirect('blog/add');
        }else {
            $this->session->set_flashdata('error', validation_errors());
            redirect('category/add', $data);
        }
    }
    /*
    function for edit Category get
    returns  Category by id.
    created by your name
    created at 25-02-21.
    */
    public function edit($category_id) {
        $data['category_id'] = $category_id;
        $data['category'] = $this->CategoryModel->getDataById($category_id);
        $this->render('category/edit', $data);
    }
    /*
    function for edit Category post
    created by your name
    created at 25-02-21.
    */
    public function editPost() {
        $category_id = $this->input->post('category_id');
        $category = $this->CategoryModel->getDataById($category_id);
        $data['name'] = $this->input->post('name');
        $edit = $this->CategoryModel->update($category_id,$data);
        if ($edit) {
            $this->session->set_flashdata('success', 'Blog Updated');
            redirect('blog/add');
        }
    }
  
    /*
    function for delete Category    created by your name
    created at 25-02-21.
    */
    public function delete($id) {
        $delete = $this->CategoryModel->delete($id);
        $this->session->set_flashdata('success', 'Category deleted');
        redirect('blog/add');
    }
    
    
}