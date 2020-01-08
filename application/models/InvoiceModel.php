<?php
Class InvoiceModel extends CI_Model {

    public function create($invoice) {
        $this->db->insert('invoice', $invoice);
        $invoice_id = $this->db->insert_id();
        $query = $this->db->get_where('invoice', array('id' => $invoice_id));
        return $query->result();
    }

    public function create_lines($invoice_id, $invoice_lines) {
        $this->db->insert_batch('invoice_line', $invoice_lines);
        $query = $this->db->get_where('invoice_line', array('invoice_id' => $invoice_id[0]->id));
        return $query->result();
    }

    public function get_invoice($invoice_id) {
        $this->db->select("invoice.*, customers.first_name as first_name, customers.last_name as last_name, customers.street_one as street_one, customers.street_two as street_two, customers.city as customer_city, customers.email as customer_email, customers.phone as customer_phone, company.name as company_name, company.street as company_street, company.phone as company_phone, company.mobile as company_mobile, company.email as company_email, company.logo as company_logo");
        $this->db->from('invoice');
        $this->db->join('customers', 'customers.id = invoice.customers_id');
        $this->db->join('company', 'company.id = invoice.company_id');
        $this->db->where('invoice.id', $invoice_id);
        $query = $this->db->get();
        return $query->result();
    }

    public function get_lines($invoice_id) {
        $this->db->select("invoice_line.*, product.code as code, product.name as product, unit_of_measures.unit as uom");
        $this->db->from('invoice_line');
        $this->db->join('product', 'product.id = invoice_line.product_id');
        $this->db->join('unit_of_measures', 'unit_of_measures.id = invoice_line.unit_of_measures_id');
        $this->db->where('invoice_id', $invoice_id);
        $query = $this->db->get();
        return $query->result();
    }

    public function get_all() {
		$this->db->select("invoice.*, customers.first_name as first_name, customers.last_name as last_name, customers.street_one as street_one, customers.street_two as street_two, customers.city as customer_city, customers.email as customer_email, customers.phone as customer_phone, company.name as company_name, company.street as company_street, company.phone as company_phone, company.mobile as company_mobile, company.email as company_email, company.logo as company_logo");
		$this->db->from('invoice');
		$this->db->join('customers', 'customers.id = invoice.customers_id');
		$this->db->join('company', 'company.id = invoice.company_id');
		$query = $this->db->get();
		return $query->result();
    }

    public function cancel($invoice_id) {
		$this->db->where('id', $invoice_id);
		$this->db->update('invoice', array('status' => 'Cancel'));
		if ($this->db->affected_rows() == 1) {
			return true;;
		}
		else {
			return false;;
		}
	}

	public function confirm($invoice_id) {
		$this->db->where('id', $invoice_id);
		$this->db->update('invoice', array('status' => 'Confirm'));
		if ($this->db->affected_rows() == 1) {
			return true;;
		}
		else {
			return false;;
		}
	}
}
?>

