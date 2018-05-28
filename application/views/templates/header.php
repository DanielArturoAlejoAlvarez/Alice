<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ciBlog</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
    <link rel="stylesheet" href="<?= base_url();?>assets/css/main.css">
    <link rel="stylesheet" href="<?= base_url();?>assets/css/select2.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
    <script src="https://cdn.ckeditor.com/4.9.2/standard/ckeditor.js"></script>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#">MediaSoftDev</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
        <li class="nav-item active">
            <a class="nav-link" href="<?= base_url(); ?>">Home <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="<?= base_url(); ?>about">About</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="<?= base_url(); ?>posts">Blog</a>
        </li>
        
        <li class="nav-item">
            <a class="nav-link disabled" href="#">FAQ</a>
        </li>
        </ul>
        <ul class="navbar-nav">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <?php if(!$this->session->userdata('logged_in')): ?>
                        Account
                    <?php else:
                        $avatar=new User_model();
                        $superavatar=$avatar->superavatar();                       
                    ?>
                        <img class="imgUser" width="40" src="<?= site_url('/uploads/users/'.$superavatar);?>" alt="Card image cap">
                    <?php endif;?>               
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                <?php if(!$this->session->userdata('logged_in')):?>                
                    <a class="dropdown-item" href="<?php echo base_url();?>users/login">Sign In</a>
                    <a class="dropdown-item" href="<?php echo base_url();?>users/register">Sign Up</a>
                <?php else:?>
                    <a class="dropdown-item" href="#">Profile</a>
                    <a class="dropdown-item" href="<?php echo base_url();?>users/logout">Logout</a>                
                <?php endif;?>
                </div>
            </li>
        </ul>
        <form class="form-inline my-2 my-lg-0" action="<?php echo site_url('posts/search_keyword');?>" method="POST">
        <input class="form-control mr-sm-2" type="text" name="keyword" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
        </form>
        
        
    </div>
    </nav> 

    <div class="container">
        <!-- Flash Messages -->
        <?php if($this->session->flashdata('user_registered')):?>
            <?php echo '<p class="alert alert-success">'.$this->session->flashdata('user_registered').'</p>';?>
        <?php endif;?>
        <?php if($this->session->flashdata('post_created')):?>
            <?php echo '<p class="alert alert-success">'.$this->session->flashdata('post_created').'</p>';?>
        <?php endif;?>
        <?php if($this->session->flashdata('post_updated')):?>
            <?php echo '<p class="alert alert-success">'.$this->session->flashdata('post_updated').'</p>';?>
        <?php endif;?>
        <?php if($this->session->flashdata('post_deleted')):?>
            <?php echo '<p class="alert alert-success">'.$this->session->flashdata('post_deleted').'</p>';?>
        <?php endif;?>
        <?php if($this->session->flashdata('category_created')):?>
            <?php echo '<p class="alert alert-success">'.$this->session->flashdata('category_created').'</p>';?>
        <?php endif;?>
        <?php if($this->session->flashdata('category_updated')):?>
            <?php echo '<p class="alert alert-success">'.$this->session->flashdata('category_updated').'</p>';?>
        <?php endif;?>        
        <?php if($this->session->flashdata('category_deleted')):?>
            <?php echo '<p class="alert alert-success">'.$this->session->flashdata('category_deleted').'</p>';?>
        <?php endif;?>       
        <?php if($this->session->flashdata('login_failed')):?>
            <?php echo '<p class="alert alert-danger">'.$this->session->flashdata('login_failed').'</p>';?>
        <?php endif;?>
        <?php if($this->session->flashdata('user_loggedin')):?>
            <?php echo '<p class="alert alert-success">'.$this->session->flashdata('user_loggedin').'</p>';?>
        <?php endif;?>
        <?php if($this->session->flashdata('user_loggedout')):?>
            <?php echo '<p class="alert alert-success">'.$this->session->flashdata('user_loggedout').'</p>';?>
        <?php endif;?>

