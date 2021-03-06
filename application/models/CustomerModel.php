<?php
Class CustomerModel extends CI_Model {

    public function view() {
        $this->db->from('customers');
        $query = $this->db->get();
        return $query->result();
    }

    public function create($new_customer) {
        $this->db->insert('customers', $new_customer);
		if ($this->db->affected_rows() == 1) {
			return true;
		}
		else {
			return false;
		}
    }

	public function single_item($customer_id) {
		$this->db->where('id', $customer_id);
		$query = $this->db->get('customers');
		return $query->result();
	}

    public function update($customer_id, $new_values) {
		$this->db->where('id', $customer_id);
		$this->db->update('customers', $new_values);
		if ($this->db->affected_rows() == 1) {
			return true;;
		}
		else {
			return false;;
		}
	}

	public function delete($customer_id) {
		$this->db->where('id', $customer_id);
		$this->db->delete('customers');
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
