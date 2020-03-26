<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ConnexionController extends Controller
{
    public function login(Request $request)
    {
        $email = $request->input('email');
        $password = $request->input('password');

        $login = DB::table('users')->where('email', $email)->first();
        if (!$login) {
            $res['success'] = false;
            $res['message'] = 'Email ou Mot de passe incorrect';
            return response($res);
        } else {
            if (Hash::check($password, $login->password)) {
                $api_token = sha1(time());
                $create_token = DB::table('users')->where('email', $login->email)->update(['api_token' =>
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
            'username' => 'required',
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $hashedPassword = Hash::make($request->input('password'));

        DB::table('users')->insert(
            [
                'username' => $request->input('username'),
                'email' => $request->input('email'),
                'password' => $hashedPassword,
                'api_token' => sha1(time()),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]
        );
        return $hashedPassword;
    }

    public function logout(Request $request)
    {
        $api_token = $request->header('api_token');
        if ($api_token != "0") {
            DB::table('users')->where('api_token', $api_token)->update(['api_token' => 0]);
            $res['success'] = true;
            $res['message'] = 'Vous êtes bien déconnecté.';
            return response($res);
        }
        $res['success'] = false;
        $res['message'] = 'Erreur lors de la deconnection.';
        return response($res);
    }
}
