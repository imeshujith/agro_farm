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
}
?>

