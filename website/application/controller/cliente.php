<?php

class Cliente
{
    public function index(){
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $id_utente = $_SESSION['id_utente'];
        $fattureCliente = Utente::find($id_utente)->fatture()->get()->toArray();

        $fattureInfo = array();
        foreach ($fattureCliente as $fattura){
            $fatturaUtente = Utente::find($fattura['utente_id'])->toArray();
            $fatturaAppareccchioElettronico = ApparecchioElettronico::find($fattura['apparecchioelettronico_id'])->toArray();
            $fatturaComponenti = ApparecchioElettronico::find($fatturaAppareccchioElettronico['id'])->componenti()->get()->toArray();
            $fatturaOreLavoro = ApparecchioElettronico::find($fatturaAppareccchioElettronico['id'])->dipendenti()->get()->toArray();
            $numeroOreLavoro = 0;
            $costoTotale = 0;
            $componentiUsati = "";
            foreach ($fatturaOreLavoro as $fatturaOraLavora){
                $numOr = $fatturaOraLavora['pivot']['ore_lavoro'];
                $utenteOr =  $fatturaOraLavora['pivot']['utente_id'];
                $numeroOreLavoro += $numOr;
                $dipendente = Utente::find($utenteOr)->toArray();
                $costoTotale += $numOr*doubleval($dipendente['salario_orario']);
            }
            foreach ($fatturaComponenti as $fatturaComp){
                $cos = $fatturaComp['prezzo'] * $fatturaComp['pivot']['quantita'];
                $componentiUsati .= $fatturaComp['nome'] . " x" . $fatturaComp['pivot']['quantita'] . ": CHF " . $cos ."<br>";
                $costoTotale += $cos;
            }
            $fattureInfo[] = array("id" => $fattura['id'],"fatturaUtente" => $fatturaUtente,"fatturaAppareccchioElettronico" => $fatturaAppareccchioElettronico, "numeroOreLavoro" => $numeroOreLavoro, "costoTotale" => "CHF " . $costoTotale, "componenti" => $componentiUsati);
        }

        require 'application/views/_templates/header.php';
        require 'application/views/cliente/fatture.php';
        require 'application/views/_templates/footer.php';


    }
}