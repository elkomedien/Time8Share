<?php

namespace App\Http\Controllers;
use App\User;
use Illuminate\Http\Request;

class ProfilController extends Controller
{
    /**
     * Show the profil
     *
     * @return \Illuminate\Http\Response
     */
    public function grab(Request $request)
    {
    $user = $request->user();
    $skills = $user->skills;

        return view('profil', ['user' => $user, 'skills' => $skills]);
    }
}
