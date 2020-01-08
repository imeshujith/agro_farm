<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Calendar extends CI_Controller {
	public function __construct() {
		parent::__construct();
		if(!$this->session->userdata('name')) {
			redirect(redirect('login'));
		}
		$this->load->model('DeliveryCalendarModel');
	}

    public function index() {
        $this->load->view('header');
        $this->load->view('delivery/calendar_view');
        $this->load->view('footer');
    }

    public function load_events() {
		$events = $this->DeliveryCalendarModel->view();

		foreach($events as $event) {
		    $url = base_url().'delivery/delivery/single_delivery_order?id='.$event->delivery_order_id;

            $color = '#428bca';
            if($event->status == 'Scheduled') {
                $color = '#f0ad4e';
            }
            elseif($event->status == 'Shipped') {
                $color = '#5bc0de';
            }
            elseif ($event->status == 'Delivered') {
                $color = '#5cb85c';
            }

			$data[] = array(
				'id' => $event->id,
				'title' => $event->title,
				'start' => $event->start_event,
				'end' => $event->end_event,
                'url' => $url,
                'color' => $color,
			);
		}

		echo json_encode($data);
	}
}
