<h3>Benvenuto <strong><?php echo $_SESSION['nome'] . " " . $_SESSION['cognome'] ?></strong></h3>
<h4>Aggiungi Apparecchio Elettronico</h4>
<a class="btn btn-success" href="<?php echo URL ?>dipendente/creaApparecchioElettronico">Crea Apparecchio
    Elettronico</a>
<br>
<h4>Ecco la lista degli apparecchi elettronici</h4>
<?php if (strlen($displayError) > 0): ?>
    <div class="alert alert-danger">
        <strong><?php echo $displayError; ?>
    </div>
<?php endif ?>
<table class="table table-striped">
    <thead style="background-color: #ddd; font-weight: bold;">
    <tr>
        <td>#</td>
        <td>Nome</td>
        <td>Modello</td>
        <td>Data Produzione</td>
        <td>Data Acquisto</td>
        <td>Prezzo in CHF</td>
        <td>Categoria</td>
        <td>Modifica</td>
        <td>Elimina</td>
    </tr>
    </thead>
    <tbody>
    <?php $numero = 0;
    foreach ($apparecchielettronici as $elemento): ?>
        <tr>
            <form method="post" action="<?php echo URL ?>dipendente/modificaApparecchioElettronico">
                <td><strong><?php echo $numero + 1 ?></strong></td>
                <td><input class="form-control" value="<?php echo $elemento['nome'] ?>" name="nome" type="text"></td>
                <input type="hidden" name="token" value="<?php echo $_SESSION['token'] ?? '' ?>">
                <input type="hidden" name="id" value="<?php echo $elemento['id'] ?>">
                <td><input class="form-control" value="<?php echo $elemento['modello'] ?>" name="modello" type="text">
                </td>
                <td><input class="form-control" value="<?php echo $elemento['data_produzione'] ?>"
                           name="data_produzione" type="date"></td>
                <td><input class="form-control" value="<?php echo $elemento['data_acquisto'] ?>" name="data_acquisto"
                           type="date"></td>
                <td><input class="form-control" value="<?php echo $elemento['prezzo'] ?>" step="0.01" placeholder="0.00"
                           required name="prezzo" type="number"></td>
                <td>
                    <select class="form-control" name="categoria">
                        <option value="<?php echo $categorie[$numero]['id'] ?>"><?php echo $categorie[$numero]['nome'] ?></option>
                        <?php foreach ($allCat as $categoria): ?>
                            <?php if ($categoria['id'] != $categorie[$numero]['id']): ?>
                                <option value="<?php echo $categoria["id"] ?>"><?php echo $categoria['nome'] ?></option>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </select>
                </td>
                <td>
                    <button class="btn btn-warning" type="submit"><i class="fas fa-edit"></i></button>
                </td>
                <td><a class="btn btn-danger"
                       href="<?php echo URL ?>dipendente/cancellaApparecchioElettronico/<?php echo $elemento['id'] ?>"><i
                                class="fas fa-trash"></i></a></td>
            </form>
        </tr>
        <?php $numero = $numero + 1; endforeach; ?>
    </tbody>
</table>

