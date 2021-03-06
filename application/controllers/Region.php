<?php

class Region extends Admin_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('RegionModel');
        $this->load->library('session');
        $region = $this->session->userdata('region');
        if($region != 0){
            redirect("coupon");
        }
    }
    /*
    function for manage Region.
    return all Regions.
    created by Hasna Technology
    created at 27-02-21.
    */
    public function index() { 
        $data['region'] = $this->RegionModel->getAll();
        
        $this->render('region/index', $data);
    }
    /*
    function for  add Region get
    created by Hasna Technology
    created at 27-02-21.
    */
    public function add() {
        $this->render('region/add');
    }
    /*
    function for add Region post
    created by Hasna Technology
    created at 27-02-21.
    */
    public function addRegionPost() {
        $data['name'] = $this->input->post('name');
        $data['code'] = $this->input->post('code');
        $this->form_validation->set_rules('name', 'Name', 'trim|required');
        $this->form_validation->set_rules('code', 'Code', 'trim|required|min_length[2]|max_length[2]|is_unique[region.code]');
        if ($this->form_validation->run() == TRUE) {
            $this->RegionModel->insert($data);
            $this->session->set_flashdata('success', 'Region added Successfully');
            redirect('region/index');
        }else{
            $this->session->set_flashdata('error', validation_errors());
            redirect('region/add', $data);
        }
    }
    /*
    function for edit Region get
    returns  Region by id.
    created by Hasna Technology
    created at 27-02-21.
    */
    public function edit($region_id) {
        $data['region_id'] = $region_id;
        $data['region'] = $this->RegionModel->getDataById($region_id);
        $this->render('region/edit', $data);
    }
    /*
    function for edit Region post
    created by Hasna Technology
    created at 27-02-21.
    */
    public function editRegionPost() {
        $region_id = $this->input->post('region_id');
        $region = $this->RegionModel->getDataById($region_id);
        $data['name'] = $this->input->post('name');
        $data['code'] = $this->input->post('code');
        if($region){

            if($region[0]->code != $data['code']) {
                $is_unique =  '|is_unique[region.code]';
             } else {
                $is_unique =  '';
             }

            $this->form_validation->set_rules('name', 'Name', 'trim|required');
            $this->form_validation->set_rules('code', 'Code', 'trim|required|min_length[2]|max_length[2]' . $is_unique);
            if ($this->form_validation->run() == TRUE) {
                $edit = $this->RegionModel->update($region_id,$data);
                if ($edit) {
                    $this->session->set_flashdata('success', 'Region Updated');
                    redirect('region/index');
                }else{
                    $this->session->set_flashdata('error', validation_errors());
                    redirect('region/edit' . $region_id , $data);
                }
            }else{
                $this->session->set_flashdata('error', validation_errors());
                redirect('region/edit/' . $region_id , $data);
            }
        }else{
            $this->session->set_flashdata('error', validation_errors());
            redirect('region/edit/' . $region_id , $data);
        }
        
       
    }
    /*
    function for view Region get
    created by Hasna Technology
    created at 27-02-21.
    */
    public function view($region_id) {
        $data['region_id'] = $region_id;
        $data['region'] = $this->RegionModel->getDataById($region_id);
        $this->render('region/view', $data);
    }
    /*
    function for delete Region    created by Hasna Technology
    created at 27-02-21.
    */
    public function delete($region_id) {
        $delete = $this->RegionModel->delete($region_id);
        $this->session->set_flashdata('success', 'Region deleted');
        redirect('region/index');
    }
    /*
    function for activation and deactivation of Region.
    created by Hasna Technology
    created at 27-02-21.
    */
    public function changeStatusRegion($region_id) {
        $edit = $this->RegionModel->changeStatus($region_id);
        $this->session->set_flashdata('success', 'region '.$edit.' Successfully');
        redirect('region/index');
    }
    
}