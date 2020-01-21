<?php
Class DeliveryPersonsModel extends CI_Model {

	public function view() {
		$query = $this->db->get('delivery_persons');
		return $query->result();
	}

	public function active_persons() {
		$this->db->where('active', true);
		$query = $this->db->get('delivery_persons');
		return $query->result();
	}

	public function create($person) {
		$this->db->insert('delivery_persons', $person);
		return true;
	}

	public function single_item($person_id) {
		$this->db->where('id', $person_id);
		$query = $this->db->get('delivery_persons');
		return $query->result();
	}

	public function check_nic($nic) {
		$this->db->where('nic', $nic);
		$query = $this->db->get('delivery_persons');
		return $query->result();
	}

	public function update($id, $new_values) {
		$this->db->where('id', $id);
		$this->db->update('delivery_persons', $new_values);
		return true;
	}

	public function active($id) {
		$this->db->where('id', $id);
		$this->db->update('delivery_persons', array('active' => true));
		if ($this->db->affected_rows() == 1) {
			return true;
		}
		else {
			return false;
		}
	}

	public function inactive($id) {
		$this->db->where('id', $id);
		$this->db->update('delivery_persons', array('active' => false));
		if ($this->db->affected_rows() == 1) {
			return true;
		}
		else {
			return false;
		}
	}
}
?>

