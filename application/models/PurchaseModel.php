<?php
Class PurchaseModel extends CI_Model {

    public function create($purchase_order) {
        $this->db->insert('purchase', $purchase_order);
        $po_id = $this->db->insert_id();
        return $po_id;
    }

    public function create_lines($purchase_order_lines) {
        $this->db->insert_batch('purchase_order_line', $purchase_order_lines);
        return true;
    }

    public function select_purchase_order($po_id) {
        $this->db->select("purchase.*, suppliers.first_name as first_name, suppliers.last_name as last_name, suppliers.street_one as street_one, suppliers.street_two as street_two, suppliers.city as supplier_city, suppliers.postal_code as supplier_postal_code, suppliers.country as supplier_country, suppliers.email as supplier_email, suppliers.phone as supplier_phone, company.name as company_name, company.street as company_street, company.phone as company_phone, company.mobile as company_mobile, company.email as company_email, company.logo as company_logo");
        $this->db->from('purchase');
        $this->db->join('suppliers', 'suppliers.id = purchase.suppliers_id');
        $this->db->join('company', 'company.id = purchase.company_id');
        $this->db->where('purchase.id', $po_id);
        $query = $this->db->get();
        return $query->result();
    }

    public function select_purchase_order_lines($po_id) {
        $this->db->select("purchase_order_line.*");
        $this->db->from('purchase_order_line');
        $this->db->where('purchase_order_line.purchase_id', $po_id);
        $query = $this->db->get();
        return $query->result();
    }

	public function select_all() {
		$this->db->select("purchase.*, suppliers.first_name as first_name, suppliers.last_name as last_name, suppliers.street_one as street_one, suppliers.street_two as street_two, suppliers.city as supplier_city, suppliers.postal_code as supplier_postal_code, suppliers.country as supplier_country, suppliers.email as supplier_email, suppliers.phone as supplier_phone, company.name as company_name, company.street as company_street, company.phone as company_phone, company.mobile as company_mobile, company.email as company_email, company.logo as company_logo");
		$this->db->from('purchase');
		$this->db->join('suppliers', 'suppliers.id = purchase.suppliers_id');
		$this->db->join('company', 'company.id = purchase.company_id');
		$query = $this->db->get();
		return $query->result();
	}
}

?>

