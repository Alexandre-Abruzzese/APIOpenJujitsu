<?php


namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MediaController extends Controller
{
    public function getLastMedias()
    {
        return DB::table('medias')
            ->orderBy('created_at', 'desc')
            ->take(4)
            ->get();
    }

    public function getAllMedias()
    {
        return DB::table('medias')
            ->orderBy('created_at', 'desc')
            ->get();
    }

    public function getOneMedia(Request $request)
    {
        $this->validate($request, [
            'id' => 'required'
        ]);

        return DB::select('SELECT * FROM medias WHERE id = ?', [$request->input('id')]);
    }
}
