<?php
Class DeliveryPersonsModel extends CI_Model {

	public function view() {
		$query = $this->db->get('delivery_persons');
		return $query->result();
	}

	public function create($person) {
		$this->db->insert('delivery_persons', $person);
		return true;
	}

	public function update($id, $new_values) {
		$this->db->where('id', $id);
		$this->db->update('delivery_person', $new_values);
		if ($this->db->affected_rows() == 1) {
			return true;
		}
		else {
			return false;
		}
	}

	public function active($id) {
		$this->db->where('id', $id);
		$this->db->update('delivery_person', array('active' => true));
		if ($this->db->affected_rows() == 1) {
			return true;
		}
		else {
			return false;
		}
	}

	public function inactive($id) {
		$this->db->where('id', $id);
		$this->db->update('delivery_person', array('active' => false));
		if ($this->db->affected_rows() == 1) {
			return true;
		}
		else {
			return false;
		}
	}
}
?>

