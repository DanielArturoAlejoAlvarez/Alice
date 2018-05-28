<?php 

    class Tags extends CI_Controller{

        public function index(){
            $data["title"]="Latest Tag";
            $data["tags"]=$this->Tag_model->getTags();
            $this->load->view('templates/header.php');
            $this->load->view('tags/index',$data);
            $this->load->view('templates/footer.php');
        }

        public function create(){
            if(!$this->session->userdata('logged_in')){
                redirect('users/login');
            }
            $data["title"]="Create tag";
            $this->form_validation->set_rules('tag','Tag','required');
            $this->form_validation->set_rules('state','State','required');

            if($this->form_validation->run()===FALSE){
                $this->load->view('templates/header.php');
                $this->load->view('tags/new',$data);
                $this->load->view('templates/footer.php');
            }else{
                $this->Tag_model->insertTags();
                $this->session->set_flashdata('tag_created','Your tag has been created');
                redirect('tags');
            }
        }

        public function show($id=NULL){
            $data["tag"]=$this->Tag_model->getTags($id);            
            //$tag_id=$data["ctag"]["idtag"];
            //$data["posts"]=$this->Post_model->getPostsByTag($tag_id);
            
            
            if(empty($data["tag"])){
                show_404();
            }else{
                $data["title"]="Edit Tag";
                $this->load->view("templates/header.php");
                $this->load->view("tags/show",$data);
                $this->load->view("templates/footer.php");
            }
        }

        public function edit($id){
            if(!$this->session->userdata('logged_in')){
                redirect('users/login');
            }
            $data["tag"]=$this->Tag_model->getTags($id);
            if(empty($data["tag"])){
                show_404();
            }else{
                $data["title"]="Edit Tag";
                $this->load->view('templates/header.php');
                $this->load->view('tags/edit',$data);
                $this->load->view('templates/footer.php');
            }
        }

        public function delete($id){
            if(!$this->session->userdata('logged_in')){
                redirect('users/login');
            }
            $this->Tag_model->deleteTags($id);
            $this->session->set_flashdata('tag_deleted','Your tag has been deleted');
            redirect('tags');
        }

        public function update(){
            if(!$this->session->userdata('logged_in')){
                redirect('users/login');
            }
            $this->Tag_model->updateTags();
            $this->session->set_flashdata('tag_created','Your tag has been updated');
            redirect('tags');
        }

    }