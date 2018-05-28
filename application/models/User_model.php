<?php 

    class User_model extends CI_Model{
        public function __construct(){
            $this->load->database();
        }

        public function getUsers($id=FALSE){
            if($id===FALSE){
                $this->db->order_by('name');
                //$this->db->where('state','ENABLE');
                $query=$this->db->get('users');
                return $query->result_array();
            }else{
                $query=$this->db->get_where('users',array('iduser'=>$id));
                return $query->row_array();
            }            
        }

        public function registerUsers($pass_encrypt,$newavatar){
            $data=array(
                'name'=>$this->input->post('name'),
                'zipcode'=>$this->input->post('zipcode'),
                'email'=>$this->input->post('email'),
                'username'=>$this->input->post('username'),
                'password'=>$pass_encrypt,
                'avatar'=>$newavatar,
                'role'=>1
            );
            return $this->db->insert('users',$data);
        }

        public function login($username,$password){
            $this->db->where('username',$username);
            $this->db->where('password',$password);

            $result=$this->db->get('users');
            if($result->num_rows()==1){
                return $result->row(0)->iduser;
            }else{
                return false;
            }
        }

        public function check_username_exists($username){
            $query=$this->db->get_where('users',array('username'=>$username));
            if(empty($query->row_array())){
                return true;
            }else{
                return false;
            }
        }

        public function check_email_exists($email){
            $query=$this->db->get_where('users',array('email'=>$email));
            if(empty($query->row_array())){
                return true;
            }else{
                return false;
            }
        }


       
        public function superavatar(){
            
            $id=$this->session->userdata('user_id');
            $this->db->where('iduser',$id);
            
            $result=$this->db->get('users');
            if($result->num_rows()==1){
                return $result->row(0)->avatar;
            }else{
                return false;
            }
        }

        public function adminUser(){
            $id=$this->session->userdata('user_id');
            $this->db->where('iduser',$id);
            
            $result=$this->db->get('users');
            if($result->num_rows()==1){
                return $result->row(0)->role;
            }else{
                return false;
            }
            
        }


        

        

        
    }