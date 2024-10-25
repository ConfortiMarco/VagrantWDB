<h4>Aggiungi ore di lavoro di <strong><?php echo $_SESSION['nome'] . " " .$_SESSION['cognome']?></strong></h4>
<form action="<?php echo URL?>dipendente/gestisciOreLavoro" method="post">
    <div class="form-group">
        <label>Apparecchio Elettronico:</label>
        <select class="form-control" name="apparecchio_elettronico">
            <?php foreach ($apparecchielettroniciFinale as $apparecchioelettronico):?>
                <option value="<?php echo $apparecchioelettronico['id'] ?>"><?php echo $apparecchioelettronico['nome'] . " - " . $apparecchioelettronico['modello'] ?></option>
            <?php endforeach; ?>
        </select>
        <label>Ore di lavoro:</label>
        <input type="number" class="form-control" name="ore_lavoro">
        <input type="hidden" name="token" value="<?php echo $_SESSION['token'] ?? '' ?>">
        <p></p>
        <button class="btn btn-success " type="submit">Crea Orario Lavoro</button>
    </div>
</form>