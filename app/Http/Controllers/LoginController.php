<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// use Barryvdh\DomPDF\Facade\Pdf;

class LoginController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function store(Request $request)
    {

        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required'
        ]);


        if (!auth()->attempt($request->only('email', 'password'), $request->remember)) {
            return back()->with('mensaje', 'Credenciales Incorrectas');
        }

        return redirect()->route('posts.index', auth()->user()->username);
    }

    //---------------PDF------------------------//
    // public function pdf()
    // {
    //     $pdf = PDF::loadView('auth.pdf');
    //     return $pdf->stream();
    // }
    //---------------PDF------------------------//
}
