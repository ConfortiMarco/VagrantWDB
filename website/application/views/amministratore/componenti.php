<h3>Benvenuto <strong><?php echo $_SESSION['nome'] . " " .$_SESSION['cognome']?></strong></h3>
<h4>Aggiungi Componente</h4>
<a class="btn btn-success" href="<?php echo URL?>amministratore/creaComponente">Crea Componente</a>
<br>
<h3>Tutti i componenti</h3>
<table class="table table-striped">
    <thead style="background-color: #ddd; font-weight: bold;">
    <tr>
        <td>#</td>
        <td>Nome</td>
        <td>Prezzo</td>
        <td>Modifica</td>
        <td>Elimina</td>
    </tr>
    </thead>
    <tbody>
    <?php $numero = 0;foreach ($componenti as $componente):?>
        <tr>
            <form action="<?php echo URL?>amministratore/modificaComponente" method="post">
                <td><strong><?php echo $numero+1?></strong></td>
                <input type="hidden" name="token" value="<?php echo $_SESSION['token'] ?? '' ?>">
                <input type="hidden" name="id" value="<?php echo $componente['id']?>">
                <td><input class="form-control" value="<?php echo $componente['nome']?>" name="nome"></td>
                <td><input class="form-control" value="<?php echo $componente['prezzo']?>" name="prezzo"</td>
                <td><button class="btn btn-warning" type="submit"><i class="fas fa-edit"></i></button></td>
                <td><a class="btn btn-danger"
                       href="<?php echo URL ?>amministratore/cancellaComponente/<?php echo $componente['id'] ?>"><i
                                class="fas fa-trash"></i></a></td>
            </form>
        </tr>
        <?php $numero++;endforeach;?>
    </tbody>
</table>