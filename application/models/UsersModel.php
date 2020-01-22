<?php
/**
 * Created by Net Beans.
 * User: Rebecca
 * Date: 7/17/2019
 * Time: 8:42 PM
 */

Class UsersModel extends CI_Model {
    public function login($login_data) {
        $condition = array(
            'email'     => $login_data['email'],
            'password'  => sha1($login_data['password']),
            'active' => 1
        );
        $query = $this->db->select("*")->from("users")->where($condition);
        $result = $query->get()->result_array();

        if (count($result) == 1) {
            return array(
                'success' => True,
                'data' => $result,
            );
        }
        else {
            return array(
                'success' => False,
                'data' => null,
            );
        }

    }

    public function signup($otp, $signup_user) {
        $condition = array(
            'email'  => $signup_user['email'],
            'token'  => $otp,
            'active' => 1
        );
        $query = $this->db->select("*")->from("users")->where($condition);
        $result = $query->get()->result_array();

        if (count($result) == 1) {
            $this->db->where('email', $signup_user['email']);
            $this->db->update('users', $signup_user);

            $this->db->where('email', $signup_user['email']);
            $query = $this->db->get('users');
            return $query->row();
        }
        else {
            return false;
        }
    }

    public function view_all_users() {
        $query = $this->db->get('users');
        return $query->result();
    }

    public function create_new_user($new_user) {
        // check duplicate accounts
        $query = $this->db->select("*")->from("users")->where('email', $new_user['email']);
        if(count($query->get()->result_array()) >= 1) {
            return false;
        }
        else {
            $this->db->insert('users', $new_user);
            return true;
        }
    }

    public function check_email($email) {
        $this->db->where('email', $email);
        $query = $this->db->get('users');
        return $query->result();
    }

    // return edit user details to contoller
    public function single_item($edit_user_id) {
        $this->db->where('id', $edit_user_id);
        $query = $this->db->get('users');
        return $query->result();
    }

    // update exsisting user details from databse
    public function update_user($user_id, $edit_user) {
        $this->db->where('id', $user_id);
        $query = $this->db->update('users', $edit_user);
		return true;
    }

    // delete user from databse
    public function delete_user($delete_user_id) {
        $this->db->where('id', $delete_user_id);
        $this->db->delete('users');
        return true;
    }

    // to active user
    public function active_user($user_id) {
        $this->db->where('id', $user_id);
        $data = array(
            'active' => 1,
        );
        $this->db->update('users', $data);
        return true;
    }

    // to inactive user
    public function inactive_user($user_id) {
        $this->db->where('id', $user_id);
        $data = array(
            'active' => 0,
        );
        $this->db->update('users', $data);
        return true;
    }

     public function reset_user($email) {
		 $query = $this->db->get_where('users', array('email' => $email));
		 if($query->result()) {
		     return $query->result();
         }
		 else {
		     return false;
         }
     }

     public function update_profile($id, $data) {
		 $this->db->where('id', $id);
		 $this->db->update('users', $data);
		 return true;
	 }

	 public function check_password($id, $old_password) {
    	$query = $this->db->get_where('users',
			array(
				'id' => $id,
				'password' => $old_password,
			)
		);
		 if(count($query->result()) == 1) {
			 return true;
		 }
		 else {
		 	return false;
		 }
	 }
}
