<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function submit(Request $request)
    {
        // Validation des données
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        // Traitement des données (par exemple, envoyer un email, enregistrer en base de données, etc.)
        // Exemple : Mail::to('admin@example.com')->send(new ContactMail($validated));

        // Retourner un message de succès
        return back()->with('success', 'Votre message a été envoyé avec succès !');
    }
}

{
    //
}
