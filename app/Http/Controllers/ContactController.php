<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use App\Mail\ContactMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    // Contacter l'administration
    public function contact(ContactRequest $request)
    {
        Mail::send(new ContactMail($request->validated()) );
        return back()->with('success','Votre demande de contact a bien été envoyée');
    }
}
