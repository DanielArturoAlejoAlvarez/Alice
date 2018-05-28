<?php

    class Posts extends CI_Controller{

        public function search_keyword(){
            $data["title"]="Search Post";

            $keyword=$this->input->post('keyword');
            $data['results']=$this->Post_model->search($keyword);

            $data["counters"]=$this->Post_model->countPosts($keyword);
            
            $this->load->view("templates/header.php");
            $this->load->view("posts/search",$data);
            $this->load->view("templates/footer.php");
        }


        public function index($offset=0){
            //PAGINATION///////////////////////////////////////////////////
            $this->load->library('pagination');
            $config['base_url'] = base_url().'posts/index/';
            $config['total_rows'] = $this->db->count_all('posts');
            $config['per_page'] = 3;
            $config['uri_segment'] = 3;
            $config['attributes']=array('class'=>'pagination-link');
            $this->pagination->initialize($config); 
            ///////////////////////////////////////////////////////////////
            
            $data["title"]="Latest Post";
            
            $data["posts"]=$this->Post_model->getPosts(FALSE, $config['per_page'], $offset);
            
            
            $this->load->view("templates/header.php");
            $this->load->view("posts/index",$data);
            $this->load->view("templates/footer.php");
        }

        
        public function show($slug=NULL,$id=NULL){
            $data["post"]=$this->Post_model->getPosts($slug);

            //Comments
            $post_id=$data["post"]["idpost"];

            $data["comments"]=$this->Comment_model->getComments($post_id);

            if(empty($data["post"])){
                show_404();
            }else{
                $data["title"]=$data["post"]["title"];
                $this->load->view("templates/header.php");
                $this->load->view("posts/show",$data);
                $this->load->view("templates/footer.php");
            }
        }

        


        public function create(){
            if(!$this->session->userdata('logged_in')){
                redirect('users/login');
            }
            $data["title"]="Create Post";
            $data["categories"]=$this->Category_model->getCategories();
            $data["tags"]=$this->Tag_model->getTags();
            $this->form_validation->set_rules('title','Title','required');
            $this->form_validation->set_rules('body','Body','required');
            $this->form_validation->set_rules('state','State','required');

            if($this->form_validation->run()===FALSE){
                $this->load->view("templates/header.php");
                $this->load->view("posts/new",$data);
                $this->load->view("templates/footer.php");
            }else{
                //UPLOAD PICTURE
                $config['upload_path']          = './uploads/posts/';
                $config['allowed_types']        = 'gif|jpg|jpeg|png';
                $config['max_size']             = 1500;
                $config['max_width']            = 5500;
                $config['max_height']           = 5500;
                

                $this->load->library('upload',$config);
                if(!$this->upload->do_upload('picture')){
                    $errors=array('error'=>$this->upload->display_errors());
                    $newpicture="noimage.jpg";
                }else{
                    $data=array('upload_data'=>$this->upload->data());
                    $newpicture=$_FILES['picture']['name'];
                }

                

                $this->Post_model->insertPosts($newpicture);
                //TAGS//////////////////////////////////////////////////////////////////////////////
                $tags=$this->input->post('tags');
                $post_title=$this->input->post('title');

                for ($i=0; $i < count($tags); $i++) {
                    $data= array(
                        'posts_titlepost'=>$post_title,
                        'tags_idtag'=>$tags[$i],
                    );
                    $this->db->insert('posts_tags',$data);
                }
                ////////////////////////////////////////////////////////////////////////////////
                $this->session->set_flashdata('post_created','Your post has been created');

                redirect('posts');
            }
        }

        public function delete($id){
            if(!$this->session->userdata('logged_in')){
                redirect('users/login');
            }
            $this->Post_model->deletePosts($id);
            $this->session->set_flashdata('post_deleted','Your post has been deleted');
            redirect('posts');
        }

        public function edit($slug=NULL){
            if(!$this->session->userdata('logged_in')){
                redirect('users/login');
            }
            if(!$this->session->userdata('logged_in')){
                redirect('users/login');
            }
            $data["post"]=$this->Post_model->getPosts($slug);
            //Only can edited by author
            if($this->session->userdata('user_id') != $this->Post_model->getPosts($slug)["users_iduser"]){
                redirect('posts');
            }

            $data["categories"]=$this->Category_model->getCategories();
            $data["tags"]=$this->Tag_model->getTags();
            


            if(empty($data["post"])){
                show_404();
            }else{
                $data["title"]="Edit Post";
                $this->load->view("templates/header.php");
                $this->load->view("posts/edit",$data);
                $this->load->view("templates/footer.php");
            }
        }

        public function update(){
            if(!$this->session->userdata('logged_in')){
                redirect('users/login');
            }
            //UPLOAD PICTURE
            $config['upload_path']          = './uploads/posts/';
            $config['allowed_types']        = 'gif|jpg|jpeg|png';
            $config['max_size']             = 1500;
            $config['max_width']            = 5500;
            $config['max_height']           = 5500;

            $this->load->library('upload',$config);
            if(!$this->upload->do_upload('picture')){
                $errors=array('error'=>$this->upload->display_errors());
                $newpicture="noimage.jpg";
            }else{
                $data=array('upload_data'=>$this->upload->data());
                $newpicture=$_FILES['picture']['name'];
            }
            $this->Post_model->updatePosts($newpicture);
             //TAGS//////////////////////////////////////////////////////////////////////////////
             
            
            $tags=$this->input->post('tags');
            $post_title=$this->input->post('title');
            

            

            /*for ($i=0; $i < count($tags); $i++) {
                $data= array(
                    'posts_titlepost'=>$post_title,
                    'tags_idtag'=>$tags[$i],
                );
                
                
				$this->db->insert('posts_tags', $data);
                
                
            }*/

            
           
                
               
			
                
            

             ////////////////////////////////////////////////////////////////////////////////

            $this->session->set_flashdata('post_updated','Your post has been updated');

            redirect('posts');
        }

    }