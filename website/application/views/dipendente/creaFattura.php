<h3>Aggiungi Fatture</h3>
<form action="<?php echo URL?>dipendente/gestisciFattura" method="post">
    <div class="form-group">
        <label>Apparecchio Elettronico:</label>
        <select class="form-control" name="apparecchio_elettronico">
            <?php foreach ($apparecchiElettroniciDisponibili as $apparecchioelettronico):?>
                <option value="<?php echo $apparecchioelettronico['id'] ?>"><?php echo $apparecchioelettronico['nome'] . ', ' . $apparecchioelettronico['modello']?></option>
            <?php endforeach; ?>
        </select>
        <label>Utente:</label>
        <select class="form-control" name="utente_id">
            <?php foreach ($utenti as $utente):?>
                <option value="<?php echo $utente['id'] ?>"><?php echo $utente['nome'] . ', ' . $utente['cognome'] . ', ' . $utente['email']?></option>
            <?php endforeach; ?>
        </select>
        <input type="hidden" name="token" value="<?php echo $_SESSION['token'] ?? '' ?>">
        <p></p>
        <button class="btn btn-success " type="submit">Crea Fattura</button>
    </div>
</form>