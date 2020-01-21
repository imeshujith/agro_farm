<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DeliveryPersons extends CI_Controller {
	public function __construct() {
		parent::__construct();
		if(!$this->session->userdata('name')) {
			redirect(redirect('login'));
		}
		$this->load->model('DeliveryPersonsModel');
		$this->load->model('CompanyModel');
	}

	public function index() {
		$data = array(
			'persons' => $this->DeliveryPersonsModel->view(),
		);

        $header = array(
            'company'	 => $this->CompanyModel->view(),
        );

        $this->load->view('header', $header);
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
		else {
            redirect('delivery/DeliveryPersons');
        }
	}

    public function get_single_item() {
        $person_id = $this->input->post('id');

        $result = $this->DeliveryPersonsModel->single_item($person_id);
        if($result == true) {
            echo json_encode($result);
        }
    }

    public function check_duplicate_nic() {
        $nic = $this->input->post('nic');

        $result = $this->DeliveryPersonsModel->check_nic($nic);
        if($result) {
            echo json_encode(true);
        }
        else {
            echo json_encode(false);
        }
    }

	public function update_person() {
	    $id = $this->input->post('id');

	    $new_values = array(
	        'name' => $this->input->post('update_dp_name'),
	        'nic' => $this->input->post('update_dp_nic'),
	        'contact' => $this->input->post('update_dp_contact'),
        );

	    $result = $this->DeliveryPersonsModel->update($id, $new_values);

	    if ($result) {
            $alert = array(
                'type' => 'warning',
                'message' => 'Delivery person information updated successful',
            );
            $this->session->set_flashdata('alert', $alert);
            redirect('delivery/DeliveryPersons');
        }
    }

    public function inactive_person() {
	    $id = $this->input->get('id');

        $result = $this->DeliveryPersonsModel->inactive($id);

        if($result) {
            $alert = array(
                'type' => 'warning',
                'message' => 'Delivery person inactivate successful',
            );
            $this->session->set_flashdata('alert', $alert);
            redirect('delivery/DeliveryPersons');
        }
        else {
            redirect('delivery/DeliveryPersons');
        }
    }

    public function active_person() {
        $id = $this->input->get('id');

        $result = $this->DeliveryPersonsModel->active($id);

        if($result) {
            $alert = array(
                'type' => 'warning',
                'message' => 'Delivery person activate successful',
            );
            $this->session->set_flashdata('alert', $alert);
            redirect('delivery/DeliveryPersons');
        }
        else {
            redirect('delivery/DeliveryPersons');
        }
    }
}
