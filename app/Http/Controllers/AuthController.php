<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    //
    public function register(Request $request)
    {
        // Validacija na podatocite sto gi vnese korisnikot
        $validatedData = $request->validate([
            'name' => 'required|string|max:255', // Imeto e potrebno, treba da e od tip string i da e najdolgo 255 karakteri
            'email' => 'required|email|unique:users,email', // Emailot e potreben, treba da e validen email i da bide unikaten vo tabelata `users`
            'password' => 'required|string|min:6', // Lozinkata e potrebna, treba da e od tip string i da e najmalku 6 karakteri
        ]);

        // Kreiranje na nov korisnik so vnesenite podatoci
        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => bcrypt($validatedData['password']), // Lozinkata se kriptira so bcrypt pred da se zacuva vo bazata
        ]);

        // Generiranje na JWT token za korisnikot
        $token = JWTAuth::fromUser($user);

        // Vrakanje na odgovor so generiraniot token
        return response()->json(compact('token'), 201);
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if ($token = JWTAuth::attempt($credentials)) {
            return response()->json(compact('token'));
        }

        return response()->json(['error' => 'Unauthorized'], 401);
    }

}
