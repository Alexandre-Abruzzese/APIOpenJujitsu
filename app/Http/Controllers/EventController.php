<?php


namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class EventController extends Controller
{
    public function getAllEvents()
    {
        return DB::table('events')
            ->orderBy('created_at', 'desc')
            ->take(3)
            ->get();
    }

    public function getOneEvent(Request $request)
    {
        $this->validate($request, [
            'id' => 'required'
        ]);

        return DB::select('SELECT * FROM events WHERE id = ?', [$request->input('id')]);
    }

    public function addAnEvent(Request $request)
    {
        DB::table('events')->insert(
            [
                'author' => Auth::user()->username,
                'event_name' => $request->input('event_name'),
                'description' => $request->input('description'),
                'start_at' => $request->input('start_at'),
                'end_at' => $request->input('start_at'),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]
        );
        $res['success'] = true;
        $res['message'] = 'Votre évènement à bien été créé.';
        $res['user_information'] = Auth::user();
        return response($res);
    }

    public function dropOneEvent(Request $request)
    {
        DB::delete('delete from events where id = ?', [$request->input('id')]);
        $res['success'] = true;
        $res['message'] = 'Votre évènement à bien été supprimé.';
        return response($res);
    }

    public function modifyOneEvent(Request $request)
    {
        $event_name = $request->input('event_name');
        $description = $request->input('description');
        $start_at = $request->input('start_at');
        $end_at = $request->input('end_at');
        $updated_at = date('Y-m-d H:i:s');

        DB::table('events')
            ->where('id', $request->input('id'))
            ->update(['event_name' => $event_name, 'description' => $description,
                'updated_at' => $updated_at, 'start_at' => $start_at, 'end_at' => $end_at]);
        $res['success'] = true;
        $res['message'] = 'Votre évènement à bien été modifié.';
        return response($res);
    }
}
