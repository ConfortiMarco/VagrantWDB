<h3>Benvenuto <strong><?php echo $_SESSION['nome'] . " " .$_SESSION['cognome']?></strong></h3>
<?php if ($_SESSION['tipo'] == "Dipendente"): ?>
    <h4>Aggiungi Ore Lavoro</h4>
    <a class="btn btn-success" href="<?php echo URL?>dipendente/creaOreLavoro">Crea Ore Lavoro</a>
<?php endif;?>
<br>
<h4>Ecco le ore di lavoro di <strong><?php echo $_SESSION['nome'] . " " .$_SESSION['cognome']?></strong></h4>
<table class="table table-striped">
    <thead style="background-color: #ddd; font-weight: bold;">
    <tr>
        <td>#</td>
        <td>Nome Apparecchio Elettronico</td>
        <td>Modello Apparecchio Elettronico</td>
        <td>Ore di lavoro</td>
        <td>Modifica</td>
        <td>Cancella</td>
    </tr>
    </thead>
    <tbody>
    <?php $numero=1;foreach ($apparecchielettronici as $apparecchioelettronico):?>
        <tr>
            <form action="<?php echo URL?>dipendente/modificaOreLavoro" method="post">
                <td><strong><?php echo $numero?></strong></td>
                <td><?php echo $apparecchioelettronico['nome'] ?></td>
                <td><?php echo  $apparecchioelettronico['modello']?></td>
                <input type="hidden" name="token" value="<?php echo $_SESSION['token'] ?? '' ?>">
                <input type="hidden" value="<?php echo $apparecchioelettronico['id']?>" name="apparecchioelettronico_id">
                <td><input class="form-control" type="number" value="<?php echo $apparecchioelettronico['pivot']['ore_lavoro']?>" name="ore_lavoro"></td>
                <td><button class="btn btn-warning" type="submit"><i class="fas fa-edit"></i></button></td>
                <td><a class="btn btn-danger" href="<?php echo URL?>dipendente/cancellaOreLavoro/<?php echo $apparecchioelettronico['id']?>"><i class="fas fa-trash"></i></a></td>
            </form>
        </tr>
    <?php $numero+=1;endforeach;?>
    </tbody>
</table>
