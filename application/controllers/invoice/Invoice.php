<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Invoice extends CI_Controller {
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
    }

    // load header, invoice view and footer pages
    public function index() {
        $data = array(
            'categories' => $this->ProductCategoriesModel->view(),
            'customers'  => $this->CustomerModel->active_customers(),
			'company'	 => $this->CompanyModel->view(),
        );

        $header = array(
            'company'	 => $this->CompanyModel->view(),
        );

        $this->load->view('header', $header);
        $this->load->view('invoice/invoice_view', $data);
        $this->load->view('footer');
    }

    public function get_category_wise_products() {
        $cat_id = $this->input->get('cat_id');
        $products = $this->StockModel->view($cat_id);
        if($products) {
            echo json_encode($products);
        }
    }

    public function create_invoice() {
        // this array insert invoice form data
		$company = $this->CompanyModel->view();

        $invoice = array(
        	'number' => 'INV/'.date("Y").'/'.date("m").'/',
            'payment_type' => $this->input->post('invoice_payment'),
            'date' => $this->input->post('invoice_date'),
            'total_untax' => $this->input->post('invoice_total_amount'),
            'total_discount' => $this->input->post('invoice_total_discount'),
            'total_tax' => $this->input->post('invoice_total_tax'),
            'total_amount' => $this->input->post('invoice_subtotal'),
            'customers_id' => $this->input->post('invoice_customer'),
            'company_id' => $company[0]->id,
        );

        $last_invoice = $this->InvoiceModel->create($invoice);

        $invoice_lines = array();
        $line = array();
        for($i = 0; $i < count($this->input->post('invoice_product')); $i++) {
            $line['product_id'] = $this->input->post('invoice_product')[$i];
            $line['price'] =$this->input->post('invoice_price')[$i];
            $line['quantity'] = $this->input->post('invoice_qty')[$i];
            $line['discount'] = $this->input->post('invoice_discount')[$i];
            $line['tax'] = $this->input->post('invoice_tax')[$i];
            $line['total'] = $this->input->post('invoice_total')[$i];
            $line['invoice_id'] = $last_invoice[0]->id;
            $line['unit_of_measures_id'] = $this->input->post('invoice_uom_id')[$i];
            array_push($invoice_lines, $line);
            unset($lines);
        }

        $last_invoice_lines = $this->InvoiceModel->create_lines($last_invoice, $invoice_lines);
        $this->create_delivery_order($last_invoice, $last_invoice_lines);

        redirect('invoice/invoice/single_invoice?id='.$last_invoice[0]->id);
    }

    public function create_delivery_order($last_invoice, $last_invoice_lines) {
        $do = array(
        	'number' => 'DO/'.date("Y").'/'.date("m").'/',
            'customers_id' => $last_invoice[0]->customers_id,
            'invoice_id' => $last_invoice[0]->id,
            'company_id' => $last_invoice[0]->company_id,
            'status' => 'Draft',
            'active' => 0,
			'date' => date('Y-m-d'),
        );

        $result = $this->DeliveryOrderModel->create($do);
        $do_id = $result[0]->id;

		$do_lines = array();
		$line = array();
		for($i = 0; $i < count($last_invoice_lines); $i++) {
			$line['product_id'] = $last_invoice_lines[$i]->product_id;
			$line['quantity'] = $last_invoice_lines[$i]->quantity;
			$line['delivery_order_id'] = $do_id;
			array_push($do_lines, $line);
			unset($lines);
		}
		$this->DeliveryOrderModel->create_lines($do_lines);
    }

    public function all_invoices() {
        $data = array(
            'invoices' => $this->InvoiceModel->get_all(),
        );

        $header = array(
            'company'	 => $this->CompanyModel->view(),
        );

        $this->load->view('header', $header);
        $this->load->view('invoice/all_invoices', $data);
        $this->load->view('footer');
    }

    public function single_invoice() {
        $invoice_id = $this->input->get('id');

        $data = array(
            'invoice' => $this->InvoiceModel->get_invoice($invoice_id),
            'invoice_lines' => $this->InvoiceModel->get_lines($invoice_id),
			'company'	 => $this->CompanyModel->view(),
			'do_id' => $this->DeliveryOrderModel->single_do($invoice_id),
        );

        $header = array(
            'company'	 => $this->CompanyModel->view(),
        );

        $this->load->view('header', $header);
        $this->load->view('invoice/single_invoice_view', $data);
        $this->load->view('footer');
    }

    public function cancel_invoice() {
		$invoice_id = $this->input->get('id');

		$result = $this->InvoiceModel->cancel($invoice_id);

		if($result) {
			$alert = array(
				'type' => 'warning',
				'message' => 'Invoice cancelled successful',
			);
			$this->session->set_flashdata('alert', $alert);
			redirect('invoice/invoice/single_invoice?id='.$invoice_id);
		}
	}

    public function confirm_invoice() {
    	$invoice_id = $this->input->get('id');

		$result = $this->InvoiceModel->confirm($invoice_id);

		// when invoice is confirm delivery order is activated
		$deliver_order = $this->DeliveryOrderModel->active($invoice_id);

		// get delivery order lines through delivery order
		$delivery_order_lines = $this->DeliveryOrderModel->get_do_lines($deliver_order[0]->id);

		foreach ($delivery_order_lines as $line) {
			$product = $this->ProductsModel->single_product($line->product_id);
			$current_quantity = $product[0]->quantity;
			$ordered_quantity = $line->quantity;

			// update each product qty
			if(($current_quantity - $ordered_quantity) > 0) {
				$new_quantity = array(
					'quantity' => ($current_quantity - $ordered_quantity),
				);
				$this->ProductsModel->update($product[0]->id, $new_quantity);
			}
		}

		if($result) {
			$alert = array(
				'type' => 'warning',
				'message' => 'Invoice confirmed successful',
			);
			$this->session->set_flashdata('alert', $alert);
			redirect('invoice/invoice/single_invoice?id='.$invoice_id);
		}
	}

	public function generate_new_invoice_line() {
		$products = $this->ProductsModel->active_products();

		$row = '<option selected disabled>Select Product</option>';
		foreach($products as $product) {
			$row .= '<option value="'.$product->id.'">'.$product->name.'</option>';
		}
		echo $row;
	}

	public function print_invoice() {
		$invoice_id = $this->input->get('id');

		$data = array(
			'invoice' => $this->InvoiceModel->get_invoice($invoice_id),
			'invoice_lines' => $this->InvoiceModel->get_lines($invoice_id),
			'company'	 => $this->CompanyModel->view(),
		);

		$this->load->view('invoice/print_invoice', $data);
	}
}
