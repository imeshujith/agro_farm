<?php
Class SupplierModel extends CI_Model {

	public function view() {
		$this->db->from('suppliers');
		$query = $this->db->get();
		return $query->result();
	}

	public function active_suppliers() {
		$this->db->from('suppliers');
		$this->db->where('active', 1);
		$query = $this->db->get();
		return $query->result();
	}

	public function single_item($supplier_id) {
		$this->db->where('id', $supplier_id);
		$query = $this->db->get('suppliers');
		return $query->result();
	}


	public function create($new_supplier) {
		$this->db->insert('suppliers', $new_supplier);
		if ($this->db->affected_rows() == 1) {
			return true;
		}
		else {
			return false;
		}
	}

	public function update($supplier_id, $new_values) {
		$this->db->where('id', $supplier_id);
		$this->db->update('suppliers', $new_values);
		return true;
	}

	public function delete($supplier_id) {
		$this->db->where('id', $supplier_id);
		$this->db->delete('suppliers');
		if ($this->db->affected_rows() == 1) {
			return true;;
		}
		else {
			return false;;
		}
	}

	public function postal_code($city) {
		$this->db->select('postcode');
		$this->db->from('cities');
		$this->db->where('name_en', $city);
		$query = $this->db->get();
		return $query->result();
	}

	public function active($supplier_id) {
		$this->db->where('id', $supplier_id);
		$this->db->update('suppliers', array('active' => 1));
		if ($this->db->affected_rows() == 1) {
			return true;;
		}
		else {
			return false;;
		}
	}

	public function inactive($supplier_id) {
		$this->db->where('id', $supplier_id);
		$this->db->update('suppliers', array('active' => 0));
		if ($this->db->affected_rows() == 1) {
			return true;;
		}
		else {
			return false;;
		}
	}
}

?>
