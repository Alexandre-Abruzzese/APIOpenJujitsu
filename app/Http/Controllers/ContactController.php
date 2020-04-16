<?php


namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

use App\Contact;
class ContactController
{
    public function add(Request $request)
    {
        $contact = new Contact();
        $contact->firstname = $request->input('firstname');
        $contact->lastname = $request->input('lastname');
        $contact->body = $request->input('body');
        $contact->email = $request->input('email');
        $contact->phone = $request->input('phone');

        if($contact->save()){
            $res['success'] = true;
            $res['message'] = 'Votre message à bien été envoyé';
            return response($res);
        };

        $res['success'] = false;
        $res['message'] = "l'email et le message sont des champs obligatoire";

        return response($res);

    }

    public function getAllContacts(Request $request)
    {
        $contacts = Contact::all();
        return $contacts;
    }
}
