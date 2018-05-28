<div class="clearfix"></div>
<h1><?= $title; ?></h1>
<div class="buttons"><a href="<?= base_url();?>categories/create" class="btn btn-primary">ADD CATEGORY</a></div>
<div class="row">
    <?php
    foreach ($categories as $category): 
        $date=Date("l jS \of F Y h:i:s A",strtotime($category["created_at"]));
    ?>
    <div class="col-md-4">
        <div class="clearfix"></div>
        <div class="card">
            <div class="card-body">
                <h3 class="card-title upper"><?= $category["category"];?></h3>
                <h6 class="card-subtitle mb-2 text-muted"><?= $date;?></h6>
                
                <a href="<?= site_url('/categories/'.$category["idcategory"]);?>" class="btn btn-primary"><i  title="READ MORE..." class="fas fa-play-circle"></i></a>
               
            </div>
        </div>
    </div>
    <?php endforeach; ?>
</div>