<?php

class CouponModel extends CI_Model {

    /*
    return all Coupons.
    created by your name
    created at 27-02-21.
    */
    var $table = "coupon";  
    var $select_column = array("id",  "region", "code", "whole_saler", "price", "issued", "issued_date", "date", "user_id");  
    var $order_column = array(null, "issued_date", "region", "code", null);  

    function make_query($region = null)  
    {  
         $this->db->select($this->select_column);  
         $this->db->from($this->table);  
        
         if($region != null){
             //echo 'region';
            $this->db->where('region', $region);
            
            if(isset($_POST["search"]["value"]))  
            {  
                 $this->db->like("code", $_POST["search"]["value"]);  
            }
         }else{
            
            if(isset($_POST["search"]["value"]))  
            {  
                 $this->db->like("code", $_POST["search"]["value"]);  
                 $this->db->or_like("region", $_POST["search"]["value"]);  
            }  
         }
         
         if(isset($_POST["order"]))  
         {  
              $this->db->order_by($this->order_column[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);  
         }  
         else  
         {  
              $this->db->order_by('id', 'DESC');  
         }  
    }

    function make_datatables($region = null){  
       
        $this->make_query($region);  
        
        if($_POST["length"] != -1 )  
        {  
             $this->db->limit($_POST['length'], $_POST['start']);  
        }  
        $query = $this->db->get();
        //print_r($this->db->last_query());    
        return $query->result();  
   }  

   function get_filtered_data($region = null){  
        $this->make_query($region);  
        $query = $this->db->get();  
        return $query->num_rows();  
   }   

   function get_all_data($region = null) 
   {
        $this->db->select("*");  
        if($region != 0){
            $this->db->where('region', $region);
        }
        $this->db->from($this->table);  
        return $this->db->count_all_results();  
   }  


    public function getAll($region = null) {
        $this->make_query($region);  
        $query = $this->db->get();
        return $query->result();  
    }
    
    public function getAllPrice() {
        return $this->db->get('price')->result();
    }

    public function getPrice($id) {
        $this->db->where('id', $id);
        return $this->db->get('price')->result();
    }

    public function getPriceId($name) {
        $this->db->where('name', $name);
        if(count($this->db->get('price')->result()) > 0){
            return $this->db->get('price')->result()[0]->id;
        }
        return "";
        
    }
    /*
    function for create Coupon.
    return Coupon inserted id.
    created by your name
    created at 27-02-21. 
    */
    public function insert($data) {
        
        $this->db->insert('coupon', $data);
        return $this->db->insert_id();
    }

    public function insert_batch($data) {
        
        $this->db->insert_batch('coupon', $data);
        return true;
    }


    public function insertCoupon($data) {
        $this->db->where('coupon', $data['coupon']);
        $coupons = $this->db->get('log')->result();
        if(count($coupons) == 0){
            $data['active'] = 1;
            $this->db->insert('log', $data);
            return $this->db->insert_id();
        }else{
            $data['active'] = 0;
            $this->db->insert('log', $data);
            return 'exist';
        }
    }

    public function getLogById($id) {
        $this->db->where('id', $id);
        return $this->db->get('log')->result();
    } 
    /*
    return Coupon by id.
    created by your name
    created at 27-02-21.
    */
    public function getDataById($id) {
        $this->db->where('id', $id);
        return $this->db->get('coupon')->result();
    }


    public function getDataByCode($id) {
        $this->db->where('code', $id);
        return $this->db->get('coupon')->result();
    }

    public function getDataByRegion($region) {
        $this->db->where('region', $region);
        return $this->db->get('coupon')->result();
    }
    
    public function getByCodeRegion($region, $code) {
        $this->db->where('region', $region);
        $this->db->where('code', $code);
        return $this->db->get('coupon')->result();
    }
    /*
    function for update Coupon.
    return true.
    created by your name
    created at 27-02-21.
    */
    public function update($id,$data) {
        $this->db->where('id', $id);
        $this->db->update('coupon', $data);
        return true;
    }
    /*
    function for delete Coupon.
    return true.
    created by your name
    created at 27-02-21.
    */
    public function delete($id) {
        $this->db->where('id', $id);
        $this->db->delete('coupon');
        return true;
    }
    /*
    function for change status of Coupon.
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