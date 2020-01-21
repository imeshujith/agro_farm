<?php

/**
 * Created by Net Beans.
 * User: Rebecca
 * Date: 7/17/2019
 * Time: 8:43 PM
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Customer extends CI_Controller {
    // constructor -> this function call first
    public function __construct() {
        parent::__construct();
		if(!$this->session->userdata('name')) {
			redirect('login');
		}
        $this->load->model('CitiesModel');
        $this->load->model('CountriesModel');
        $this->load->model('CustomerModel');
        $this->load->model('CompanyModel');
    }

    public function index() {
        // get cities and countries
        $data = array(
            'cities' => $this->CitiesModel->view(),
            'countries' => $this->CountriesModel->view(),
            'customers' => $this->CustomerModel->view(),
        );

        $header = array(
            'company'	 => $this->CompanyModel->view(),
        );

        $this->load->view('header', $header);
        $this->load->view('customers/customer_view', $data);
        $this->load->view('footer');
    }

    public function create_customer() {
		$new_customer = array(
		    'customer_type' => $this->input->post('customer_type'),
			'first_name' => $this->input->post('first_name'),
			'street_one' => $this->input->post('street_one'),
			'street_two' => $this->input->post('street_two'),
			'city' => $this->input->post('city'),
			'postal_code' => $this->input->post('postal_code'),
			'country' => $this->input->post('country'),
			'phone' => $this->input->post('phone'),
			'email' => $this->input->post('email'),
			'create_date' => date("Y-m-d"),
		);

		if($new_customer['customer_type'] == 'person') {
		    $new_customer['last_name'] = $this->input->post('last_name');
        }

		$result = $this->CustomerModel->create($new_customer);

		if($result) {
			$alert = array(
				'type' => 'success',
				'message' => 'New Customer Created Successful',
			);
			$this->session->set_flashdata('alert', $alert);
			redirect('customers/customer');
		}
    }

	public function get_single_item() {
		$customer_id = $this->input->post('id');

		$result = $this->CustomerModel->single_item($customer_id);
		if($result == true) {
			echo json_encode($result);
		}
	}

    public function update_customer() {
    	$customer_id = $this->input->post('id');

		$new_values = array(
            'customer_type' => $this->input->post('customer_type'),
			'first_name' => $this->input->post('first_name'),
			'street_one' => $this->input->post('street_one'),
			'street_two' => $this->input->post('street_two'),
			'city' => $this->input->post('city'),
			'postal_code' => $this->input->post('postal_code'),
			'country' => $this->input->post('country'),
			'phone' => $this->input->post('phone'),
			'email' => $this->input->post('email'),
		);

        if($new_values['customer_type'] == 'person') {
            $new_values['last_name'] = $this->input->post('last_name');
        }

		$result = $this->CustomerModel->update($customer_id, $new_values);

		if($result) {
			$alert = array(
				'type' => 'warning',
				'message' => 'Customer Information Updated Successful',
			);
			$this->session->set_flashdata('alert', $alert);
			redirect('customers/customer');
		}
	}

	public function delete_customer() {
		$customer_id = $this->input->post('id');

		$result = $this->CustomerModel->delete($customer_id);

		if($result) {
			$alert = array(
				'type' => 'warning',
				'message' => 'Customer Deleted Successful',
			);
			$this->session->set_flashdata('alert', $alert);
			redirect('customers/customer');
		}
	}

	public function get_postal_code() {
    	$city = $this->input->get('city');
		$result = $this->CustomerModel->postal_code($city);
    	echo json_encode($result);
	}

    public function active_customer() {
        $customer_id = $this->input->get('id');
        $result = $this->CustomerModel->active($customer_id);
        if($result) {
            $alert = array(
                'type' => 'warning',
                'message' => 'Customer activate successful',
            );
            $this->session->set_flashdata('alert', $alert);
            redirect('customers/customer');
        }

        else {
            redirect('customers/customer');
        }
    }

    public function inactive_customer() {
        $customer_id = $this->input->get('id');
        $result = $this->CustomerModel->inactive($customer_id);
        if($result) {
            $alert = array(
                'type' => 'warning',
                'message' => 'Customer inactivate successful',
            );
            $this->session->set_flashdata('alert', $alert);
            redirect('customers/customer');
        }

        else {
            redirect('customers/customer');
        }
    }
}
