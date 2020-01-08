<?php
Class DeliveryCalendarModel extends CI_Model {

	public function insert($event) {
		$this->db->insert('delivery_calendar', $event);
		return true;
	}

	public function view() {
		return $this->db->select('delivery_calendar.*, delivery_order.status as status')
						->from('delivery_calendar')
						->join('delivery_order', 'delivery_order.id = delivery_calendar.delivery_order_id')
						->order_by('id')
						->get()
		                ->result();
	}
}
?>

