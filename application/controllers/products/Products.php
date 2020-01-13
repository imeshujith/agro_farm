<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Products extends CI_Controller {
    // constructor -> this function call first
    public function __construct() {
        parent::__construct();
		if(!$this->session->userdata('name')) {
			redirect(redirect('login'));
		}
        $this->load->model('ProductsModel');
        $this->load->model('ProductCategoriesModel');
        $this->load->model('UomModel');
        $this->load->model('StockModel');
    }

    // load header, product view and footer
    public function index() {
        // pass all categories and uom to products view
        $data = array(
            'products'   => $this->ProductsModel->view(),
            'categories' => $this->ProductCategoriesModel->view(),
            'uoms'       => $this->UomModel->view(),
        );

        $this->load->view('header');
        $this->load->view('products/product_view', $data);
        $this->load->view("footer");
    }

    public function view_single_product() {
		$product_id = $this->input->post('id');
		$result = $this->ProductsModel->single_product($product_id);
		echo json_encode($result);
    }

    public function create_product() {
        $new_product = array(
            'name'                  => $this->input->post('name'),
            'description'           => $this->input->post('description'),
            'product_category_id'   => $this->input->post('category'),
            'price'                 => $this->input->post('price'),
			'unit_of_measures_id'   => $this->input->post('unit_of_measure'),
            'quantity'				=> $this->input->post('quantity'),
			'minimum_qty'           => $this->input->post('minimum'),
			'maximum_qty'           => $this->input->post('maximum'),
            'create_date'           => date("Y-m-d"),
        );

        $category_id = $new_product['product_category_id'];
        $category = $this->ProductCategoriesModel->single_item($category_id);

        $last_product_code = $this->ProductsModel->get_category_wise_product($category_id);

        if($last_product_code) {
            $new_product['code'] = $category[0]->code;
            $new_product['number'] = (int)$last_product_code[0]->number + 1;
        }

        else {
            $new_product['code'] = $category[0]->code;
            $new_product['number'] = 1;
        }

        $result = $this->ProductsModel->create($new_product);
		if($result) {
			$alert = array(
				'type' => 'success',
				'message' => 'New product created successful',
			);
			$this->session->set_flashdata('alert', $alert);
			redirect('products/products');
		}
    }

	public function update_product() {
    	$product_id = $this->input->post('id');

		$new_values = array(
			'name'                  => $this->input->post('name'),
			'description'           => $this->input->post('description'),
			'product_category_id'   => $this->input->post('category'),
			'price'                 => $this->input->post('price'),
			'unit_of_measures_id'   => $this->input->post('unit_of_measure'),
			'quantity'				=> $this->input->post('quantity'),
			'minimum_qty'           => $this->input->post('minimum'),
			'maximum_qty'           => $this->input->post('maximum'),
			'edit_date'             => date("Y-m-d"),
		);

		$result = $this->ProductsModel->update($product_id, $new_values);
		if($result) {
			$alert = array(
				'type' => 'warning',
				'message' => 'Product information updated successful',
			);
			$this->session->set_flashdata('alert', $alert);
			redirect('products/products');
		}
	}

	public function delete_product() {
		$product_id = $this->input->post('id');

		$result = $this->ProductsModel->delete($product_id);

		if($result) {
			$alert = array(
				'type' => 'warning',
				'message' => 'Product deleted successful',
			);
			$this->session->set_flashdata('alert', $alert);
			redirect('products/products');
		}
	}

	public function update_quantity() {
    	$product_id = $this->input->post('id');
    	$cat_id = $this->input->post('cat_id');

    	$new_qty = array(
    		'quantity' => (int)$this->input->post('current_qty') + (int)$this->input->post('stock_new_quantity'),
		);

		$result = $this->ProductsModel->update($product_id, $new_qty);

		if($result) {
			redirect('products/stock?cat_id='.$cat_id);
		}
	}

    public function active_product() {
        $product_id = $this->input->get('id');
        $result = $this->ProductsModel->active($product_id);
        if($result) {
            $alert = array(
                'type' => 'warning',
                'message' => 'Product activate successful',
            );
            $this->session->set_flashdata('alert', $alert);
            redirect('products/products');
        }

        else {
            redirect('products/products');
        }
    }

    public function inactive_product() {
        $product_id = $this->input->get('id');
        $result = $this->ProductsModel->inactive($product_id);
        if($result) {
            $alert = array(
                'type' => 'warning',
                'message' => 'Product inactivate successful',
            );
            $this->session->set_flashdata('alert', $alert);
            redirect('products/products');
        }

        else {
            redirect('products/products');
        }
    }
}
