<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Stock extends CI_Controller {
    // constructor -> this function call first
    public function __construct() {
        parent::__construct();
		if(!$this->session->userdata('name')) {
			redirect(redirect('login'));
		}
        $this->load->model('StockModel');
    }

   // load header, inventory view and footer pages
   public function index() {
        $cat_id = $this->input->get('cat_id');

        $data = array(
            'products' => $this->StockModel->view($cat_id),
        );

        $this->load->view('header');
        $this->load->view('products/stock', $data);
        $this->load->view("footer");
    }
}
