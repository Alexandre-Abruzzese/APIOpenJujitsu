<?php


namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use App\Event;

class EventController extends Controller
{
    public function getAllEvents()
    {
        $events = Event::orderBy('created_at','desc')->take(3)->get();
        return $events;
    }

    public function getOneEvent(Request $request)
    {
        $this->validate($request, [
            'id' => 'required'
        ]);

        $event = Event::find($request->input('id'));

        return $event;
    }

    public function addAnEvent(Request $request)
    {

        $event = new Event();

        $event->author = Auth::user()->username;
        $event->event_name = $request->input('event_name');
        $event->description = $request->input('description');
        $event->start_at = $request->input('start_at');
        $event->end_at = $request->input('end_at');
        $event->save();

        $res['success'] = true;
        $res['message'] = 'Votre évènement à bien été créé.';
        $res['user_information'] = Auth::user();
        return response($res);
    }

    public function dropOneEvent(Request $request)
    {
        Event::find($request->input('id'))->delete();
        $res['success'] = true;
        $res['message'] = 'Votre évènement a bien été supprimé.';
        return response($res);
    }

    public function modifyOneEvent(Request $request)
    {
        $event = Event::find($request->input('id'));

        $event->event_name = $request->input('event_name');
        $event->description = $request->input('description');
        $event->start_at = $request->input('start_at');
        $event->end_at = $request->input('end_at');
        $event->updated_at = date('Y-m-d H:i:s');

        $event->save();

        $res['success'] = true;
        $res['message'] = 'Votre évènement a bien été modifié.';
        return response($res);
    }
}
