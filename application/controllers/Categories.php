<?php 

    class Categories extends CI_Controller{

        public function index(){
            $data["title"]="Latest Category";
            $data["categories"]=$this->Category_model->getCategories();
            $this->load->view('templates/header.php');
            $this->load->view('categories/index',$data);
            $this->load->view('templates/footer.php');
        }

        public function create(){
            if(!$this->session->userdata('logged_in')){
                redirect('users/login');
            }
            $data["title"]="Create Category";
            $this->form_validation->set_rules('category','Category','required');
            $this->form_validation->set_rules('state','State','required');

            if($this->form_validation->run()===FALSE){
                $this->load->view('templates/header.php');
                $this->load->view('categories/new',$data);
                $this->load->view('templates/footer.php');
            }else{
                $this->Category_model->insertCategories();
                $this->session->set_flashdata('category_created','Your category has been created');
                redirect('categories');
            }
        }

        public function show($id=NULL){
            $data["category"]=$this->Category_model->getCategories($id);            
            $category_id=$data["category"]["idcategory"];
            $data["posts"]=$this->Post_model->getPostsByCategory($category_id);
            
            
            if(empty($data["category"])){
                show_404();
            }else{
                $data["title"]="Edit Category";
                $this->load->view("templates/header.php");
                $this->load->view("categories/show",$data);
                $this->load->view("templates/footer.php");
            }
        }

        public function edit($id){
            if(!$this->session->userdata('logged_in')){
                redirect('users/login');
            }
            $data["category"]=$this->Category_model->getCategories($id);
            if(empty($data["category"])){
                show_404();
            }else{
                $data["title"]="Edit Category";
                $this->load->view('templates/header.php');
                $this->load->view('categories/edit',$data);
                $this->load->view('templates/footer.php');
            }
        }

        public function delete($id){
            if(!$this->session->userdata('logged_in')){
                redirect('users/login');
            }
            $this->Category_model->deleteCategories($id);
            $this->session->set_flashdata('category_deleted','Your category has been deleted');
            redirect('categories');
        }

        public function update(){
            if(!$this->session->userdata('logged_in')){
                redirect('users/login');
            }
            $this->Category_model->updateCategories();
            $this->session->set_flashdata('category_created','Your category has been updated');
            redirect('categories');
        }

    }