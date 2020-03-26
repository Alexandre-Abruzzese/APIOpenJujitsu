<?php


namespace App\Http\Controllers;


use App\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Lumen\Http\Request;

class UserController extends Controller
{
    public function __construct()
    {
        $user = User::find(1);
        Auth::login($user);
    }

    public function getAccountInformations(Request $request)
    {
        return "ok";
    }
}
