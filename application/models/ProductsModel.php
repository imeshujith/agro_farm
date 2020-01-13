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

	public function active_products() {
		$this->db->select('product.*, product_category.name as category, unit_of_measures.unit as uom');
		$this->db->from('product');
		$this->db->join('product_category', 'product_category.id = product.product_category_id');
		$this->db->join('unit_of_measures', 'unit_of_measures.id = product.unit_of_measures_id');
		$this->db->where('product.active', 1);
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

	public function get_category_wise_product($category_id) {
		$this->db->select('product_category.code as code, product.number as number');
		$this->db->from('product');
		$this->db->join('product_category', 'product_category.id = product.product_category_id');
		$this->db->where('product.product_category_id', $category_id);
		$this->db->order_by('product.id', 'DESC');
		$this->db->limit(1);
		$query = $this->db->get();
		return $query->result();
	}

	public function active($product_id) {
		$this->db->where('id', $product_id);
		$this->db->update('product', array('active' => 1));
		if ($this->db->affected_rows() == 1) {
			return true;;
		}
		else {
			return false;;
		}
	}

	public function inactive($product_id) {
		$this->db->where('id', $product_id);
		$this->db->update('product', array('active' => 0));
		if ($this->db->affected_rows() == 1) {
			return true;;
		}
		else {
			return false;;
		}
	}
}

?>
