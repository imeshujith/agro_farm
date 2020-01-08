<?php
Class ReturnsModel extends CI_Model {

	public function create($return) {
		$this->db->insert('returns', $return);
		$return_id = $this->db->insert_id();
		$query = $this->db->get_where('returns', array('id' => $return_id));
		return $query->result();
	}

	public function create_lines($return_id, $return_lines) {
		$this->db->insert_batch('returns_lines', $return_lines);
		$query = $this->db->get_where('returns_lines', array('returns_id' => $return_id[0]->id));
		return $query->result();
	}

	public function get_return($return_id) {
		$this->db->select("returns.*, customers.first_name as first_name, customers.last_name as last_name, customers.street_one as street_one, customers.street_two as street_two, customers.city as customer_city, customers.email as customer_email, customers.phone as customer_phone, company.name as company_name, company.street as company_street, company.phone as company_phone, company.mobile as company_mobile, company.email as company_email, company.logo as company_logo");
		$this->db->from('returns');
		$this->db->join('customers', 'customers.id = returns.customers_id');
		$this->db->join('company', 'company.id = returns.company_id');
		$this->db->where('returns.id', $return_id);
		$query = $this->db->get();
		return $query->result();
	}

	public function get_lines($return_id) {
		$this->db->select("returns_lines.*, product.code as code, product.name as product, unit_of_measures.unit as uom");
		$this->db->from('returns_lines');
		$this->db->join('product', 'product.id = returns_lines.product_id');
		$this->db->join('unit_of_measures', 'unit_of_measures.id = returns_lines.unit_of_measures_id');
		$this->db->where('returns_id', $return_id);
		$query = $this->db->get();
		return $query->result();
	}

	public function get_all() {
		$this->db->select("returns.*, customers.first_name as first_name, customers.last_name as last_name, customers.street_one as street_one, customers.street_two as street_two, customers.city as customer_city, customers.email as customer_email, customers.phone as customer_phone, company.name as company_name, company.street as company_street, company.phone as company_phone, company.mobile as company_mobile, company.email as company_email, company.logo as company_logo");
		$this->db->from('returns');
		$this->db->join('customers', 'customers.id = returns.customers_id');
		$this->db->join('company', 'company.id = returns.company_id');
		$query = $this->db->get();
		return $query->result();
	}

	public function cancel($return_id) {
		$this->db->where('id', $return_id);
		$this->db->update('returns', array('status' => 'Cancel'));
		if ($this->db->affected_rows() == 1) {
			return true;;
		}
		else {
			return false;;
		}
	}

	public function confirm($return_id) {
		$this->db->where('id', $return_id);
		$this->db->update('returns', array('status' => 'Confirm'));
		if ($this->db->affected_rows() == 1) {
			$query = $this->db->get_where('returns_lines', array('returns_id' => $return_id));
			return $query->result();
		}
		else {
			return false;;
		}
	}
}
?>

