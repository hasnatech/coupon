<?php
class Json extends MY_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->model('BlogModel');
        $this->load->model('TagModel');
        $this->load->model('CategoryModel');
    }

    public function blog($id = null) { 
        if($id == null){
            $result = $this->BlogModel->getAll();
            foreach ($result as $blog) {
                $strip_text = strip_tags($blog->content);    
                $blog->content = substr($strip_text, 0, 100);  
                if(strlen($strip_text) > 100){
                    $blog->content = $blog->content . "...";
                }
                $tags = array();
                 foreach (json_decode($blog->tags) as $tag) {
                     array_push($tags, $this->TagModel->getDataById($tag));
                 }
                 $blog->tags = $tags;
            }
            $this->json($result);
        }else {
            $result = $this->BlogModel->getDataByURL($id);
            $tags = array();
          
             foreach (json_decode($result[0]->tags) as $tag) {
                 array_push($tags, $this->TagModel->getDataById($tag));
             }
            $result[0]->tags = $tags;
            $this->json($result);
        }
    }

    public function tag($id = null) { 
        if($id == null){
            $this->json($this->TagModel->getAll());
        }else {
            $this->json($this->TagModel->getDataById($id));
        }
    }

    public function category($id = null) { 
        if($id == null){
            $result = $this->CategoryModel->getAll();
            foreach ($result as $category) {
                $category->count = $this->BlogModel->getCount($category->id);
            }
            $this->json($result);
        }else {
            $result = $this->CategoryModel->getDataById($id);
            foreach ($result as $category) {
                $category->count = $this->BlogModel->getCount($category->id);
            }
            $this->json($result);
        }
    }
}

