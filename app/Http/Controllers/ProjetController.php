<?php

namespace App\Http\Controllers;

use App\Models\Projet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProjetController extends Controller
{
    //creer un projet
    public function create(Request $request){
        //Validation
        $request->validate([
            "name" => "required",
            "duree" => "required",
            "description" => "required"
        ]);

        //enregistrer les projets
        $projet = new Projet();
        $projet->name = $request->name;
        $projet->duree = $request->duree;
        $projet->description = $request->description;
        $projet->etudiant_id = Auth::user()->id;
        $projet->save();

        //réponse
        //Url: http://127.0.0.1:8000/api/create
        return response()->json([
            "status" => 1,
            "message" => "projet créer avec succes"
        ]);
    }
    public function delete(Request $request){
        
    }
    public function liste(Request $request){
        
    }
    public function details(Request $request){
        
    }
}
