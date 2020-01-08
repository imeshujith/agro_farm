<?php
Class CitiesModel extends CI_Model {

    public function view() {
        $this->db->from('cities');
        $this->db->order_by('name_en', 'asd');
        $query = $this->db->get();
        return $query->result();
    }
}

?>
