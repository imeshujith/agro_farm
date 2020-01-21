<?php
/**
 * Created by PhpStorm.
 * User: Imesh
 * Date: 11/24/2019
 * Time: 6:18 PM
 */

defined('BASEPATH') OR exit('No direct script access allowed');

class UserManagement extends CI_Controller {
    public function __construct() {
        parent::__construct();
        if(!$this->session->userdata('name')) {
            redirect(redirect('login'));
        }
        $this->load->model('CompanyModel');
    }

    // load header, dashboard and footer pages
    public function index() {
        if(!$this->session->userdata('name')) {
            redirect(redirect('login'));
        }

        else {
            $header = array(
                'company'	 => $this->CompanyModel->view(),
            );

            $this->load->view('header', $header);
            $this->load->view('users/user_management');
            $this->load->view("footer");
        }
    }
}
