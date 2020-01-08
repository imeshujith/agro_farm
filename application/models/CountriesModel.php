<?php
Class CountriesModel extends CI_Model {

    public function view() {
        $this->db->from('countries');
        $this->db->order_by('country_name', 'asd');
        $query = $this->db->get();
        return $query->result();
    }
}

?>
