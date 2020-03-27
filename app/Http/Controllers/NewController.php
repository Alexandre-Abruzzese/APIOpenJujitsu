<?php


namespace App\Http\Controllers;


use Illuminate\Support\Facades\DB;

class NewController
{
    public function getNews()
    {
        return DB::table('news')
        ->orderBy('description', 'desc')
        ->take(3)
        ->get();
    }
}
