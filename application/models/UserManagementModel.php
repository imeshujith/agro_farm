<?php
/**
 * Created by PhpStorm.
 * User: Imesh
 * Date: 11/24/2019
 * Time: 7:12 PM
 */

Class UserManagementModel extends CI_Model {

    public function view() {
        $query = $this->db->get('users_has_user_group_has_operations');
        return $query->result();
    }

    public function create_access($new_access) {
        $condition = array(
            'user_group_id' => $new_access['access_module_id'],
            'operations_id' => $new_access['access_operation_id'],
        );

        $this->db->from("user_group_has_operations")->where($condition);
        $query = $this->db->get();
        $group_has_oprations = $query->result();

        $insert = array(
            'users_id' => $new_access['access_user_id'],
            'user_group_has_operations_id' => $group_has_oprations[0]->id,
            'user_group_has_operations_user_group_id' => $group_has_oprations[0]->user_group_id,
            'user_group_has_operations_operations_id' => $group_has_oprations[0]->operations_id,
        );

        $this->db->insert('users_has_user_group_has_operations', $insert);
        return true;
    }

    public function update($updated_permission){
        $this->db->where('user_group_has_operations_id', $updated_permission['user_group_has_operations_id']);
        $this->db->update('users_has_user_group_has_operations', array('user_group_has_operations_operations_id' => $updated_permission['new_operarion_id']));
        return true;
    }

    public function get_users() {
        $query = $this->db->get('users');
        return $query->result();
    }

    public function get_modules() {
        $query = $this->db->get('user_group');
        return $query->result();
    }

    public function get_operations() {
        $query = $this->db->get('operations');
        return $query->result();
    }

    public function get_permissions() {
        $this->db->select("users_has_user_group_has_operations.users_id, users_has_user_group_has_operations.user_group_has_operations_user_group_id, users.first_name as first_name, users.last_name as last_name, users.email as email, user_group.name as module_name");
        $this->db->from("users_has_user_group_has_operations");
        $this->db->join('users', 'users.id = users_has_user_group_has_operations.users_id');
        $this->db->join('user_group', 'user_group.id = users_has_user_group_has_operations.user_group_has_operations_user_group_id');
//        $this->db->join('operations', 'operations.id = users_has_user_group_has_operations.user_group_has_operations_operations_id');
        $this->db->group_by(array('users_id', 'user_group_has_operations_user_group_id'));
        $query = $this->db->get();
        return $query->result();
    }

//    public function delete_permission() {
//
//    }
}






















