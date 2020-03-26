<?php


namespace App\Http\Controllers;


use Illuminate\Support\Facades\DB;

class MediaController extends Controller
{
    public function getMedias()
    {
        return DB::table('medias')
            ->orderBy('created_at', 'desc')
            ->take(4)
            ->get();
    }
}
