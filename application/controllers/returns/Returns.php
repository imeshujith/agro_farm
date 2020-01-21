<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Returns extends CI_Controller {
	// constructor -> this function call first
	public function __construct() {
		parent::__construct();
		if(!$this->session->userdata('name')) {
			redirect(redirect('login'));
		}
		$this->load->model('ProductsModel');
		$this->load->model('ProductCategoriesModel');
		$this->load->model('StockModel');
		$this->load->model('CustomerModel');
		$this->load->model('InvoiceModel');
		$this->load->model('CompanyModel');
		$this->load->model('DeliveryOrderModel');
		$this->load->model('ReturnsModel');
	}

	// load header, invoice view and footer pages
	public function index() {
		$data = array(
			'categories' => $this->ProductCategoriesModel->view(),
			'customers'  => $this->CustomerModel->view(),
			'company'	 => $this->CompanyModel->view(),
		);

		$this->load->view('header');
		$this->load->view('returns/returns_view', $data);
		$this->load->view('footer');
	}

	public function get_category_wise_products() {
		$cat_id = $this->input->get('cat_id');
		$products = $this->StockModel->view($cat_id);
		if($products) {
			echo json_encode($products);
		}
	}

	public function create_return() {
		// this array insert invoice form data
		$company = $this->CompanyModel->view();

		$return = array(
			'number' => 'RO/'.date("Y").'/'.date("m").'/',
			'payment_type' => $this->input->post('return_payment'),
			'date' => $this->input->post('return_date'),
			'total_untax' => $this->input->post('return_total_amount'),
			'total_discount' => $this->input->post('return_total_discount'),
			'total_tax' => $this->input->post('return_total_tax'),
			'total_amount' => $this->input->post('return_subtotal'),
			'customers_id' => $this->input->post('return_customer'),
			'invoice_number' => $this->input->post('return_invoice_number'),
			'company_id' => $company[0]->id,
			'status' => 'Draft',
		);

		$last_return = $this->ReturnsModel->create($return);

		$return_lines = array();
		$line = array();
		for($i = 0; $i < count($this->input->post('return_product')); $i++) {
			$line['product_id'] = $this->input->post('return_product')[$i];
			$line['price'] =$this->input->post('return_price')[$i];
			$line['quantity'] = $this->input->post('return_qty')[$i];
			$line['discount'] = $this->input->post('return_discount')[$i];
			$line['tax'] = $this->input->post('return_tax')[$i];
			$line['total'] = $this->input->post('return_total')[$i];
			$line['returns_id'] = $last_return[0]->id;
			$line['unit_of_measures_id'] = $this->input->post('return_uom_id')[$i];
			array_push($return_lines, $line);
			unset($lines);
		}

		$this->ReturnsModel->create_lines($last_return, $return_lines);

		redirect('returns/returns/single_return?id='.$last_return[0]->id);
	}

	public function all_returns() {
		$data = array(
			'returns' => $this->ReturnsModel->get_all(),
		);

		$this->load->view('header');
		$this->load->view('returns/all_returns', $data);
		$this->load->view('footer');
	}

	public function single_return() {
		$return_id = $this->input->get('id');

		$data = array(
			'return' => $this->ReturnsModel->get_return($return_id),
			'return_lines' => $this->ReturnsModel->get_lines($return_id),
			'company'	 => $this->CompanyModel->view(),
		);

		$this->load->view('header');
		$this->load->view('returns/single_return_view', $data);
		$this->load->view('footer');
	}

	public function cancel_return() {
		$return_id = $this->input->get('id');

		$result = $this->ReturnsModel->cancel($return_id);

		if($result) {
			$alert = array(
				'type' => 'warning',
				'message' => 'Return Order cancelled successful',
			);
			$this->session->set_flashdata('alert', $alert);
			redirect('returns/returns/single_return?id='.$return_id);
		}
	}

	public function confirm_return() {
		$return_id = $this->input->get('id');

		$result = $this->ReturnsModel->confirm($return_id);

		foreach ($result as $line) {
			$product = $this->ProductsModel->single_product($line->product_id);
			$current_quantity = $product[0]->quantity;
			$return_quantity = $line->quantity;

			// update each return line quantity
			if($return_quantity) {
				$new_quantity = array(
					'quantity' => ($current_quantity + $return_quantity),
				);
				$this->ProductsModel->update($product[0]->id, $new_quantity);
			}
		}

		if($result) {
			$alert = array(
				'type' => 'warning',
				'message' => 'Return Order confirmed successful',
			);
			$this->session->set_flashdata('alert', $alert);
			redirect('returns/returns/single_return?id='.$return_id);
		}
	}

	public function generate_new_invoice_line() {
		$products = $this->ProductsModel->view();

		$row = '<option selected disabled>Select Product</option>';
		foreach($products as $product) {
			$row .= '<option value="'.$product->id.'">'.$product->name.'</option>';
		}
		echo $row;
	}

	public function print_return() {
		$return_id = $this->input->get('id');

		$data = array(
			'return' => $this->ReturnsModel->get_return($return_id),
			'return_lines' => $this->ReturnsModel->get_lines($return_id),
			'company'	 => $this->CompanyModel->view(),
		);

		$this->load->view('returns/print_return', $data);
	}
}
