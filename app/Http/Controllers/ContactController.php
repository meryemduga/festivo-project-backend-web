<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactFormMail;

class ContactController extends Controller
{
    public function show()
    {
        return view('contact');
    }

    public function send(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'message' => 'required|string',
        ]);

        // Stuur mail naar admin e-mailadres
        Mail::to('admin@ehb.be')->send(new ContactFormMail($validated));

        return back()->with('success', 'Bedankt! Je bericht is succesvol verzonden.');
    }
}