<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Inventory extends CI_Controller {
    // constructor -> this function call first
    public function __construct() {
        parent::__construct();
		if(!$this->session->userdata('name')) {
			redirect(redirect('login'));
		}
        $this->load->model('InventoryModel');
        $this->load->model('CompanyModel');
    }

    // load header, inventory view and footer pages
    public function index() {
        $data = array(
            'inventories' => $this->InventoryModel->view(),
        );

        $header = array(
            'company'	 => $this->CompanyModel->view(),
        );

        $this->load->view('header', $header);
        $this->load->view('products/inventory', $data);
        $this->load->view("footer");
    }
}
