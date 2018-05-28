

<div class="row">
    <div class="col-md-8 offset-md-2">
        <div class="clearfix"></div>
        <h1><?= $title; ?></h1>
        <?= validation_errors(); ?>
        <?= form_open("categories/create"); ?>
            <div class="form-group">
                <label for="category"></label>
                <input type="text" name="category" id="category" placeholder="Enter category..." class="form-control">
            </div>
            
            
            <div class="form-group">
                <label for="state"></label>
                <select name="state" class="form-control">
                    <option value="ENABLE">ENABLE</option>
                    <option value="DISABLE">DISABLE</option>
                </select>
            </div>
            
            <input type="submit" value="CREATE" class="btn btn-primary">
        <?= form_close(); ?>
    </div>
</div>