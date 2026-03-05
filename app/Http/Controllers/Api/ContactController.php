<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{

    // afficher tous les contacts
    public function index()
    {
        return Contact::all();
    }

    // ajouter un contact
    public function store(Request $request)
    {
        $contact = Contact::create($request->all());

        return response()->json($contact, 201);
    }

    // afficher un contact
    public function show($id)
    {
        return Contact::findOrFail($id);
    }

    // modifier un contact
    public function update(Request $request, $id)
    {
        $contact = Contact::findOrFail($id);
        $contact->update($request->all());

        return response()->json($contact, 200);
    }

    // supprimer un contact
    public function destroy($id)
    {
        Contact::destroy($id);

        return response()->json(null, 204);
    }
}