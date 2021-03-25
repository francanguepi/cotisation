<?php

namespace App\Http\Controllers;

use App\Membre;
use Illuminate\Http\Request;

class MembresController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'liste des membres';
        //$membres = Membre::all();
        $membres = Membre::paginate(5);
        return view('membres/index')->with('title', $title)->with('membres', $membres);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = 'Inserrer un membre';
        $membre = new Membre();
        return view('membres/create')->with('title', $title)->with('membre', $membre);

        //return view('membres/create')->with('title', $title);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $this->validate($request, [
        //     'nom' => 'required|min:5',
        //     'prenom' => 'required|min:3',
        //     'tel' => "required|unique:membres",  // format du champ de validation :::: 'champ'=> "required"|unique:migration
        //     'email' => "required|unique:membres",
        //     'poste' => "required",
        //     'num_cni' => 'required|min:9',
        //     'quartier' => 'required|min:3',
        //     'dateNaissance' => 'required|date',     
        // ]);
        //dd($postMembre);

        request()->validate([
            'nom' => 'required|min:5',
            'prenom' => 'required|min:3',
            'tel' => "required|unique:membres",  // format du champ de validation :::: 'champ'=> "required"|unique:migration
            'email' => "required|unique:membres",
            'poste' => "required",
            'num_cni' => 'required|min:9',
            'quartier' => 'required|min:3',
            'dateNaissance' => 'required|date', 
        ]);
        $membre = new \App\Membre;
        $membre->nom = $request->nom;
        $membre->prenom = $request->prenom;
        $membre->tel = $request->tel;
        $membre->email = $request->email;
        $membre->poste = $request->poste;
        $membre->num_cni = $request->num_cni;
        $membre->quartier = $request->quartier;
        $membre->dateNaissance = $request->dateNaissance;  
        $membre->save();
        return redirect('/membres');
        //dd($membre->poste);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $title = "détails membres";
        $membre = Membre::find($id);
        //affichage de la liste des cotisation du membre
        $cotisations = $membre->cotisations()->get();
        if($cotisations->isNotEmpty())
        {
            $message ="";
            return view('membres.show')->with('title', $title)->with('membre', $membre)->with('cotisations', $cotisations)
                                                                ->with('message', $message);
        }
        else
        {
            $message ="le membre n'est inscrit dans aucune cotisation";
            return view('membres.show')->with('title', $title)->with('membre', $membre)->with('cotisations', $cotisations)
                                                                ->with('message', $message);
        }

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $title = 'informations sur le membre';
        //$client = Client::where('id', $id)->first();
        $membre = Membre::where('id', $id)->first();
        return view('membres.edit')->with('title', $title)->with('membre', $membre);
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
        $membreUpdate = Membre::find($request->id);
        $this->validate($request, [
            'nom' => 'required|min:5',
            'prenom' => 'required|min:3',
            'tel' => "required|unique:membres,tel,$request->id",
            'email' => "required|unique:membres,email,$request->id",
            'num_cni' => 'required|min:9',
            'quartier' => 'required|min:9',
            'dateNaissance' => 'required|date',   
            
        ]);
        
        $membreUpdate->nom = $request->nom;
        $membreUpdate->prenom = $request->prenom;
        $membreUpdate->tel = $request->tel;
        $membreUpdate->email = $request->email;
        $membreUpdate->num_cni = $request->num_cni;
        $membreUpdate->quartier = $request->quartier;
        $membreUpdate->dateNaissance = $request->dateNaissance;  
        $membreUpdate->save();
        
        return redirect('/membres');
       //dd($request->dateNaissance);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $membre = Membre::find($id);
        $membre->delete();

        return redirect('/membres');
    }

    public function listMember()
    {
        $noms = Membre::all('id', 'nom', 'prenom');
        return $noms;
    }

    public function getMember($id)
    {
        $membre = Membre::find($id);
        return $membre;
    }
}
