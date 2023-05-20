<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function register(Request $request)
    {
        $user = User::create([
            'name' => $request->get('login'),
            'email' => $request->get('email'),
            'password' => Hash::make($request->get('password')),
        ]);
        $token = $user->createToken('Access Token')->accessToken;
        $data = [
            $user,
            'access_token' => $token,
        ];

        return $this->susscesResponse($data);
    }

    public function login(Request $request)
    {
        if (Auth::attempt(['name' => $request->get('login'), 'password' => $request->get('password')])) {

            $user = Auth::user();
            $data = [
                'user' => $user,
                'token' => $user->createToken('User Token')->accessToken
            ];

            return $this->susscesResponse($data);
        } else {
            return $this->failResponse('Login failed or user not found');
        }

    }
    public function index(Request $request)
    {
        return $this->susscesResponse(User::findById($request->user()->id));
    }

    public function getUser(Request $request, $id)
    {
        return $this->susscesResponse(User::findById($id));
    }
}
