<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Subscriber;

class SubscriberController extends Controller
{
    public  function store(Request $request)
    {

        $request->validate([
            'email' => 'required|email|unique:subscribers'
        ],[
            'email.required' => 'El campo correo es obligatorio',
            'email.email' => 'El correo es invalido',
            'email.unique' => 'Este correo ya esta suscrito',
        ]);

        Subscriber::create([
            'email' => $request->email,
        ]);

        Toastr()->success('Te has suscrito con exito :)', 'Exito.');
        return redirect()->back();
    }
}
