<?php 

    class Users extends CI_Controller{
        public function index(){
            
        }

        public function register(){
            $data["title"]="Sign Up";
            $this->form_validation->set_rules('name','Name','required');
            $this->form_validation->set_rules('zipcode','Zip Code','required');
            $this->form_validation->set_rules('email','Email','required|callback_check_email_exists');
            $this->form_validation->set_rules('username','Username','required|callback_check_username_exists');
            $this->form_validation->set_rules('password','Password','required');
            $this->form_validation->set_rules('password2','Confirm Password','matches[password]');

            if($this->form_validation->run()===FALSE){
                $this->load->view('templates/header.php');
                $this->load->view('users/register',$data);
                $this->load->view('templates/footer.php');
            }else{
                //die('Continue');
                //UPLOAD AVATAR
                $config['upload_path']          = './uploads/users/';
                $config['allowed_types']        = 'gif|jpg|jpeg|png';
                $config['max_size']             = 1500;
                $config['max_width']            = 5500;
                $config['max_height']           = 5500;
                

                $this->load->library('upload',$config);
                if(!$this->upload->do_upload('avatar')){
                    $errors=array('error'=>$this->upload->display_errors());
                    $newavatar="nouser.jpg";
                }else{
                    $data=array('upload_data'=>$this->upload->data());
                    $newavatar=$_FILES['avatar']['name'];
                }
                
                $pass_encrypt=md5($this->input->post('password'));
                $this->User_model->registerUsers($pass_encrypt,$newavatar);

                $this->session->set_flashdata('user_registered','You are now registered and can log in');
                redirect('posts');
            }
        }

        public function login(){
            $data["title"]="Sign In";
            $this->form_validation->set_rules('username','Username','required');
            $this->form_validation->set_rules('password','Password','required');
            
            if($this->form_validation->run()===FALSE){
                $this->load->view('templates/header.php');
                $this->load->view('users/login',$data);
                $this->load->view('templates/footer.php');
            }else{
                
                $username=$this->input->post('username');
                $password=md5($this->input->post('password'));

                $user_id=$this->User_model->login($username,$password);
                
                
                

                if($user_id){
                    //Create session
                    //die('Success!');
                    //Set message
                    $user_data=array(
                        'user_id'=>$user_id,
                        'username'=>$username,                        
                        'logged_in'=>true
                    );
                    $this->session->set_userdata($user_data);

                    $this->session->set_flashdata('user_loggedin','Your are now logged in!');
                    redirect('posts');
                }else{
                    $this->session->set_flashdata('login_failed','Login is invalid!');
                    redirect('users/login');
                } 
            }
        }

        public function logout(){
            $this->session->unset_userdata('logged_in');
            $this->session->unset_userdata('user_id');
            $this->session->unset_userdata('username');

            $this->session->set_flashdata('user_loggedout','Your are now logged out!');
            redirect('users/login');
        }

        public function check_username_exists($username){
            $this->form_validation->set_message('check_username_exists','That username is taken. Please choose in a different one!');
            if($this->User_model->check_username_exists($username)){
                return true;
            }else{
                return false;
            }
        }

        public function check_email_exists($email){
            $this->form_validation->set_message('check_email_exists','That email is taken. Please choose in a different one!');
            if($this->User_model->check_email_exists($email)){
                return true;
            }else{
                return false;
            }
        }
        
    }