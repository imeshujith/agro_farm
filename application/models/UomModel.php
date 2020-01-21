<?php
Class UomModel extends CI_Model {

    public function view() {
        $query = $this->db->get('unit_of_measures');
        		 $this->db->order_by('name', 'ASD');
        return $query->result();
    }

    public function create($new_uom) {
        // check duplicate accounts
        $this->db->insert('unit_of_measures', $new_uom);
        return true;
    }

    public function single_item($uom_id) {
        $this->db->where('id', $uom_id);
        $query = $this->db->get('unit_of_measures');
        return $query->result();
    }

    public function update($uom_id, $new_values) {
        $this->db->where('id', $uom_id);
		$this->db->update('unit_of_measures', $new_values);
        return true;
    }

    public function delete($uom_id) {
        $this->db->where('id', $uom_id);
        $this->db->delete('unit_of_measures');
        if ($this->db->affected_rows() == 1) {
            return true;;
        }
        else {
            return false;;
        }
    }


}

?>
