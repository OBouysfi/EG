<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class SupportController extends Controller
{
    public function contact()
    {
        return view('support.contact');
    }

    public function send(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'message' => 'required|string|max:1000',
        ]);

        // Envoi du mail
        Mail::send([], [], function ($message) use ($request) {
            $message->to('support@continuum.ma')
                    ->subject('Demande de support')
                    ->from($request->email, $request->name)
                    ->setBody($request->message, 'text/plain');
        });

        return redirect()->back()->with('success', 'Votre message a été envoyé avec succès.');
    }
}
