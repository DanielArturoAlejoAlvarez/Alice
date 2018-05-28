<div class="clearfix"></div>


<div class="row">
    <?php
    
        $date=Date("l jS \of F Y h:i:s A",strtotime($category["created_at"]));
    ?>
    <div class="col-md-8 offset-md-2">
        <div class="clearfix"></div>
        <div class="card">
            <div class="card-body">
                
                <h3 class="card-title upper"><?= $category["category"];?></h3>
                <h6 class="card-subtitle mb-2 text-muted"><i class="far fa-calendar"></i>&nbsp;<?= $date;?>&nbsp;<i class="far fa-clock"></i></h6>
                
                <div class="clearfix"></div>
                <div class="buttons-actions">
                    <a  title="BACK PAGE..." href="<?= base_url();?>categories" class="btn btn-primary mr-2"><i class="fas fa-chevron-circle-left"></i></a>
                    <?php if($this->session->userdata('user_id') == $category["users_iduser"]):?>
                        <a  title="EDIT CATEGORY" href="<?= base_url();?>categories/edit/<?= $category["idcategory"];?>" class="btn btn-warning mr-2"><i class="fas fa-pencil-alt"></i></a>
                        <?= form_open('categories/delete/'.$category["idcategory"]);?>
                            <button  title="REMOVE CATEGORY" class="btn btn-danger" name='delete_btn' type='submit' value='button-value'><i class='fa fa-trash-alt'></i></button>
                    
                        <?= form_close();?>
                    <?php endif;?>                  

                    
                </div>
                
            </div>
        </div>
        
    </div>

    
</div>
<hr>
<h4>Posts by Category <span class="be-red"><?php echo $category["category"];?></span></h4>
 <div class="row">
        
        <?php foreach ($posts as $pbc):?>
        <div class="col-md-3">
            <div class="clearfix"></div>
            <div class="card">
                <div class="card-body">
                <h4><a href="<?php echo base_url();?>posts/<?php echo $pbc["slug"];?>"><?php echo $pbc["title"];?><img width="50" src="<?php echo base_url(); ?>uploads/posts/<?php echo $pbc["picture"]; ?>" alt=""></a></h4>
                
                </div>
            </div>
        </div>
        <?php endforeach;?>
    
</div>