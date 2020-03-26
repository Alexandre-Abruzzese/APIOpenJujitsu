<?php


namespace App\Http\Controllers;


use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Laravel\Lumen\Http\Request;

class UserController extends Controller
{
    public function getAccountInformations(Request $request)
    {
        if (Auth::user()) {
            return Auth::user();
        }
    }
}
