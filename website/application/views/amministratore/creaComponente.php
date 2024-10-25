<div class="container-fluid p-2">
    <h2>AGGIUNGI UN NUOVO COMPONENTE</h2>
    <div>
        <?php if (strlen($displayError) > 0): ?>
            <div class="alert alert-danger">
                <strong><?php echo $displayError; ?>
            </div>
        <?php endif ?>
        <form action="<?php echo URL ?>amministratore/creaComponente" method="post">
            <div class="form-group">
                <label>Nome:</label>
                <input type="text" name="nome" required class="form-control"/>
                <label>Prezzo:</label>
                <input type="number" name="prezzo" step="0.01" placeholder="0.00" required class="form-control"/>
                <input type="hidden" name="token" value="<?php echo $_SESSION['token'] ?? '' ?>">
                <p></p>
                <input type="submit" name="submit_login" value="Registra Componente"
                       class="btn btn-success"/>
            </div>
        </form>
    </div>

</div>