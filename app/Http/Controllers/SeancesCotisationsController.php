<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SeanceCotisation;


class SeancesCotisationsController extends Controller
{
    public function enregistrer($cotisation_id, $membre_id, $date_jour, $montant_cotise, $penalite, $cotise)
    {
        $seanceCotisation = new \App\SeanceCotisation;
        $seanceCotisation->cotisation_id = $cotisation_id;
        $seanceCotisation->membre_id = $membre_id;
        $seanceCotisation->date_jour = $date_jour;
        $seanceCotisation->montant_cotise = $montant_cotise;
        $seanceCotisation->penalite = $penalite;
        $seanceCotisation->cotise = $cotise;

        $seanceCotisation->save();
    }

    public function getSeanceCotisation($cotisation_id, $dateCotisation)
    {
        $seancesCotisations = SeanceCotisation::where('cotisation_id', $cotisation_id)
                                                ->where('date_jour', $dateCotisation)
                                                ->get();
        return $seancesCotisations;
    }

    public function checkSeanceCotisation($cotisation_id, $membre_id, $dateCotisation)
    {
        $seanceCotisation = SeanceCotisation::where('cotisation_id', $cotisation_id)
                                                ->where('membre_id', $membre_id)
                                                ->where('date_jour', $dateCotisation)
                                                ->first();
        return $seanceCotisation;
    }

    function getAdhrentCotise($cotisation_id, $dateCotisation)
    {
        $adherents = SeanceCotisation::select('membre_id')
                                        ->where('cotisation_id', $cotisation_id)
                                        ->where('date_jour', $dateCotisation)
                                        ->get();
        return  $adherents;
    }
    //$noms = Membre::all('id', 'nom', 'prenom');
    
}
