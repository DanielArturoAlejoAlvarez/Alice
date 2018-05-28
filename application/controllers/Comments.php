<?php 

    class Comments extends CI_Controller{
       
        public function create($post_id){
            if(!$this->session->userdata('logged_in')){
                redirect('users/login');
            }
            $slug=$this->input->post('slug');
            $data["post"]=$this->Post_model->getPosts($slug);
            //$this->form_validation->set_rules('name','Name','required');
            //$this->form_validation->set_rules('email','Email','required');
            $this->form_validation->set_rules('body','Body','required');

            if($this->form_validation->run()===FALSE){
                $this->load->view('templates/header.php');
                $this->load->view('posts/show',$data);
                $this->load->view('templates/footer.php');
            }else{
                $this->Comment_model->insertComments($post_id);
                redirect('posts/'.$slug);
            }
        }
    }