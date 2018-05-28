<div class="row">
    <div class="col-md-6 offset-md-3">
        <div class="clearfix"></div>
        <h1 class="text-center"><?php echo $title;?></h1>            

        <?php echo validation_errors();?>

        <?= form_open_multipart("users/register"); ?>
            
            <div class="form-group">
                <label for="name"></label>
                <input type="text" name="name" id="name" placeholder="Enter name..." class="form-control" autofocus>
            </div>
            <div class="form-group">
                <label for="zipcode"></label>
                <input type="text" name="zipcode" id="zipcode" placeholder="Enter zipcode..." class="form-control">
            </div>
            <div class="form-group">
                <label for="email"></label>
                <input type="email" name="email" id="email" placeholder="Enter email..." class="form-control">
            </div>
            <div class="form-group">
                <label for="username"></label>
                <input type="text" name="username" id="username" placeholder="Enter username..." class="form-control">
            </div>
            <div class="form-group">
                <label for="password"></label>
                <input type="password" name="password" id="password" placeholder="Enter password..." class="form-control">
            </div>
            <div class="form-group">
                <label for="password2"></label>
                <input type="password" name="password2" id="password2" placeholder="Confirm password..." class="form-control">
            </div>
            <div class="form-group">
                <label for="avatar">Upload Avatar</label>
                <input type="file" name="avatar" id="avatar" class="form-control">
            </div>
            <input type="submit" value="REGISTER" class="btn btn-primary btn-block">
        <?= form_close(); ?>
    </div>
</div>




