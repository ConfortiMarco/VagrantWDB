<?php

// carico il file di configurazione
require 'application/config/config.php';

require 'vendor/autoload.php';

new Database();

// carico le classi dell'applicazione
require 'application/libs/application.php';

// faccio partire l'applicazione
$app = new Application();
