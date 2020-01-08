<?php
Class StockModel extends CI_Model {

    public function view($cat_id) {
        $this->db->select('product.*, product_category.name as category, (product.quantity * product.price) as total, unit_of_measures.unit as uom, ((product.quantity / product.maximum_qty) * 100) as inventory_level, product_category.id as category_id');
        $this->db->from('product')->where('product_category_id', $cat_id);
        $this->db->join('product_category', 'product_category.id = product.product_category_id');
		$this->db->join('unit_of_measures', 'unit_of_measures.id = product.unit_of_measures_id');
        $query = $this->db->get();
        return $query->result();
    }
}

?>
