<?php

namespace App\Http\Controllers;

use App\Reception;
use App\Membre;
use Carbon\Carbon;
use DateTime;
use DatePeriod;
use DateInterval;

use Illuminate\Http\Request;

class ReceptionsController extends Controller
{
    public $timestamps = false;

    public function getReception($cotisation_id)
    {
        $receptions = Reception::where('cotisation_id', $cotisation_id)->get();
        return $receptions;
    }

    /*public function checkReception($cotisation_id)
    {
        $receptions = Reception::where('cotisation_id', $cotisation_id)->first();

    }*/
    public function enregistrer($cotisation_id, $membre_id, $jour_reception, $montant_reçu, $recu, $calendrier)
    {
        
        $cotisationMembreReception = new \App\Reception;
        $cotisationMembreReception->cotisation_id = $cotisation_id;
        $cotisationMembreReception->membre_id = $membre_id;
        $cotisationMembreReception->jour_reception = $jour_reception;
        $cotisationMembreReception->montant_reçu = $montant_reçu;
        $cotisationMembreReception->recu = $recu;
        $cotisationMembreReception->calendrier = $calendrier;

         
        $cotisationMembreReception->save();
        
    }

    public function updateReception($cotisation_id, $nouveauMontant)
    {
        $receptions = Reception::where('cotisation_id', $cotisation_id)->get();
        foreach($receptions as $reception)
        {
            $reception->montant_reçu = $nouveauMontant;
        }
    }

    public function updateCalendrier($cotisation_id)
    {
        $date = Carbon::now();
        $dateJour = $date->format("Y-m-d");
        $receptions = Reception::where('cotisation_id', $cotisation_id)->get();
        foreach($receptions as $reception)
        {
            // echo $dateJour, " "; 
            // echo "<br>";
            // echo $reception->jour_reception;
            // echo "<br>";

            // if($reception->jour_reception < $dateJour)
            // {
            //     echo "déjà bouffé";
            // echo "<br> <br>";

            // }
            // else
            // {
            //     echo "pas encore bouffé";
            // echo "<br> <br>";


            // }
            if($reception->jour_reception < $dateJour)
            {
                $reception->recu  = 1;

            }
            else
            {
            $reception->recu  = 0;

            }
            $reception->save();
        }

    }
}
