<h3>Benvenuto <strong><?php echo $_SESSION['nome'] . " " . $_SESSION['cognome'] ?></strong></h3>
<?php if ($_SESSION['tipo'] == "Dipendente"): ?>
    <h4>Aggiungi Componenti</h4>
    <a class="btn btn-success" href="<?php echo URL ?>dipendente/creaUsoComponente">Aggiungi Componenti Utilizzati</a>
<?php endif; ?>
<br>
<h2>Componenti Utlizzati</h2>
<table class="table table-striped">
    <thead style="background-color: #ddd; font-weight: bold;">
    <tr>
        <td>#</td>
        <td>Nome Componente</td>
        <td>Prezzo Componente</td>
        <td>Nome Apparecchio Elettronico</td>
        <td>Modello Apparecchio Elettronico</td>
        <td>Quantità</td>
        <td>Modifica</td>
        <td>Cancella</td>
    </tr>
    </thead>
    <tbody>
    <?php $numero = 1;
    foreach ($tutto as $apparecchioelettronico): ?>

        <tr>
            <form method="post" action="<?php echo URL ?>dipendente/modificaUsoComponente">
                <td><strong><?php echo $numero ?></strong></td>
                <input type="hidden" name="token" value="<?php echo $_SESSION['token'] ?? '' ?>">
                <input type="hidden" value="<?php echo $apparecchioelettronico['Componente']['id'] ?>"
                       name="idComponente">
                <input type="hidden" value="<?php echo $apparecchioelettronico['ApparecchiElettronici']['id'] ?>"
                       name="idApparecchioElettronico">
                <td><input class="form-control" value="<?php echo $apparecchioelettronico['Componente']['nome'] ?>"
                           readonly></td>
                <td><input class="form-control"
                           value="<?php echo "CHF " . $apparecchioelettronico['Componente']['prezzo'] ?>" readonly></td>
                <td><input class="form-control"
                           value="<?php echo $apparecchioelettronico['ApparecchiElettronici']['nome'] ?>" readonly></td>
                <td><input type="text" class="form-control"
                           value="<?php echo $apparecchioelettronico['ApparecchiElettronici']['modello'] ?>" readonly>
                </td>
                <td><input type="number" class="form-control" name="quantita"
                           value="<?php echo $apparecchioelettronico['ApparecchiElettronici']['pivot']['quantita'] ?>">
                </td>
                <td>
                    <button class="btn btn-warning" type="submit"><i class="fas fa-edit"></i></button>
                </td>
                <td><a class="btn btn-danger"
                       href="<?php echo URL ?>dipendente/cancellaUsoComponente/<?php echo $apparecchioelettronico['ApparecchiElettronici']['id'] . "/" . $apparecchioelettronico['Componente']['id'] ?>"><i
                                class="fas fa-trash"></i></a></td>
            </form>
        </tr>

        <?php $numero += 1;endforeach; ?>
    </tbody>
</table>