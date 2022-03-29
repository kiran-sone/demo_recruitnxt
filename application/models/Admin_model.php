<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Admin_model extends CI_Model {

    public $cdate = null;
    public $full_date = null;

    public function __construct() {
        $datestring = "%Y-%m-%d";
        $datestring1 = "%Y-%m-%d %h:%i:%s";
        $time = time();
        $this->cdate = mdate($datestring, $time);
        $this->full_date = mdate($datestring1, $time);
    }

    public function image_resize($file_name, $path, $newpath, $newWidth) {
        $img_size = getimagesize($path . $file_name);
        $newHeight = round(($newWidth / $img_size[0]) * $img_size[1]);
        $config['image_library'] = 'gd2';
        $config['source_image'] = $path . $file_name;
        $config['new_image'] = $newpath . $file_name;
        $config['maintain_ratio'] = TRUE;
        $config['width'] = $newWidth;
        $config['height'] = $newHeight;
        $this->image_lib->initialize($config);
        $this->image_lib->resize();
        
        $this->load->helper('phpass');
    }

    /* Checks User exists or not */

    public function checkUser() {
        $email = $this->input->post("email");
        $paswd = $this->input->post("password");
        if(!empty($paswd) && !empty($email))
        {
            $this->db->where('au_email', $email);
            $query = $this->db->get('users');

            if($query->num_rows())
            {
                $result = $query->result();
                $pas_hash = $result[0]->au_password;
                if(PHP_VERSION < "5.5")
                {
                    $hasher = new PasswordHash(PHPASS_HASH_STRENGTH, PHPASS_HASH_PORTABLE);
                    if($hasher->CheckPassword($paswd, $pas_hash))
                    {
                        $this->session->set_userdata('email', $result[0]->au_email);
                        $this->session->set_userdata('name', $result[0]->au_name);
                        $this->session->set_userdata('type', $result[0]->user_role);
                        return 1;
                    }
                    else
                    {
                        return 0;
                    }
                }
                else
                {
                    if(password_verify($paswd, $pas_hash))
                    {
                        $this->session->set_userdata('email', $result[0]->au_email);
                        $this->session->set_userdata('name', $result[0]->au_name);
                        $this->session->set_userdata('type', $result[0]->user_role);
                        return 1;
                    }
                    else
                    {
                        return 0;
                    }
                }
            }
            else
            {
                return 0;
            }
        }
        else
        {
            return 0;
        }
    }
    
    public function update_password($val) {
        if(!empty($val['old_pass']))
        {
            $email = $this->session->userdata("email");
            $this->db->where('au_email', $email);
            $query = $this->db->get('users');
            $true_pass = 0;

            if($query->num_rows())
            {
                $result = $query->result();
                $pas_hash = $result[0]->au_password;
                if(PHP_VERSION < "5.5")
                {
                    $hasher = new PasswordHash(PHPASS_HASH_STRENGTH, PHPASS_HASH_PORTABLE);
                    if($hasher->CheckPassword($val['old_pass'], $pas_hash))
                    {
                        $true_pass = 1;
                    }
                }
                else
                {
                    if(password_verify($val['old_pass'], $pas_hash))
                    {
                        $true_pass = 1;
                    }
                }
                if($true_pass == "1")
                {
                    $ran_str = $this->random_str_gen(12);
                    $pwd = $val['new_pass']; //User password here
                    
                    if(PHP_VERSION < "5.5")
                    {
                        //Code for PHpass hashing
                        $hasher = new PasswordHash(PHPASS_HASH_STRENGTH, PHPASS_HASH_PORTABLE);
                        $updated_hash_password = $hasher->HashPassword($pwd);
                        // echo $hash_password; exit;
                    }
                    else
                    {
                        $updated_hash_password = password_hash($pwd, PASSWORD_DEFAULT);
                    }
                    $this->db->query("UPDATE users SET au_password='" . $updated_hash_password . "' WHERE au_email='" . $this->session->userdata('email') . "'");
                    $this->session->set_flashdata('password-update', 'true');
                    return 1;
                }
                else
                {
                    return 0;
                }
            }
            else
            {
                return 0;
            }
        }
        else
        {
            return 0;
        }
    }
    
    public function gen_hash_pass($new_pa_txt)
    {
        // $ran_str = $this->random_str_gen(12);
        $pwd = $new_pa_txt; //User password here
        $hash_password = 0;
        
        if(PHP_VERSION < "5.5")
        {
            //Code for PHpass hashing
            $hasher = new PasswordHash(PHPASS_HASH_STRENGTH, PHPASS_HASH_PORTABLE);
            $hash_password = $hasher->HashPassword($pwd);
            // echo $hash_password; exit;
        }
        else
        {
            $hash_password = password_hash($pwd, PASSWORD_DEFAULT);
        }
        if(!empty($hash_password))
        {
            $data = array(
                'au_password'=>$hash_password,
            );

            $this->db->where('user_role', "Admin");
            $this->db->update('users', $data);

            return 1;
        }
        else
            return 0;
    }
    
    function random_str_gen($length, $keyspace = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ')
    {
        $pieces = array();
        $max = mb_strlen($keyspace, '8bit') - 1;
        for ($i = 0; $i < $length; ++$i) {
            $pieces []= $keyspace[mt_rand(0, $max)];
        }
        return implode('', $pieces);
    }

    /* Category Models */

    public function admin_profile() {
        $query = $this->db->query("SELECT * FROM users WHERE au_email='" . $this->session->userdata('email') . "'");
        return $query->result();
    }

    public function update_admin_profile($val) {
        $this->db->query("UPDATE users SET au_name='" . $val['fname'] . "',au_contact='" . $val['contact'] . "' WHERE au_email='" . $this->session->userdata('email') . "'");
        $this->session->set_userdata('name', $val['fname']);
    }
    
    public function get_users()
    {
        $query = $this->db->query("SELECT * FROM users");
        return $query->result();
    }
    
    public function save_user()
    {
        $check = $this->db->query("SELECT * FROM users WHERE au_email='".$_POST['email']."'");
        if($check->num_rows())
        {
            return 2;
        }
        $data = array('user_role'=>'User',
            'au_email'=>$_POST['email'],
            'au_password'=>$_POST['password'],
            'au_name'=>$_POST['fname'],
            'au_contact'=>$_POST['contact'],
            'au_date'=>$this->cdate);
        
        $this->db->insert('users', $data);
        
        if(isset($_POST['perm']))
        {
            foreach($_POST['perm'] as $pm)
            {
                $data1 = array('u_id'=>$_POST['email'],
                    'up_permission'=>$pm);
                
                $this->db->insert('user_permission', $data1);
            }
        }
        return 1;
    }
    
    public function get_user_permission($id)
    {
        $query = $this->db->query("SELECT * FROM user_permission WHERE u_id='".$id."'");
        return $query->result();
    }
    
    public function get_single_users($id)
    {
        $query = $this->db->query("SELECT * FROM users WHERE au_id='".$id."'");
        return $query->result();
    }
    
    public function update_user()
    {
        if($_POST['email']!=$_POST['pemail'])
        {
            $check = $this->db->query("SELECT * FROM users WHERE au_email='".$_POST['email']."'");
            if($check->num_rows())
            {
                return 2;
            }
        }
        $data = array(
            'au_email'=>$_POST['email'],
            'au_name'=>$_POST['fname'],
            'au_contact'=>$_POST['contact'],
            'au_date'=>$this->cdate);
        
        $this->db->where('au_id', $_POST['uid']);
        $this->db->update('users', $data);
        
        $this->db->query("DELETE FROM user_permission WHERE u_id='".$_POST['pemail']."'");
        if(isset($_POST['perm']))
        {
            foreach($_POST['perm'] as $pm)
            {
                $data1 = array('u_id'=>$_POST['email'],
                    'up_permission'=>$pm);
                
                $this->db->insert('user_permission', $data1);
            }
        }
        return 1;
    }
    
    public function update_user_password($val)
    {
        $check = $this->db->query("SELECT au_id FROM users WHERE au_id='".$val['uid']."' AND au_password='".$val['old_pass']."'");
        if($check->num_rows())
        {
            $this->db->query("UPDATE users SET au_password='".$val['new_pass']."' WHERE au_id='".$val['uid']."'");
            return 1;
        }
        return 0;
    }
    
    // ** product module 

    public function add_state() {
        $attachment = NULL;
        if (!empty($_FILES['att_img']['name'])) {
            $path = './assets/upload/state_icons/';
            $img_name = $_FILES['att_img']['name'];
            $tmp_name = $_FILES['att_img']['tmp_name'];
            if ($file_name = image_upload($path, $img_name, $tmp_name)) {
                $attachment = $file_name;
            }
        }

        $data = array(
            's_name' => $_POST['title'],
            's_img' => $attachment,
        );
        if($this->db->insert('states', $data))
            return 1;
    }

    public function get_states() {
        $query = $this->db->query("SELECT * FROM states");
        return $query->result();
    }

    public function get_state_by_id($id) {
        $this->db->where("s_id", $id);
        $query = $this->db->get('states');
        return $query->result();
    }

    public function edit_state() {
        $attachment = NULL;
        if (!empty($_FILES['att_img']['name'])) {
            $path = './assets/upload/state_icons/';
            $img_name = $_FILES['att_img']['name'];
            $tmp_name = $_FILES['att_img']['tmp_name'];
            if ($file_name = image_upload($path, $img_name, $tmp_name)) {
                $attachment = $file_name;
            }
        }

        $data = array(
            's_name' => $_POST['title'],
        );

        if(!empty($attachment))
            $data['s_img'] = $attachment;

        $this->db->where('s_id', $_POST['s_id']);
        if($this->db->update('states', $data))
            return 1;
    }
    
    public function delete_state($val){
        $this->db->where("s_id", $val['sid']);
        $query = $this->db->get("states");
        $img = $query->result();
        if(!empty($img[0]->s_img))
            unlink('./assets/upload/state_icons/' . $img[0]->s_img);
        $this->db->query("DELETE FROM states WHERE s_id='".$val['sid']."'");
    }
    
    public function save_city()
    {
        $data = array(
            's_id'=>$_POST['sid'],
            'c_name'=>$_POST['title']);
        if($this->db->insert('cities', $data))
            return 1;
    }
    
    public function get_cities()
    {
        $query = $this->db->query("SELECT * FROM cities JOIN states using (s_id)");
        return $query->result();
    }
    
    public function get_single_city($id)
    {
        $this->db->where("c_id", $id);
        $query = $this->db->get("cities");
        return $query->result();
    }
    
    public function edit_city()
    {
        $data = array(
            's_id'=>$_POST['sid'],
            'c_name'=>$_POST['title']);
        
        $this->db->where('c_id', $_POST['cid']);
        if($this->db->update('cities', $data))
            return 1;
    }
    
    public function delete_city($val)
    {
        $this->db->query("DELETE FROM cities WHERE c_id='".$val['cid']."'");
    }
    
    public function save_product()
    {
        $img = '';
        if (!empty($_FILES['img']['name'])) {
            $path = './assets/upload/product-img/';
            $img_name = $_FILES['img']['name'];
            $tmp_name = $_FILES['img']['tmp_name'];
            if ($file_name = image_upload($path, $img_name, $tmp_name)) {
                $img = $file_name;
            }
        }
        
        $data = array('pd_name'=>$_POST['title'],
            'pd_code'=>$_POST['code'],
            'pd_img'=>$img,
            'c_id'=>$_POST['cat'],
            'sc_id'=>$_POST['sub'],
            'pd_user'=>$this->session->userdata('admin'),
            'pd_date'=>$this->cdate);
        
        $this->db->insert('product', $data);
        return 1;
    }
    
    public function get_product($id,$sid=NULL)
    {
        if(empty($sid))
        {
            $query = $this->db->query("SELECT * FROM product WHERE c_id='".$id."'");
        }
        else {
            $query = $this->db->query("SELECT * FROM product WHERE c_id='".$id."' AND sc_id='".$sid."'");
        }
        return $query->result();
    }
    
    public function get_single_product($id)
    {
        $query = $this->db->query("SELECT * FROM product WHERE pd_id='".$id."'");
        return $query->result();
    }
    
    public function update_product()
    {
        $img = $_POST['cimg'];
        if (!empty($_FILES['img']['name'])) {
            $path = './assets/upload/product_large/';
            $img_name = $_FILES['img']['name'];
            $tmp_name = $_FILES['img']['tmp_name'];
            if ($file_name = image_upload($path, $img_name, $tmp_name)) {
                $img = $file_name;
            }
        }
        
        
        $data = array('pd_name'=>$_POST['title'],
            'pd_code'=>$_POST['code'],
            'pd_img'=>$img,
            'c_id'=>$_POST['cat'],
            'sc_id'=>$_POST['sub'],
            'pd_user'=>$this->session->userdata('admin'),
            'pd_date'=>$this->cdate);
        
        $this->db->where('pd_id', $_POST['pid']);
        $this->db->update('product', $data);
        return 1;
    }
    
   
    public function remove_product($val)
    {
        $this->db->query("DELETE FROM product WHERE pd_id='".$val['rid']."'");
    }
    
    // end product module **
    
    public function get_feedback()
    {
        $query = $this->db->query("SELECT * FROM customer_feedback ORDER BY cf_id DESC");
        return $query->result();
    }
    
    

    public function save_team()
    {
        $img = "";
        if (!empty($_FILES['img']['name'])) {
            $path = './assets/upload/team_img/';
            $img_name = $_FILES['img']['name'];
            $tmp_name = $_FILES['img']['tmp_name'];
            if ($file_name = image_upload($path, $img_name, $tmp_name)) {
                $img = $file_name;
            }
        }
        
        $data = array('ot_name'=>$_POST['fname'],
            'ot_desg'=>$_POST['desg'],
            'ot_email'=>$_POST['email'],
            'ot_contact'=>$_POST['contact'],
            'ot_img'=>$img);
        
        $this->db->insert('our_team', $data);
        return 1;
    }
    
    public function update_team()
    {
        $img = $_POST['cimg'];
        if (!empty($_FILES['img']['name'])) {
            $path = './assets/upload/team_img/';
            $img_name = $_FILES['img']['name'];
            $tmp_name = $_FILES['img']['tmp_name'];
            if ($file_name = image_upload($path, $img_name, $tmp_name)) {
                $img = $file_name;
            }
        }
        
        $data = array('ot_name'=>$_POST['fname'],
            'ot_desg'=>$_POST['desg'],
            'ot_email'=>$_POST['email'],
            'ot_contact'=>$_POST['contact'],
            'ot_img'=>$img);
        
        $this->db->where('ot_id', $_POST['tid']);
        $this->db->update('our_team', $data);
        return 1;
    }
    
    public function get_team()
    {
        $query = $this->db->query("SELECT * FROM our_team");
        return $query->result();
    }
    
    public function get_single_team($id)
    {
        $query = $this->db->query("SELECT * FROM our_team WHERE ot_id='".$id."'");
        return $query->result();
    }
    
    public function remove_team($val)
    {
        $this->db->query("DELETE FROM our_team WHERE ot_id='".$val['rid']."'");
    }
    
    public function get_career()
    {
        $query = $this->db->query("SELECT * FROM career ORDER BY cr_id DESC");
        return $query->result();
    }

}
