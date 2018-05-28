

<div class="row">
    <div class="col-md-8 offset-md-2">
        <div class="clearfix"></div>
        <h1><?= $title; ?>&nbsp;<?= $tag["tag"];?></h1>
        <?= validation_errors(); ?>
        <?= form_open("tags/update"); ?>
            <input type="hidden" name="id" id="id" value="<?= $tag["idtag"];?>">
            <div class="form-group">
                <label for="tag"></label>
                <input type="text" name="tag" id="tag" class="form-control" value="<?= $tag["tag"]?>">
            </div>
            
            
            <div class="form-group">
                <label for="state"></label>
                <select name="state" class="form-control">
                    <option value="ENABLE">ENABLE</option>
                    <option value="DISABLE">DISABLE</option>
                </select>
            </div>
            
            <input type="submit" value="UPDATE" class="btn btn-primary">
        <?= form_close(); ?>
    </div>
</div>