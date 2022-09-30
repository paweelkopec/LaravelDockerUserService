<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class UserController extends Controller
{
    public function register(Request $request)
    {
        $validatedData = $request->validate([
            'username' => 'required|string|max:255|unique:users',
            'full_name' => 'required|string|max:255',
            'address' => 'required|string',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
        ]);

        $user = User::create([
            'username' => $validatedData['username'],
            'full_name' => $validatedData['full_name'],
            'address' => $validatedData['address'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
        ]);

        $token = $user->createToken('auth_token', ['user:update','user:list'])->plainTextToken;

        return response()->json([
            'user' => $user->toArray(),
            'access_token' => $token,
            'token_type' => 'Bearer',
        ],201);
    }

    public function userList(Request $request)
    {
        return User::all(['id','username','full_name','address','email']);
    }

    public function detail(User $user)
    {
        return $user->toArray();
    }

    public function update(Request $request, User $user)
    {
        $validatedData = $request->validate([
            'full_name' => 'required|string|max:255',
            'address' => 'required|string',
            'email' => 'required|string|email|max:255|unique:users',
        ]);
        $user->update($validatedData );
        return response()->json( $user);
    }

    public function delete( User $user)
    {
        $user->tokens()->delete();
        $user->delete();
        return response()->json(null, 204);
    }
}
