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
        $data = array(
            'users' => $this->UsersModel->view_all_users(),
        );
        $this->load->view('header');
        $this->load->view('users/user_view', $data);
        $this->load->view("footer");
    }

    // create new user
    public function create_user() {
        // assign form input values to array
        $new_user = array (
            'first_name'    => $this->input->post('first_name'),
            'last_name'     => $this->input->post('last_name'),
            'email'         => $this->input->post('email'),
            'user_type'     => $this->input->post('user_type'),
            'token'         => rand(1000, 9999),
            'create_date'   => date("Y-m-d"),
        );

        // check given email has exsisting databse record
        $result = $this->UsersModel->create_new_user($new_user);
        $this->send_invitation_email($new_user);

        if($result) {
            $alert = array(
                'type' => 'success',
                'message' => "<p>User created successfully</p><p>Invitation link send to user's email address</p>"
            );
            $this->session->set_flashdata('alert', $alert);
            redirect('users/users');
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
            <p>Invitation Link : <a href="'.base_url().'/login/signup?email='.$new_user['email'].'">Invitation Link</a></p>
            <p>OTP Code : '.$new_user['token'].'</p>
            <p>To accept the invitation, click on the invitation link and enter your email and OTP code</p>
            <p>Accept invitation to "Bio Green Holdings (Pvt) Ltd"</p> <br/>

            <p>Best regards,</p>
            <p>'.$this->session->userdata('name').'</p>
            <p>AgroFarm Management System - Bio Green Holdings (pvt) Ltd</p>
            ');
        $this->email->send();
    }

    // get edit user details from database
    public function get_single_item() {
        $edit_user_id = $this->input->post('id');

        $result = $this->UsersModel->single_item($edit_user_id);
        echo json_encode($result);
    }

    // update exsisting user
    public function update_user() {
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

        if($result) {
            $alert = array(
                'type' => 'warning',
                'message' => 'User details updated successfully',
            );
            $this->session->set_flashdata('alert', $alert);
            redirect('users/users');
        }
    }

    // delete users from databse
    public function delete_user() {
        $delete_user_id = $this->input->post('id');

        $result = $this->UsersModel->delete_user($delete_user_id);
        return true;
    }

    // to set inactive user
    public function active_user() {
        $user_id = $this->input->get('id');

        $result = $this->UsersModel->active_user($user_id);
        redirect('users/users');
    }

    // to set active user
    public function inactive_user() {
        $user_id = $this->input->get('id');

        $result = $this->UsersModel->inactive_user($user_id);
        redirect('users/users');
    }
}
