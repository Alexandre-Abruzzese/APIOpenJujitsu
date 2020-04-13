<?php


namespace App\Http\Controllers;


use Illuminate\http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ScheduleController extends Controller
{
    public function getAllSessions()
    {
        return DB::table('schedule')
            ->orderBy('created_at', 'desc')
            ->take(6)
            ->get();
    }

    public function getOneSession(Request $request)
    {
        $this->validate($request, [
            'id' => 'required'
        ]);

        return DB::select('SELECT * FROM schedule WHERE id = ?', [$request->input('id')]);
    }

    public function addASession(Request $request)
    {
        DB::table('schedule')->insert(
            [
                'location' => $request->input('location'),
                'begin_at' => $request->input('begin_at'),
                'end_at' => $request->input('end_at'),
                'date' => $request->input('date'),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]
        );
        $res['success'] = true;
        $res['message'] = 'Votre session a bien été créé.';
        return response($res);
    }

    public function dropOneSession(Request $request)
    {
        DB::delete('delete from schedule where id = ?', [$request->input('id')]);
        $res['success'] = true;
        $res['message'] = 'Votre session a bien été supprimé.';
        return response($res);
    }

    public function modifyOneSession(Request $request)
    {
        $location = $request->input('location');
        $begin_at = $request->input('begin_at');
        $end_at = $request->input('end_at');
        $date = $request->input('date');
        $updated_at = $request->input('update_at');

        DB::table('schedule')
            ->where('id', $request->input('id'))
            ->update(['location' => $location, 'begin_at' => $begin_at,
                'end_at' => $end_at, 'date' => $date, 'update_at' => $updated_at]);

        $res['success'] = true;
        $res['message'] = 'Votre session a bien été modifié.';
        return response($res);
    }
}
