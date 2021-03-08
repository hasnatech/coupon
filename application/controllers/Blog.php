<?php


class Blog extends Admin_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('BlogModel');
        $this->load->library('session');
    }
    /*
    function for manage Blog.
    return all Blogs.
    created by your name
    created at 25-02-21.
	santosh salve
    */
    public function index() { 
        $data['blogs'] = $this->BlogModel->getAll();
        foreach ($data['blogs'] as $blog) {
            $strip_text = strip_tags($blog->content);    
            $blog->content = substr($strip_text, 0, 100);    
            if(strlen($strip_text) > 100){
                $blog->content = $blog->content . "...";
            }
        }
        
        $this->render('blog/index', $data);
    }
    /*
    function for  add Blog get
    created by your name
    created at 25-02-21.
    */
    public function add() {
        $data['Categories'] = $this->BlogModel->getAllCategories();
        $data['Tags'] = $this->BlogModel->getAllTag();
        $this->render('blog/add', $data);
    }
    /*
    function for add Blog post
    created by your name
    created at 25-02-21.
    */
    public function addBlogPost() {

        $data['title'] = $this->input->post('title');
        $data['content'] = $this->input->post('content');
        $data['url'] = $this->input->post('url');
        $data['author_name'] = $this->input->post('author_name');
        $data['image'] = $this->input->post('image');
        $data['tags'] = json_encode($this->input->post('tag'));  
        $data['categories'] = json_encode($this->input->post('category')); 
        $data['user_id'] = $this->session->userdata('id');

        
        $data['date'] = date('Y-m-d');
        $data['active'] = $this->input->post('active') == 'checked' ? 1 : 0;


        $this->form_validation->set_rules('title', 'title', 'required');
        $this->form_validation->set_rules('content', 'content', 'required');
        $this->form_validation->set_rules('url', 'url', 'required|is_unique[blog.url]');

        if ($this->form_validation->run() == TRUE) {
            $this->BlogModel->insert($data);
            $this->session->set_flashdata('success', 'Blog added Successfully');
            redirect('blog');
        }else {
            $this->session->set_flashdata('error', validation_errors());
            redirect('blog/add', $data);
        }
    }
    /*
    function for edit Blog get
    returns  Blog by id.
    created by your name
    created at 25-02-21.
    */
    public function edit($blog_id) {
        $data['blog_id'] = $blog_id;
        $data['blog'] = $this->BlogModel->getDataById($blog_id);
        
        $data['Categories'] = $this->BlogModel->getAllCategories();
        $data['Tags'] = $this->BlogModel->getAllTag();

        $data['blog'][0]->tags = $data['blog'][0]->tags == null ? "[]" : $data['blog'][0]->tags;
        $data['blog'][0]->categories = $data['blog'][0]->categories == null ? "[]" : $data['blog'][0]->categories;
        
        $this->render('blog/edit', $data);
    }
    /*
    function for edit Blog post
    created by your name
    created at 25-02-21.
    */
    public function editBlogPost() {
        $blog_id = $this->input->post('blog_id');
        $blog = $this->BlogModel->getDataById($blog_id);
        $data['title'] = $this->input->post('title');
        $data['content'] = $this->input->post('content');
        $data['url'] = $this->input->post('url');
        $data['author_name'] = $this->input->post('author_name');
        $data['image'] = $this->input->post('image');
        $data['tags'] = json_encode($this->input->post('tag'));  
        $data['categories'] = json_encode($this->input->post('category')); 
        $data['user_id'] = $this->session->userdata('id');
        
        /*if ($_FILES['image']['name']) { 
            $data['image'] = $this->doUpload('image');
            unlink('./uploads/blog/'.$blog[0]->image);
        } */
            $data['date'] = $this->input->post('date');
            $data['active'] = $this->input->post('active') == 'checked' ? 1 : 0;
            $edit = $this->BlogModel->update($blog_id,$data);
        if ($edit) {
            $this->session->set_flashdata('success', 'Blog Updated');
            //redirect('blog');
            //$this->json( $this->input->post('active'));
            $this->json('completed');
        }
    }
    /*
    function for view Blog get
    created by your name
    created at 25-02-21.
    */
    public function view($blog_id) {
        $data['blog_id'] = $blog_id;
        $data['blog'] = $this->BlogModel->getDataById($blog_id);
        $this->render('blog/view', $data);
    }
    /*
    function for delete Blog    created by your name
    created at 25-02-21.
    */
    public function delete($blog_id) {
        $delete = $this->BlogModel->delete($blog_id);
        $this->session->set_flashdata('success', 'blog deleted');
        redirect('blog');
    }
    /*
    function for activation and deactivation of Blog.
    created by your name
    created at 25-02-21.
    */
    public function changeStatusBlog($blog_id) {
        $edit = $this->BlogModel->changeStatus($blog_id);
        $this->session->set_flashdata('success', 'blog '.$edit.' Successfully');
        redirect('manage-blog');
    }
        /*
    function for upload files
    return uploaded file name.
    created by your name
    created at 25-02-21.
    */
    function doUpload($file) {
        $config['upload_path'] = './uploads/blog';
        $config['allowed_types'] = '*';
        $this->load->library('upload', $config);
            if ( ! $this->upload->do_upload($file))
            {
              $error = array('error' => $this->upload->display_errors());
              $this->load->view('upload_form', $error);
            }
            else
            {
              $data = array('upload_data' => $this->upload->data());
              return $data['upload_data']['file_name'];
            }
        }
    
}