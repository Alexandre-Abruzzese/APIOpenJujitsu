<?php


namespace App\Http\Controllers;

use App\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ConnexionController extends Controller
{

    public function hashPassword(Request $request){
        $email = isset($_GET['email']) ? $_GET['email']:$request->input('email');
        $user = User::Where('email', $email)->first();
        $res['password'] = $user->password;
        $res['success'] = true;
        $res['secret'] = sha1(time());
        $user->token = $res['secret'];
        $user->save();
        return response($res);
    }

    public function login(Request $request)
    {
        $token = $request->input('secret');
        $passwordCheck = $request->input('passwordCheck');

        $login = User::where('token', $token)->first();
        if (!$login) {
            $res['success'] = false;
            $res['message'] = 'Email ou Mot de passe incorrect';
            return response($res);
        } else {
            if ($passwordCheck) {
                $api_token = sha1(time());
                $create_token = User::where('email', $login->email)->update(['api_token' =>
                    $api_token]);
                if ($create_token) {
                    $res['success'] = true;
                    $res['api_token'] = $api_token;
                    $res['message'] = $login;
                    return response($res);
                }
                $res['success'] = false;
                $res['api_token'] = "Erreur lors de la création du jeton de connection";
                return response($res);
            }
        }
        $res['success'] = false;
        $res['message'] = 'Email ou Mot de passe incorrect';
        return response($res);
    }

    public function register(Request $request)
    {
        $this->validate($request, [
            'firstname' => 'required',
            'lastname' => 'required',
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $hashedPassword = Hash::make($request->input('password'));

        $newUser = new User();
        $newUser->firstname = $request->input('firstname');
        $newUser->lastname = $request->input('lastname');
        $newUser->email = $request->input('email');
        $newUser->password = $hashedPassword;
        $newUser->api_token = sha1(time());
        $newUser->is_active = 1;
        $newUser->save();

        return $hashedPassword;
    }

    public function logout(Request $request)
    {
        $api_token = $request->header('api_token');
        if ($api_token != "0") {
            User::where('api_token', $api_token)->update(['api_token' => 0]);
            $res['success'] = true;
            $res['message'] = 'Vous êtes bien déconnecté.';
            return response($res);
        }
        $res['success'] = false;
        $res['message'] = 'Erreur lors de la deconnection.';
        return response($res);
    }
}
