<?php
Class CompanyModel extends CI_Model {

    public function view() {
        $query = $this->db->get('company', 1);
        return $query->result();
    }

    public function create($company) {
        // check available rows
        $query = $this->db->get('company');
        $rows = $query->result();

        // if rows available update company records
        if(count($rows) >= 1) {
            $this->db->limit(1);
            $this->db->update('company', $company);
            return count($rows);
        }
        // else create a new company record
        else {
            $this->db->insert('company', $company);
            return true;
       }
    }
}

?>
