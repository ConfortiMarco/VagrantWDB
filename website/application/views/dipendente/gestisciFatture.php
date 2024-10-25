<h3>Benvenuto <strong><?php echo $_SESSION['nome'] . " " .$_SESSION['cognome']?></strong></h3>
<h4>Aggiungi fatture</h4>
<a class="btn btn-success" href="<?php echo URL?>dipendente/creaFattura">Crea Fattura</a>
<br>
<h4>Tutte le fatture</h4>
<table class="table table-striped">
    <thead style="background-color: #ddd; font-weight: bold;">
    <tr>
        <td>#</td>
        <td>Nome Cliente</td>
        <td>Cognome Cliente</td>
        <td>Email Cliente</td>
        <td>Nome Apparecchio Elettronico</td>
        <td>Modello Apparecchio Elettronico</td>
        <td>Ore di lavoro</td>
        <td>Componenti Utilizzati</td>
        <td>Prezzo</td>
        <td>Cancella</td>
    </tr>
    </thead>
    <tbody>
    <?php $numero=1;foreach ($fattureInfo as $fatturaInfo):?>
        <tr>
            <form action="<?php echo URL?>dipendente/modificaOreLavoro" method="post">
                <td><strong><?php echo $numero?></strong></td>
                <td><?php echo $fatturaInfo['fatturaUtente']['nome'] ?></td>
                <td><?php echo $fatturaInfo['fatturaUtente']['cognome'] ?></td>
                <td><?php echo $fatturaInfo['fatturaUtente']['email'] ?></td>
                <td><?php echo  $fatturaInfo['fatturaAppareccchioElettronico']['nome']?></td>
                <td><?php echo  $fatturaInfo['fatturaAppareccchioElettronico']['modello']?></td>
                <td><?php echo  $fatturaInfo['numeroOreLavoro']?></td>
                <td><?php echo  $fatturaInfo['componenti']?></td>
                <td><?php echo  $fatturaInfo['costoTotale']?></td>
                <td><a class="btn btn-danger" href="<?php echo URL?>dipendente/cancellaFattura/<?php echo $fatturaInfo['id']?>"><i class="fas fa-trash"></i></a></td>
            </form>
        </tr>
    <?php $numero+=1;endforeach;?>
    </tbody>
</table>
