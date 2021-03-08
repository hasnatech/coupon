<?php

class CategoryModel extends CI_Model {

    /*
    return all Category.
    created by your name
    created at 25-02-21.
    */
    public function getAll() {
        return $this->db->get('category')->result();
    }

    /*
    function for create Catgeory.
    return Catgeory inserted id.
    created by your name
    created at 25-02-21.
    */
    public function insert($data) {
        $this->db->insert('category', $data);
        return $this->db->insert_id();
    }
    /*
    return Catgeory by id.
    created by your name
    created at 25-02-21.
    */
    public function getDataById($id) {
        $this->db->where('id', $id);
        return $this->db->get('category')->result();
    }
    /*
    function for update Catgeory.
    return true.
    created by your name
    created at 25-02-21.
    */
    public function update($id,$data) {
        $this->db->where('id', $id);
        $this->db->update('category', $data);
        return true;
    }
    /*
    function for delete Catgeory.
    return true.
    created by your name
    created at 25-02-21.
    */
    public function delete($id) {
        $this->db->where('id', $id);
        $this->db->delete('category');
        return true;
    }
    /*
    function for change status of Catgeory.
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