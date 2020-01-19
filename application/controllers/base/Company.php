<?php
/**
 * Created by Net Beans.
 * User: Rebecca
 * Date: 7/17/2019
 * Time: 11:14 PM
 */

defined('BASEPATH') OR exit('No direct script access allowed');

class Company extends CI_Controller {

    // constructor -> this function call first
    public function __construct() {
        parent::__construct();
        if(!$this->session->userdata('name')) {
        	redirect(redirect('login'));
		}
        $this->load->model('CitiesModel');
        $this->load->model('CountriesModel');
        $this->load->model('CompanyModel');
    }

    // load header, inventory view and footer pages
   public function index() {

        // get cities and countries
        $data = array(
            'cities' => $this->CitiesModel->view(),
            'countries' => $this->CountriesModel->view(),
            'company_details' => $this->CompanyModel->view(),
        );

        // set company logo to session
        if($data['company_details']) {
            $this->session->set_userdata('logo', $data['company_details'][0]->logo);
        }

        // load company view
        $this->load->view('header');
        $this->load->view('base/company', $data);
        $this->load->view("footer");
    }

    public function update() {

        // define upload image configurations
        $config['upload_path'] = 'assets/images/company/';
        $config['allowed_types'] = 'jpg|png';
        $config['max_size'] = 2000;
        $config['max_width'] = 1500;
        $config['max_height'] = 1500;

        // load upload library
        $this->load->library('upload', $config);

        // get upload image attributes
        $this->upload->do_upload('company_logo');
        $image_data = $this->upload->data();

        $company = array(
            'name' => $this->input->post('company_name'),
            'street' => $this->input->post('company_street'),
            'city' => $this->input->post('company_city'),
            'country' => $this->input->post('company_country'),
            'phone' => $this->input->post('company_phone'),
            'mobile' => $this->input->post('company_mobile'),
            'email' => $this->input->post('company_email'),
        );

        if($image_data['file_name']) {
            $company['logo'] = $image_data['file_name'];
        }

        $result = $this->CompanyModel->create($company);

        // update company logo session data
        $this->session->set_userdata('logo', $image_data['file_name']);

		$alert = array(
			'type' => 'warning',
			'message' => 'Company information updated successful',
		);
		$this->session->set_flashdata('alert', $alert);
        redirect('base/company');
    }
}
