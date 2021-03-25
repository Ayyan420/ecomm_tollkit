<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Portal extends CI_Controller {

    public function __construct() {
        parent::__construct();
        date_default_timezone_set("Asia/Karachi");
        $public = array(
            'portal/index',
            'portal/signin',
            'portal/signup',
            'portal/signup_save',
            'portal/forgot_password',
            'portal/forgot_password_send',
            'portal/reset_password',
            'portal/reset_password_save',
        );
        $private = array(
            'portal/dashboard',
            'portal/logout',
            'portal/account',
            'portal/account_save',
        );
        $this->load->model('portal_model');
        $current_url = $this->router->fetch_class() . '/' . $this->router->fetch_method();
        if ($this->session->userdata('user_logged_in')) {
            if ((in_array($current_url, $public))) {
                redirect('dashboard');
            } else if (in_array($current_url, $private)) {
                
            }
        } elseif (!$this->session->userdata('user_logged_in') && !in_array($current_url, $public)) {
            redirect();
        }
    }

    public function index() {
        $data["page_title"] = "Admin";
        $data['main_view'] = "portal/login_view";
        $this->load->view('portal/login', $data);
    }

    public function signin() {
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');
        if (!$this->form_validation->run()) {
            $data["page_title"] = "";
            $this->load->view('portal', $data);
        } else {
            $email = $this->input->post('email');
            $password = $this->input->post('password');
            $this->load->model('portal_model');
            if ($user = $this->portal_model->login_user($email, $password)) {
                $userdata = array(
                    'user_id' => $user->id,
                    'name' => $user->first_name . ' ' . $user->last_name,
                    'user_profile_image' => $user->profile_image,
                    'user_role_id' => $user->user_role_id,
                    'user_role_name' => $this->portal_model->get_user_role_name_by_id($user->user_role_id),
                    'user_logged_in' => true
                );
                $this->session->set_userdata($userdata);
                redirect('dashboard');
            } else {
                $this->session->set_flashdata('no_user_access', 'Invalid Email / Password.');
                redirect();
            }
        }
    }

    public function signup() {
        $data["page_title"] = "Signup";
        $data['main_view'] = "portal/login_view";
        $this->load->view('portal/signup', $data);
    }

    public function signup_save() {
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|is_unique[users.email]');
        $this->form_validation->set_message('is_unique', 'The email is already registered');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[8]');
        $this->form_validation->set_rules('passconf', 'Password Confirmation', 'trim|required|matches[password]');
        if (!$this->form_validation->run()) {
            $data["page_title"] = "Pakistan Lawyers";
            $this->load->view('portal/signup', $data);
        } else {
            $_POST['active'] = 0;
            if ($secret = $this->portal_model->add_user_save()) {
                // send email to user
                $htmlContent = '<h1>Account verification link</h1>';
                $htmlContent .= '<p>Click on the link below to verify your email.</p>';
                $htmlContent .= '<p><a href="' . base_url('user') . '/email-verify/' . $secret . '">Email Verify</a></p>';
                $body = $htmlContent;
                $subject = "Nephrology account verification ";
                $msg = 'Your account successfully created';
                $to = $this->input->post('email');
                if (send_email_using_template($body, $to, $subject)) {
                    $msg .= ' and Email sent for verification.';
                }
                $this->session->set_flashdata('signup_success', $msg);
                redirect('signup');
            } else {
                $this->session->set_flashdata('no_user_access', 'Something went wrong, Please try again');
                redirect('signup');
            }
        }
    }

    public function validate_register() {
        $this->form_validation->set_rules('name', 'Name', 'trim|required');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|is_unique[users.email]');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[8]');
        $this->form_validation->set_rules('cpassword', 'Confirm Password', 'trim|required|matches[password]');
        if (!$this->form_validation->run()) {
            $this->session->set_flashdata('no_user_access', 'Please check the form errors');
            $data["page_title"] = "Register";
            $data['main_view'] = strtolower($this->router->fetch_class()) . "/register";
            $this->load->view('layout', $data);
        } else {
            if ($secret = $this->portal_user->add_user_save()) {
                $htmlContent = '<h1>Account verification link</h1>';
                $htmlContent .= '<p>Click on the link below to verify your email.</p>';
                $htmlContent .= '<p><a href="' . base_url('user') . '/email-verify/' . $secret . '">Email Verify</a></p>';
                $body = $htmlContent;
                $subject = "Nephrology account verification ";
                $msg = 'Your account successfully created';
                $to = $this->input->post('email');
                if (send_email_using_template($body, $to, $subject)) {
                    $msg .= ' and Email sent for verification.';
                }
                $this->session->set_flashdata('signup_success', $msg);
                redirect('register');
            } else {
                $this->session->set_flashdata('error_message', 'Something went wrong. Please try again!');
                redirect('register');
            }
        }
    }

    public function email_verification($code) {
        if ($this->portal_model->user_check_secret_code($code)) {
            if ($this->portal_user->verify_user_email($code)) {
                $this->session->set_flashdata('signup_success', 'Your email has been verified');
            } else {
                $this->session->set_flashdata('error_message', 'Something went wrong');
            }
            redirect('login');
        } else {
            $this->session->set_flashdata('error_message', 'Invalid Verification code');
            redirect('login');
        }
    }

    public function logout() {
        $this->session->sess_destroy();
        redirect();
    }

    public function forgot_password() {
        $data["page_title"] = "UTraders";
        $data['main_view'] = "portal/forgot_password_view";
        $this->load->view('portal/forgot_password_view', $data);
    }

    public function forgot_password_send() {
        $email = $this->input->post('email');
        $this->load->model('portal_model');
        if ($secret = $this->portal_model->user_forgot_password($email)) {
            $htmlContent = '<h1>UTraders Reset Password Request</h1>';
            $htmlContent .= '<p>Click on the link below to reset your password.</p>';
            $htmlContent .= '<p><a href="' . base_url('user') . '/reset-password/' . $secret . '">Reset Password</a></p>';

            $this->email->to($this->input->post('email'));
            $this->email->from(EMAIL_FROM_SMTP, 'UTraders');
            $this->email->subject('UTraders Reset Password Request');
            $this->email->message($htmlContent);
            $this->email->send();
            $this->session->set_flashdata('signup_success', 'Reset password link has been sent. Check your inbox.');
            redirect('forgot-password');
        } else {
            $this->session->set_flashdata('no_user_access', 'Invalid Email! Please try again.');
            redirect('forgot-password');
        }
    }

    public function reset_password($code) {
        $data['is_code_valid'] = $this->portal_model->user_check_secret_code($code);
        $data['secret_code'] = $code;
        $data["page_title"] = "SGIC - Admin Portal";
        $data['main_view'] = "portal/reset_password_view";
        $this->load->view('portal/reset_password_view', $data);
    }

    public function reset_password_save() {
        $code = $this->input->post('secret_code');
        $data['is_code_valid'] = $this->portal_model->user_check_secret_code($code);
        $data['secret_code'] = $code;
        if (!$data['is_code_valid']) {
            redirect('reset-password/' . $code);
        }
        $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[8]');
        $this->form_validation->set_rules('cpassword', 'Confirm Password', 'matches[password]');
        if (!$this->form_validation->run()) {
            $data['secret_code'] = $code;
            $data["page_title"] = "SGIC - Employee Portal";
            $data['main_view'] = "portal/reset_password_view";
            $this->load->view('portal/reset_password_view', $data);
        } else {
            if ($this->portal_model->user_reset_password($code)) {
                $this->session->set_flashdata('signup_success', 'Password changed successfully!');
                redirect();
            } else {
                $this->session->set_flashdata('no_user_access', 'Something went wrong! Please try again.');
                redirect('reset-password/' . $code);
            }
        }
    }

    public function account() {
        $data['page_title'] = "Account Settings";
        $data['main_view'] = "portal/account";
        $data['account'] = $this->db->where('id', $this->session->userdata('user_id'))->get('users')->row();
        $this->load->view('portal/layout', $data);
    }

    public function account_save() {
        $data['page_title'] = "Account Settings";
        $data['main_view'] = "portal/account";
        $is_password = FALSE;
        $this->form_validation->set_rules('first_name', 'First Name', 'trim|required');
        $this->form_validation->set_rules('last_name', 'Surname', 'trim|required');
        if ($this->input->post('new_password')) {
            $this->form_validation->set_rules('current_password', 'Current Password', 'trim|required|callback_current_password_check');
            $this->form_validation->set_rules('new_password', 'New Password', 'trim|required');
            $this->form_validation->set_rules('confirm_password', 'Confirm Password', 'trim|required|matches[new_password]');
            $is_password = TRUE;
        }
        if (!$this->form_validation->run()) {
            $data['account'] = $this->db->where('id', $this->session->userdata('user_id'))->get('users')->row();
            $this->load->view('portal/layout', $data);
        } else {
            if ($this->portal_model->user_account_update($is_password)) {
                $this->session->set_flashdata('success_message', 'Account updated successfully!');
                redirect('account');
            } else {
                $data['account'] = $this->db->where('id', $this->session->userdata('user_id'))->get('users')->row();
                $this->session->set_flashdata('errorr_message', 'Something went wrong. Please try again!');
                $this->load->view('portal/layout', $data);
            }
        }
    }

    public function current_password_check($current_password) {
        if (!$this->portal_model->match_current_password($current_password)) {
            $this->form_validation->set_message('current_password_check', 'Current password doesn\'t not match');
            return FALSE;
        }
        return TRUE;
    }

    public function dashboard() {
        $data['page_title'] = "Dashboard";
        $data['main_view'] = "portal/dashboard";
        $data['total_users'] = $this->db->count_all_results('products');
        $this->load->view('portal/layout', $data);
    }

    public function error404() {
        $this->load->view('404');
    }

    public function users_list() {
        $data['page_title'] = "Users List";
        $result = $this->portal_model->get_all_users();
        $data['users'] = $this->paginator->paginate($result, ['base_url' => 'portal/users']);
        $data['user_roles'] = $this->db->order_by('created_at', 'ASC')->get('user_roles')->result();
        $data['search'] = $this->input->get('name');
        $data['main_view'] = "portal/users";
        $this->load->view('portal/layout', $data);
    }

    public function add_user_save() {
        $this->form_validation->set_rules('first_name', 'First Name', 'trim|required');
        $this->form_validation->set_rules('last_name', 'Last Name', 'trim|required');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|is_unique[users.email]');
        $this->form_validation->set_rules('password', 'Email', 'trim|required|min_length[8]');
        $this->form_validation->set_rules('user_role_id', 'User Role', 'trim|required');
        if (!$this->form_validation->run()) {
            $this->session->set_flashdata('errorr_message', 'Something went wrong. Please try again!');
            $this->session->set_flashdata('add_user_error', 'Something went wrong. Please try again!');
//            redirect('users');
            $this->users_list();
        } else {
            if ($this->portal_model->add_user_save()) {
                $this->session->set_flashdata('success_message', 'User added successfully.');
                redirect('users');
            } else {
                $this->session->set_flashdata('errorr_message', 'Something went wrong. Please try again!');
                redirect('users');
            }
        }
    }

    public function edit_user_save() {
        $this->form_validation->set_rules('first_name', 'First Name', 'trim|required');
        $this->form_validation->set_rules('last_name', 'Last Name', 'trim|required');
        $this->form_validation->set_rules('email', 'Email', 'trim|required');
        $this->form_validation->set_rules('password', 'Password', 'trim|min_length[8]');
        $this->form_validation->set_rules('user_role_id', 'User Role', 'trim|required');
        if (!$this->form_validation->run()) {
            $this->session->set_flashdata('error_message', 'Something went wrong. Please try again!');
            $this->session->set_flashdata('add_user_error', 'Something went wrong. Please try again!');
            redirect('users');
//            $this->users_list();
        } else {
            if ($this->portal_model->edit_user_save()) {
                $this->session->set_flashdata('success_message', 'User Updated successfully.');
                redirect('users');
            } else {
                $this->session->set_flashdata('error_message', 'Something went wrong. Please try again!');
                redirect('users');
            }
        }
    }

    public function delete_user() {
        $this->db->where('id', $this->input->post('id'))->delete('users');
    }

    public function add_product() {
        $data['page_title'] = "Add product";
        $data['main_view'] = "portal/add_product";
        $this->load->view('portal/layout', $data);
    }

    public function edit_product($id) {
        $data['product'] = $product = $this->portal_model->get_all_products($id)->get()->row();
        $data['page_title'] = "Edit product - " . $product->product_name;
        $data['main_view'] = "portal/edit_product";
        $this->load->view('portal/layout', $data);
    }

    public function public_products_list() {
        $data['page_title'] = "Products List";
        $result = $this->portal_model->get_all_products();
        $data['products'] = $this->paginator->paginate($result, ['base_url' => 'portal/products']);
        $data['search'] = $this->input->get('name');
        $data['main_view'] = "portal/public_products";
        $this->load->view('portal/layout', $data);
    }

    public function public_products_detail($id) {

        $data['product'] = $product = $this->portal_model->get_all_products($id)->get()->row();
        $data['page_title'] = $product->product_name;
        $data['main_view'] = "portal/public_product_detail";
        $this->load->view('portal/layout', $data);
    }

    public function products_list() {
        $data['page_title'] = "Products List";
        $result = $this->portal_model->get_all_products();
        $data['products'] = $this->paginator->paginate($result, ['base_url' => 'portal/products']);
        $data['search'] = $this->input->get('name');
        $data['main_view'] = "portal/products";
        $this->load->view('portal/layout', $data);
    }

    public function add_product_save() {
        $this->form_validation->set_rules('product_name', 'Product Name', 'trim|required');
        if (!$this->form_validation->run()) {
            $this->session->set_flashdata('errorr_message', 'Product name required');
            redirect('add-product');
        } else {
            if ($this->portal_model->add_product_save()) {
                $this->session->set_flashdata('success_message', 'Product added successfully.');
                redirect('products');
            } else {
                $this->session->set_flashdata('errorr_message', 'Something went wrong. Please try again!');
                redirect('add-product');
            }
        }
    }

    public function edit_product_save($id) {
        $this->form_validation->set_rules('product_name', 'Product Name', 'trim|required');
        if (!$this->form_validation->run()) {
            $this->session->set_flashdata('errorr_message', 'Something went wrong. Please try again!');
            redirect('products');
        } else {
            if ($this->portal_model->edit_product_save($id)) {
                $this->session->set_flashdata('success_message', 'Product updated successfully.');
                redirect('products');
            } else {
                $this->session->set_flashdata('errorr_message', 'Something went wrong. Please try again!');
                redirect('products');
            }
        }
    }

    public function delete_product() {
        $this->db->where('product_id', $this->input->post('product_id'))->delete('products');
    }

    public function all_user_permissions() {
        $data['page_title'] = "User Permissions";
        $data['user_permissions'] = $this->portal_model->get_all_user_permissions();
        $data['main_view'] = "portal/user_permissions";
        $this->load->view('portal/layout', $data);
    }

    public function add_user_permission_save() {
        $this->form_validation->set_rules('user_permission_name', 'User Permission Name', 'trim|required');
        $this->form_validation->set_rules('user_permission_route', 'Route', 'trim|required');
        $this->form_validation->set_rules('user_permission_url', 'URL', 'trim|required');
        $this->form_validation->set_rules('user_permission_type', 'Type', 'trim|required');
        if (!$this->form_validation->run()) {
            $this->session->set_flashdata('errorr_message', 'Something went wrong. Please try again!');
            redirect('user-permissions');
        } else {
            if ($this->portal_model->add_user_permission_save()) {
                $this->session->set_flashdata('success_message', 'User Permission added successfully.');
                redirect('user-permissions');
            } else {
                $this->session->set_flashdata('errorr_message', 'Something went wrong. Please try again!');
                redirect('user-permissions');
            }
        }
    }

    public function edit_user_permission_save() {
        $this->form_validation->set_rules('user_permission_name', 'User Permission Name', 'trim|required');
        $this->form_validation->set_rules('user_permission_route', 'Route', 'trim|required');
        $this->form_validation->set_rules('user_permission_url', 'URL', 'trim|required');
        $this->form_validation->set_rules('user_permission_type', 'Type', 'trim|required');
        if (!$this->form_validation->run()) {
            $this->session->set_flashdata('errorr_message', 'Something went wrong. Please try again!');
            redirect('user-permissions');
        } else {
            if ($this->portal_model->edit_user_permission_save()) {
                $this->session->set_flashdata('success_message', 'User Permission updated successfully.');
                redirect('user-permissions');
            } else {
                $this->session->set_flashdata('errorr_message', 'Something went wrong. Please try again!');
                redirect('user-permissions');
            }
        }
    }

    public function delete_user_permission() {
        $this->db->where('user_permission_id', $this->input->post('user_permission_id'))->delete('user_permissions');
    }

    public function all_user_roles() {
        $data['page_title'] = "User Roles";
        $data['user_roles'] = $this->portal_model->get_all_user_roles();
        $data['main_view'] = "portal/user_roles";
        $this->load->view('portal/layout', $data);
    }

    public function add_user_role_save() {
        $this->form_validation->set_rules('user_role_name', 'User Role Name', 'trim|required');
        if (!$this->form_validation->run()) {
            $this->session->set_flashdata('errorr_message', 'Something went wrong. Please try again!');
            redirect('user-roles');
        } else {
            if ($this->portal_model->add_user_role_save()) {
                $this->session->set_flashdata('success_message', 'User Role added successfully.');
                redirect('user-roles');
            } else {
                $this->session->set_flashdata('errorr_message', 'Something went wrong. Please try again!');
                redirect('user-roles');
            }
        }
    }

    public function edit_user_role_save() {
        $this->form_validation->set_rules('user_role_name', 'User Role Name', 'trim|required');
        if (!$this->form_validation->run()) {
            $this->session->set_flashdata('errorr_message', 'Something went wrong. Please try again!');
            redirect('user-roles');
        } else {
            if ($this->portal_model->edit_user_role_save()) {
                $this->session->set_flashdata('success_message', 'User Role updated successfully.');
                redirect('user-roles');
            } else {
                $this->session->set_flashdata('errorr_message', 'Something went wrong. Please try again!');
                redirect('user-roles');
            }
        }
    }

    public function delete_user_role() {
        $this->db->where('user_role_id', $this->input->post('user_role_id'))->delete('user_roles');
    }

    public function all_user_roles_permissions($user_role_id) {
        if ($role_name = $this->portal_model->get_user_role_name_by_id($user_role_id)) {
            $data['user_role_name'] = $role_name;
        } else {
            redirect('user-roles');
        }
        $data['page_title'] = "Assign User Role's Permissions";
        $data['user_permissions'] = $this->portal_model->get_all_user_permissions();
        $data['user_role_id'] = $user_role_id;
        $data['main_view'] = "portal/user_roles_permissions";
        $this->load->view('portal/layout', $data);
    }

    public function add_user_roles_permissions_save() {
        if ($this->portal_model->add_user_roles_permissions_save()) {
            $this->session->set_flashdata('success_message', 'User Role\'s Permissions assigned successfully.');
            redirect('user-roles');
        } else {
            $this->session->set_flashdata('errorr_message', 'Something went wrong. Please try again!');
            redirect('user-roles');
        }
    }

}
