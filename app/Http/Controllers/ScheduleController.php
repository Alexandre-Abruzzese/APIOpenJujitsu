<?php


namespace App\Http\Controllers;


use Illuminate\http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Schedule;

class ScheduleController extends Controller
{
    public function getAllSessions()
    {
        $schedules = Schedule::orderBy('created_at','desc')->take(6)->get();
        return $schedules;
    }

    public function getOneSession(Request $request)
    {
        $this->validate($request, [
            'id' => 'required'
        ]);
        $schedule = Schedule::find($request->input('id'));
        return $schedule;
    }

    public function addASession(Request $request)
    {
        $schedule = new Schedule();
        $schedule->location = $request->input('location');
        $schedule->begin_at = $request->input('begin_at');
        $schedule->end_at = $request->input('end_at');
        $schedule->date = $request->input('date');

        $schedule->save();

        $res['success'] = true;
        $res['message'] = 'Votre session a bien été créé.';
        return response($res);
    }

    public function dropOneSession(Request $request)
    {
        Schedule::find($request->input('id'))->delete();
        if(Schedule::find($request->input('id')) == null){
            $res['success'] = true;
            $res['message'] = 'Votre session a bien été supprimé.';
            return response($res);
        }
        $res['success'] = false;
        $res['message'] = "Votre session n'a pas bien été supprimé.";
        return response($res);
    }

    public function modifyOneSession(Request $request)
    {
        $schedule = Schedule::find($request->input('id'));
        $schedule->location = $request->input('location');
        $schedule->begin_at = $request->input('begin_at');
        $schedule->end_at = $request->input('end_at');
        $schedule->date = $request->input('date');
        $schedule->updated_at = $request->input('update_at');

        $schedule->save();

        $res['success'] = true;
        $res['message'] = 'Votre session a bien été modifié.';
        return response($res);
    }
}
