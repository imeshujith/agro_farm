<?php
Class DashboardModel extends CI_Model {

	public function total_users() {
		return $this->db->select('count(id) as total_users')
						->from('users')
						->get()
						->result();
	}

	public function total_products() {
		return $this->db->select('count(id) as total_products')
						->from('product')
						->get()
						->result();
	}

	public function total_customers() {
		return $this->db->select('count(id) as total_customers')
						->from('customers')
						->get()
						->result();
	}

	public function total_suppliers() {
		return $this->db->select('count(id) as total_suppliers')
						->from('suppliers')
						->get()
						->result();
	}

	public function category_wise_product() {
		return $this->db->select('count(product.id) as total_product, product_category.name as category')
			->from('product')
			->join('product_category', 'product_category.id = product.product_category_id')
			->group_by('product.product_category_id')
			->get()
			->result();
	}

	public function current_month_income() {
		return $this->db->select('sum(total_amount) as total, Day(date) as day')
			->from('invoice')
			->group_by('date')
			->where('Month(date) = ', date('m'))
			->get()
			->result();
	}

	public function stock_level() {
		$this->db->select('product.*, (product.quantity * product.price) as total, ((product.quantity / product.maximum_qty) * 100) as inventory_level');
		$this->db->from('product');
		$query = $this->db->get();
		return $query->result();
	}

	public function all_invoices() {
		$this->db->select("invoice.*, customers.first_name as first_name, customers.last_name as last_name, customers.street_one as street_one, customers.street_two as street_two, customers.city as customer_city, customers.email as customer_email, customers.phone as customer_phone, company.name as company_name, company.street as company_street, company.phone as company_phone, company.mobile as company_mobile, company.email as company_email, company.logo as company_logo");
		$this->db->from('invoice');
		$this->db->join('customers', 'customers.id = invoice.customers_id');
		$this->db->join('company', 'company.id = invoice.company_id');
		$this->db->where('Month(date) =', Date('m'));
		$query = $this->db->get();
		return $query->result();
	}
}

?>
