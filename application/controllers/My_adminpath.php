<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class My_adminpath extends CI_Controller {

    public function index() {
        $this->check_sess();
        $this->load->model('admin_model');
        if(isset($_POST['fname']))
        {
            $this->admin_model->update_admin_profile($_POST);
        }
	    $data['profile'] = $this->admin_model->admin_profile();
        $this->load->view('admin/dashboard', $data);
    }
    
    public function page_map($pr, $sc, $par = NULL) {
        $this->$pr($sc, $par);
    }
    
    public function check_sess()
    {
        $ses_u_type = $this->session->userdata('type');
        $user_roles = array("admin", "manager", "operator");
        // $this->session->userdata('admin');
        if (!in_array($ses_u_type, $user_roles) && !$this->session->userdata('email'))
        {
            redirect(base_url().'my_adminpath/login');
            exit;
        }
    }

    public function login() {
        $this->load->model('admin_model');
        $ses_u_type = $this->session->userdata('type');
        $user_roles = array("admin", "manager", "operator");
        // $this->session->userdata('admin');
        if (in_array($ses_u_type, $user_roles) && $this->session->userdata('email'))
        {
            redirect(base_url().'my_adminpath');
            exit;
        }

        $data['msg'] = '';
        if (isset($_POST['login'])) {
            $isUser = $this->admin_model->checkUser();
            if ($isUser != 0) {
                redirect(base_url().'my_adminpath');
                exit;
            } else {
                $data['msg'] = 'Invalid Credentials';
            }
        }
        $this->load->view('admin/login',$data);
    }

    public function states() {
        $this->check_sess();
        $data['msg'] = 0;
        $this->load->model('admin_model');
        if(isset($_POST['title']))
        {
            $data['msg'] = $this->admin_model->add_state();
        }
        $data['sts'] = $this->admin_model->get_states();
        $data['ses_u_type'] = $this->session->userdata('type');
        $this->load->view('admin/states', $data);
    }
    
    public function edit_state($id) {
        $this->check_sess();
        $ses_u_type = $this->session->userdata('type');
        if($ses_u_type == 'operator')
        {
            redirect(base_url().'my_adminpath/states');
            exit;
        }
        $data['msg'] = 0;
        $this->load->model('admin_model');
        if(isset($_POST['title']))
        {
            $data['msg'] = $this->admin_model->edit_state();
        }
	    $data['st'] = $this->admin_model->get_state_by_id($id);
        $this->load->view('admin/edit_state', $data);
    }
    
    public function cities() {
        $this->check_sess();
        $data['msg'] = 0;
        $this->load->model('admin_model');
        if(isset($_POST['title']))
        {
            $data['msg'] = $this->admin_model->save_city();
        }
	    $data['states'] = $this->admin_model->get_states();
        $data['cities'] = $this->admin_model->get_cities();
        $data['ses_u_type'] = $this->session->userdata('type');
        $this->load->view('admin/cities', $data);
    }
    
    public function edit_city($id)
    {
        $this->check_sess();
        $ses_u_type = $this->session->userdata('type');
        if($ses_u_type == 'operator')
        {
            redirect(base_url().'my_adminpath/cities');
            exit;
        }
        $data['msg'] = 0;
        $this->load->model('admin_model');
        if(isset($_POST['title']))
        {
            $data['msg'] = $this->admin_model->edit_city();
        }
	    $data['city'] = $this->admin_model->get_single_city($id);
	    $data['states'] = $this->admin_model->get_states();
        // echo "<pre>"; print_r($data); exit;
        $this->load->view('admin/edit_city', $data); 
    }
    
    public function get_subCategory()
    {
        $this->load->model('admin_model');
        $cid = $_POST['cid'];
        $data['sub'] = $this->admin_model->get_subCategory($cid);
        $this->load->view('admin/load-sub-category', $data);
    }
    
    public function logout()
    {
        $this->session->unset_userdata('admin');
        $this->session->unset_userdata('name');
        $this->session->unset_userdata('type');
        $this->session->sess_destroy();
        redirect(base_url().'my_adminpath/login');
        exit;
    }
    
    public function ajax_page() {
        $this->check_sess();
        $this->load->model('admin_model');
        $page = $this->input->post("page");
        echo $this->admin_model->$page($_POST);
    }

}
