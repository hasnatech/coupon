<?php 
class Coupon extends Admin_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('CouponModel');
        $this->load->model('RegionModel');
       //$this->load->library('session');
       $this->load->library('excel');
    } 
    /*
    function for manage Coupon.
    return all Coupons.
    created by your name
    created at 27-02-21.
    santosh salve
    */
    public function index() { 
        $region = $this->session->userdata('region');
        if($region != 0){
            $region = $this->RegionModel->getDataById($region);
            $data['coupons'] = $this->CouponModel->getDataByRegion($region[0]->code);
        }else {
            $data['coupons'] = $this->CouponModel->getAll();
        }
        foreach($data['coupons'] as $coupon)
        {
            $coupon->price_text = $this->CouponModel->getPrice($coupon->price);
        }
        $this->render('coupon/index', $data);
    }


    public function fetch() { 
        $region = $this->session->userdata('region');
        if($region != 0){
            $region = $this->RegionModel->getDataById($region)[0]->code;
            $data['coupons'] = $this->CouponModel->make_datatables($region);
        }else {
            $data['coupons'] = $this->CouponModel->make_datatables();
        }

        $result = array();  
        $count = 0;
        foreach($data['coupons'] as $key => $coupon)
        {
            $count++;
            $sub_array = array();  
            $sub_array[] = ($coupon->issued == 1) ? '' : '<input  type="checkbox" class="couponc" value="'. $coupon->id . '">';  
            $sub_array[] = $count;  
            $sub_array[] = $coupon->region. "-" . $coupon->whole_saler . '-' . $coupon->code;  
            $sub_array[] = $this->CouponModel->getPrice($coupon->price)[0]->name;  
            //$sub_array[] = $coupon->whole_saler;
            $sub_array[] = ($coupon->issued == 1) ? '<div class="badge bg-success ">Issued</div>' : '<div class="badge bg-warning text-dark">Available</div>';  
            $sub_array[] = ($coupon->issued_date == null) ? '' : date('M d, Y',  strtotime($coupon->issued_date));
            if($coupon->issued_date == null){
                $sub_array[] = "<a href='" . site_url('coupon/edit/') . $coupon->id . "'>Edit</a>
                <a href='" . site_url('coupon/delete/') . $coupon->id . "' onclick=\"return confirm('are you sure to delete')\">Delete</a>";  
            }else{
                $sub_array[] = "";  
            }
            $result[] = $sub_array;  
        }
        
        $region = $region == '0' ? null : $region;
        //echo $region;
        $output = array(
            "draw"          => intval($_POST['draw']),
            "recordTotal"   => $this->CouponModel->get_all_data($region),
            "recordsFiltered" => $this->CouponModel->get_filtered_data($region),  
            "data"          => $result 
        );
        $this->json($output);

    }
    public function import(){
        $config['upload_path']          = './uploads/';
        //$config['allowed_types']      = 'xlsx|csv|xls';
        $config['allowed_types']        = 'xlsx|csv|xls|ods';
        //$config['max_size']             = 1024 * 10;
        //$config['encrypt_name']         = true;
        
        $this->load->library('upload', $config);

        if ( ! $this->upload->do_upload('import'))
        {
            //echo  $this->upload->display_errors();
            $this->json($this->upload->display_errors());
            //$error = array('error' => $this->upload->display_errors());
            //$this->render('asset/index', $error);
        } else
        {
            $data =  $this->upload->data();
            $excel = array();

            $path = $_FILES["import"]["tmp_name"];

           
            $object = PHPExcel_IOFactory::load($path);
            foreach($object->getWorksheetIterator() as $worksheet)
            {
                $highestRow = $worksheet->getHighestRow();
                $highestColumn = $worksheet->getHighestColumn();
                $row_error = [];
                for($row=2; $row<=$highestRow; $row++)
                {
                    $row_error_fl = false;
                    //$customer_name = $worksheet->getCellByColumnAndRow(0, $row)->getValue();
                    $region = $worksheet->getCellByColumnAndRow(1, $row)->getValue();
                    $whole_saler = $worksheet->getCellByColumnAndRow(2, $row)->getValue();
                    $code = $worksheet->getCellByColumnAndRow(3, $row)->getValue();
                    $price = $this->CouponModel->getPriceId($worksheet->getCellByColumnAndRow(4, $row)->getValue());
                    $code_arr = $this->CouponModel->getDataByCode($code);
                    if(count($code_arr) > 0)
                    {
                        foreach($code_arr as $c){
                            if($c->region == $region){
                                $row_error[] =  "<p class='text-danger'>Row " . $row . ' - Code '. $region . '-'. $code . ' is already created.</p>';
                                $row_error_fl = true;
                            }
                        }
                    }

                    if($code == ""){
                        $row_error_fl = true;
                        $row_error[] =  "<p class='text-danger'>Row " . $row . ' - The code is empty.</p>';
                    }

                    if($region == ""){
                        $row_error_fl = true;
                        $row_error[] =  "<p class='text-danger'>Row " . $row . ' - The region is empty.</p>';
                    }

                    if($price == ""){
                        $row_error_fl = true;
                        $row_error[] =  "<p class='text-danger'>Row " . $row . ' - The price is empty.</p>';
                    }

                    if($whole_saler == ""){
                        $row_error_fl = true;
                        $row_error[] =  "<p class='text-danger'>Row " . $row . ' - The whole saler is empty.</p>';
                    }
                    
                    if ($row_error_fl == false) {
                        $excel[] = array(
                            'region'  => $region,
                            'code'   => $code,
                            'price' => $price,
                            'whole_saler'    => $whole_saler,
                            'user_id' => $this->session->userdata('id')
                        );
                    }
                    
                }
            }
            if(count($excel) > 0){
                $result = $this->CouponModel->insert_batch($excel);
            }
            
            if(count($row_error) != 0){
                $row_error[] = "<p class='text-success'>" . count($excel) . " data are imported.</p>";
                $this->json($row_error);
            }else {
                $row_error[] = "<p class='text-success'>" . count($excel) . " data are imported.</p>";
                $this->json($row_error);
            }
            
        }
    }

    public function export(){
        //$this->load->model("excel_export_model");
        //$this->load->library("excel");
        $object = new PHPExcel();

        $object->setActiveSheetIndex(0);

        $table_columns = array("Id", "Region", "Code", "Price", "Wholesaler", "Issued", "Issued Date");

        $column = 0;

        foreach($table_columns as $field)
        {
            $object->getActiveSheet()->setCellValueByColumnAndRow($column, 1, $field);
            $column++;
        }
        $region = $this->session->userdata('region');

        if(isset($_POST["search"])){
            $_POST["search"] = array(
                "value" => $_POST["search"]
            );
            //print_r($_POST["search"]);
        }
        

        if($region != 0){
            $region = $this->RegionModel->getDataById($region)[0]->code;
            $data['coupons'] = $this->CouponModel->getAll($region);
        }else {
            $data['coupons'] = $this->CouponModel->getAll();
        }
        
        $excel_row = 2;
        
        
        foreach($data['coupons'] as $row)
        {
            $object->getActiveSheet()->setCellValueByColumnAndRow(0, $excel_row, $row->id);
            $object->getActiveSheet()->setCellValueByColumnAndRow(1, $excel_row, $row->region);
            $object->getActiveSheet()->setCellValueByColumnAndRow(2, $excel_row,  $row->whole_saler);
            $object->getActiveSheet()->setCellValueByColumnAndRow(3, $excel_row,  $row->code);
            $object->getActiveSheet()->setCellValueByColumnAndRow(4, $excel_row, $this->CouponModel->getPrice($row->price)[0]->name);
            $object->getActiveSheet()->setCellValueByColumnAndRow(5, $excel_row, ($row->issued == 1) ? 'Issued' : 'Available');
            $object->getActiveSheet()->setCellValueByColumnAndRow(6, $excel_row, $row->issued_date);
            $excel_row++;
        }

        $this->json($data['coupons']);
        $object_writer = PHPExcel_IOFactory::createWriter($object, 'Excel5');
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="Coupon Data.xls"');
        $object_writer->save('php://output');
        
    }


    /*
    function for  add Coupon get
    created by your name
    created at 27-02-21.
    */
    public function add() {
        $region = $this->session->userdata('region');
        if($region != 0){
            $data['region'] = $this->RegionModel->getDataById($region);
        }else {
            $data['region'] = $this->RegionModel->getAll();
        }
        
        $data['price'] = $this->CouponModel->getAllPrice();
        $this->render('coupon/add', $data);
    }
    /*
    function for add Coupon post
    created by your name
    created at 27-02-21.
    */
    public function addCouponPost() {
        $data['code'] = $this->input->post('code');
        $data['region'] = $this->input->post('region');
        $data['price'] = $this->input->post('price');
        $data['user_id'] = $this->session->userdata('id');
        $data['whole_saler'] = $this->input->post('whole_saler');

        $code = $this->CouponModel->getDataByCode($data['code']);
        if(count($code) > 0)
        {
            foreach($code as $c){
                if($c->region == $data['region']){
                    $this->session->set_flashdata('error', 'The code '. $data['region'] . '-'. $data['code'] . ' is already created.');
                    redirect('coupon/add', $data);
                }
            }
        }

        $this->form_validation->set_rules('code', 'Code', 'trim|required|min_length[4]');
        $this->form_validation->set_rules('region', 'Region', 'trim|required');
        $this->form_validation->set_rules('price', 'Price', 'trim|required');
        if ($this->form_validation->run() == TRUE) {
            $this->CouponModel->insert($data);
            $this->session->set_flashdata('success', 'Coupon added Successfully');
            redirect('coupon/index');
        } else {
            $this->session->set_flashdata('error', validation_errors());
            redirect('coupon/add', $data);
        }
    }
    /*
    function for edit Coupon get
    returns  Coupon by id.
    created by your name
    created at 27-02-21.
    */
    public function edit($coupon_id) {
        $data['coupon_id'] = $coupon_id;
        $data['coupon'] = $this->CouponModel->getDataById($coupon_id);
        $region = $this->session->userdata('region');
        if($region != 0){
            $data['region'] = $this->RegionModel->getDataById($region);
        }else {
            $data['region'] = $this->RegionModel->getAll();
        }
        $data['price'] = $this->CouponModel->getAllPrice();
        $this->render('coupon/edit', $data);
    }
    /*
    function for edit Coupon post
    created by your name
    created at 27-02-21.
    */
    public function editPost() {
        $coupon_id = $this->input->post('coupon_id');
        $coupon = $this->CouponModel->getDataById($coupon_id);

        $data['code'] = $this->input->post('code');
        $data['region'] = $this->input->post('region');
        $data['price'] = $this->input->post('price');
        $data['whole_saler'] = $this->input->post('whole_saler');

        $this->form_validation->set_rules('code', 'Code', 'trim|required|min_length[4]');
        $this->form_validation->set_rules('region', 'Region', 'trim|required');
        $this->form_validation->set_rules('price', 'Price', 'trim|required');
        if ($this->form_validation->run() == TRUE) {
            $edit = $this->CouponModel->update($coupon_id,$data);
            if ($edit) {
                $this->session->set_flashdata('success', 'Coupon Updated');
                redirect('coupon');
            }
        }else {
            $this->session->set_flashdata('error', validation_errors());
            redirect('coupon/edit/'. $coupon_id  , $data);
        }
    }
    /*
    function for view Coupon get
    created by your name
    created at 27-02-21.
    */
    public function view($coupon_id) {
        $data['coupon_id'] = $coupon_id;
        $data['coupon'] = $this->CouponModel->getDataById($coupon_id);
        $this->render('coupon/view-coupon', $data);
    }
    /*
    function for delete Coupon    created by your name
    created at 27-02-21.
    */
    public function delete($coupon_id) {
        $delete = $this->CouponModel->delete($coupon_id);
        $this->session->set_flashdata('success', 'coupon deleted');
        redirect('coupon');
    }

    public function delete_bulk(){
        $data = json_decode(file_get_contents('php://input'), true);
        for ($i = 0; $i < count($data); $i++)
        {
            $this->CouponModel->delete($data[$i]);
        }
        $this->json("success");
    }
    /*
    function for activation and deactivation of Coupon.
    created by your name
    created at 27-02-21.
    */
    public function changeStatusCoupon($coupon_id) {
        $edit = $this->CouponModel->changeStatus($coupon_id);
        $this->session->set_flashdata('success', 'coupon '.$edit.' Successfully');
        redirect('coupon');
    }

}
?>