<?php
Class SupplierModel extends CI_Model {

	public function view() {
		$this->db->from('suppliers');
		$query = $this->db->get();
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
		if ($this->db->affected_rows() == 1) {
			return $this->db->error();;
		}
		else {
			return $this->db->error();;
		}
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
}

?>
