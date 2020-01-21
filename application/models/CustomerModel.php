<?php
Class CustomerModel extends CI_Model {

    public function view() {
        $this->db->from('customers');
        $query = $this->db->get();
        return $query->result();
    }

	public function active_customers() {
		$this->db->from('customers');
		$this->db->where('active', 1);
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
		return true;
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

	public function active($customer_id) {
		$this->db->where('id', $customer_id);
		$this->db->update('customers', array('active' => 1));
		if ($this->db->affected_rows() == 1) {
			return true;;
		}
		else {
			return false;;
		}
	}

	public function inactive($customer_id) {
		$this->db->where('id', $customer_id);
		$this->db->update('customers', array('active' => 0));
		if ($this->db->affected_rows() == 1) {
			return true;;
		}
		else {
			return false;;
		}
	}
}

?>
