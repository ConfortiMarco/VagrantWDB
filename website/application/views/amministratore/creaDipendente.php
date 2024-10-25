<div class="container-fluid p-2">
    <h2>AGGIUNGI UN NUOVO DIPENDENTE</h2>
    <div>
        <?php if (strlen($displayError) > 0): ?>
            <div class="alert alert-danger">
                <strong><?php echo $displayError; ?>
            </div>
        <?php endif ?>
        <form action="<?php echo URL; ?>amministratore/creaDipendente" method="POST">
            <div class="form-group">
                <label>Nome</label>
                <input type="text" name="nome" required class="form-control"/>
                <label>Cognome</label>
                <input type="text" name="cognome" required class="form-control"/>
                <label>Email</label>
                <input type="email" name="email" required class="form-control"/>
                <label>Data Nascita</label>
                <input type="date" name="data_nascita" required class="form-control"/>
                <label>Salario Orario</label>
                <input type="number" name="salario_orario" step="0.01" placeholder="0.00" required class="form-control"/>
                <label>password</label>
                <input type="password" name="password" required class="form-control"/>
                <input type="hidden" name="token" value="<?php echo $_SESSION['token'] ?? '' ?>">
                <p></p>
                <input type="submit" name="submit_login" value="Registra Dipendente"
                       class="btn btn-success"/>
            </div>
        </form>
    </div>

</div>