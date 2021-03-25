<?php

namespace App\Http\Controllers;

use App\Cotisation;
use App\Membre;
use Carbon\Carbon;
use DateTime;
use DatePeriod;
use DateInterval;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CotisationsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'liste des cotisations';
        $cotisations = Cotisation::paginate(5);
        $noms = app('App\Http\Controllers\MembresController')->listMember();
        //return view('cotisations/inscriptionMembre')->with('noms', $noms);
        return view('cotisations/index')->with('title', $title)->with('cotisations', $cotisations)->with('noms', $noms);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = 'Inserrer un cotisation';
        //$cotisation = new Cotisation();
        return view('cotisations/create')->with('title', $title);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $postCotisation = $this->validate($request, [
            'nom' => 'required|min:5',
            'type' => 'required',
            'date_debut' => 'required|date',
            'heure_debut' => 'required',
            'montant' => 'required',
            'penalite' => 'required',       
            
        ]);
        //dd($postMembre);
        $cotisation = new \App\Cotisation;
        $cotisation->nom = $request->nom;
        $cotisation->type = $request->type;
        $cotisation->date_debut = $request->date_debut;
        $cotisation->heure_debut = $request->heure_debut;
        $cotisation->montant = $request->montant;
        $cotisation->penalite = $request->penalite;
        $cotisation->membres_inscrits = 0;  

        $cotisation->save();
        
        return redirect('/cotisations');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $title = "Liste des adhérents à la cotisation";
        $listeCotisations = Cotisation::all();
        $cotisationUpdate = Cotisation::find($request->id);
        $cotisations = Cotisation::find($request->id);
        $membre =  app('App\Http\Controllers\MembresController')->getMember($request->membre); 
        $cotisationUpdate->membres_inscrits = $cotisationUpdate->membres_inscrits + 1;
        $cotisationUpdate->save();

        //insertion dans la table pivot cotisations_membres
        $membre->cotisations()->syncWithoutDetaching($request->id);
        $membres = $cotisationUpdate->membres()->get();

        //ajout du membre à la fin du calendrier lorsque la cotisation a déjà été organisée dans un calendrier
        $receptions = app('App\Http\Controllers\ReceptionsController')->getReception($request->id);
        //$receptions = app('App\Http\Controllers\ReceptionsController')->getReception($id);
    
        if($receptions->count() > 0)
        {
            $nouveauMontantARecevoir = $cotisationUpdate->montant * $cotisationUpdate->membres_inscrits;
            $positionReception = $cotisationUpdate->membres_inscrits - 1;
            $dateReception = $this->convertDateReception($cotisationUpdate->type, $positionReception, $cotisationUpdate->date_debut);
            app('App\Http\Controllers\ReceptionsController')->enregistrer($request->id,  $request->membre, $dateReception, $nouveauMontantARecevoir, 0, 0); 
        }
             

        //actualiser le nouveau montant à recevoir
        //app('App\Http\Controllers\ReceptionsController')->updateReception($request->id, $nouveauMontantARecevoir);

        return view('/cotisations/listeAdherentsCotisation')->with('title', $title)->with('listeCotisations', $listeCotisations)->with('cotisationUpdate', $cotisationUpdate)->with('cotisations', $cotisations)->with('membres', $membres);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cotisation = Cotisation::find($id);
        $cotisation->delete();

        return redirect('/cotisations');
    }
    public function getNameMember()
    { 
        $noms = app('App\Http\Controllers\MembresController')->listNameMember();
        return view('cotisations/inscriptionMembre')->with('noms', $noms);
    }

    public function afficherMembres(Request $request)
    {
        $title = "Liste des adhérents à la cotisation";
        $cotisations = Cotisation::find($request->id);
        $listeCotisations = Cotisation::all();
        //affichage des membres de la cotisation
        $membres = $cotisations->membres()->get();

        return view('/cotisations/listeAdherentsCotisation')->with('title', $title)->with('listeCotisations', $listeCotisations)->with('cotisations', $cotisations)->with('membres', $membres);
        

    }

    public function afficherCalendrier($id)
    {
        $title ="organisation du calendrier";

        $cotisation = Cotisation::find($id);
        $totalAdherents = $cotisation->membres_inscrits;
        $typeCotisation = $cotisation->type;
        $dateDebut = $cotisation->date_debut;
        $montant = $cotisation->montant;
        $montantARecevoir = $montant * $totalAdherents;
        $listeAdherents = $cotisation->membres()->get();

        /*on organise la reception d'une cotisation lorsqu'elle n'est pas encore enregistré dans la base de données
        sinon on affiche juste le calendrier*/
        $receptions = app('App\Http\Controllers\ReceptionsController')->getReception($id);

        if($cotisation->membres_inscrits == 0)
        {
            //dd("veuillez inscrire d'abord les membres dans la cotisation");
            return back()->with('status', "veuillez inscrire d'abord les membres dans la cotisation");

        }
        if($receptions->count() == 0)
        {
            $this->organisationCalendrier($id, $typeCotisation, $dateDebut, $totalAdherents, $listeAdherents, $montantARecevoir);
            
        }
        
        $calendrierReception = $this->getCalendar($id);
        return view('/cotisations/calendrier')->with('title', $title)->with('cotisation', $cotisation)->with('calendrierReception', $calendrierReception)->with('listeAdherents', $listeAdherents);

    }


    public function organisationCalendrier($cotisation_id, $typeCotisation, $dateDebut, $totalAdherents, $listeAdherents, $montantARecevoir)
    {
        $positionArray = array(); // cette table enregistre les positions de reception générées aléatoirement     
        $position = 0;

        do
        {
            do{
                $position = rand(0, $totalAdherents-1); //génère un nombre compris entre 0 et le nombre d'adhérents-1
                $trouve = in_array($position, $positionArray);
            }while($trouve == true);
            array_push($positionArray, $position);

        }while((count($positionArray)) < $totalAdherents);
            /*for($i = 1; $i <= $totalAdherents; $i++)
            {
                do{
                    $position = rand(0, $totalAdherents);
                    $trouve = in_array($position, $positionArray);
                }while($trouve == true);
                array_push($positionArray, $position);
            }*/

            $positionReception = 0;
            foreach($listeAdherents as $adherent)
            {
                $dateReception = $this->convertDateReception($typeCotisation, $positionArray[$positionReception], $dateDebut);
                //$dateReception = $this->convertDateReception($typeCotisation, $positionReception, $dateDebut);

                app('App\Http\Controllers\ReceptionsController')->enregistrer($cotisation_id,  $adherent->id, $dateReception, $montantARecevoir, 0, 1);

                $positionReception++;
            }

        
    }

    public function updateCalendrier(Request $request)
    {
        app('App\Http\Controllers\ReceptionsController')->updateCalendrier($request->cotisation_id);
        return back();
    }

    public function convertDateReception($typeCotisation, $positionReception, $dateDebut)
    {
        if($typeCotisation == "journaliere")
        {
            $dateReception = strtotime($positionReception." day", strtotime($dateDebut));
            $dateReceptioncont = date("Y-m-d", $dateReception);

            return $dateReceptioncont;
        }

        if($typeCotisation == "hebdommadaire")
        {
            $dateReception = strtotime($positionReception." week", strtotime($dateDebut));
            $dateReceptioncont = date("Y-m-d", $dateReception);
            
            return $dateReceptioncont;
        }

        if($typeCotisation == "mensuelle")
        {
            $dateReception = strtotime($positionReception." month", strtotime($dateDebut));
            $dateReceptioncont = date("Y-m-d", $dateReception);
        
            return $dateReceptioncont;
        }
    }

    //cette fonction recupère la cotisation dejà organisée et se touvant en bd dans la bd
    public function getCalendar($cotisation_id)
    {
        $calendrierReception = app('App\Http\Controllers\ReceptionsController')->getReception($cotisation_id);
        return $calendrierReception;
    }

    public function enregistrerSeanceCotisation(Request $request)
    {
        $title = "Enregistrements des cotisations";
        $date = Carbon::now();
        $dateCotisation = $date->format("Y-m-d");
        $heureCotisation = ($date->add(new DateInterval('PT1H')))->format("H:i");
        $dateVue = $date->format("d-m-Y");
        $cotisation = Cotisation::find($request->cotisation_id);
        //$penalite = "";
        
        //on vérifie si l'adhérent n'a pas encore cotisé vavant d'enregistrer sa cotisation
        $seanceCotisation = app('App\Http\Controllers\SeancesCotisationsController')->checkSeanceCotisation($request->cotisation_id, $request->membre_id, $dateCotisation);
        if($seanceCotisation == null)
        {
            
            if($heureCotisation > date("H:i", strtotime("$cotisation->heure_debut + 30 minutes")))
            {
                app('App\Http\Controllers\SeancesCotisationsController')->enregistrer($request->cotisation_id, $request->membre_id, $dateCotisation, $request->montant_cotise, 1, 1);
            }
            else
            {
                app('App\Http\Controllers\SeancesCotisationsController')->enregistrer($request->cotisation_id, $request->membre_id, $dateCotisation, $request->montant_cotise, 0, 1);
            }
            
            $seancesCotisations = app('App\Http\Controllers\SeancesCotisationsController')->getSeanceCotisation($request->cotisation_id, $dateCotisation);
            
            $adherentsCotises = app('App\Http\Controllers\SeancesCotisationsController')->getAdhrentCotise($request->cotisation_id, $dateCotisation);
            $listeAdherents = $cotisation->membres()->get();

            $tableauListeAdherents = array();
            $tableauAdherentsCotises = array();
            foreach($listeAdherents as $listeAdherent)
            {
                array_push($tableauListeAdherents, $listeAdherent->id);
            }

            foreach($adherentsCotises as $adherentCotise)
            {
                array_push($tableauAdherentsCotises, $adherentCotise->membre_id);
            }

            $adherentsNonCotises = collect($tableauListeAdherents)->diff($tableauAdherentsCotises);
            //dd($adherentsNonCotises);*/
        
            return  view('/cotisations/enregistrementCotisation')->with('title', $title)->with('cotisation', $cotisation)->with('seancesCotisations', $seancesCotisations)
                                                                ->with('dateCotisation', $dateCotisation)
                                                                ->with('adherentsNonCotises', $adherentsNonCotises);
            //dd($adherentsNonCotises);

        }
        else{
            return back()->with('status', "le membre a déjà cotisé pour cette séance");
            //dd("le membre a déjà cotisé pour cette séance");
        }
        //dd("cotisation");
        
    }
    
    public function afficherSeanceCotisation(Request $request)
    {
        $title = "Enregistrements des cotisations";
        $dateCotisation = $request->dateCotisation;
        $cotisation = Cotisation::find($request->cotisation_id);
    
        $seancesCotisations = app('App\Http\Controllers\SeancesCotisationsController')->getSeanceCotisation($request->cotisation_id, $request->dateCotisation);
        if($seancesCotisations->isNotEmpty())
        {
            $adherentsCotises = app('App\Http\Controllers\SeancesCotisationsController')->getAdhrentCotise($request->cotisation_id, $dateCotisation);
            $listeAdherents = $cotisation->membres()->get(); //recupère la liste des adhérents de cette cotisation       
            $tableauListeAdherents = array();
            $tableauAdherentsCotises = array();

            // on construit deux tableaux contenant les id des adhérents à la cotisation et ceux ayant cotisés
            foreach($listeAdherents as $listeAdherent)
            {
                array_push($tableauListeAdherents, $listeAdherent->id);
            }

            foreach($adherentsCotises as $adherentCotise)
            {
                array_push($tableauAdherentsCotises, $adherentCotise->membre_id);
            }
            //on extrait de la liste des adhérents de la cotisation ceux qui ont cotisés pour avoir ceux qui n'ont pas cotisés
            $adherentsNonCotises = collect($tableauListeAdherents)->diff($tableauAdherentsCotises);
            return  view('/cotisations/enregistrementCotisation')->with('title', $title)->with('cotisation', $cotisation)
                                                                 ->with('seancesCotisations', $seancesCotisations)
                                                                 ->with('dateCotisation', $dateCotisation)
                                                                 ->with('adherentsNonCotises', $adherentsNonCotises);
        }
        else
        {
            //return back()->with('message', "aucun enregistrement ne correspond à cette date");
            
            dd("aucun enregistrement ne correspond à cette date");
        }

    }

}
