<?php
Class EmailModel extends CI_Model {

	public function view($user) {
		$query = $this->db->get_where('emails', array('users_id' => $user));
		return $query->result();
	}

	public function send($data) {
		$this->db->insert('emails', $data);
		return true;
	}
}

?>
