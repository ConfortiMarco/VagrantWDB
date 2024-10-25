<h3>Benvenuto <strong><?php echo $_SESSION['nome'] . " " .$_SESSION['cognome']?></strong></h3>

<h3>Tutti gli utenti</h3>
<table class="table table-striped">
    <thead style="background-color: #ddd; font-weight: bold;">
    <tr>
        <td>Nome</td>
        <td>Cognome</td>
        <td>Data Nascita</td>
        <td>Email</td>
        <td>Password</td>
        <td>Tipo</td>
    </tr>
    </thead>
    <tbody>
    <?php $numero = 0;foreach ($utenti as $utente):?>
        <tr>
            <td><?php echo $utente['nome']?></td>
            <td><?php echo $utente['cognome']?></td>
            <td><?php echo $utente['data_nascita']?></td>
            <td><?php echo $utente['email']?></td>
            <td><?php echo $utente['password']?></td>
            <td><?php echo $utente['tipo']?></td>
        </tr>
    <?php $numero++;endforeach;?>
    </tbody>
</table>