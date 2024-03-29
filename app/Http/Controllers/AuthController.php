<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Resources\ApiUserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;


class AuthController extends Controller
{
    //

    public function register(Request $request)
    {

        $data = $request->all();
        // dd("hello");

        $validator = Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8',
            'role' => 'required',
        ]);

        if ($validator->fails()) {
            return self::failure($validator->errors()->first());
        }



        $obj = [
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ];

        $user = User::create($obj);
        $token = $user->createToken('crickbn3')->accessToken;

        $response = [
            'token' => $token,
            'user' => $user,
        ];
        return self::success('User created successfully', ['data' => $response]);
    }


    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        $validator = Validator::make($credentials, [
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        if ($validator->fails()) {
            return self::failure($validator->errors()->first());
        }

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            $token = $user->createToken('crickbn3')->accessToken;

            $response = [
                'token' => $token,
                'user' => $user,
            ];

            return self::success('Login successful', ['data' => $response]);
        } else {
            return self::failure('Invalid credentials', ['data' => $credentials]);
        }
    }

}
