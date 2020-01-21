<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class UserProfile extends CI_Controller {
	// constructor -> this function call first
	public function __construct() {
		parent::__construct();
        if(!$this->session->userdata('name')) {
            redirect(redirect('login'));
        }
		$this->load->model('UsersModel');
		$this->load->model('CompanyModel');
	}

	// load header, dashboard and footer pages
	public function index() {
		$user_id = $this->session->userdata('id');

		$data = array(
			'user' => $this->UsersModel->single_item($user_id),
		);

        $header = array(
            'company'	 => $this->CompanyModel->view(),
        );

        $this->load->view('header', $header);
		$this->load->view('users/user_profile_view', $data);
		$this->load->view("footer");
	}

	public function update_profile() {
		$id = $this->session->userdata('id');

		$data = array(
			'first_name' => $this->input->post('first_name'),
			'last_name' => $this->input->post('last_name'),
		);

		$result = $this->UsersModel->update_profile($id, $data);

		if($result) {
			$alert = array(
				'type' => 'warning',
				'message' => 'User profile updated successful',
			);
			$this->session->set_flashdata('alert', $alert);
			$this->session->set_userdata('name', $data['first_name'].' '.$data['last_name']);
			redirect('users/UserProfile');
		}
	}

	public function update_password() {
		$id = $this->session->userdata('id');
		$old_password = $this->input->post('current_password');

		// check the old password is correct or incorrect
		$valid = $this->UsersModel->check_password($id, sha1($old_password));

		// if old password is correct
		if($valid) {
			$data = array(
				'password' => sha1($this->input->post('new_password')),
				'retype_password' => sha1($this->input->post('retype_password')),
			);

			$result = $this->UsersModel->update_profile($id, $data);

			if($result) {
				$alert = array(
					'type' => 'warning',
					'message' => 'User password change successful',
				);
				$this->session->set_flashdata('alert', $alert);
				redirect('users/UserProfile');
			}
		}
		// else old password is incorrect
		else {
			$alert = array(
				'type' => 'danger',
				'message' => 'Your current password is incorrect',
			);
			$this->session->set_flashdata('alert', $alert);
			redirect('users/UserProfile');
		}

	}
}
