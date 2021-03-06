<?php

class RegionModel extends CI_Model {

    /*
    return all Regions.
    created by your name
    created at 27-02-21.
    */
    public function getAll() {
        return $this->db->get('region')->result();
    }
    /*
    function for create Region.
    return Region inserted id.
    created by your name
    created at 27-02-21.
    */
    public function insert($data) {
        $this->db->insert('region', $data);
        return $this->db->insert_id();
    }
    /*
    return Region by id.
    created by your name
    created at 27-02-21.
    */
    public function getDataById($id) {
        $this->db->where('id', $id);
        return $this->db->get('region')->result();
    }
    /*
    function for update Region.
    return true.
    created by your name
    created at 27-02-21.
    */
    public function update($id,$data) {
        $this->db->where('id', $id);
        $this->db->update('region', $data);
        return true;
    }
    /*
    function for delete Region.
    return true.
    created by your name
    created at 27-02-21.
    */
    public function delete($id) {
        $this->db->where('id', $id);
        $this->db->delete('region');
        return true;
    }
    /*
    function for change status of Region.
    return activated of deactivated.
    created by your name
    created at 27-02-21.
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