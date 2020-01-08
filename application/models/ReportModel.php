<?php
Class ReportModel extends CI_Model {

	public function income_report_query($from_date, $to_date) {
		$query = $this->db->select('invoice.*, customers.first_name as first_name, customers.last_name as last_name');
		$this->db->from('invoice');
		$this->db->join('customers', 'customers.id = invoice.customers_id');
		$this->db->where('invoice.date >=', $from_date);
		$this->db->where('invoice.date <=', $to_date);
		$this->db->where('invoice.status !=', 'Cancel');

		$this->db->order_by('date', 'ASC');

		return $query->get()->result();
	}

	public function income_report_sum($from_date, $to_date) {
		$query = $this->db->select('sum(total_amount) as sum');
		$this->db->from('invoice');
		$this->db->where('date >=', $from_date);
		$this->db->where('date <=', $to_date);

		return $query->get()->result();
	}

	public function expense_report_query($from_date, $to_date) {
		$query = $this->db->select('purchase.*');
		$this->db->from('purchase');
		$this->db->where('date >=', $from_date);
		$this->db->where('date <=', $to_date);
		$this->db->order_by('date', 'ASC');

		return $query->get()->result();
	}

	public function expense_report_sum($from_date, $to_date) {
		$query = $this->db->select('sum(total_amount) as sum');
		$this->db->from('purchase');
		$this->db->where('date >=', $from_date);
		$this->db->where('date <=', $to_date);

		return $query->get()->result();
	}

	public function stock_report_query($cat_id) {
		$query = $this->db->select('product.*, product_category.name as category, unit_of_measures.unit as uom');
		$this->db->from('product');
		$this->db->where('product_category_id =', $cat_id);
		$this->db->join('product_category', 'product_category.id = product.product_category_id');
		$this->db->join('unit_of_measures', 'unit_of_measures.id = product.unit_of_measures_id');
		$this->db->order_by('name', 'ASD');

		return $query->get()->result();
	}

	public function stock_report_qty($cat_id) {
		$query = $this->db->select('sum(quantity * price) as total');
		$this->db->from('product');
		$this->db->where('product_category_id =', $cat_id);
		$this->db->order_by('name', 'ASD');

		return $query->get()->result();
	}

	public function delivery_report_query($from_date, $to_date) {
		$query = $this->db->select('delivery_order.*, customers.first_name as first_name, customers.last_name as last_name, delivery_persons.name as person_name, invoice.id as invoice_id, invoice.number as invoice_number');
		$this->db->from('delivery_order');
		$this->db->where('scheduled_date >=', $from_date);
		$this->db->where('scheduled_date <=', $to_date);
		$this->db->where('delivery_order.active =', 1);
		$this->db->join('customers', 'customers.id = delivery_order.customers_id');
		$this->db->join('delivery_persons', 'delivery_persons.id = delivery_order.delivery_persons_id');
		$this->db->join('invoice', 'invoice.id = delivery_order.invoice_id');
		$this->db->order_by('delivery_order.scheduled_date', 'ASC');
		return $query->get()->result();
	}

	public function yearly_income_report($year) {
		return $this->db->select('invoice.*, customers.first_name as first_name, customers.last_name as last_name')
			->from('invoice')
			->join('customers', 'customers.id = invoice.customers_id')
			->where('Year(date) =', $year)
			->where('status !=', 'Cancel')
			->order_by('date', 'ASD')
			->get()
			->result();
	}

	public function yearly_income_report_sum($year) {
		return $this->db->select('sum(total_amount) as total')
			->from('invoice')
			->where('Year(date) =', $year)
			->where('status !=', 'Cancel')
			->get()
			->result();
	}

	public function yearly_expense_report($year) {
		return $this->db->select('purchase.*, suppliers.first_name as first_name, suppliers.last_name as last_name')
			->from('purchase')
			->join('suppliers', 'suppliers.id = purchase.suppliers_id')
			->where('Year(date) =', $year)
			->order_by('date', 'ASD')
			->get()
			->result();
	}

	public function yearly_expense_report_sum($year) {
		return $this->db->select('sum(total_amount) as total')
			->from('purchase')
			->where('Year(date) =', $year)
			->get()
			->result();
	}

	public function monthly_income_report($year, $month) {
		return $this->db->select('invoice.*, customers.first_name as first_name, customers.last_name as last_name')
			->from('invoice')
			->join('customers', 'customers.id = invoice.customers_id')
			->where('Year(date) =', $year)
			->where('Month(date) =', $month)
			->where('status !=', 'Cancel')
			->order_by('date', 'ASD')
			->get()
			->result();
	}

	public function monthly_income_report_sum($year, $month) {
		return $this->db->select('sum(total_amount) as total')
			->from('invoice')
			->where('Year(date) =', $year)
			->where('Month(date) =', $month)
			->where('status !=', 'Cancel')
			->get()
			->result();
	}

	public function monthly_expense_report($year, $month) {
		return $this->db->select('purchase.*, suppliers.first_name as first_name, suppliers.last_name as last_name')
			->from('purchase')
			->join('suppliers', 'suppliers.id = purchase.suppliers_id')
			->where('Year(date) =', $year)
			->where('Month(date) =', $month)
			->order_by('date', 'ASD')
			->get()
			->result();
	}

	public function monthly_expense_report_sum($year, $month) {
		return $this->db->select('sum(total_amount) as total')
			->from('purchase')
			->where('Year(date) =', $year)
			->where('Month(date) =', $month)
			->get()
			->result();
	}

}

?>
