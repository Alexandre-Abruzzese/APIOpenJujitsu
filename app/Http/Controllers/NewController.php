<?php


namespace App\Http\Controllers;


use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\News;
class NewController
{
    public function getNews()
    {
        $news = News::orderBy('created_at', 'desc')->take(3)->get();
        return $news;
    }

    public function addANews(Request $request)
    {
        $news = new News();
        $news->title = $request->get('title');
        $news->description = $request->get('description');
        $news->linkURL = $request->get('linkURL');
        if($news->save()){
            $res['success'] = true;
            $res['message'] = 'Votre news à bien été ajouté';
            return response($res);
        }
        $res['success'] = false;
        $res['message'] = 'Une erreur est survenue';
        return response($res);
    }
}
