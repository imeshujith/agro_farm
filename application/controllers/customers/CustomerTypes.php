<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CustomerTypes extends CI_Controller {

    public function index() {
        $this->load->view('header');
        $this->load->view('customers/customer_types_view');
        $this->load->view('footer');
    }
}
