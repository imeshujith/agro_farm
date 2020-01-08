<?php
/**
 * Created by PhpStorm.
 * User: Imesh
 * Date: 11/24/2019
 * Time: 6:18 PM
 */

defined('BASEPATH') OR exit('No direct script access allowed');

class UserManagement extends CI_Controller {

    // load header, dashboard and footer pages
    public function index() {
        if(!$this->session->userdata('name')) {
            redirect(redirect('login'));
        }

        else {
            $this->load->view('header');
            $this->load->view('users/user_management');
            $this->load->view("footer");
        }
    }
}
