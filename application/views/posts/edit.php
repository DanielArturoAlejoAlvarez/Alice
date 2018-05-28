

<div class="row">
    <div class="col-md-8 offset-md-2">
        <div class="clearfix"></div>
        <h1><?= $title; ?></h1>
        <?= validation_errors(); ?>
        <?= form_open_multipart("posts/update"); ?>
        <input type="hidden" name="id" id="id" value="<?= $post["idpost"];?>">
            <div class="form-group">
                <label for="title"></label>
                <input type="text" name="title" id="title" class="form-control" value="<?= $post["title"];?>">
            </div>
            
            <div class="form-group">
                <label for="body"></label>
                <textarea name="body" id="editor1" cols="30" rows="10" class="form-control"><?= $post["body"];?></textarea>
            </div>
            <div class="form-group">
                <label for="state"></label>
                <select name="state" class="form-control">
                    <option value="1">ON</option>
                    <option value="0">OFF</option>
                </select>
            </div>
            <div class="form-group">                
                <select name="categories_idcategory" class="form-control">
                    <?php foreach ($categories as $category):?>
                        <option <?php if($category["idcategory"] == $post["categories_idcategory"]){ echo 'selected="selected"'; } ?> value="<?= $category["idcategory"];?>"><?= $category["category"];?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <!-- <div class="form-group">                
                <label for="tags">Tags</label>
                <select name="tags[]" class="form-control select2-multi" multiple="multiple">
                    <?php foreach ($tags as $tag):?>
                        <option value="<?= $tag["idtag"];?>"><?= $tag["tag"];?></option>
                    <?php endforeach; ?>
                </select>
            </div>             -->
            <div class="form-group">
                <?php if($post["picture"]!=''):?>
                    <div class="clearfix"></div> 
                    <img width="100" src="<?php echo base_url();?>uploads/posts/<?php echo $post["picture"];?>" alt="">
                    <div class="clearfix"></div> 
                <?php endif;?>
                <label for="picture">Upload Picture</label>
                <input type="file" name="picture" id="picture" class="form-control">
               
            </div>
            <input type="submit" value="UPDATE" class="btn btn-primary">
        <?= form_close(); ?>
    </div>
</div>
