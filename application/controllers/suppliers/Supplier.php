<?php

/**
 * Created by Net Beans.
 * User: Rebecca
 * Date: 7/17/2019
 * Time: 8:43 PM
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Supplier extends CI_Controller {
	// constructor -> this function call first
	public function __construct() {
		parent::__construct();
		if(!$this->session->userdata('name')) {
			redirect(redirect('login'));
		}
		$this->load->model('CitiesModel');
		$this->load->model('CountriesModel');
		$this->load->model('SupplierModel');
	}

	public function index() {
		// get cities and countries
		$data = array(
			'cities' => $this->CitiesModel->view(),
			'countries' => $this->CountriesModel->view(),
			'suppliers' => $this->SupplierModel->view(),
		);

		$this->load->view('header');
		$this->load->view('suppliers/suppliers_view', $data);
		$this->load->view('footer');
	}

	public function create_supplier() {

		$new_supplier = array(
			'first_name' => $this->input->post('first_name'),
			'last_name' => $this->input->post('last_name'),
			'street_one' => $this->input->post('street_one'),
			'street_two' => $this->input->post('street_two'),
			'city' => $this->input->post('city'),
			'postal_code' => $this->input->post('postal_code'),
			'country' => $this->input->post('country'),
			'phone' => $this->input->post('phone'),
			'email' => $this->input->post('email'),
			'create_date' => date("Y-m-d"),
		);

		$result = $this->SupplierModel->create($new_supplier);

		if($result) {
			$alert = array(
				'type' => 'success',
				'message' => 'New Supplier Created Successful',
			);
			$this->session->set_flashdata('alert', $alert);
			redirect('suppliers/supplier');
		}
	}

	public function update_supplier() {
		$supplier_id = $this->input->post('id');

		$new_values = array(
			'first_name' => $this->input->post('first_name'),
			'last_name' => $this->input->post('last_name'),
			'street_one' => $this->input->post('street_one'),
			'street_two' => $this->input->post('street_two'),
			'city' => $this->input->post('city'),
			'postal_code' => $this->input->post('postal_code'),
			'country' => $this->input->post('country'),
			'phone' => $this->input->post('phone'),
			'email' => $this->input->post('email'),
		);

		$result = $this->SupplierModel->update($supplier_id, $new_values);

		if($result) {
			$alert = array(
				'type' => 'warning',
				'message' => 'Supplier Information Updated Successful',
			);
			$this->session->set_flashdata('alert', $alert);
			redirect('suppliers/supplier');
		}
	}

	public function delete_supplier() {
		$supplier_id = $this->input->post('id');

		$result = $this->SupplierModel->delete($supplier_id);

		if($result) {
			$alert = array(
				'type' => 'warning',
				'message' => 'Supplier Deleted Successful',
			);
			$this->session->set_flashdata('alert', $alert);
			redirect('suppliers/supplier');
		}
	}

	public function get_postal_code() {
		$city = $this->input->get('city');
		$result = $this->SupplierModel->postal_code($city);
		echo json_encode($result);
	}

    public function active_supplier() {
        $supplier_id = $this->input->get('id');
        $result = $this->SupplierModel->active($supplier_id);
        if($result) {
            $alert = array(
                'type' => 'warning',
                'message' => 'Supplier activated successful',
            );
            $this->session->set_flashdata('alert', $alert);
            redirect('suppliers/supplier');
        }

        else {
            redirect('suppliers/supplier');
        }
    }

    public function inactive_supplier() {
        $supplier_id = $this->input->get('id');
        $result = $this->SupplierModel->inactive($supplier_id);
        if($result) {
            $alert = array(
                'type' => 'warning',
                'message' => 'Supplier inactivate successful',
            );
            $this->session->set_flashdata('alert', $alert);
            redirect('suppliers/supplier');
        }

        else {
            redirect('suppliers/supplier');
        }
    }
}
