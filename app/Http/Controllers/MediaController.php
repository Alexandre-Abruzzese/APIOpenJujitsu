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

    public function addAMedia(Request $request){
        $this->validate($request, [
            'path' => 'max:255',
            'description' => "max:255",
            'type' => 'required'
        ]);
        if($request->get('path') == null){
            $res['success'] = false;
            $res['message'] = "Aucun fichier uploader ni d'url ";

            return response($res);
        }

        $media = new Media();

        $media->description = $request->input('description');
        $media->type = $request->input('type');
        $media->path = $request->input('path');

        $media->save();

        $res['success'] = true;
        $res['message'] = "Le fichier à bien été uploader";

        return response($res);
    }
}
