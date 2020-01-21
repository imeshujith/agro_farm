<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reports extends CI_Controller {
	// constructor -> this function call first
	public function __construct() {
		parent::__construct();
		if(!$this->session->userdata('name')) {
			redirect(redirect('login'));
		}
		$this->load->model('ReportModel');
		$this->load->model('ProductCategoriesModel');
		$this->load->model('CompanyModel');
	}

	public function income_report() {
		$data = array(
			'invoices' => null,
			'sum' => null,
			'title' => null,
		);

		$from_date = $this->input->post('from_date');
		$to_date = $this->input->post('to_date');

		$company = $this->CompanyModel->view();

		if($from_date and $to_date) {
			$data['invoices'] = $this->ReportModel->income_report_query($from_date, $to_date);
			$data['sum'] = $this->ReportModel->income_report_sum($from_date, $to_date);
			$data['title'] = $from_date.' - '.$to_date.' Income Report - '.$company[0]->name;
		}

        $header = array(
            'company'	 => $this->CompanyModel->view(),
        );

        $this->load->view('header', $header);
		$this->load->view('reports/income_report', $data);
		$this->load->view("footer");
	}

	public function expense_report() {
		$data = array(
			'purchases' => null,
			'total' => null,
			'title' => null,
		);

		$from_date = $this->input->post('from_date');
		$to_date = $this->input->post('to_date');

		$company = $this->CompanyModel->view();

		if($from_date and $to_date) {
			$data['purchases'] = $this->ReportModel->expense_report_query($from_date, $to_date);
			$data['total'] = $this->ReportModel->expense_report_sum($from_date, $to_date);
			$data['title'] = $from_date.' - '.$to_date.' Expense Report - '.$company[0]->name;
		}

        $header = array(
            'company'	 => $this->CompanyModel->view(),
        );

        $this->load->view('header', $header);
		$this->load->view('reports/expense_report', $data);
		$this->load->view("footer");
	}

	public function stock_report() {
		$data = array(
			'products' => null,
			'total' => null,
			'categories' => $this->ProductCategoriesModel->view(),
			'title' => null,
		);

		$cat_id = $this->input->post('category');
		$company = $this->CompanyModel->view();

		if($cat_id) {
			$data['products'] = $this->ReportModel->stock_report_query($cat_id);
			$data['total'] = $this->ReportModel->stock_report_qty($cat_id);
			$data['title'] = 'Current Stock Report - '.$company[0]->name;
		}

        $header = array(
            'company'	 => $this->CompanyModel->view(),
        );

        $this->load->view('header', $header);
		$this->load->view('reports/stock_report', $data);
		$this->load->view("footer");
	}

	public function delivery_report() {
		$data = array(
			'dos' => null,
			'title' => null,
		);

		$from_date = $this->input->post('from_date');
		$to_date = $this->input->post('to_date');

		$company = $this->CompanyModel->view();

		if($from_date and $to_date) {
			$data['dos'] = $this->ReportModel->delivery_report_query($from_date, $to_date);
			$data['title'] = $from_date.' - '.$to_date.' Delivery Report - '.$company[0]->name;
		}

        $header = array(
            'company'	 => $this->CompanyModel->view(),
        );

        $this->load->view('header', $header);
		$this->load->view('reports/delivery_report', $data);
		$this->load->view("footer");
	}

    public function yearly_income_expense_report() {
        $year = $this->input->post('year');

        $data = array(
            'invoices' => null,
            'pos' => null,
            'title' => null,
            'invoice_ysum' => null,
            'po_ysum' => null,
        );

        $company = $this->CompanyModel->view();

        if($year) {
            $data['invoices'] = $this->ReportModel->yearly_income_report($year);
            $data['invoice_ysum'] = $this->ReportModel->yearly_income_report_sum($year);
            $data['pos'] = $this->ReportModel->yearly_expense_report($year);
            $data['po_ysum'] = $this->ReportModel->yearly_expense_report_sum($year);
            $data['title'] = $year.' Income and Expense Report - '.$company[0]->name;
        }

        $header = array(
            'company'	 => $this->CompanyModel->view(),
        );

        $this->load->view('header', $header);
        $this->load->view('reports/yearly_income_expense_report', $data);
        $this->load->view("footer");
    }

    public function monthly_income_expense_report() {
        $year = $this->input->post('year');
        $month = $this->input->post('month');

        $data = array(
            'invoices' => null,
            'pos' => null,
            'title' => null,
            'invoice_msum' => null,
            'po_msum' => null,
        );

        $company = $this->CompanyModel->view();

        if($year) {
            $data['invoices'] = $this->ReportModel->monthly_income_report($year, $month);
            $data['invoice_msum'] = $this->ReportModel->monthly_income_report_sum($year, $month);
            $data['pos'] = $this->ReportModel->monthly_expense_report($year, $month);
            $data['po_msum'] = $this->ReportModel->monthly_expense_report_sum($year, $month);
            $data['title'] = $year.'/'.$month.' Income and Expense Report - '.$company[0]->name;
        }

        $header = array(
            'company'	 => $this->CompanyModel->view(),
        );

        $this->load->view('header', $header);
        $this->load->view('reports/monthly_income_expense_report', $data);
        $this->load->view("footer");
    }
}
