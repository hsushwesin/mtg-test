<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $response = Http::post('https://awesome-borg.103-47-185-219.plesk.page/api/register', [
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => $request->input('password'),
            'password_confirmation' => $request->input('password_confirmation'),
            'phone' => $request->input('phone'),
        ]);

        return $response->json();
    }

    public function login(Request $request)
    {
        $response = Http::post('https://awesome-borg.103-47-185-219.plesk.page/api/authenticate', [
            'email' => $request->input('email'),
            'password' => $request->input('password'),
        ]);

        return $response->json();
    }

    public function logout(Request $request)
    {
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $request->bearerToken(),
        ])->post('https://awesome-borg.103-47-185-219.plesk.page/api/logout');

        return $response->json();
    }

    public function getProfile(Request $request)
    {
        $response = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer ' . $request->bearerToken(),
        ])->get('https://awesome-borg.103-47-185-219.plesk.page/api/me');

        return $response->json(); 
    }
}
