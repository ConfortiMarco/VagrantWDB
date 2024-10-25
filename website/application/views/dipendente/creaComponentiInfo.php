<h3>Aggiungi Componenti Utilizzati</h3>
<?php if(strlen($displayError) > 0): ?>
    <div class="alert alert-danger">
        <strong><?php echo $displayError; ?>
    </div>
<?php endif ?>
<form action="<?php echo URL?>dipendente/creaUsoComponente" method="post">
    <div class="form-group">
        <label>Apparecchio Elettronico:</label>
        <select class="form-control" name="apparecchio_elettronico">
            <?php foreach ($apparecchiElettronici as $apparecchioElettronico):?>
                <option value="<?php echo $apparecchioElettronico['id'] ?>"><?php echo $apparecchioElettronico['nome'] . " - " . $apparecchioElettronico['modello'] ?></option>
            <?php endforeach; ?>
        </select>
        <label>Componente:</label>
        <select class="form-control" name="componente">
            <?php foreach ($componenti as $componente):?>
                <option value="<?php echo $componente['id'] ?>"><?php echo $componente['nome'] ?></option>
            <?php endforeach; ?>
        </select>
        <label>Quantità:</label>
        <input type="number" class="form-control" name="quantita" min="1" required>
        <input type="hidden" name="token" value="<?php echo $_SESSION['token'] ?? '' ?>">
        <p></p>
        <button class="btn btn-success" type="submit">Crea Componenti Utilizzati</button>
    </div>
</form>