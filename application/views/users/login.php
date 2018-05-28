<div class="row">
    <div class="col-md-6 offset-md-3">
        <div class="clearfix"></div>
        <h1 class="text-center"><?php echo $title;?></h1>            

        <?php echo validation_errors();?>

        <?= form_open_multipart("users/login"); ?>
            
        <input type="hidden" name="iduser" id="iduser">
            <div class="form-group">
                <label for="username"></label>
                <input type="text" name="username" id="username" placeholder="Enter username..." class="form-control" required autofocus>
            </div>
            <div class="form-group">
                <label for="password"></label>
                <input type="password" name="password" id="password" placeholder="Enter password..." class="form-control">
            </div>
            
            <input type="submit" value="LOGIN" class="btn btn-primary btn-block">
        <?= form_close(); ?>
    </div>
</div>



