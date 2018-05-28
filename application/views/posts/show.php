<div class="clearfix"></div>


<div class="row">
    <?php
    
        $date=Date("l jS \of F Y",strtotime($post["created_at"]));
        $time=Date("h:i:s A",strtotime($post["created_at"]));

        $avatar=new User_model();
        $superavatar=$avatar->superavatar();
    ?>
    <div class="col-md-8 offset-md-2">
        <div class="clearfix"></div>
        
        <div class="card">
            <div class="card-body">
                <img class="card-img-top" src="<?= site_url('/uploads/posts/'.$post["picture"]);?>" alt="Card image cap">
               <div class="clearfix"></div>
                <h3 class="card-title upper"><a href=""><?= $post["title"];?></a></h3>
                
                <h6 class="card-subtitle mb-2 text-muted"><i class="far fa-calendar"></i>&nbsp;<?= $date;?>&nbsp;<i class="far fa-clock"></i>&nbsp;<?= $time;?>&nbsp;by&nbsp;
                    <img width="24" src="<?php echo site_url('uploads/users/'.$post["avatar"]);?>">
                    <span class="be-red"><?= $post["name"];?></span> 
                </h6>
                
                
                <p class="parraph"><?= $post["body"];?></p>
                <h5 class="card-subtitle mb-2 text-muted upper"><strong>CATEGORY:</strong>&nbsp;<span class="badge badge-secondary"><a href="<?= site_url('/categories/'.$post["idcategory"]);?>"><i class="fas fa-heart"></i>&nbsp;<?= $post["category"];?></a></span></h5>
                

                <!-- <span class="badge badge-success"><?php echo $post["mytags"];?></span> -->
                
                <h5 class="card-subtitle mb-2 text-muted upper">
                <?php 
                    echo '<strong>TAGS:</strong>&nbsp;';
                    if(null !== $files = $post["mytags"]){
                        $hashtags=explode(",",$files);
                        foreach ($hashtags as $hashtag):
                            
                            echo '<span class="badge badge-success"><i class="fas fa-tag"></i>&nbsp;'.$hashtag.'</span>&nbsp';
                            
                        endforeach;
                    }
                ?>
                </h5>



                
                <div class="clearfix"></div>

                
                <div class="buttons-actions">
                    <a  title="BACK PAGE..." href="<?= base_url();?>posts" class="btn btn-primary mr-2"><i class="fas fa-chevron-circle-left"></i></a>
                    
                    <?php if($this->session->userdata('user_id') == $post["users_iduser"]):?>
                        <a  title="EDIT POST" href="<?= base_url();?>posts/edit/<?= $post["slug"];?>" class="btn btn-warning mr-2"><i class="fas fa-pencil-alt"></i></a>
                        
                        
                        <?php 
                            $role=new User_model();
                            $admin_user=$role->adminUser();
                            //var_dump($admin_user);
                            if($admin_user!='3'):

                                //echo "Sorry but you do not have Administrator's permission.";

                            else:
                        ?>
                        
                        <?= form_open('posts/delete/'.$post["idpost"]);?>
                            <button  title="REMOVE POST" class="btn btn-danger" name='delete_btn' type='submit' value='button-value'><i class='fa fa-trash-alt'></i></button>
                                
                        <?= form_close();?>
                        <?php endif;?>
                    <?php endif;?>
                </div>
                
            </div>
        </div>
        <hr>
        <h3>COMMENTS</h3>
        <div class="all-comments col-md-10 offset-md-1">
            <div class="card">
                <div class="card-body">
                    <?php foreach($comments as $comment):?>                    
                        <div class="row">                        
                            <div class="col-md-4">
                                <img class="imgUser" src="<?php echo site_url('uploads/users/'.$comment["avatar"]);?>">
                            </div>
                            <div class="col-md-8">                                
                                <h4><?php echo $comment["name"];?></h4>
                                <h5><i class="far fa-envelope"></i>&nbsp;<?php echo $comment["email"];?></h5>
                                <p><i class="far fa-heart"></i>&nbsp;<?php echo $comment["body"];?></p>
                            </div>
                        </div>                    
                        <hr>
                    <?php endforeach;?>
                </div>
            </div>
        </div>
        <hr>

        <?php if($this->session->userdata('logged_in')):?>
            <div class="yourComment" style="display: block;">
                <h3>ADD COMMENT</h3>
                <?php echo validation_errors();?>
                <?php echo form_open('comments/create/'.$post["idpost"]); ?>
                
                    <input type="hidden" name="slug" id="slug" value="<?= $post["slug"];?>">
                
                    <div class="form-group">
                        <label for="body"></label>
                        <textarea name="body" id="body" cols="30" rows="10" placeholder="Enter comment..." class="form-control"></textarea>
                    </div>
                    <input type="submit" value="REPLY" class="btn btn-primary">

                <?php echo form_close(); ?>
            </div>
        <?php else:?>
        <p class="msg-comment">You want to participate in the comments I invite you to register?<a href="<?php echo site_url('users/login');?>">Log in</a></p>
        <?php endif;?>
    </div>

    
</div>