<?php
Class ReportModel extends CI_Model {

	// income report query
	public function income_report_query($from_date, $to_date) {
		return $this->db->select('invoice.*, customers.first_name as first_name, customers.last_name as last_name')
			->from('invoice')
			->join('customers', 'customers.id = invoice.customers_id')
			->where('invoice.date >=', $from_date)
			->where('invoice.date <=', $to_date)
			->where('invoice.status !=', 'Cancel')
			->where('invoice.total_amount > 5000') // add new condition total_amount > 5000
			->order_by('date', 'ASC')
			->get()
			->result();
	}

	// income total report query
	public function income_report_sum($from_date, $to_date) {
		return $this->db->select('sum(total_amount) as sum')
			->from('invoice')
			->where('date >=', $from_date)
			->where('date <=', $to_date)
            ->where('invoice.total_amount > 5000')
			->get()
			->result();
	}

	// expense report query
	public function expense_report_query($from_date, $to_date) {
		return $this->db->select('purchase.*')
			->from('purchase')
			->where('date >=', $from_date)
			->where('date <=', $to_date)
			->order_by('date', 'ASC')
			->get()
			->result();
	}

	// expense total report query
	public function expense_report_sum($from_date, $to_date) {
		return $this->db->select('sum(total_amount) as sum')
			->from('purchase')
			->where('date >=', $from_date)
			->where('date <=', $to_date)
			->get()
			->result();
	}


	public function stock_report_query($cat_id) {
		return $this->db->select('product.*, product_category.name as category, unit_of_measures.unit as uom')
			->from('product')
			->where('product_category_id =', $cat_id)
			->join('product_category', 'product_category.id = product.product_category_id')
			->join('unit_of_measures', 'unit_of_measures.id = product.unit_of_measures_id')
			->order_by('name', 'ASD')
			->get()
			->result();

	}

	public function stock_report_qty($cat_id) {
		return $this->db->select('sum(quantity * price) as total')
			->from('product')
			->where('product_category_id =', $cat_id)
			->order_by('name', 'ASD')
			->get()
			->result();
	}

	public function delivery_report_query($from_date, $to_date) {
		return $this->db->select('delivery_order.*, customers.first_name as first_name, customers.last_name as last_name, delivery_persons.name as person_name, invoice.id as invoice_id, invoice.number as invoice_number')
			->from('delivery_order')
			->where('scheduled_date >=', $from_date)
			->where('scheduled_date <=', $to_date)
			->where('delivery_order.active =', 1)
			->join('customers', 'customers.id = delivery_order.customers_id')
			->join('delivery_persons', 'delivery_persons.id = delivery_order.delivery_persons_id')
			->join('invoice', 'invoice.id = delivery_order.invoice_id')
			->order_by('delivery_order.scheduled_date', 'ASC')
			->get()
			->result();
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
