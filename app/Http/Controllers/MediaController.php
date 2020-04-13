<?php


namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Media;

class MediaController extends Controller
{
    public function getLastMedias()
    {
        $media = Media::orderBy('created_at','desc')->take(4)->get();
        return $media;
    }

    public function getAllMedias()
    {
        $media = Media::orderBy('created_at','desc')->get();
        return $media;
    }

    public function getOneMedia(Request $request)
    {
        $this->validate($request, [
            'id' => 'required'
        ]);
        $media = Media::find($request->input('id'));
        return $media;
    }
}
