<?php 

    class Tag_model extends CI_Model{
        public function __construct(){
            $this->load->database();
        }

        

        public function getTags($id=FALSE){
            if($id===FALSE){
                $this->db->order_by('tag');
                $this->db->where('state','ENABLE');
                $query=$this->db->get('tags');
                return $query->result_array();
            }else{
                $query=$this->db->get_where('tags',array('idtag'=>$id));
                return $query->row_array();
            }           
        }

       
        public function insertTags(){
            $slug=url_title($this->input->post('tag'));
            $data=array(
                'tag'=>$this->input->post('tag'),
                'slug'=>strtolower($slug),
                'state'=>$this->input->post('state'),
                'users_iduser'=>$this->session->userdata('user_id')                
            );
            return $this->db->insert('tags',$data);
        }

        public function deleteTags($id){
            $this->db->where('idtag',$id);
            $this->db->delete('tags');            
            return TRUE;
        }

        public function updateTags(){
            $slug=url_title($this->input->post('tag'));
            $this->db->where('idtag',$this->input->post('id'));
            $data=array(
                'tag'=>$this->input->post('tag'),
                'slug'=>strtolower($slug),
                'state'=>$this->input->post('state')
            );
            return $this->db->update('tags',$data);
        }
    }