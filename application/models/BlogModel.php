<?php

class BlogModel extends CI_Model {

    /*
    return all Blogs.
    created by your name
    created at 25-02-21.
    */
    public function getAll() {
        return $this->db->get('blog')->result();
    }

    public function getAllCategories() {
        return $this->db->get('category')->result();
    }

    public function getAllTag() {
        return $this->db->get('tag')->result();
    }

    public function getCount($id) {
        $this->db->like('categories', $id);
        $blogs = $this->db->get('blog')->result();
        $result = [];
        foreach($blogs as $blog){
            $arr = json_decode($blog->categories);
            foreach($arr as $cat){
                if($id == $cat){
                    array_push($result, $blog);
                }
            }
        }
        return count($result);
    }


    /*
    function for create Blog.
    return Blog inserted id.
    created by your name
    created at 25-02-21.
    */
    public function insert($data) {
        $this->db->insert('blog', $data);
        return $this->db->insert_id();
    }

    /*
    return Blog by id.
    created by your name
    created at 25-02-21.
    */
    public function getDataById($id) {
        $this->db->where('id', $id);
        return $this->db->get('blog')->result();
    }

    public function getDataByURL($id) {
        $this->db->where('url', $id);
        return $this->db->get('blog')->result();
    }
    
    /*
    function for update Blog.
    return true.
    created by your name
    created at 25-02-21.
    */
    public function update($id,$data) {
        $this->db->where('id', $id);
        $this->db->update('blog', $data);
        return true;
    }
    /*
    function for delete Blog.
    return true.
    created by your name
    created at 25-02-21.
    */
    public function delete($id) {
        $this->db->where('id', $id);
        $this->db->delete('blog');
        return true;
    }
    /*
    function for change status of Blog.
    return activated of deactivated.
    created by your name
    created at 25-02-21.
    */
    public function changeStatus($id) {
        $table=$this->getDataById($id);
             if($table[0]->status==0)
             {
                $this->update($id,array('status' => '1'));
                return "Activated";
             }else{
                $this->update($id,array('status' => '0'));
                return "Deactivated";
             }
    }

}