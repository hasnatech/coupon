<?php
    class Asset extends Admin_Controller 
    {   
        public function __construct()
        {
                parent::__construct();
                $this->load->model('AssetModel');
                $this->load->helper(array('form', 'url', 'directory'));
        }
        public function index()
        {
            //$data = array('upload_data' => directory_map('./uploads/'));
            $data =  array('upload_data' => $this->AssetModel->getAll(),
                        'search'=>'',
                    'header' => 'hide');
            $this->render('asset/index', $data);
        }

        public function search()
        {
            $search = $this->input->post('search');
            $data =  array('upload_data' => $this->AssetModel->search($search ),
                        'search'=>$search);
            $this->render('asset/index', $data);
        }
        public function upload(){
            $config['upload_path']          = './uploads/';
            $config['allowed_types']        = 'gif|jpg|png';
            $config['max_size']             = 1024 * 10;
            $config['encrypt_name']         = true;

            $this->load->library('upload', $config);

            if ( ! $this->upload->do_upload('image'))
            {
                echo  $this->upload->display_errors();
                //$error = array('error' => $this->upload->display_errors());
                //$this->render('asset/index', $error);
            } else
            {
                $data =  $this->upload->data();
                unset($data['file_path']);
                unset($data['full_path']);
                unset($data['raw_name']);
                unset($data['client_name']);
                unset($data['is_image']);
                unset($data['is_image']);
                unset($data['image_type']);
                unset($data['image_size_str']);
                $this->AssetModel->insert($data);
                redirect('asset');
            }
        }

        public function update() {
            $asset_id = $this->input->post('asset_id');
            //$asset = $this->AssetModel->getDataById($asset_id);
            $data['alt_text'] = $this->input->post('alt_text');
            $edit = $this->AssetModel->update($asset_id,$data);
            if ($edit) {
                $this->session->set_flashdata('success', 'Asset Updated');
                redirect('asset');
            }
        }

        public function delete($asset_id) {
            $delete = $this->AssetModel->delete($asset_id);
            $this->session->set_flashdata('success', 'Asset Deleted');
            redirect('asset');
        }
    }
    
?>