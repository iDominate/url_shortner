<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginUserRequest;
use App\Http\Requests\RegisterUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;

class UserController extends Controller
{
    public function register(RegisterUserRequest $request)
    {
        User::create([
            'name' => $request->name,
            'password' => bcrypt($request->password),
            'email' => $request->email
        ]);
        return response()->with(data: 'User Created Successfully', code: Response::HTTP_CREATED, status: 'ok');
    }

    public function login(LoginUserRequest $request)
    {
        $user = User::where('email', $request->email)->first();
        if (!Hash::check($request->password, $user->password) || $user == null) {
            return response()->with(data: 'Invalid Credentials', code: Response::HTTP_BAD_REQUEST, status: 'error');

        }
        return response()->with(data: [
            'token' => $user->createToken('apiToken')->plainTextToken
        ], code: Response::HTTP_OK, status: 'ok');

    }
}