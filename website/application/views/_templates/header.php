<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Gestione Negozio Riparazione</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <base href="<?php echo URL ?>">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">


    <link href="application/libs/font-awesome/css/all.css" rel="stylesheet">

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

</head>
<body class="container-fluid">
<nav class="navbar navbar-default" style="background-color: <?php if (isset($_COOKIE['pageColor'])) echo $_COOKIE['pageColor']; ?>">
    <div class="container-fluid">
        <ul class="nav navbar-nav">
            <?php if (!isset($_SESSION['tipo'])): ?>
                <li><a href="<?php echo URL; ?>">LOGIN</a></li>
                <li><a href="<?php echo URL; ?>home/register">REGISTER</a></li>
            <?php elseif ($_SESSION['tipo'] == "Cliente") : ?>
                <li><a href="<?php echo URL; ?>cliente">FATTURE</a></li>
            <?php elseif ($_SESSION['tipo'] == "Dipendente" || $_SESSION['tipo'] == "Amministratore") : ?>
                <li><a href="<?php echo URL; ?>dipendente/gestisciFattura">FATTURE</a></li>
                <li><a href="<?php echo URL; ?>dipendente">APPARECCHI ELETTRONICI</a></li>
            <?php if ($_SESSION['tipo'] == "Dipendente") :?>
                <li><a href="<?php echo URL; ?>dipendente/gestisciOreLavoro">ORE LAVORO</a></li><?php endif;?>
                <li><a href="<?php echo URL; ?>dipendente/usaComponente">UTILIZZA COMPONENTI</a></li>
            <?php endif ?>
            <?php if (isset($_SESSION['tipo']) && $_SESSION['tipo'] == "Amministratore") : ?>
                <li><a href="<?php echo URL; ?>amministratore/gestisciClienti">CLIENTI</a></li>
                <li><a href="<?php echo URL; ?>amministratore/gestisciDipendenti">DIPENDENTI</a></li>
                <li><a href="<?php echo URL; ?>amministratore/gestisciComponenti">COMPONENTI</a></li>
            <?php endif ?>
        </ul>
        <ul class="nav navbar-nav navbar-right">
            <li ><a href="<?php echo URL; ?>home/logout">LOGOUT</a></li>
        </ul>
    </div>
</nav>
<div style="border-style: double; border-radius: 15px;" class="container-fluid">
