<?php 

    class Post_model extends CI_Model{
        public function __construct(){
            $this->load->database();
        }

        /*public function getAllTagsByPost(){
           
            //$query="SELECT p.idpost,p.categories_idcategory,p.users_iduser,p.title,p.slug,p.body,p.picture,p.state,GROUP_CONCAT(t.tag) as mytags FROM posts p LEFT JOIN posts_tags pt ON p.idpost=pt.posts_idpost LEFT JOIN tags t ON t.idtag=pt.tags_idtag GROUP BY p.idpost";
            $this->db->select('p.idpost,p.categories_idcategory,p.users_iduser,p.title,p.slug,p.body,p.picture,p.created_at,p.state,GROUP_CONCAT(t.tag SEPARATOR ",") as mytags');
            $this->db->from('posts p');
            $this->db->join('posts_tags pt','pt.posts_idpost=p.idpost');
            $this->db->join('tags t','t.idtag=pt.tags_idtag');
            
            $this->db->group_by('p.idpost');
            $query = $this->db->get();
            return $query->result_array();
        
            
        }*/

        public function countPosts($keyword){            
            $this->db->like('title',$keyword);
            $query=$this->db->get('posts');
            return $query->num_rows();   
        }

        public function search($keyword){
           $this->db->like('title',$keyword);
           $query=$this->db->get('posts');
           return $query->result();
        }

        public function getPosts($slug=FALSE,$limit=FALSE,$offset=FALSE){
            if($limit){
                $this->db->limit($limit,$offset);
            }
            
            if($slug===FALSE){
                $this->db->order_by('p.idpost','DESC');
                $this->db->where('p.state',1); 
                
                //$this->db->select('p.idpost,p.categories_idcategory,p.users_iduser,p.title,p.slug,p.body,p.picture,p.created_at,p.state,u.name,c.idcategory,c.category,GROUP_CONCAT(t.tag SEPARATOR ",") as mytags');
                
                $this->db->select('p.title,p.slug,p.picture,p.created_at,u.name,c.idcategory,c.category,GROUP_CONCAT(t.tag SEPARATOR ",") as mytags');
                $this->db->from('posts p');
              
                $this->db->join('categories c','c.idcategory=p.categories_idcategory');
                $this->db->join('users u','u.iduser=p.users_iduser');

                
                $this->db->join('posts_tags pt','pt.posts_titlepost=p.title');
                $this->db->join('tags t','t.idtag=pt.tags_idtag');
                $this->db->group_by('p.idpost');

                $this->db->order_by('p.idpost','DESC');
                $query=$this->db->get();
                return $query->result_array();




            }else{                 
                $this->db->select('p.idpost,p.categories_idcategory,p.users_iduser,p.title,p.slug,p.body,p.picture,p.created_at,u.name,u.avatar,c.idcategory,c.category,GROUP_CONCAT(t.tag SEPARATOR ",") as mytags');
                //$this->db->from('posts p');
                $this->db->join('categories c','c.idcategory=p.categories_idcategory');
                $this->db->join('users u','u.iduser=p.users_iduser');

                $this->db->join('posts_tags pt','pt.posts_titlepost=p.title');
                $this->db->join('tags t','t.idtag=pt.tags_idtag');
                $this->db->group_by('p.idpost');
                $query=$this->db->get_where('posts p',array('p.slug'=>$slug));
                //$query=$this->db->get_where('posts p',array('slug'=>$slug));
                return $query->row_array();
            }
        }

        public function getPostsByCategory($category_id){
            $query=$this->db->get_where('posts',array('categories_idcategory'=>$category_id));
            return $query->result_array();
        }

        


        

        public function deletePosts($id){
            $image_file_name=$this->db->select('picture')->get_where('posts',array('idpost'=>$id))->row()->picture;
            $cwd=getcwd();//save the current working directory
            $image_file_path=$cwd . "\\uploads\\";
            chdir($image_file_path);
            unlink($image_file_name);
            chdir($cwd);//Restore the previous working directory





            $this->db->where('idpost',$id);
            $this->db->delete('posts');
            return TRUE;
        }

        public function insertPosts($newpicture){
            $slug=url_title($this->input->post('title'));

            $data=array(
                'title'=>$this->input->post('title'),
                'slug'=>$slug,
                'body'=>$this->input->post('body'),
                'picture'=>$newpicture,
                'state'=>$this->input->post('state'),                
                'categories_idcategory'=>$this->input->post('categories_idcategory'),
                'users_iduser'=>$this->session->userdata('user_id')
                
            );
            return $this->db->insert('posts',$data);
        }

        public function updatePosts($newpicture){
            $slug=url_title($this->input->post('title'));
            
            $this->db->where('idpost',$this->input->post('id'));
            $data=array(
                'title'=>$this->input->post('title'),
                'slug'=>$slug,
                'body'=>$this->input->post('body'),
                'picture'=>$newpicture,
                'state'=>$this->input->post('state'),
                'categories_idcategory'=>$this->input->post('categories_idcategory')
            );
            
            return $this->db->update('posts',$data);
        }


       


        

       
    }