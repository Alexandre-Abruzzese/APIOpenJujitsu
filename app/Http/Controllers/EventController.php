<?php


namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

use App\Event;
use App\User;

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
        $user = User::where('api_token',$request->header('api_token'))->first();
        $event = new Event();

        $event->author = $user->id;
        $event->event_name = $request->input('event_name');
        $event->description = $request->input('description');
        $event->start_at = new Carbon($request->input('start_at'));
        $event->end_at = Carbon::parse($request->input('end_at'));
        if($event->save()){
            $res['success'] = true;
            $res['message'] = 'Votre évènement à bien été créé.';
            return response($res);
        }
        $res['success'] = false;
        $res['message'] = 'Une erreur est survenue';
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
