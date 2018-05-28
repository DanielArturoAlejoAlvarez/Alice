<div class="clearfix"></div>
<h1><?= $title; ?></h1>
<h3>TOTAL: <?php echo $counters;?> posts</h3>
<h4>KEYWORD: <span class="be-red"><?php echo $_POST["keyword"];?></h4>
<?php if($results):?>
    <div class="row">
        <?php
        foreach ($results as $row): 
            $date=Date("jS \of F Y",strtotime($row->created_at));
        ?>
        <div class="col-md-4">
            <div class="clearfix"></div>
            <div class="card">
                <div class="card-body">
                    <a href="<?= site_url('/posts/'.$row->slug);?>"><img class="card-img-top" src="<?= site_url('/uploads/posts/'.$row->picture);?>" alt="Card image cap"></a>
                    <h3 class="card-title upper"><a href="<?= site_url('/posts/'.$row->slug);?>"><?= $row->title;?></a></h3>
                </div>
            </div>
        </div>
        
        <?php endforeach; ?>
        
        
    </div>
<?php else:?>
    <h5>No data was found about the word <span class="be-red"><?php echo $_POST["keyword"];?></span>, please try again with another word!</h5>
<?php endif;?>

