<div class="container-fluid p-2">
    <h2>AGGIUNGI UN NUOVO APPARECCHIO ELETTRONICO</h2>
    <div>
        <?php if(strlen($displayError) > 0): ?>
            <div class="alert alert-danger">
                <strong><?php echo $displayError; ?>
            </div>
        <?php endif ?>
        <form action="<?php echo URL; ?>dipendente/creaApparecchioElettronico" method="POST">
            <div class="form-group">
                <label>Nome:</label>
                <input type="text" name="nome" required class="form-control"/>
                <label>Modello:</label>
                <input type="text" name="modello" required class="form-control"/>
                <label>Data Produzione:</label>
                <input type="date" name="data_produzione" required class="form-control"/>
                <label>Data Acquisto:</label>
                <input type="date" name="data_acquisto" required class="form-control"/>
                <label>Prezzo:</label>
                <input type="number" name="prezzo" step="0.01" placeholder="0.00" required class="form-control"/>
                <label>Categoria: </label>
                <select class="form-control" name="categoria" >
                    <?php foreach ($categorie as $categoria):?>
                        <option value="<?php echo $categoria["id"]?>"><?php echo $categoria['nome']?></option>
                    <?php endforeach;?>
                </select>
                <input type="hidden" name="token" value="<?php echo $_SESSION['token'] ?? '' ?>">
                <p></p>
                <input type="submit" name="submit_login" value="Registra Apparecchio Elettronico" class="btn btn-success" />
            </div>
        </form>

    </div>

</div>
