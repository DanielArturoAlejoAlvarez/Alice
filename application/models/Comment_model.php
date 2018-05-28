<?php 

    class Comment_model extends CI_Model{
        public function __construct(){
            $this->load->database();
        }

        public function getComments($post_id){ 
            $this->db->join('users','comments.users_iduser=users.iduser');
            $query=$this->db->get_where('comments',array('posts_idpost'=>$post_id));
            return $query->result_array();
        }

        public function insertComments($post_id){
            $user_id=$this->session->userdata('user_id');
            
            $data=array(
                'posts_idpost'=>$post_id,
                //'name'=>$this->input->post('name'),
                'users_iduser'=>$user_id,

                //'email'=>$this->input->post('email'),
                'body'=>$this->input->post('body')
            );
            return $this->db->insert('comments',$data);
        }
    }

