<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Uom extends CI_Controller {
    // constructor -> this function call first
    public function __construct() {
        parent::__construct();
		if(!$this->session->userdata('name')) {
			redirect(redirect('login'));
		}
        $this->load->model('UomModel');
        $this->load->model('CompanyModel');
    }

    // load header, uom view and footer pages
    public function index() {
        // get all uom from database
        $data = array(
            'uoms' => $this->UomModel->view(),
        );

        $header = array(
            'company'	 => $this->CompanyModel->view(),
        );

        $this->load->view('header', $header);
        $this->load->view('products/uom_view', $data);
        $this->load->view("footer");
    }

    // create new uom
    public function create_uom() {
        $new_uom = array (
            'name'        => $this->input->post('name'),
            'unit'        => $this->input->post('unit'),
            'create_date' => date("Y-m-d"),
        );
        $result = $this->UomModel->create($new_uom);

        if($result) {
            $alert = array(
                'type' => 'success',
                'message' => 'Unit of Measure created successful',
            );
            $this->session->set_flashdata('alert', $alert);
            redirect('products/uom');
        }
        else {
			$alert = array(
				'type' => 'danger',
				'message' => 'Error please try again later',
			);
			$this->session->set_flashdata('alert', $alert);
			redirect('products/uom');
		}
    }

    public function get_single_item() {
        $uom_id = $this->input->post('id');

        $result = $this->UomModel->single_item($uom_id);
        if($result == true) {
            echo json_encode($result);
        }
    }

    public function update_uom() {
        $uom_id = $this->input->post('id');

        $new_values = array (
            'name'        => $this->input->post('name'),
            'unit'        => $this->input->post('unit'),
        );

        $result = $this->UomModel->update($uom_id, $new_values);

        if($result) {
            $alert = array(
                'type' => 'warning',
                'message' => 'Unit of Measure information updated successful',
            );
            $this->session->set_flashdata('alert', $alert);
            redirect('products/uom');
        }
		else {
			$alert = array(
				'type' => 'danger',
				'message' => 'Error please try again later',
			);
			$this->session->set_flashdata('alert', $alert);
			redirect('products/uom');
		}
    }

    public function delete_uom() {
        $uom_id = $this->input->post('id');

        $result = $this->UomModel->delete($uom_id);

        if($result) {
            $alert = array(
                'type' => 'warning',
                'message' => 'Unit of Measure deleted successful',
            );
            $this->session->set_flashdata('alert', $alert);
            redirect('products/uom');
        }
		else {
			$alert = array(
				'type' => 'danger',
				'message' => 'Error please try again later',
			);
			$this->session->set_flashdata('alert', $alert);
			redirect('products/uom');
		}
    }
}
