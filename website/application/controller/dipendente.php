<?php

class dipendente
{

    public function index()
    {
        $displayError = "";
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        if (!isset($_SESSION['tipo'])) {
            header("Location:" . URL);
        } elseif ($_SESSION['tipo'] == "Cliente") {
            header("Location:" . URL . "cliente");
        }

        $apparecchielettronici = ApparecchioElettronico::all()->toArray();

        $categorie = [];

        foreach ($apparecchielettronici as $apparecchioelettronico) {
            $num = $apparecchioelettronico['categoria_id'];
            $arr = Categoria::find($num)->toArray();
            $categorie[] = $arr;
        }

        $allCat = Categoria::all()->toArray();

        require 'application/views/_templates/header.php';
        require 'application/views/dipendente/index.php';
        require 'application/views/_templates/footer.php';
    }

    public function creaApparecchioElettronico()
    {
        $displayError = "";
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        if (!isset($_SESSION['tipo'])) {
            header("Location:" . URL);
        } elseif ($_SESSION['tipo'] == "Cliente") {
            header("Location:" . URL . "cliente");
        }
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (Security::isValidToken($_POST['token'])) {
                $nome = "";
                $modello = "";
                $data_produzione = "";
                $data_acquisto = "";
                $prezzo = "";
                $categoria = "";

                if (isset($_POST['nome'])) {
                    $nome = Security::filterField($_POST['nome']);
                } else {
                    $displayError .= "<br>Nome mancante";
                }

                if (isset($_POST['modello'])) {
                    $modello = Security::filterField($_POST['modello']);
                } else {
                    $displayError .= "<br>Modello mancante";
                }

                if (isset($_POST['categoria'])) {
                    $categoria = Security::filterField($_POST['categoria']);
                    if (!is_int(intval($categoria))) {
                        $displayError .= "<br>Categoria Errata";
                    }
                } else {
                    $displayError .= "<br>Categoria mancante";
                }

                if (isset($_POST['prezzo'])) {
                    $prezzo = Security::filterField($_POST['prezzo']);
                    if (!is_double(doubleval($prezzo))) {
                        $displayError .= "<br>Prezzo Errato";
                    }
                    if ($prezzo <= 0) {
                        $displayError .= "<br>Prezzo deve essere maggiore di 0";
                    }
                } else {
                    $displayError .= "<br>Prezzo mancante";
                }

                if (isset($_POST['data_produzione'])) {
                    if (Security::isRealDate($_POST['data_produzione'])) {
                        $data_produzione = Security::filterField($_POST['data_produzione']);
                    } else {
                        $displayError .= "<br>Data Produzione non valida";
                    }
                } else {
                    $displayError .= "<br>Data Produzione mancante";
                }

                if (isset($_POST['data_acquisto'])) {
                    if (Security::isRealDate($_POST['data_acquisto'])) {
                        $data_acquisto = Security::filterField($_POST['data_acquisto']);
                    } else {
                        $displayError .= "<br>Data Acquisto non valida";
                    }
                } else {
                    $displayError .= "<br>Data Acquisto mancante";
                }

                if (strlen($displayError) == 0) {
                    $apparecchioElettronico = new ApparecchioElettronico();
                    $apparecchioElettronico->nome = $nome;
                    $apparecchioElettronico->modello = $modello;
                    $apparecchioElettronico->data_produzione = $data_produzione;
                    $apparecchioElettronico->data_acquisto = $data_acquisto;
                    $apparecchioElettronico->prezzo = $prezzo;
                    $apparecchioElettronico->categoria_id = $categoria;
                    $apparecchioElettronico->save();
                    header("location: " . URL . "dipendente");
                } else {
                    require 'application/views/_templates/header.php';
                    require 'application/views/dipendente/creaApparecchioElettronico.php';
                    require 'application/views/_templates/footer.php';
                }
            }
        } else {
            require 'application/models/Categoria.php';
            $categorie = Categoria::all()->toArray();

            require 'application/views/_templates/header.php';
            require 'application/views/dipendente/creaApparecchioElettronico.php';
            require 'application/views/_templates/footer.php';
        }
    }

    public function modificaApparecchioElettronico()
    {
        $displayError = "";
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        if (!isset($_SESSION['tipo'])) {
            header("Location:" . URL);
        } elseif ($_SESSION['tipo'] == "Cliente") {
            header("Location:" . URL . "cliente");
        }
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (Security::isValidToken($_POST['token'])) {
                $nome = "";
                $modello = "";
                $data_produzione = "";
                $data_acquisto = "";
                $prezzo = "";
                $categoria = "";

                if (isset($_POST['nome'])) {
                    $nome = Security::filterField($_POST['nome']);
                } else {
                    $displayError .= "<br>Nome mancante";
                }

                if (isset($_POST['modello'])) {
                    $modello = Security::filterField($_POST['modello']);
                } else {
                    $displayError .= "<br>Modello mancante";
                }

                if (isset($_POST['categoria'])) {
                    $categoria = Security::filterField($_POST['categoria']);
                    if (!is_int(intval($categoria))) {
                        $displayError .= "<br>Categoria Errata";
                    }
                } else {
                    $displayError .= "<br>Categoria mancante";
                }

                if (isset($_POST['prezzo'])) {
                    $prezzo = Security::filterField($_POST['prezzo']);
                    if (!is_double(doubleval($prezzo))) {
                        $displayError .= "<br>Prezzo Errato";
                    }
                    if ($prezzo <= 0) {
                        $displayError .= "<br>Prezzo deve essere maggiore di 0";
                    }
                } else {
                    $displayError .= "<br>Prezzo mancante";
                }

                if (isset($_POST['data_produzione'])) {
                    if (Security::isRealDate($_POST['data_produzione'])) {
                        $data_produzione = Security::filterField($_POST['data_produzione']);
                    } else {
                        $displayError .= "<br>Data Produzione non valida";
                    }
                } else {
                    $displayError .= "<br>Data Produzione mancante";
                }

                if (isset($_POST['data_acquisto'])) {
                    if (Security::isRealDate($_POST['data_acquisto'])) {
                        $data_acquisto = Security::filterField($_POST['data_acquisto']);
                    } else {
                        $displayError .= "<br>Data Acquisto non valida";
                    }
                } else {
                    $displayError .= "<br>Data Acquisto mancante";
                }

                if (strlen($displayError) == 0) {
                    ApparecchioElettronico::where("id", "LIKE", $_POST['id'])->update(['nome' => $nome, 'modello' => $modello, 'data_produzione' => $data_produzione, 'data_acquisto' => $data_acquisto, 'prezzo' => $prezzo, 'categoria_id' => $categoria]);
                    header("location: " . URL . "dipendente");
                } else {
                    $apparecchielettronici = ApparecchioElettronico::all()->toArray();

                    $categorie = [];

                    foreach ($apparecchielettronici as $apparecchioelettronico) {
                        $num = $apparecchioelettronico['categoria_id'];
                        $arr = Categoria::find($num)->get()->toArray();
                        $categorie[] = $arr;
                    }

                    $allCat = Categoria::all()->toArray();

                    require 'application/views/_templates/header.php';
                    require 'application/views/dipendente/index.php';
                    require 'application/views/_templates/footer.php';
                }
            } else {
                header("location: " . URL . "dipendente");
            }
        } else {
            header("location: " . URL . "dipendente");
        }

    }

    public function cancellaApparecchioElettronico($id)
    {
        $displayError = "";
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        if (!isset($_SESSION['tipo'])) {
            header("Location:" . URL);
        } elseif ($_SESSION['tipo'] == "Cliente") {
            header("Location:" . URL . "cliente");
        }

        $del = ApparecchioElettronico::destroy($id);
        header("location: " . URL . "dipendente");
    }

    public function creaOreLavoro()
    {
        $displayError = "";
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        if (!isset($_SESSION['tipo'])) {
            header("Location:" . URL);
        } elseif ($_SESSION['tipo'] == "Cliente") {
            header("Location:" . URL . "cliente");
        }
        $id_utente = $_SESSION['id_utente'];
        $apparecchielettronici = Utente::find($id_utente)->apparecchielettronici()->get()->toArray();

        $apparecchielettronicitutti = ApparecchioElettronico::all()->toArray();


        $apparecchielettroniciNonDisponibili = array();
        foreach ($apparecchielettronici as $apparecchielettronico) {
            $apparecchielettroniciNonDisponibili[] = $apparecchielettronico['pivot']['apparecchioelettronico_id'];
        }

        $apparecchielettroniciFinale = array();
        foreach ($apparecchielettronicitutti as $apparecchielettronicitutto) {
            if (!in_array($apparecchielettronicitutto['id'], $apparecchielettroniciNonDisponibili)) {
                $apparecchielettroniciFinale[] = $apparecchielettronicitutto;
            }
        }

        require 'application/views/_templates/header.php';
        require 'application/views/dipendente/creaOreLavoro.php';
        require 'application/views/_templates/footer.php';
    }

    public function gestisciOreLavoro()
    {
        $displayError = "";
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        if (!isset($_SESSION['tipo'])) {
            header("Location:" . URL);
        } elseif ($_SESSION['tipo'] == "Cliente") {
            header("Location:" . URL . "cliente");
        }
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (Security::isValidToken($_POST['token'])) {
                $apparecchioelettronico = "";
                $orelavoro = "";

                if (isset($_POST['apparecchio_elettronico'])) {
                    $apparecchioelettronico = Security::filterField($_POST['apparecchio_elettronico']);
                    if (!is_double(doubleval($apparecchioelettronico))) {
                        $displayError .= "<br>App. Elettronico Errato";
                    }
                } else {
                    $displayError .= "<br>App. Elettronico mancante";
                }

                if (isset($_POST['ore_lavoro'])) {
                    $orelavoro = Security::filterField($_POST['ore_lavoro']);
                    if (!is_double(doubleval($orelavoro))) {
                        $displayError .= "<br>Ore Lavoro Errato";
                    }
                    if ($orelavoro <= 0) {
                        $displayError .= "<br>Ore Lavoro deve essre > 0";
                    }
                } else {
                    $displayError .= "<br>Ore Lavoro mancante";
                }

                Utente::find($_SESSION['id_utente'])->apparecchielettronici()->attach($apparecchioelettronico, array('ore_lavoro' => $orelavoro));
                header("location: " . URL . "dipendente/gestisciOreLavoro");
            }
        } else {
            $id_utente = $_SESSION['id_utente'];
            $apparecchielettronici = Utente::find($id_utente)->apparecchielettronici()->get()->toArray();

            $apparecchielettronicitutti = ApparecchioElettronico::all()->toArray();


            $apparecchielettroniciNonDisponibili = array();
            foreach ($apparecchielettronici as $apparecchielettronico) {
                $apparecchielettroniciNonDisponibili[] = $apparecchielettronico['pivot']['apparecchioelettronico_id'];
            }

            $apparecchielettroniciFinale = array();
            foreach ($apparecchielettronicitutti as $apparecchielettronicitutto) {
                if (!in_array($apparecchielettronicitutto['id'], $apparecchielettroniciNonDisponibili)) {
                    $apparecchielettroniciFinale[] = $apparecchielettronicitutto;
                }
            }

            require 'application/views/_templates/header.php';
            require 'application/views/dipendente/oreLavoro.php';
            require 'application/views/_templates/footer.php';
        }
    }

    public function modificaOreLavoro()
    {
        $displayError = "";
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        if (!isset($_SESSION['tipo'])) {
            header("Location:" . URL);
        } elseif ($_SESSION['tipo'] == "Cliente") {
            header("Location:" . URL . "cliente");
        }
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (Security::isValidToken($_POST['token'])) {
                $apparecchioelettronico_id = $_POST['apparecchioelettronico_id'];

                $ore_lavoro = Security::filterField($_POST['ore_lavoro']);
                if ($ore_lavoro >= 0) {
                    $apps = Utente::find($_SESSION['id_utente'])->apparecchielettronici()->updateExistingPivot($apparecchioelettronico_id, array('ore_lavoro' => $ore_lavoro));
                } else {
                    $displayError .= "<br>Ore Lavoro deve essere > 0";
                }


                header("location: " . URL . "dipendente/gestisciOreLavoro");
            }
        } else {
            header("location: " . URL . "dipendente/gestisciOreLavoro");
        }
    }

    public function cancellaOreLavoro($id)
    {
        $displayError = "";
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        if (!isset($_SESSION['tipo'])) {
            header("Location:" . URL);
        } elseif ($_SESSION['tipo'] == "Cliente") {
            header("Location:" . URL . "cliente");
        }

        $del = Utente::find($_SESSION['id_utente'])->apparecchielettronici()->detach(intval($id));
        header("location: " . URL . "dipendente/gestisciOreLavoro");
    }

    public function creaUsoComponente()
    {
        $displayError = "";
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        if (!isset($_SESSION['tipo'])) {
            header("Location:" . URL);
        } elseif ($_SESSION['tipo'] == "Cliente") {
            header("Location:" . URL . "cliente");
        }
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (Security::isValidToken($_POST['token'])) {
                $apparecchioelettronico = "";
                $componente = "";
                $quantita = "";

                if (isset($_POST['apparecchio_elettronico'])) {
                    $apparecchioelettronico = Security::filterField($_POST['apparecchio_elettronico']);
                    if (!is_double(doubleval($apparecchioelettronico))) {
                        $displayError .= "<br>App. Elettronico Errato";
                    }
                } else {
                    $displayError .= "<br>App. Elettronico mancante";
                }

                if (isset($_POST['componente'])) {

                    $componente = Security::filterField($_POST['componente']);
                    if (!is_double(doubleval($componente))) {
                        $displayError .= "<br>App. Elettronico Errato";
                    }
                } else {
                    $displayError .= "<br>App. Elettronico mancante";
                }

                if (isset($_POST['quantita'])) {
                    $quantita = Security::filterField($_POST['quantita']);
                    if (!is_double(doubleval($quantita))) {
                        $displayError .= "<br>Quantita Errato";
                    }
                    if ($quantita <= 0) {
                        $displayError .= "<br>Quantita deve essere > 0";
                    }
                } else {
                    $displayError .= "<br>Quantita mancante";
                }
                try {
                    ApparecchioElettronico::find($apparecchioelettronico)->componenti()->attach($componente, array('quantita' => $quantita));
                } catch (Exception $e) {
                    $displayError .= "<br>Combinazione già inserita";
                }
                if (strlen($displayError) > 0) {
                    $componenti = Componente::all()->toArray();

                    $apparecchiElettronici = ApparecchioElettronico::all()->toArray();

                    require 'application/views/_templates/header.php';
                    require 'application/views/dipendente/creaComponentiInfo.php';
                    require 'application/views/_templates/footer.php';
                } else {
                    header("location: " . URL . "dipendente/usaComponente");
                }
            }
        } else {
            $componenti = Componente::all()->toArray();

            $apparecchiElettronici = ApparecchioElettronico::all()->toArray();


            require 'application/views/_templates/header.php';
            require 'application/views/dipendente/creaComponentiInfo.php';
            require 'application/views/_templates/footer.php';
        }

    }

    public function cancellaUsoComponente($idApparecchioElettronico, $idComponente)
    {
        $displayError = "";
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        if (!isset($_SESSION['tipo'])) {
            header("Location:" . URL);
        } elseif ($_SESSION['tipo'] == "Cliente") {
            header("Location:" . URL . "cliente");
        }

        $del = ApparecchioElettronico::find($idApparecchioElettronico)->componenti()->detach($idComponente);

        header("location: " . URL . "dipendente/usaComponente");
    }

    public function usaComponente()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        if (!isset($_SESSION['tipo'])) {
            header("Location:" . URL);
        } elseif ($_SESSION['tipo'] == "Cliente") {
            header("Location:" . URL . "cliente");
        }

        $componenti = Componente::all()->toArray();

        $apparecchiElettronici = ApparecchioElettronico::all()->toArray();

        $tutto = array();

        foreach ($componenti as $componente) {
            $info = Componente::find($componente['id'])->apparecchielettronici()->get()->toArray();
            foreach ($info as $inf) {
                $tutto[] = array("Componente" => $componente, "ApparecchiElettronici" => $inf);
            }
        }

        require 'application/views/_templates/header.php';
        require 'application/views/dipendente/componentiInfo.php';
        require 'application/views/_templates/footer.php';

    }

    public function creaFattura()
    {
        $displayError = "";
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        if (!isset($_SESSION['tipo'])) {
            header("Location:" . URL);
        } elseif ($_SESSION['tipo'] == "Cliente") {
            header("Location:" . URL . "cliente");
        }

        $fatture = Fattura::all()->toArray();
        $apparecchiElettroniciFatture = array();
        foreach ($fatture as $fattura) {
            $apparecchiElettroniciFatture[] = $fattura['apparecchioelettronico_id'];
        }

        $apparecchiElettronici = ApparecchioElettronico::all()->toArray();
        $utenti = Utente::where("tipo", "LIKE", "Cliente")->get()->toArray();

        $apparecchiElettroniciDisponibili = array();
        foreach ($apparecchiElettronici as $apparecchioElettronico) {
            if (!in_array($apparecchioElettronico['id'], $apparecchiElettroniciFatture)) {
                $apparecchiElettroniciDisponibili[] = $apparecchioElettronico;
            }
        }

        $fattureInfo = array();
        foreach ($fatture as $fattura) {
            $fatturaUtente = Utente::find($fattura['utente_id'])->toArray();
            $fatturaAppareccchioElettronico = ApparecchioElettronico::find($fattura['apparecchioelettronico_id'])->toArray();
            $fatturaComponenti = ApparecchioElettronico::find($fatturaAppareccchioElettronico['id'])->componenti()->get()->toArray();
            $fatturaOreLavoro = ApparecchioElettronico::find($fatturaAppareccchioElettronico['id'])->dipendenti()->get()->toArray();
            $numeroOreLavoro = 0;
            $costoTotale = 0;
            $componentiUsati = "";
            foreach ($fatturaOreLavoro as $fatturaOraLavora) {
                $numOr = $fatturaOraLavora['pivot']['ore_lavoro'];
                $utenteOr = $fatturaOraLavora['pivot']['utente_id'];
                $numeroOreLavoro += $numOr;
                $dipendente = Utente::find($utenteOr)->toArray();
                $costoTotale += $numOr * doubleval($dipendente['salario_orario']);
            }
            foreach ($fatturaComponenti as $fatturaComp) {
                $componentiUsati .= $fatturaComp['nome'] . ": CHF " . $fatturaComp['prezzo'] . "<br>";
                $costoTotale += $fatturaComp['prezzo'];
            }
            $fattureInfo[] = array("id" => $fattura['id'], "fatturaUtente" => $fatturaUtente, "fatturaAppareccchioElettronico" => $fatturaAppareccchioElettronico, "numeroOreLavoro" => $numeroOreLavoro, "costoTotale" => "CHF " . $costoTotale, "componenti" => $componentiUsati);
        }

        require 'application/views/_templates/header.php';
        require 'application/views/dipendente/creaFattura.php';
        require 'application/views/_templates/footer.php';
    }

    public function gestisciFattura()
    {
        $displayError = "";
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        if (!isset($_SESSION['tipo'])) {
            header("Location:" . URL);
        } elseif ($_SESSION['tipo'] == "Cliente") {
            header("Location:" . URL . "cliente");
        }
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (Security::isValidToken($_POST['token'])) {

                $utente_id = "";
                $apparecchioElettronico_id = "";

                if (isset($_POST['utente_id'])) {
                    $utente_id = Security::filterField($_POST['utente_id']);
                    if (!is_double(doubleval($utente_id))) {
                        $displayError .= "<br>Utente Errato";
                    }
                } else {
                    $displayError .= "<br>Utente mancante";
                }

                if (isset($_POST['apparecchio_elettronico'])) {
                    $apparecchioElettronico_id = Security::filterField($_POST['apparecchio_elettronico']);
                    if (!is_double(doubleval($apparecchioElettronico_id))) {
                        $displayError .= "<br>Apparecchio Elettronico Errato";
                    }
                } else {
                    $displayError .= "<br>Apparecchio Elettronico mancante";
                }

                $ins = new Fattura();
                $ins->apparecchioelettronico_id = $apparecchioElettronico_id;
                $ins->utente_id = $utente_id;
                $ins->save();
                header("location: " . URL . "dipendente/gestisciFattura");
            }
        } else {
            $fatture = Fattura::all()->toArray();

            $fattureInfo = array();
            foreach ($fatture as $fattura) {
                $fatturaUtente = Utente::find($fattura['utente_id'])->toArray();
                $fatturaAppareccchioElettronico = ApparecchioElettronico::find($fattura['apparecchioelettronico_id'])->toArray();
                $fatturaComponenti = ApparecchioElettronico::find($fatturaAppareccchioElettronico['id'])->componenti()->get()->toArray();
                $fatturaOreLavoro = ApparecchioElettronico::find($fatturaAppareccchioElettronico['id'])->dipendenti()->get()->toArray();
                $numeroOreLavoro = 0;
                $costoTotale = 0;
                $componentiUsati = "";
                foreach ($fatturaOreLavoro as $fatturaOraLavora) {
                    $numOr = $fatturaOraLavora['pivot']['ore_lavoro'];
                    $utenteOr = $fatturaOraLavora['pivot']['utente_id'];
                    $numeroOreLavoro += $numOr;
                    $dipendente = Utente::find($utenteOr)->toArray();
                    $costoTotale += $numOr * doubleval($dipendente['salario_orario']);
                }
                foreach ($fatturaComponenti as $fatturaComp) {
                    $cos = $fatturaComp['prezzo'] * $fatturaComp['pivot']['quantita'];
                    $componentiUsati .= $fatturaComp['nome'] . " x" . $fatturaComp['pivot']['quantita'] . ": CHF " . $cos . "<br>";
                    $costoTotale += $cos;
                }
                $fattureInfo[] = array("id" => $fattura['id'], "fatturaUtente" => $fatturaUtente, "fatturaAppareccchioElettronico" => $fatturaAppareccchioElettronico, "numeroOreLavoro" => $numeroOreLavoro, "costoTotale" => "CHF " . $costoTotale, "componenti" => $componentiUsati);
            }

            require 'application/views/_templates/header.php';
            require 'application/views/dipendente/gestisciFatture.php';
            require 'application/views/_templates/footer.php';
        }

    }

    public function cancellaFattura($id)
    {
        $displayError = "";
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        if (!isset($_SESSION['tipo'])) {
            header("Location:" . URL);
        } elseif ($_SESSION['tipo'] == "Cliente") {
            header("Location:" . URL . "cliente");
        }
        $del = Fattura::destroy($id);
        header("location: " . URL . "dipendente/gestisciFattura");
    }

    public function modificaUsoComponente()
    {
        $displayError = "";
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        if (!isset($_SESSION['tipo'])) {
            header("Location:" . URL);
        } elseif ($_SESSION['tipo'] == "Cliente") {
            header("Location:" . URL . "cliente");
        }
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (Security::isValidToken($_POST['token'])) {
                $quantita = "";
                if (isset($_POST['quantita'])) {
                    $quantita = Security::filterField($_POST['quantita']);
                    if (!is_double(doubleval($quantita))) {
                        $displayError .= "<br>Quantita Errato";
                    }
                    if ($quantita <= 0) {
                        $displayError .= "<br>Quantita deve essere > 0";
                    }
                } else {
                    $displayError .= "<br>Quantita mancante";
                }

                if (strlen($displayError) == 0) {
                    $idC = $_POST['idComponente'];
                    $apps = Componente::find($idC)->apparecchielettronici()->updateExistingPivot($_POST['idApparecchioElettronico'], array('quantita' => $quantita));
                    header("location: " . URL . "dipendente/usaComponente");
                } else {

                    $componenti = Componente::all()->toArray();

                    $apparecchiElettronici = ApparecchioElettronico::all()->toArray();

                    require 'application/views/_templates/header.php';
                    require 'application/views/dipendente/index.php';
                    require 'application/views/_templates/footer.php';
                }
            } else {
                header("location: " . URL . "dipendente/usaComponente");
            }
        } else {
            header("location: " . URL . "dipendente");
        }
    }
}