<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Purchase extends CI_Controller {
	// constructor -> this function call first
	public function __construct() {
		parent::__construct();
		if(!$this->session->userdata('name')) {
			redirect(redirect('login'));
		}
		$this->load->model('ProductsModel');
		$this->load->model('ProductCategoriesModel');
		$this->load->model('StockModel');
		$this->load->model('SupplierModel');
		$this->load->model('PurchaseModel');
		$this->load->model('CompanyModel');
		$this->load->model('UomModel');
	}

	// load header, invoice view and footer pages
	public function index() {

		$data = array(
			'products' => $this->ProductsModel->active_products(),
			'suppliers'  => $this->SupplierModel->active_suppliers(),
			'company'	 => $this->CompanyModel->view(),
		);

        $header = array(
            'company'	 => $this->CompanyModel->view(),
        );

        $this->load->view('header', $header);
		$this->load->view('purchase/purchase_view', $data);
		$this->load->view('footer');
	}

	public function generate_new_po_line() {
		$uoms = $this->UomModel->view();

        $row = '<option selected disabled>Select UoM</option>';
        foreach($uoms as $uom) {
            $row .= '<option value="'.$uom->unit.'">'.$uom->unit.'</option>';
        }
        echo $row;
    }

	public function create_purchase() {
        $company = $this->CompanyModel->view();

		$purchase_order = array(
			'number' => 'PO/'.date("Y").'/'.date("m").'/',
			'payment_type' => $this->input->post('purchase_payment'),
			'date' => $this->input->post('purchase_date'),
			'total_amount' => $this->input->post('purchase_subtotal'),
			'company_id' => $company[0]->id,
            'suppliers_id' => $this->input->post('supplier_name'),
		);

		$po_id = $this->PurchaseModel->create($purchase_order);
		$this->create_po_order_lines($po_id);

        redirect('purchase/purchase/single_purchase_order?id='.$po_id);
	}

	public function create_po_order_lines($po_id) {
		$purchase_order_lines = array();

		$line = array();
		for($i = 0; $i < count($this->input->post('purchase_product')); $i++) {
			$line['price'] =$this->input->post('purchase_price')[$i];
			$line['quantity'] = $this->input->post('purchase_qty')[$i];
			$line['total'] = $this->input->post('purchase_total')[$i];
			$line['product'] = $this->input->post('purchase_product')[$i];
			$line['purchase_id'] = $po_id;
			array_push($purchase_order_lines, $line);
			unset($lines);
		}

		$result = $this->PurchaseModel->create_lines($purchase_order_lines);
	}

	public function view_purchase_orders() {
		$data = array(
			'purchase_orders' => $this->PurchaseModel->select_all(),
		);

        $header = array(
            'company'	 => $this->CompanyModel->view(),
        );

        $this->load->view('header', $header);
		$this->load->view('purchase/all_purchase', $data);
		$this->load->view('footer');
	}

	public function single_purchase_order() {
	    $po_id = $this->input->get('id');

		$data = array(
			'purchase_order' => $this->PurchaseModel->select_purchase_order($po_id),
			'purchase_order_lines' => $this->PurchaseModel->select_purchase_order_lines($po_id),
            'company'	 => $this->CompanyModel->view(),
		);

        $header = array(
            'company'	 => $this->CompanyModel->view(),
        );

        $this->load->view('header', $header);
		$this->load->view('purchase/single_purchase_order_view', $data);
		$this->load->view('footer');
	}

	public function print_purchase() {
		$po_id = $this->input->get('id');

		$data = array(
			'purchase_order' => $this->PurchaseModel->select_purchase_order($po_id),
			'purchase_order_lines' => $this->PurchaseModel->select_purchase_order_lines($po_id),
			'company'	 => $this->CompanyModel->view(),
		);

		$this->load->view('purchase/print_purchase', $data);
	}
}
