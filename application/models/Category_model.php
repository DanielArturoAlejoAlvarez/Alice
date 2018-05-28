<?php 

    class Category_model extends CI_Model{
        public function __construct(){
            $this->load->database();
        }

        public function getCategories($id=FALSE){
            if($id===FALSE){
                $this->db->order_by('category');
                $this->db->where('state','ENABLE');
                $query=$this->db->get('categories');
                return $query->result_array();
            }else{
                $query=$this->db->get_where('categories',array('idcategory'=>$id));
                return $query->row_array();
            }            
        }

       
        public function insertCategories(){
            $data=array(
                'category'=>$this->input->post('category'),
                'state'=>$this->input->post('state'),
                'users_iduser'=>$this->session->userdata('user_id')                
            );
            return $this->db->insert('categories',$data);
        }

        public function deleteCategories($id){
            $this->db->where('idcategory',$id);
            $this->db->delete('categories');            
            return TRUE;
        }

        public function updateCategories(){
            $this->db->where('idcategory',$this->input->post('id'));
            $data=array(
                'category'=>$this->input->post('category'),
                'state'=>$this->input->post('state')
            );
            return $this->db->update('categories',$data);
        }
    }