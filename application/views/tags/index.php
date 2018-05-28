<div class="clearfix"></div>
<h1><?= $title; ?></h1>
<div class="buttons"><a href="<?= base_url();?>tags/create" class="btn btn-primary">ADD TAG</a></div>
<div class="row">
    <?php
    foreach ($tags as $tag): 
        $date=Date("l jS \of F Y h:i:s A",strtotime($tag["created_at"]));
    ?>
    <div class="col-md-4">
        <div class="clearfix"></div>
        <div class="card">
            <div class="card-body">
                <h3 class="card-title upper"><?= $tag["tag"];?></h3>
                <h6 class="card-subtitle mb-2 text-muted"><?= $date;?></h6>
                
                <a href="<?= site_url('/tags/'.$tag["idtag"]);?>" class="btn btn-primary"><i  title="READ MORE..." class="fas fa-play-circle"></i></a>
               
            </div>
        </div>
    </div>
    <?php endforeach; ?>
</div>