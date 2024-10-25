<?php

class Amministratore
{
    public function index(){
        $displayError = "";
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        if(!isset($_SESSION['tipo'])){
            header("Location:" . URL);
        }
        elseif($_SESSION['tipo'] == "Cliente"){
            header("Location:" . URL . "cliente");
        }
        elseif ($_SESSION['tipo'] == "Dipendente"){
            header("Location:" . URL . "dipendente");
        }
        require 'application/views/_templates/header.php';
        $utenti = Utente::all()->toArray();
        require 'application/views/amministratore/index.php';
        require 'application/views/_templates/footer.php';
    }
    public function cancellaUtente($id){
        $displayError = "";
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        if(!isset($_SESSION['tipo'])){
            header("Location:" . URL);
        }
        elseif($_SESSION['tipo'] == "Cliente"){
            header("Location:" . URL . "cliente");
        }
        elseif ($_SESSION['tipo'] == "Dipendente"){
            header("Location:" . URL . "dipendente");
        }

        $destroy = Utente::destroy($id);
        header("Location:" . URL . "amministratore");
    }
    public function gestisciClienti(){
        $displayError = "";
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        if(!isset($_SESSION['tipo'])){
            header("Location:" . URL);
        }
        elseif($_SESSION['tipo'] == "Cliente"){
            header("Location:" . URL . "cliente");
        }
        elseif ($_SESSION['tipo'] == "Dipendente"){
            header("Location:" . URL . "dipendente");
        }
        require 'application/views/_templates/header.php';
        $utenti = Utente::where("tipo","LIKE","Cliente")->get()->toArray();
        require 'application/views/amministratore/clienti.php';
        require 'application/views/_templates/footer.php';
    }
    public function modificaCliente(){
        $displayError = "";
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        if(!isset($_SESSION['tipo'])){
            header("Location:" . URL);
        }
        elseif($_SESSION['tipo'] == "Cliente"){
            header("Location:" . URL . "cliente");
        }
        elseif ($_SESSION['tipo'] == "Dipendente"){
            header("Location:" . URL . "dipendente");
        }
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (Security::isValidToken($_POST['token'])) {
                $nome = "";
                $cognome = "";
                $data_nascita = "";
                $password = "";

                $utenti = Utente::all()->toArray();

                if (isset($_POST['nome'])){
                    $nome = Security::filterField($_POST['nome']);
                }else{
                    $displayError .= "<br>Nome mancante";
                }

                if (isset($_POST['cognome'])){
                    $cognome = Security::filterField($_POST['cognome']);
                }else{
                    $displayError .= "<br>Cognome mancante";
                }

                if (isset($_POST['data_nascita'])){
                    if(Security::isRealDate($_POST['data_nascita'])){
                        $data_nascita = Security::filterField($_POST['data_nascita']);
                    }else{
                        $displayError .= "<br>Data di nascita non valida";
                    }
                }else{
                    $displayError .= "<br>Data di nascita mancante";
                }

                if (isset($_POST['password'])){
                    $password = Security::filterField($_POST['password']);
                }else{
                    $password = "";
                }

                if(strlen($displayError) == 0){
                    if(empty($password)){
                        Utente::where("id","LIKE",$_POST['id'])->update(['nome'=>$nome,'cognome'=>$cognome,'data_nascita'=>$data_nascita]);

                    }else{
                        Utente::where("id","LIKE",$_POST['id'])->update(['nome'=>$nome,'cognome'=>$cognome,'data_nascita'=>$data_nascita,'password'=>hash('sha256', $password)]);

                    }
                    header("location: ".URL . "amministratore");
                }else{
                    require 'application/views/_templates/header.php';
                    require 'application/views/amministratore/clienti.php';
                    require 'application/views/_templates/footer.php';
                }
            }
        }else{
            header("Location:" . URL . "amministratore");
        }
    }
    public function gestisciDipendenti(){
    $displayError = "";
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    if(!isset($_SESSION['tipo'])){
        header("Location:" . URL);
    }
    elseif($_SESSION['tipo'] == "Cliente"){
        header("Location:" . URL . "cliente");
    }
    elseif ($_SESSION['tipo'] == "Dipendente"){
        header("Location:" . URL . "dipendente");
    }
    require 'application/views/_templates/header.php';
    $utenti = Utente::where("tipo","LIKE","Dipendente")->get()->toArray();
    require 'application/views/amministratore/dipendenti.php';
    require 'application/views/_templates/footer.php';
}
    public function modificaDipendente(){
        $displayError = "";
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        if(!isset($_SESSION['tipo'])){
            header("Location:" . URL);
        }
        elseif($_SESSION['tipo'] == "Cliente"){
            header("Location:" . URL . "cliente");
        }
        elseif ($_SESSION['tipo'] == "Dipendente"){
            header("Location:" . URL . "dipendente");
        }
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (Security::isValidToken($_POST['token'])) {
                $nome = "";
                $cognome = "";
                $data_nascita = "";
                $password = "";
                $salario_orario = "";

                $utenti = Utente::all()->toArray();

                if (isset($_POST['nome'])){
                    $nome = Security::filterField($_POST['nome']);
                }else{
                    $displayError .= "<br>Nome mancante";
                }

                if (isset($_POST['cognome'])){
                    $cognome = Security::filterField($_POST['cognome']);
                }else{
                    $displayError .= "<br>Cognome mancante";
                }

                if (isset($_POST['data_nascita'])){
                    if(Security::isRealDate($_POST['data_nascita'])){
                        $data_nascita = Security::filterField($_POST['data_nascita']);
                    }else{
                        $displayError .= "<br>Data di nascita non valida";
                    }
                }else{
                    $displayError .= "<br>Data di nascita mancante";
                }

                if (isset($_POST['password'])){
                    $password = Security::filterField($_POST['password']);
                }else{
                    $password = "";
                }

                if (isset($_POST['salario_orario'])){
                    if (is_int(intval($_POST['salario_orario']))){
                        $salario_orario = Security::filterField($_POST['salario_orario']);
                    }else{
                        $displayError .= "<br>Salario orario non valido";
                    }
                }else{
                    $displayError .= "<br>Salario orario mancante";
                }

                if(strlen($displayError) == 0){
                    if(empty($password)){
                        Utente::where("id","LIKE",$_POST['id'])->update(['nome'=>$nome,'cognome'=>$cognome,'data_nascita'=>$data_nascita,'salario_orario'=>$salario_orario]);

                    }else{
                        Utente::where("id","LIKE",$_POST['id'])->update(['nome'=>$nome,'cognome'=>$cognome,'data_nascita'=>$data_nascita,'salario_orario'=>$salario_orario,'password'=>hash('sha256', $password)]);

                    }
                    header("location: ".URL . "amministratore");
                }else{
                    require 'application/views/_templates/header.php';
                    require 'application/views/amministratore/dipendenti.php';
                    require 'application/views/_templates/footer.php';
                }
            }
        }else{
            header("Location:" . URL . "amministratore");
        }
    }
    public function creaDipendente(){
        $displayError = "";
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        if(!isset($_SESSION['tipo'])){
            header("Location:" . URL);
        }
        elseif($_SESSION['tipo'] == "Cliente"){
            header("Location:" . URL . "cliente");
        }
        elseif ($_SESSION['tipo'] == "Dipendente"){
            header("Location:" . URL . "dipendente");
        }
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (Security::isValidToken($_POST['token'])) {
                $nome = "";
                $cognome = "";
                $data_nascita = "";
                $email = "";
                $password = "";
                $salario_orario = "";

                $utenti = Utente::all()->toArray();

                if (isset($_POST['nome'])){
                    $nome = Security::filterField($_POST['nome']);
                }else{
                    $displayError .= "<br>Nome mancante";
                }

                if (isset($_POST['cognome'])){
                    $cognome = Security::filterField($_POST['cognome']);
                }else{
                    $displayError .= "<br>Cognome mancante";
                }

                if (isset($_POST['email'])){
                    $pattern = '/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/';
                    if(preg_match($pattern,strtolower($_POST['email']))){
                        $email = Security::filterField($_POST['email']);
                        foreach($utenti as $utente){
                            if($email == str($utente['email'])){
                                $displayError .= "<br> Email già esistente";
                            }
                        }
                    }else{
                        $displayError .= "<br> Email non valida";
                    }
                }else{
                    $displayError .= "<br>Email mancante";
                }

                if (isset($_POST['data_nascita'])){
                    if(Security::isRealDate($_POST['data_nascita'])){
                        $data_nascita = Security::filterField($_POST['data_nascita']);
                    }else{
                        $displayError .= "<br>Data di nascita non valida";
                    }
                }else{
                    $displayError .= "<br>Data di nascita mancante";
                }

                if (isset($_POST['password'])){
                    $password = Security::filterField($_POST['password']);
                }else{
                    $password = "";
                }

                if (isset($_POST['salario_orario'])){
                    if (is_int(intval($_POST['salario_orario']))){
                        $salario_orario = Security::filterField($_POST['salario_orario']);
                    }else{
                        $displayError .= "<br>Salario orario non valido";
                    }
                }else{
                    $displayError .= "<br>Salario orario mancante";
                }
                if(strlen($displayError) == 0){
                    $user = new Utente();
                    $user->nome = $nome;
                    $user->cognome = $cognome;
                    $user->email = $email;
                    $user->data_nascita = $data_nascita;
                    $user->salario_orario = $salario_orario;
                    $user->password = $password;
                    $user->tipo = "Dipendente";
                    $user->save();

                    header("location: ".URL . "amministratore/gestisciDipendenti");
                }else{
                    require 'application/views/_templates/header.php';
                    require 'application/views/amministratore/creaDipendente.php';
                    require 'application/views/_templates/footer.php';
                }
            }
        }else{
            require 'application/views/_templates/header.php';
            require 'application/views/amministratore/creaDipendente.php';
            require 'application/views/_templates/footer.php';
        }
    }
    public function gestisciComponenti(){
        $displayError = "";
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        if(!isset($_SESSION['tipo'])){
            header("Location:" . URL);
        }
        elseif($_SESSION['tipo'] == "Cliente"){
            header("Location:" . URL . "cliente");
        }
        elseif ($_SESSION['tipo'] == "Dipendente"){
            header("Location:" . URL . "dipendente");
        }
        $componenti = Componente::all()->toArray();
        require 'application/views/_templates/header.php';
        require 'application/views/amministratore/componenti.php';
        require 'application/views/_templates/footer.php';
    }
    public function modificaComponente(){
        $displayError = "";
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        if(!isset($_SESSION['tipo'])){
            header("Location:" . URL);
        }
        elseif($_SESSION['tipo'] == "Cliente"){
            header("Location:" . URL . "cliente");
        }
        elseif ($_SESSION['tipo'] == "Dipendente"){
            header("Location:" . URL . "dipendente");
        }
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (Security::isValidToken($_POST['token'])) {
                $nome = "";
                $prezzo = "";

                if (isset($_POST['nome'])){
                    $nome = Security::filterField($_POST['nome']);
                }else{
                    $displayError .= "<br>Nome mancante";
                }

                if (isset($_POST['prezzo'])){
                    if (is_int(intval($_POST['prezzo']))){
                        $prezzo = Security::filterField($_POST['prezzo']);
                    }else{
                        $displayError .= "<br>Salario orario non valido";
                    }
                }else{
                    $displayError .= "<br>Salario orario mancante";
                }

                if(strlen($displayError) == 0){
                    Componente::where("id","LIKE",$_POST['id'])->update(['nome'=>$nome,'prezzo'=>$prezzo]);
                    header("location: ".URL . "amministratore/gestisciComponenti");
                }else{
                    require 'application/views/_templates/header.php';
                    require 'application/views/amministratore/modificaComponente.php';
                    require 'application/views/_templates/footer.php';
                }
            }
        }
    }
    public function creaComponente(){
        $displayError = "";
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        if(!isset($_SESSION['tipo'])){
            header("Location:" . URL);
        }
        elseif($_SESSION['tipo'] == "Cliente"){
            header("Location:" . URL . "cliente");
        }
        elseif ($_SESSION['tipo'] == "Dipendente"){
            header("Location:" . URL . "dipendente");
        }
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (Security::isValidToken($_POST['token'])) {
                $nome = "";
                $prezzo = "";

                if (isset($_POST['nome'])){
                    $nome = Security::filterField($_POST['nome']);
                }else{
                    $displayError .= "<br>Nome mancante";
                }

                if (isset($_POST['prezzo'])){
                    if (is_int(intval($_POST['prezzo']))){
                        $prezzo = Security::filterField($_POST['prezzo']);
                    }else{
                        $displayError .= "<br>Salario orario non valido";
                    }
                }else{
                    $displayError .= "<br>Salario orario mancante";
                }

                if(strlen($displayError) == 0){
                    $componente = new Componente();
                    $componente->nome = $nome;
                    $componente->prezzo = $prezzo;
                    $componente->save();
                    header("location: ".URL . "amministratore/gestisciComponenti");
                }else{
                    require 'application/views/_templates/header.php';
                    require 'application/views/amministratore/creaComponente.php';
                    require 'application/views/_templates/footer.php';
                }
            }
        }else{
            require 'application/views/_templates/header.php';
            require 'application/views/amministratore/creaComponente.php';
            require 'application/views/_templates/footer.php';
        }
    }
    public function cancellaComponente($id){
        $displayError = "";
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        if(!isset($_SESSION['tipo'])){
            header("Location:" . URL);
        }
        elseif($_SESSION['tipo'] == "Cliente"){
            header("Location:" . URL . "cliente");
        }
        elseif ($_SESSION['tipo'] == "Dipendente"){
            header("Location:" . URL . "dipendente");
        }

        $destroy = Componente::destroy($id);
        header("Location:" . URL . "amministratore");
    }
}