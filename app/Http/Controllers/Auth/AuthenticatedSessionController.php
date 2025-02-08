<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

use App\Models\User;

class AuthenticatedSessionController extends Controller
{

    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        return redirect()->intended(RouteServiceProvider::HOME);

        // $users = User::with('role')->get();

        // // $userRole = $request->user()->role->name;

        // $url = '';
        // $user = $request->user(); // Récupérer l'utilisateur authentifié
        // $userRole = $user->role;  // Utiliser la relation pour récupérer le rôle

        // if ($userRole->name === 'admin') {
        //     $url = 'admin/dashboard';
        // } elseif ($userRole->name === 'personnel') {
        //     $url = 'personnel/dashboard';
        // }
        // elseif ($userRole->name === 'gestionnaire') {
        //     $url = 'gestionnaire/dashboard';
        // }
        // elseif ($userRole->name === 'permanencier') {
        //     $url = 'permanencier/dashboard';
        // }  else {
        //     $url = '/';
        // }


        // return redirect()->intended($url);
        }









    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');

    }
}
