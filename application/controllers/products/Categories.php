<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Categories extends CI_Controller {
    // constructor -> this function call first
    public function __construct() {
        parent::__construct();
		if(!$this->session->userdata('name')) {
			redirect(redirect('login'));
		}
        $this->load->model('ProductCategoriesModel');
        $this->load->model('CompanyModel');
    }

    // load header, categories and footer pages
    public function index() {
        // get all categories from database
        $data = array(
            'categories' => $this->ProductCategoriesModel->view(),
        );

        $header = array(
            'company'	 => $this->CompanyModel->view(),
        );

        $this->load->view('header', $header);
        $this->load->view('products/product_categories_view', $data);
        $this->load->view("footer");
    }

    // create new category
    public function create_category() {
        $new_category = array (
            'code'        => $this->input->post('code'),
            'name'        => $this->input->post('name'),
            'create_date' => date("Y-m-d"),
        );
        $result = $this->ProductCategoriesModel->create($new_category);

        if($result == true) {
			$alert = array(
				'type' => 'success',
				'message' => 'New category created successful',
			);
			$this->session->set_flashdata('alert', $alert);
            redirect('products/categories');
        }
		else {
			$alert = array(
				'type' => 'danger',
				'message' => 'Error please try again later',
			);
			$this->session->set_flashdata('alert', $alert);
			redirect('products/categories');
		}
    }

    public function get_single_item() {
        $category_id = $this->input->post('id');

        $result = $this->ProductCategoriesModel->single_item($category_id);
        if($result == true) {
            echo json_encode($result);
        }
    }

    public function update_category() {
        $category_id = $this->input->post('id');

        $new_values = array (
            'code'        => $this->input->post('code'),
            'name'        => $this->input->post('name'),
        );

        $result = $this->ProductCategoriesModel->update($category_id, $new_values);

        if($result) {
            $alert = array(
                'type' => 'warning',
                'message' => 'Category information updated successful',
            );
            $this->session->set_flashdata('alert', $alert);
            redirect('products/categories');
        }
		else {
			$alert = array(
				'type' => 'danger',
				'message' => 'Error please try again later',
			);
			$this->session->set_flashdata('alert', $alert);
			redirect('products/categories');
		}
    }

    public function delete_category() {
        $category_id = $this->input->post('id');

        $result = $this->ProductCategoriesModel->delete($category_id);

        if($result) {
            $alert = array(
                'type' => 'warning',
                'message' => 'Category deleted successful',
            );
            $this->session->set_flashdata('alert', $alert);
            redirect('products/categories');
        }
		else {
			$alert = array(
				'type' => 'danger',
				'message' => 'Error please try again later',
			);
			$this->session->set_flashdata('alert', $alert);
			redirect('products/categories');
		}
    }
}
