<?php
/**
 * Created by Net Beans.
 * User: Rebecca
 * Date: 7/17/2019
 * Time: 11:14 PM
 */

defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {
    // constructor -> this function call first
    public function __construct() {
        parent::__construct();
		if(!$this->session->userdata('name')) {
			redirect(redirect('login'));
		}
        $this->load->model('UsersModel');
    }

    // load header, dashboard and footer pages
    public function index() {
        $this->load->view('header');
        $this->load->view('users/user_view');
        $this->load->view("footer");
    }

    // get all users from database
    public function all_users() {
        $result = $this->UsersModel->view_all_users();
        $users = '';
        foreach ($result as $user) {
            $users .= '<tr>'.
                        '<td>EMP'.sprintf("%04d", $user->id).'</td>'.
                        '<td>'.$user->first_name.' '.$user->last_name.'</td>'.
                        '<td>'.$user->email.'</td>'.
                        '<td>'.$user->user_type.'</td>'.
                        '<td>'.($user->active == 1 ? '<span class="label label-success">Active</span>': '<span class="label label-danger">Inactive</span>').'</td>'.
                        '<td class="text-center">'.(is_null($user->last_login) ? '-': $user->last_login).'</td>'.
                        '<td>'.$user->create_date.'</td>'.
                        '<td class="text-center">'.(is_null($user->edit_date) ? '-': $user->edit_date).'</td>'.
                        '<td class="text-right">'.
                            '<button id="edit_user" class="btn btn-default btn-xs" data="'.$user->id.'">Edit</button>&nbsp;&nbsp;&nbsp;&nbsp;'.
                            ($user->active == 1 ? '<button id="active" class="btn btn-default btn-xs" data="'.$user->id.'"><strong class="text-danger">Inactive</strong></button>&nbsp;&nbsp;&nbsp;&nbsp;': '<button id="inactive" class="btn btn-default btn-xs" data="'.$user->id.'" style="width: 54.2px;"><strong class="text-success">Active</strong></button>&nbsp;&nbsp;&nbsp;&nbsp;').
                            '<button id="delete_user" class="btn btn-default btn-xs" data="'.$user->id.'">Delete</button>&nbsp;&nbsp;&nbsp;&nbsp;'.
                        '</td>'.
                      '</tr>';
        }
        echo json_encode($users);
    }

    // create new user
    public function create_user() {
        // create user form validation
        $this->form_validation->set_rules('first_name', 'First Name', 'trim|required');
        $this->form_validation->set_rules('last_name', 'Last Name', 'trim|required');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');

        // invalid form tigger error messages
        if($this->form_validation->run() == FALSE) {
            $error = array(
                'error' => true,
                'message' => validation_errors(),
            );
            echo json_encode($error);
        }

        // valid form
        else {
            // assign form input values to array
            $new_user = array (
                'first_name'    => $this->input->post('first_name'),
                'last_name'     => $this->input->post('last_name'),
                'email'         => $this->input->post('email'),
                'user_type'     => $this->input->post('user_type'),
                'token'         => rand(1000, 9999),
                'create_date'   => date("Y-m-d"),
                'edit_date'     => date("Y-m-d H:i"),
            );

            // check given email has exsisting databse record
            $result = $this->UsersModel->create_new_user($new_user);

            // given email address already registered, tigger error message
            if($result == false) {
                $error = array(
                    'error' => true,
                    'message' => "The given email address already registered",
                );
                echo json_encode($error);

            }

            // given email address not registered, create new user
            else {
                $error = array (
                    'error' => false,
                    'message' => '<p>User created successfully</p><p>Invitation link send to given email address</p>',
                );
                // send invitation email to new user
                $this->send_invitation_email($new_user);
                echo json_encode($error);
            }
        }
    }

    // send invitation email to new users
    public function send_invitation_email($new_user) {
        $mail_settings = Array(
            'protocol'    => 'smtp',
            'smtp_host'   => 'smtp.googlemail.com',
            'smtp_port'   => '587',
            'smtp_user'   => 'alliontestmail@gmail.com',
            'smtp_pass'   => 'Allion@321',
            'mailtype'    => 'html',
            'smtp_crypto' => 'tls',
            'charset'     => 'utf-8',
            'newline'     => "\r\n"
        );

        $this->load->library('email', $mail_settings);
        $this->email->from('admin@biogreen.com', 'Bio Green Holdings (Pvt) Ltd');
        $this->email->to($new_user['email']);
        $this->email->set_mailtype("html");
        $this->email->subject('Invitation for AgroFarm Management System - Bio Green Holdings (Pvt) Ltd');
        $this->email->message('
            <p>Dear '.$new_user['first_name'].' '.$new_user['last_name'].',</p>

            <p>You have been invited to connect to "Bio Green Holdings (Pvt) Ltd" in order to get access to our system AgroFarm Management System.</p>
            <p>OTP Code : '.$new_user['token'].'</p>
            <p>To accept the invitation, click on the following link: <a href="'.base_url().'/login/signup?email='.$new_user['email'].'">Invitation Link</a> and enter your email and OTP code</p>
            <p>Accept invitation to "Bio Green Holdings (Pvt) Ltd"</p> <br/>

            <p>Best regards,</p>
            <p>'.$this->session->userdata('name').'</p>
            <p>AgroFarm Management System - Bio Green Holdings (pvt) Ltd</p>
            ');
        $this->email->send();
    }

    // get edit user details from database
    public function get_edit_user() {
        $edit_user_id = $this->input->post('id');
        $result = $this->UsersModel->edit_user($edit_user_id);
        echo json_encode($result);
    }

    // update exsisting user
    public function update_user() {
        // edit user form validation
        $this->form_validation->set_rules('first_name', 'First Name', 'trim|required');
        $this->form_validation->set_rules('last_name', 'Last Name', 'trim|required');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');

        // invalid form tigger error messages
        if($this->form_validation->run() == FALSE) {
            $error = array(
                'error' => true,
                'message' => validation_errors(),
            );
            echo json_encode($error);
        }

        // valid form
        else {
            // assign form input values to array
            $edit_user = array(
                'first_name'    => $this->input->post('first_name'),
                'last_name'     => $this->input->post('last_name'),
                'email'         => $this->input->post('email'),
				'user_type'     => $this->input->post('user_type'),
                'edit_date'     => date("Y-m-d H:i"),
            );

            // check given email has exsisting databse record
            $result = $this->UsersModel->update_user($edit_user);

            // given email address already registered tigger error message
            if($result == false) {
                $error = array(
                    'error' => true,
                    'message' => "The given email address already registered",
                );
                echo json_encode($error);

            }

            // given email address not registered, create new user
            else {
                $error = array (
                    'error' => false,
                    'message' => 'User updated successfully',
                );
                echo json_encode($error);
            }
        }
    }

    // delete users from databse
    public function delete_user() {
        $delete_user_id = $this->input->post('id');
        $result = $this->UsersModel->delete_user($delete_user_id);
        echo json_encode($result);
    }

    // to set inactive user
    public function active_user() {
        $user_id = $this->input->post('id');
        $result = $this->UsersModel->active_user($user_id);
        echo json_encode($result);
    }

    // to set active user
    public function inactive_user() {
        $user_id = $this->input->post('id');
        $result = $this->UsersModel->inactive_user($user_id);
        echo json_encode($result);
    }
}
