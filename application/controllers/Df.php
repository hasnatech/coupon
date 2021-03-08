<?php 
class Df extends My_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('CouponModel');
        $this->load->library('session');
    }

    public function verify(){
        $data['coupon'] = $this->input->post('coupon');
        $data['checked'] = $this->input->post('checked');

        $this->form_validation->set_rules('coupon', 'Coupon', 'trim|required');
        $this->form_validation->set_rules('checked', 'Checked', 'trim|required',
        array(
            'required' => 'Accept the term.',
        ));

        if ($this->form_validation->run() == TRUE) {
            $codeArr = explode("-", $data['coupon']);
            if(count($codeArr) == 2){
                $region = $codeArr[0];
                $code = $codeArr[1];
                $result = $this->CouponModel->getByCodeRegion($region, $code);
                //print_r($result);
                //exit;
                if(count($result) == 1){
                    $newdata['coupon'] = $data['coupon'];
                    $newdata['ip_address'] = getenv('REMOTE_ADDR');
                    $newdata['agent'] = $_SERVER['HTTP_USER_AGENT'];
                    $code = $this->CouponModel->insertCoupon($newdata);

                    if($result[0]->issued != 0) {
                        $this->session->set_flashdata('error', "This coupon code ". $data['coupon'] ." alread taken.");
                        redirect('', $data);  
                        /*$result[0]->price_text = $this->CouponModel->getPrice($result[0]->price);
                        $result = array('result' => $result[0]);
                        $this->load->view('df/index', $result);*/

                    }else{
                        $result[0]->issued = 1;
                        $result[0]->issued_date = date("Y/m/d");
                        $code = $this->CouponModel->update($result[0]->id, $result[0]);
                        $result[0]->price_text = $this->CouponModel->getPrice($result[0]->price);
                        $result = array('result' => $result[0]);
                        $this->load->view('df/index', $result);
                    }
                }else{
                    $this->session->set_flashdata('error', "There is no coupon with id ". $data['coupon']);
                    redirect('', $data); 
                }
            }
            else{
                $this->session->set_flashdata('error', "Incorrect code " . $data['coupon']);
                redirect('', $data);
            }
        }
        else {
            $this->session->set_flashdata('error', validation_errors());
            //redirect('', $data);

            $result = $this->CouponModel->getByCodeRegion('IN', '123456');
            //$result[0] = array();
            $result[0]->region = 'IN';
            $result[0]->code = '123456';
            $result[0]->issued_date = date("Y/m/d");
            $result[0]->price_text = $this->CouponModel->getPrice(1);
            $result = array('result' => $result[0]);
            $this->load->view('df/index', $result);
        }
    }
    

    public function index(){
        echo "Index";
    }
}
?>