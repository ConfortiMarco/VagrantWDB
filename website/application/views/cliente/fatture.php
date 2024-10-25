<h3>Benvenuto <strong><?php echo $_SESSION['nome'] . " " .$_SESSION['cognome']?></strong></h3>
<h4>Tutte le fatture</h4>
<table class="table table-striped">
    <thead style="background-color: #ddd; font-weight: bold;">
    <tr>
        <td>#</td>
        <td>Nome Apparecchio Elettronico</td>
        <td>Modello Apparecchio Elettronico</td>
        <td>Ore di lavoro</td>
        <td>Componenti Utilizzati</td>
        <td>Prezzo</td>
    </tr>
    </thead>
    <tbody>
    <?php $numero=1;foreach ($fattureInfo as $fatturaInfo):?>
        <tr>
            <td><strong><?php echo $numero?></strong></td>
            <td><?php echo $fatturaInfo['fatturaAppareccchioElettronico']['nome']?></td>
            <td><?php echo $fatturaInfo['fatturaAppareccchioElettronico']['modello']?></td>
            <td><?php echo $fatturaInfo['numeroOreLavoro']?></td>
            <td><?php if($fatturaInfo['componenti'] == ""){echo "Nessuno";}else{echo $fatturaInfo['componenti'];}?></td>
            <td><?php echo $fatturaInfo['costoTotale']?></td>
        </tr>
        <?php $numero+=1;endforeach;?>
    </tbody>
</table>
