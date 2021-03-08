<?php

class AssetModel extends CI_Model {

    /*
    return all assetss.
    created by your name
    created at 25-02-21.
    */
    public function getAll() {
        return $this->db->get('assets')->result();
    }
    /*
    function for create assets.
    return assets inserted id.
    created by your name
    created at 25-02-21.
    */
    public function insert($data) {
        $this->db->insert('assets', $data);
        return $this->db->insert_id();
    }

    public function search($key) {
        $this->db->like('alt_text', $key, 'both');
        $this->db->or_like('orig_name', $key, 'both');
        $query = $this->db->get('assets');
        return $query->result();
    }


    /*
    return assets by id.
    created by your name
    created at 25-02-21.
    */
    public function getDataById($id) {
        $this->db->where('id', $id);
        return $this->db->get('assets')->result();
    }
    /*
    function for update assets.
    return true.
    created by your name
    created at 25-02-21.
    */
    public function update($id,$data) {
        $this->db->where('id', $id);
        $this->db->update('assets', $data);
        return true;
    }
    /*
    function for delete assets.
    return true.
    created by your name
    created at 25-02-21.
    */
    public function delete($id) {
        $this->db->where('id', $id);
        $this->db->delete('assets');
        return true;
    }
    
}