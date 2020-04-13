<?php


namespace App\Http\Controllers;


use Illuminate\Support\Facades\DB;
use App\News;
class NewController
{
    public function getNews()
    {
        $news = News::orderBy('created_at', 'desc')->take(3)->get();
        return $news;
    }
}
