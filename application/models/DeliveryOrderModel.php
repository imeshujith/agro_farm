<?php
Class DeliveryOrderModel extends CI_Model {
    public function create($do) {
        $this->db->insert('delivery_order', $do);
        $insert_id = $this->db->insert_id();
        $query = $this->db->get_where('delivery_order', array('id' => $insert_id));
        return $query->result();
    }

    public function create_lines($do_lines) {
        $this->db->insert_batch('delivery_order_lines', $do_lines);
        return True;
    }

    public function list_all() {
        $this->db->select("delivery_order.*, customers.first_name as first_name, customers.last_name as last_name, customers.city as customer_city");
        $this->db->from('delivery_order');
        $this->db->join('customers', 'customers.id = delivery_order.customers_id');
        $query = $this->db->get();
        return $query->result();
    }

	public function get_do($order_id) {
		$this->db->select("delivery_order.*, customers.first_name as first_name, customers.last_name as last_name, customers.street_one as street_one, customers.street_two as street_two, customers.city as customer_city, customers.country as customer_country, customers.email as customer_email, customers.phone as customer_phone");
		$this->db->from('delivery_order');
		$this->db->join('customers', 'customers.id = delivery_order.customers_id');
//		$this->db->join('delivery_persons', 'delivery_persons.id = delivery_order.delivery_persons_id');
		$this->db->where('delivery_order.id', $order_id);
		$query = $this->db->get();
		return $query->result();
	}

	public function get_do_with_person($order_id) {
		$this->db->select("delivery_order.*, customers.first_name as first_name, customers.last_name as last_name, customers.street_one as street_one, customers.street_two as street_two, customers.city as customer_city, customers.country as customer_country, customers.email as customer_email, customers.phone as customer_phone, delivery_persons.name as person");
		$this->db->from('delivery_order');
		$this->db->join('customers', 'customers.id = delivery_order.customers_id');
		$this->db->join('delivery_persons', 'delivery_persons.id = delivery_order.delivery_persons_id');
		$this->db->where('delivery_order.id', $order_id);
		$query = $this->db->get();
		return $query->result();
	}

	public function get_do_lines($order_id) {
		$this->db->select("delivery_order_lines.*, product.code as code, product.name as product, unit_of_measures.unit as uom");
		$this->db->from('delivery_order_lines');
		$this->db->join('product', 'product.id = delivery_order_lines.product_id');
		$this->db->join('unit_of_measures', 'unit_of_measures.id = product.unit_of_measures_id');
		$this->db->where('delivery_order_lines.delivery_order_id', $order_id);
		$query = $this->db->get();
		return $query->result();
	}

    public function active($invoice_id) {
		$this->db->where('invoice_id', $invoice_id);
		$this->db->update('delivery_order', array('active' => 1));
		$query = $this->db->get_where('delivery_order', array('invoice_id' => $invoice_id));
		return $query->result();
	}

	public function schedule($order_id, $data) {
		$this->db->where('id', $order_id);
		$this->db->update('delivery_order', $data);

		$this->db->select("delivery_order.*, customers.first_name as first_name, customers.last_name as last_name, customers.email as email, delivery_persons.name as person");
		$this->db->from('delivery_order');
		$this->db->join('customers', 'customers.id = delivery_order.customers_id');
		$this->db->join('delivery_persons', 'delivery_persons.id = delivery_order.delivery_persons_id');
		$this->db->where('delivery_order.id', $order_id);
		$query = $this->db->get();
		return $query->result();
	}

	public function shipped($order_id, $shipped_date) {
		$this->db->where('id', $order_id);
		$this->db->update('delivery_order', array('status' => 'Shipped', 'shipped_date' => $shipped_date));

		$this->db->select("delivery_order.*, customers.first_name as first_name, customers.last_name as last_name, customers.email as email, delivery_persons.name as person");
		$this->db->from('delivery_order');
		$this->db->join('customers', 'customers.id = delivery_order.customers_id');
		$this->db->join('delivery_persons', 'delivery_persons.id = delivery_order.delivery_persons_id');
		$this->db->where('delivery_order.id', $order_id);
		$query = $this->db->get();
		return $query->result();
	}

	public function delivered($order_id, $shipped_date) {
		$this->db->where('id', $order_id);
		$this->db->update('delivery_order', array('status' => 'Delivered', 'delivered_date' => $shipped_date));

		$this->db->select("delivery_order.*, customers.first_name as first_name, customers.last_name as last_name, customers.email as email, delivery_persons.name as person");
		$this->db->from('delivery_order');
		$this->db->join('customers', 'customers.id = delivery_order.customers_id');
		$this->db->join('delivery_persons', 'delivery_persons.id = delivery_order.delivery_persons_id');
		$this->db->where('delivery_order.id', $order_id);
		$query = $this->db->get();
		return $query->result();
	}

	public function cancel($order_id) {
		$this->db->where('id', $order_id);
		$this->db->update('delivery_order', array('status' => 'Cancel'));

		$$this->db->select("delivery_order.*, customers.first_name as first_name, customers.last_name as last_name, customers.email as email, delivery_persons.name as person");
		$this->db->from('delivery_order');
		$this->db->join('customers', 'customers.id = delivery_order.customers_id');
		$this->db->join('delivery_persons', 'delivery_persons.id = delivery_order.delivery_persons_id');
		$this->db->where('delivery_order.id', $order_id);
		$query = $this->db->get();
		return $query->result();
	}

	public function single_do($invoice_id) {
		$query = $this->db->get_where('delivery_order', array('invoice_id' => $invoice_id));
		return $query->result();
	}
}
?>

