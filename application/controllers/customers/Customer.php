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

    // customer controller default function
    public function index() {
        // get cities and countries
        $data = array(
            'cities' => $this->CitiesModel->view(),
            'countries' => $this->CountriesModel->view(),
            'customers' => $this->CustomerModel->view(),
        );

        // set company logo to header
        $header = array(
            'company'	 => $this->CompanyModel->view(),
        );

        $this->load->view('header', $header);
        $this->load->view('customers/customer_view', $data);
        $this->load->view('footer');
    }

    // customer create function
    public function create_customer() {

        // new customer details array
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

		// send new customer details to customer model
		$result = $this->CustomerModel->create($new_customer);

		// if data insert success redirect to the customer view
		if($result) {
			$alert = array(
				'type' => 'success',
				'message' => 'New customer created successful',
			);
			$this->session->set_flashdata('alert', $alert);
			redirect('customers/customer');
		}
		else {
            $alert = array(
                'type' => 'danger',
                'message' => 'New customer created failed',
            );
            $this->session->set_flashdata('alert', $alert);
            redirect('customers/customer');
        }
    }

    // get specific customer from database
	public function get_single_item() {
		$customer_id = $this->input->post('id');

		$result = $this->CustomerModel->single_item($customer_id);
		if($result == true) {
			echo json_encode($result);
		}
	}

	// update customer function
    public function update_customer() {
        // update customer id
    	$customer_id = $this->input->post('id');

    	// updated values set to the $new_values array
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

        // updates values send to the model
		$result = $this->CustomerModel->update($customer_id, $new_values);

        // update success redirect to the customer view
		if($result) {
			$alert = array(
				'type' => 'warning',
				'message' => 'Customer information updated successful',
			);
			$this->session->set_flashdata('alert', $alert);
			redirect('customers/customer');
		}
		else{
            $alert = array(
                'type' => 'danger',
                'message' => 'Customer information updated failed',
            );
            $this->session->set_flashdata('alert', $alert);
            redirect('customers/customer');
        }
	}

	// customer delete function
	public function delete_customer() {
        // get delete customer id
		$customer_id = $this->input->post('id');

		// send delete id to customer model
		$result = $this->CustomerModel->delete($customer_id);

		// deleted successful redirect to the customer view
		if($result) {
			$alert = array(
				'type' => 'warning',
				'message' => 'Customer deleted successful',
			);
			$this->session->set_flashdata('alert', $alert);
			redirect('customers/customer');
		}
		else {
            $alert = array(
                'type' => 'danger',
                'message' => 'Customer deleted failed',
            );
            $this->session->set_flashdata('alert', $alert);
            redirect('customers/customer');
        }
	}

	// get postal code for specific city
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
