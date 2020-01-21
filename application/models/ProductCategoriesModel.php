<?php
Class ProductCategoriesModel extends CI_Model {

    public function view() {
        $query = $this->db->get('product_category');
        return $query->result();
    }

    public function create($new_category) {
        // check duplicate accounts
        $query = $this->db->select("*")->from("product_category")->where('code', $new_category['code']);
        if(count($query->get()->result_array()) >= 1) {
            return false;
        }
        else {
            $this->db->insert('product_category', $new_category);
            return true;
        }
    }

    public function single_item($category_id) {
        $this->db->where('id', $category_id);
        $query = $this->db->get('product_category');
        return $query->result();
    }

    public function update($category_id, $new_values) {
        $this->db->where('id', $category_id);
        $this->db->update('product_category', $new_values);
        return true;
    }

    public function delete($category_id) {
        $this->db->where('id', $category_id);
        $this->db->delete('product_category');
        if ($this->db->affected_rows() == 1) {
            return true;;
        }
        else {
            return false;;
        }
    }
}

?>
