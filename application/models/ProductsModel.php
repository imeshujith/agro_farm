<?php
Class ProductsModel extends CI_Model {

    public function view() {
        $this->db->select('product.*, product_category.name as category, unit_of_measures.unit as uom');
        $this->db->from('product');
        $this->db->join('product_category', 'product_category.id = product.product_category_id');
        $this->db->join('unit_of_measures', 'unit_of_measures.id = product.unit_of_measures_id');
        $query = $this->db->get();
        return $query->result();
    }

    public function create($new_product) {
        $this->db->insert('product', $new_product);
		if ($this->db->affected_rows() == 1) {
			return true;
		}
		else {
			return false;
		}
    }

	public function update($product_id, $new_values) {
		$this->db->where('id', $product_id);
		$this->db->update('product', $new_values);
		if ($this->db->affected_rows() == 1) {
			return true;;
		}
		else {
			return false;;
		}
	}

	public function delete($product_id) {
		$this->db->where('id', $product_id);
		$this->db->delete('product');
		if ($this->db->affected_rows() == 1) {
			return true;;
		}
		else {
			return false;;
		}
	}

	public function single_product($product_id) {
		$this->db->select('product.*, product_category.name as category, product_category.id as category_id, unit_of_measures.unit as uom, unit_of_measures.id as uom_id');
		$this->db->from('product');
		$this->db->join('product_category', 'product_category.id = product.product_category_id');
		$this->db->join('unit_of_measures', 'unit_of_measures.id = product.unit_of_measures_id');
		$this->db->where('product.id', $product_id);
		$query = $this->db->get();
		return $query->result();
	}
}

?>
