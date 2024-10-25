<?php

class Home
{
    public function index()
    {

        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $displayError = "";
        if ($_SERVER['REQUEST_METHOD'] == 'POST'){
            
            $email = "";
            $password = "";

            $pattern = '/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/';
            if(preg_match($pattern,strtolower($_POST['email']))){
                $email = Security::filterField($_POST['email']);
            }else{
                $displayError .= "<br> Email non valida";
            }

            if (isset($_POST['password'])){
                $password = Security::filterField($_POST['password']);
                $pass = hash('sha256', $password);
            }else{
                $displayError .= "<br>Password mancante";
            }

            if(strlen($displayError) == 0){
                $result = Utente::where('email',$email)
                    ->where('password',$pass)
                    ->first();

                if ($result) {
                    $_SESSION["tipo"] = $result['tipo'];
                    $_SESSION["nome"] = $result['nome'];
                    $_SESSION["cognome"] = $result['cognome'];
                    $_SESSION['id_utente'] = $result['id'];

                    header("Location:" . URL . "cliente");
                } else {
                    $displayError .= "Email o password errati";
                    require 'application/views/_templates/header.php';
                    require 'application/views/accesso/login.php';
                    //require 'application/views/_templates/footer.php';
                }
            }else{

                require 'application/views/_templates/header.php';
                require 'application/views/accesso/login.php';
                require 'application/views/_templates/footer.php';
            }
            
        }else{
            if (!isset($_SESSION['tipo'])){
                Security::generateCSRF();
                require 'application/views/_templates/header.php';
                require 'application/views/accesso/login.php';
                require 'application/views/_templates/footer.php';
            }elseif ($_SESSION['tipo'] == "Cliente"){
                header("Location:" . URL . "cliente");
            }elseif($_SESSION['tipo'] == "Dipendente"){
                header("Location:" . URL . "dipendente");
            }else{
                header("Location:" . URL . "amministratore");
            }

        }


    }

    public function register(){
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        $displayError = "";
        if ($_SERVER['REQUEST_METHOD'] == 'POST'){
            $nome = "";
            $cognome = "";
            $email = "";
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
                $displayError .= "<br>Data di nascita mancante";
            }

            if(strlen($displayError) == 0){
                $user = new Utente();
                $user->nome = $nome;
                $user->cognome = $cognome;
                $user->email = $email;
                $user->data_nascita = $data_nascita;
                $user->password = $password;
                $user->tipo = "Cliente";
                $user->save();


                if(!isset($_SESSION['tipo'])){
                    header("Location:" . URL);
                }elseif ($_SESSION['tipo'] == "Amministratore"){
                    header("location: ".URL."amministratore/gestisciClienti");
                }
            }else{
                require 'application/views/_templates/header.php';
                require 'application/views/accesso/register.php';
                require 'application/views/_templates/footer.php';
            }

        }else{
            require 'application/views/_templates/header.php';
            require 'application/views/accesso/register.php';
            require 'application/views/_templates/footer.php';
        }
    }

    public function logout()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        session_destroy();
        header("location: " . URL);
    }

}