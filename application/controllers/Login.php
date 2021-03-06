<?php
/**
 * Created by Net Beans.
 * User: Rebecca
 * Date: 7/17/2019
 * Time: 8:21 PM
 */

defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->model('UsersModel'); // load Users model
		$this->load->model('CompanyModel');
	}

	public function index() {
		$this->load->view("login_view");
	}

	public function login() {
		// set login form data to array
		$login_data = array(
			'email'     => $this->input->post('email'),
			'password'  => $this->input->post('password'),
		);

		// set system admin login credentials
		if($login_data['email'] == 'admin@ceylonmarine.com' && $login_data['password'] == 'admin') {
			$this->session->set_userdata('name', 'Admin');
			$this->session->set_userdata('type', 'Admin');
			$this->session->set_userdata('id', 1);
			$this->session->set_userdata('email', 'admin@ceylonmarine.com');
			redirect('home');
		}
		else {
			// check is this registered user or not
			$result = $this->UsersModel->login($login_data);
			$company = $this->CompanyModel->view();

			// if login successful redirect to dashboard else redirect to login form
			if ($result['success'] == True) {
				$this->session->set_userdata('name', $result['data'][0]['first_name']. ' ' .$result['data'][0]['last_name']);
				$this->session->set_userdata('id', $result['data'][0]['id']);
				$this->session->set_userdata('type', $result['data'][0]['user_type']);
				$this->session->set_userdata('email', $result['data'][0]['email']);
				$this->session->set_userdata('logo', $company[0]->logo);
				redirect('home');
			}
			else {
				$this->session->set_flashdata('error', true);
				redirect('login');
			}
		}

	}

	public function signup() {
		// load signup form
		$data = array(
			'email' => $this->input->get('email'),
		);
		$this->load->view("signup_view", $data);
	}

	public function confirm_signup() {
		$otp = $this->input->post('otp');

		// assign singup form values to signup_user->array
		$signup_user = array(
			'email'             => $this->input->post('email'),
			'password'          => sha1($this->input->post('password')),
			'retype_password'   => sha1($this->input->post('retype_password')),
			'last_login'        => date("Y-m-d H:i"),
			'token'             => rand(1000, 9999),
		);

		// otp and signup form values pass to model
		$result = $this->UsersModel->signup($otp, $signup_user);

		// signup successfull redirect to home page
		if($result == true) {
			$this->session->set_userdata('name', $result->first_name.' '.$result->last_name);
			$this->session->set_userdata('id', $result->id);
			$this->session->set_userdata('type', $result->user_type);
			redirect('home');
		}
		// sigup unsuccessfull redirect popup error message
		else {
			redirect('login');
		}
	}

	public function forgot_password() {
		// load forget_password view
		$this->load->view('forgot_password');

		$email = $this->input->post('email');

		// check entered email address is system user
		$result = $this->UsersModel->reset_user($email);

		if ($result) {
			// send password reset email
			$mail_settings = Array(
				'protocol'    => 'smtp',
				'smtp_host'   => 'smtp.googlemail.com',
				'smtp_port'   => '587',
				'smtp_user'   => 'alliontestmail@gmail.com',
				'smtp_pass'   => 'Allion@321',
				'mailtype'    => 'html',
				'smtp_crypto' => 'tls',
				'charset'     => 'utf-8',
				'newline'     => "\r\n"
			);

			$this->load->library('email', $mail_settings);
			$this->email->from('admin@ceylonmarine.com', 'Ceylon Marine Equipment and Services (pvt) Ltd');
			$this->email->to($result[0]->email);
			$this->email->set_mailtype("html");
			$this->email->subject('Request Password Reset');
			$this->email->message('
                <p>Dear '.$result[0]->first_name.' '.$result[0]->last_name.',</p>

                <p>You have been requested to reset your "CM Distribution Management System" password in order to get reset to your password click on the following link and enter your OTP code.</p>

                <p>Code : '.$result[0]->token.'</p>
                <p>Link: <a href="'.base_url().'login/signup?email='.$result[0]->email.'">Reset Password Link</a> <br/>

                <p>Best regards,</p>
                <p>Administrator</p>
                ');
			$this->email->send();
		}
	}

	// logout function
	public function logout() {
		session_destroy();
		redirect('login');
	}
}
