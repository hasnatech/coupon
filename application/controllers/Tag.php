<?php


class Tag extends Admin_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('TagModel');
        $this->load->library('session');
    }
    /*
    function for manage Tag.
    return all Tags.
    created by your name
    created at 25-02-21.
	santosh salve
    */

    /*
    function for  add Tag get
    created by your name
    created at 25-02-21.
    */
    public function add() {
        $this->render('tag/add');
    }
    /*
    function for add Tag post
    created by your name
    created at 25-02-21.
    */
    public function addPost() {

        $data['name'] = $this->input->post('name');
        $this->form_validation->set_rules('name', 'Name', 'required');
        if ($this->form_validation->run() == TRUE) {
            $this->TagModel->insert($data);
            $this->session->set_flashdata('success', 'Tag added Successfully');
            redirect('blog/add');
        }else {
            $this->session->set_flashdata('error', validation_errors());
            redirect('tag/add', $data);
        }
    }
    /*
    function for edit Tag get
    returns  Tag by id.
    created by your name
    created at 25-02-21.
    */
    public function edit($tag_id) {
        $data['tag_id'] = $tag_id;
        $data['tag'] = $this->TagModel->getDataById($tag_id);
        $this->render('tag/edit', $data);
    }
    /*
    function for edit Tag post
    created by your name
    created at 25-02-21.
    */
    public function editPost() {
        $tag_id = $this->input->post('tag_id');
        $Tag = $this->TagModel->getDataById($tag_id);
        $data['name'] = $this->input->post('name');
        $edit = $this->TagModel->update($tag_id,$data);
        if ($edit) {
            $this->session->set_flashdata('success', 'Blog Updated');
            redirect('blog/add');
        }
    }
  
    /*
    function for delete Tag    created by your name
    created at 25-02-21.
    */
    public function delete($id) {
        $delete = $this->TagModel->delete($id);
        $this->session->set_flashdata('success', 'Tag deleted');
        redirect('blog/add');
    }
    
    
}