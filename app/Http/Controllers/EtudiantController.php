<?php

namespace App\Http\Controllers;

use App\Models\Etudiant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class EtudiantController extends Controller
{
    //création d'un étudiant
    //URL: http://127.0.0.1:8000/api/register
    public function register(Request $request) {
        //validation
        $request->validate([
            'name' => "required",
            'email' => "required|email|unique:etudiants",
            'password' => "required|confirmed"
        ]);

        //traitement des données
        $etudiant = new Etudiant();
        $etudiant->name = $request->name;
        $etudiant->email = $request->email;
        $etudiant->password = Hash::make($request->password);
        $etudiant->phone = isset($request->phone) ? $request->phone : '';
        $etudiant->save();

        //réponse
        return response()->json([
            "status" => 1,
            "message" => "étudiant crée avec success"
        ]);

    }
    public function login(Request $request) {
        
    }
    public function logout(Request $request) {
        
    }
    public function profil(Request $request) {
        
    }
}
