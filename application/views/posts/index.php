<div class="clearfix"></div>
<h1><?= $title; ?></h1>

<div class="buttons"><a title="ADD NEW POST" href="<?= base_url();?>posts/create" class="btn btn-primary btn-lg"><i class="fas fa-plus"></i></a></div>
<div class="row">
    <?php
    foreach ($posts as $post): 
        $date=Date("jS \of F Y",strtotime($post["created_at"]));        
    ?>
    <div class="col-md-4">
        <div class="clearfix"></div>
        <div class="card">
            <div class="card-body">
                <a href="<?= site_url('/posts/'.$post["slug"]);?>"><img class="card-img-top" src="<?= site_url('/uploads/posts/'.$post["picture"]);?>" alt="Card image cap"></a>
                <h3 class="card-title upper"><a href="<?= site_url('/posts/'.$post["slug"]);?>"><?= $post["title"];?></a></h3>
                <h6 class="card-subtitle mb-2 text-muted"><i class="far fa-calendar"></i>&nbsp;<?= $date;?>&nbsp;by&nbsp;<i class="far fa-user"></i>&nbsp;<span class="be-red"><?= $post["name"]; ?></span></h6>
                <!-- <p><?= word_limiter($post["body"],10)?></p> -->
                <p><strong class="badge badge-secondary"><a href="<?= site_url('/categories/'.$post["idcategory"]);?>"><i class="fas fa-heart"></i>&nbsp;<?= $post["category"]; ?></a></strong></p>
                 <!-- <span class="badge badge-success"><?php echo $post["mytags"];?></span> -->
                <!-- <?php 

                    if(null !== $files = $post["mytags"]){
                        $hashtags=explode(",",$files);
                        foreach ($hashtags as $hashtag):
                            
                            echo '<span class="badge badge-success">'.$hashtag.'</span>&nbsp';
                            
                        endforeach;
                    }
                ?> -->
                
                <a href="<?= site_url('/posts/'.$post["slug"]);?>" class="btn btn-primary"><i  title="READ MORE..." class="fas fa-play-circle"></i></a>
                

              
    

            </div>
        </div>
    </div>
    
    <?php endforeach; ?>
    
    <div class="pagination-links"><?= $this->pagination->create_links();?></div>
</div>




