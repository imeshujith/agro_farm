<?php
/**
 * Created by PhpStorm.
 * User: Rebecca
 * Date: 7/17/2019
 * Time: 8:43 PM
 */

defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
    public function __construct() {
        parent::__construct();
		if(!$this->session->userdata('name')) {
			redirect(redirect('login'));
		}
        $this->load->model('DashboardModel');
        $this->load->model('ProductsModel');
        $this->load->model('CustomerModel');
        $this->load->model('SupplierModel');
        $this->load->model('CompanyModel');
    }

    public function index() {
		$categories = $this->DashboardModel->category_wise_product();

		foreach ($categories as $category) {
			$chart_data[] = array(
				'value' => $category->total_product,
				'color' => '#' . dechex(mt_rand(0, 16777215)),
				'highlight' => '#' . dechex(mt_rand(0, 16777215)),
				'label' => $category->category,
			);
		}

		if ($chart_data) {
            $chart_data = (preg_replace('/"([^"]+)"\s*:\s*/', '$1:', json_encode($chart_data))); // randomly generate colors
        }

    	$data = array(
    		'user' => $this->DashboardModel->total_users(),
    		'product' => $this->DashboardModel->total_products(),
    		'customer' => $this->DashboardModel->total_customers(),
    		'supplier' => $this->DashboardModel->total_suppliers(),
    		'stocks' => $this->DashboardModel->stock_level(),
    		'invoices' => $this->DashboardModel->all_invoices(),
			'piechart' => $chart_data,
            'company'	 => $this->CompanyModel->view(),
		);

        $header = array(
            'company'	 => $this->CompanyModel->view(),
        );

        $this->load->view('header', $header);
        $this->load->view('dashboard', $data);
        $this->load->view("footer");
    }

    public function current_income() {
		$this_month_incomes = $this->DashboardModel->current_month_income();
		echo json_encode($this_month_incomes); // return json array
	}
}
