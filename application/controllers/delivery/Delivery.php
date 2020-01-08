<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Delivery extends CI_Controller {
	// constructor -> this function call first
	public function __construct() {
		parent::__construct();
		if(!$this->session->userdata('name')) {
			redirect(redirect('login'));
		}
		$this->load->model('ProductsModel');
		$this->load->model('CustomerModel');
		$this->load->model('CompanyModel');
		$this->load->model('DeliveryOrderModel');
		$this->load->model('DeliveryCalendarModel');
		$this->load->model('DeliveryPersonsModel');
		$this->load->model('EmailModel');
	}

    public function single_delivery_order() {
		$order_id = $this->input->get('id');

		$data = array(
			'order' => $this->DeliveryOrderModel->get_do($order_id),
			'order_lines' => $this->DeliveryOrderModel->get_do_lines($order_id),
			'persons'  => $this->DeliveryPersonsModel->view(),
		);

        $this->load->view('header');
        $this->load->view('delivery/delivery_order_view', $data);
        $this->load->view('footer');
    }

    public function all_delivery_orders() {
    	$data = array(
    		'orders' => $this->DeliveryOrderModel->list_all(),
		);
        $this->load->view('header');
        $this->load->view('delivery/all_delivery_orders', $data);
        $this->load->view('footer');
    }

    public function delivery_calendar_view() {
        $this->load->view('header');
        $this->load->view('delivery/delivery_calendar_view');
        $this->load->view('footer');
    }

    public function schedule_delivery() {
		$order_id = $this->input->post('id');

		$data = array(
			'scheduled_date' => $this->input->post('scheduled_date'),
			'delivery_persons_id' => $this->input->post('delivery_person'),
			'status' => 'Scheduled'
		);
		$result = $this->DeliveryOrderModel->schedule($order_id, $data);

		$event = array(
			'title' => $result[0]->number.$result[0]->id.' - '.$result[0]->person,
			'start_event' => $this->input->post('scheduled_date'),
			'end_event' => $this->input->post('scheduled_date'),
			'delivery_order_id' => $order_id,
		);
		$this->DeliveryCalendarModel->insert($event);

		if($result[0]->email) {
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
			$this->email->from('delivery@ceylonmarine.com', 'Ceylon Marine Equipment and Services (pvt) Ltd');
			$this->email->to($result[0]->email);
			$this->email->set_mailtype("html");
			$this->email->subject($result[0]->number.$result[0]->id.' order has ready to ship');
			$this->email->message('
            <p>Dear '.$result[0]->first_name.' '.$result[0]->last_name.',</p>

            <p>You order number '.$result[0]->number.$result[0]->id.' has ready to ship. Once your order has shipped you will notify via an email.</p>

            <p>Best regards,</p>
            <p>'.$this->session->userdata('name').'</p>
            <p>CM Distribution Management System - Ceylon Marine Equipment and Services (pvt) Ltd</p>
            ');
			$this->email->send();
		}

		redirect('delivery/delivery/single_delivery_order?id='.$result[0]->id);
    }

    public function shipped_delivery() {
		$order_id = $this->input->get('id');
		$shipped_date = date('Y-m-d');
		$result = $this->DeliveryOrderModel->shipped($order_id, $shipped_date);

		if($result[0]->email) {
			$mail_settings = Array(
				'protocol' => 'smtp',
				'smtp_host' => 'smtp.googlemail.com',
				'smtp_port' => '587',
				'smtp_user' => 'alliontestmail@gmail.com',
				'smtp_pass' => 'Allion@321',
				'mailtype' => 'html',
				'smtp_crypto' => 'tls',
				'charset' => 'utf-8',
				'newline' => "\r\n"
			);

			$this->load->library('email', $mail_settings);
			$this->email->from('delivery@ceylonmarine.com', 'Ceylon Marine Equipment and Services (pvt) Ltd');
			$this->email->to($result[0]->email);
			$this->email->set_mailtype("html");
			$this->email->subject($result[0]->number.$result[0]->id.' order has shipped');
			$this->email->message('
				<p>Dear '.$result[0]->first_name.' '.$result[0]->last_name.',</p>
	
				<p>You order number '.$result[0]->number.$result[0]->id.' has shipped. Once your order come to your doorstep our delivery person will contact to you.</p>	

				<p>Best regards,</p>
				<p>' . $this->session->userdata('name') . '</p>
				<p>CM Distribution Management System - Ceylon Marine Equipment and Services (pvt) Ltd</p>
				');
			$this->email->send();
		}

		redirect('delivery/delivery/single_delivery_order?id='.$result[0]->id);
    }

    public function cancel_delivery() {
		$order_id = $this->input->get('id');
		$result = $this->DeliveryOrderModel->cancel($order_id);

		if($result[0]->email) {
			$mail_settings = Array(
				'protocol' => 'smtp',
				'smtp_host' => 'smtp.googlemail.com',
				'smtp_port' => '587',
				'smtp_user' => 'alliontestmail@gmail.com',
				'smtp_pass' => 'Allion@321',
				'mailtype' => 'html',
				'smtp_crypto' => 'tls',
				'charset' => 'utf-8',
				'newline' => "\r\n"
			);

			$this->load->library('email', $mail_settings);
			$this->email->from('delivery@ceylonmarine.com', 'Ceylon Marine Equipment and Services (pvt) Ltd');
			$this->email->to($result[0]->email);
			$this->email->set_mailtype("html");
			$this->email->subject($result[0]->number.$result[0]->id.' order has canceled');
			$this->email->message('
            <p>Dear '.$result[0]->first_name.' '.$result[0]->last_name.',</p>

            <p>You order number '.$result[0]->number.$result[0]->id.' has canceled due to following reason. </p>

            <p>Best regards,</p>
            <p>' . $this->session->userdata('name') . '</p>
            <p>CM Distribution Management System - Ceylon Marine Equipment and Services (pvt) Ltd</p>
            ');
			$this->email->send();
		}

		redirect('delivery/delivery/single_delivery_order?id='.$result[0]->id);
    }

    public function order_delivered() {
		$order_id = $this->input->get('id');
		$delivered_date = date('Y-m-d');
		$result = $this->DeliveryOrderModel->delivered($order_id, $delivered_date);
		redirect('delivery/delivery/single_delivery_order?id='.$result[0]->id);
	}

	public function print_order() {
		$order_id = $this->input->get('id');

		$data = array(
			'order' => $this->DeliveryOrderModel->get_do_with_person($order_id),
			'order_lines' => $this->DeliveryOrderModel->get_do_lines($order_id),
			'company'	 => $this->CompanyModel->view(),
		);

		$this->load->view('delivery/print_order', $data);
	}
}
