<div class="container-fluid p-2">
    <h2>REGISTER</h2>
    <div>
        <h3>Maschera di Register</h3>
        <?php if(strlen($displayError) > 0): ?>
            <div class="alert alert-danger">
                <strong><?php echo $displayError; ?>
            </div>
        <?php endif ?>
        <form action="<?php echo URL; ?>home/register" method="POST">
            <div class="form-group">
                <label>nome</label>
                <input type="text" name="nome" required class="form-control"/>
                <label>cognome</label>
                <input type="text" name="cognome" required class="form-control"/>
                <label>email</label>
                <input type="email" name="email" required class="form-control"/>
                <label>data_nascita</label>
                <input type="date" name="data_nascita" required class="form-control"/>
                <label>password</label>
                <input type="password" name="password" required class="form-control"/>
                <p></p>
                <input type="submit" name="submit_login" value="Register" class="btn btn-success" />
            </div>
        </form>

    </div>

</div>
