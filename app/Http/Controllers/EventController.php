<?php


namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class EventController
{
    public function getAllEvents()
    {
        return DB::table('events')
            ->orderBy('created_at', 'desc')
            ->take(3)
            ->get();
    }

    public function addAnEvent(Request $request)
    {
        DB::table('events')->insert(
            [
                'author' => Auth::user()->username,
                'event_name' => $request->input('event_name'),
                'description' => $request->input('description'),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]
        );
        $res['success'] = true;
        $res['message'] = 'Votre évènement à bien été créé.';
        $res['user_information'] = Auth::user();
        return response($res);
    }
}
