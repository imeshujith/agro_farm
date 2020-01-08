<?php
Class InventoryModel extends CI_Model {

    public function view() {
        $this->db->select('sum(price * quantity) as total_items, sum(quantity) as total_qty, product_category.name as category, count(product_category_id) as item_count, product_category.id as cat_id');
        $this->db->from('product');
        $this->db->join('product_category', 'product_category.id = product.product_category_id');
        $this->db->group_by('product_category_id');
        $query = $this->db->get();
        return $query->result();
    }
}

?>
