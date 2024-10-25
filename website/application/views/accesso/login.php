<div class="container-fluid p-2">
    <h2>LOGIN</h2>
    <div>
        <h3>Maschera di Login</h3>
        <form action="<?php echo URL; ?>" method="POST">
            <div class="form-group">
                <label>email</label>
                <input type="email" name="email" required class="form-control"/>
                <label>password</label>
                <input type="password" name="password" required class="form-control"/>
                <p></p>
                <input type="hidden" name="token" value="<?php echo $_SESSION['token'] ?? '' ?>">
                <input type="submit" name="submit_login" value="Login" class="btn btn-default" />
            </div>
        </form>
        <?php if(strlen($displayError) > 0): ?>
            <div class="alert alert-danger">
                <strong><?php echo $displayError; ?>
            </div>
        <?php endif ?>
    </div>

</div>
