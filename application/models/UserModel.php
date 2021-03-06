 
<?php

class UserModel extends CI_Model {

    public function __construct()
    {
        //parent::__construct();
        $this->load->database();
        $this->load->library(array('session'));
    }
    /*
    return all Users.
    created by your name
    created at 25-02-21.
    */
    public function getAll() {
        return $this->db->get('users')->result();
    }
    public function getDataByRegion($region) {
        $this->db->where('region', $region);
        return $this->db->get('users')->result();
    }
    /*
    function for create User.
    return User inserted id.
    created by your name
    created at 25-02-21.
    */
    public function insert($data) {
        $this->db->insert('users', $data);
        return $this->db->insert_id();
    }
    /*
    return User by id.
    created by your name
    created at 25-02-21.
    */
    public function getDataById($id) {
        $this->db->where('id', $id);
        return $this->db->get('users')->result();
    }
    /*
    function for update User.
    return true.
    created by your name
    created at 25-02-21.
    */
    public function update($id,$data) {
        $this->db->where('id', $id);
        $this->db->update('users', $data);
        return true;
    }
    /*
    function for delete User.
    return true.
    created by your name
    created at 25-02-21.
    */
    public function delete($id) {
        $this->db->where('id', $id);
        $this->db->delete('users');
        return true;
    }
    /*
    function for change status of User.
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


    public function get_user($email, $password)
    {
        $where = array(
            'email' => $email,
            'password' => md5($password),
        );
        return $this->db->get_where('users', $where, 1)->result();
    }

}