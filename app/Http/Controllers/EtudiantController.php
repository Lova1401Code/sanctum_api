<?php

namespace App\Http\Controllers;

use App\Models\Etudiant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class EtudiantController extends Controller
{
    //création d'un étudiant
    //URL: http://127.0.0.1:8000/api/register
    public function register(Request $request) {
        //validation
        $request->validate([
            'name' => "required|min:8",
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
    //Authentification de l'utilisateur
    public function login(Request $request) {
        //validation
        $request->validate([
            "email" => "required|email",
            "password" => "required"
        ]);

        //verification si l'etudiant existe
        //URL : http://127.0.0.1:8000/api/login
        $etudiant = Etudiant::where('email', '=', $request->email)->first(); 
        if ($etudiant) {
            if (Hash::check($request->password, $etudiant->password)) {
                //creer un jeton/token
                $token = $etudiant->createToken('auth_tokenEtudiant')->plainTextToken;
                //réponse pour envoyer le token
                return response()->json([
                    "status" => 1,
                    "message" => "connexion réussie",
                    "access_token" => $token 
                ]);
            }else{
                return response()->json([
                    "status" => 0,
                    "message" => "mot de passe incorrect"
                ]);
            }
        }else{
            return response()->json([
                "status" => 0,
                "message" => "Etudiant introuvable"
            ], 404);
        }
    }
    //déconnexion
    //URL : http://127.0.0.1:8000/api/logout
    public function logout(Request $request) {
        Auth::user()->tokens()->delete();
        return response()->json([
            "status" => 1,
            "message" => "Deconnexion réussie"
        ]);
    }
    //récupération de profil d'un utilisateur
    //URL : http://127.0.0.1:8000/api/profil
    public function profil() {
        return response()->json([
            "status" => 1,
            "message" => "Information profile",
            "datas" => Auth::user()
        ]);
    }
}
