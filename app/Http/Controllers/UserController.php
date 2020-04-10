<?php


namespace App\Http\Controllers;


use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function updateActiveUser(Request $request)
    {
        $this->validate($request, [
            'lastname' => 'required',
            'is_active' => 'required'
        ]);

        DB::table('users')
            ->where('lastname', $request->input('lastname'))
            ->update(['is_active' => $request->input('is_active')]);
    }
}
