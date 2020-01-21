<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Email extends CI_Controller {
	public function __construct() {
		parent::__construct();
		if(!$this->session->userdata('name')) {
			redirect(redirect('login'));
		}
		$this->load->model('EmailModel');
		$this->load->model('CompanyModel');
	}

    public function index() {
		$user = $this->session->userdata('id');

		$data = array(
			'emails' => $this->EmailModel->view($user)
		);

        $header = array(
            'company'	 => $this->CompanyModel->view(),
        );

        $this->load->view('header', $header);
        $this->load->view('email/email_view', $data);
        $this->load->view('footer');
    }

    public function send() {
    	$data = array(
    		'users_id' => $this->session->userdata('id'),
			'receiver' => $this->input->post('receiver'),
			'subject' => $this->input->post('subject'),
			'body' => $this->input->post('body'),
			'date' => date('Y-m-d'),
		);

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
		$this->email->from($this->session->userdata('email'), $this->session->userdata('name'));
		$this->email->to($this->input->post('receiver'));
		$this->email->set_mailtype("html");
		$this->email->subject($this->input->post('subject'));
		$this->email->message($this->input->post('body'));
		$this->email->send();

    	$result = $this->EmailModel->send($data);
		if($result) {
			$alert = array(
				'type' => 'success',
				'message' => 'Email send successful',
			);
			$this->session->set_flashdata('alert', $alert);
			redirect('email/email');
		}
		else {
			redirect('email/email');
		}

	}
}
