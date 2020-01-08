<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DeliveryPersons extends CI_Controller {
	public function __construct() {
		parent::__construct();
		if(!$this->session->userdata('name')) {
			redirect(redirect('login'));
		}
		$this->load->model('DeliveryPersonsModel');
	}

	public function index() {
		$data = array(
			'persons' => $this->DeliveryPersonsModel->view(),
		);

		$this->load->view('header');
		$this->load->view('delivery/delivery_persons', $data);
		$this->load->view('footer');
	}

	public function create_person() {
		$person = array(
			'name' => $this->input->post('name'),
			'nic' => $this->input->post('nic'),
			'contact' => $this->input->post('contact'),
		);

		$result = $this->DeliveryPersonsModel->create($person);

		if($result) {
			$alert = array(
				'type' => 'success',
				'message' => 'Delivery person created successful',
			);
			$this->session->set_flashdata('alert', $alert);
			redirect('delivery/DeliveryPersons');
		}
	}
}
