

<div class="row">
    <div class="col-md-8 offset-md-2">
        <div class="clearfix"></div>
        <h1><?= $title; ?></h1>
        <?= validation_errors(); ?>
        <?= form_open_multipart("posts/create"); ?>
            
            <div class="form-group">
                <label for="title"></label>
                <input type="text" name="title" id="title" placeholder="Enter title..." class="form-control">
            </div>
            
            <div class="form-group">
                <label for="body"></label>
                <textarea name="body" id="editor1" cols="30" rows="10" placeholder="Enter Content..." class="form-control"></textarea>
            </div>
            <div class="form-group">
                <label for="state">State</label>
                <select name="state" class="form-control">
                    <option value="1">ON</option>
                    <option value="0">OFF</option>
                </select>
            </div>
            <div class="form-group"> 
                <label for="tags">Category</label>               
                <select name="categories_idcategory" class="form-control">
                    <?php foreach ($categories as $category):?>
                        <option value="<?= $category["idcategory"];?>"><?= $category["category"];?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">                
                <label for="tags">Tags</label>
                <select name="tags[]" class="form-control select2-multi" multiple="multiple">
                    <?php foreach ($tags as $tag):?>
                        <option value="<?= $tag["idtag"];?>"><?= $tag["tag"];?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <label for="picture">Upload Picture</label>
                <input type="file" name="picture" id="picture" class="form-control">
            </div>
            <input type="submit" value="CREATE" class="btn btn-primary">
        <?= form_close(); ?>
    </div>
</div>


