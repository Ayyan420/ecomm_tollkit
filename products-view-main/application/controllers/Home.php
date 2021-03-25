<?php

class Home extends CI_Controller{
    
    function index() {
        $this->load->model('portal_model');
        $result = $this->portal_model->get_all_products();
        $data['products'] = $this->paginator->paginate($result, ['base_url' => 'portal/products']);
        $this->load->view('front/home',$data);
    }
    function product($id) {
        $this->load->model('portal_model');
         $data['product'] = $this->portal_model->get_all_products($id)->get()->row();
        $this->load->view('front/product',$data);
    }
}