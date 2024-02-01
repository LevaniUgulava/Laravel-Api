<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Resources\UserResource;
use App\Mail\LoginNotifications;
use App\Models\User;
use Illuminate\Auth\Events\Login;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class Usercontroller extends Controller
{

    public function index()
    {
        $users = User::orderbydesc('id')->get();

        return UserResource::collection($users);
    }
    public function show($id)
    {
        $user = User::with('products')->findorfail($id);

        return UserResource::make($user);
    }

    public function register(RegisterRequest $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return response()->json([
            'message' => 'Registered',
            'token' => $user->createToken("API TOKEN")->plainTextToken,
        ]);
    }

    public function login(LoginRequest $request)
    {
        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json([
                'error' => 'you aret login',
            ]);
        }

        Auth::login($user);
        $this->mail($user);

        return response()->json([
            'message' => 'login succesfully',
            'token' => $user->createToken("API TOKEN")->plainTextToken,
        ]);

    }

    protected function mail($user)
    {
        Mail::to($user->email)->send(new LoginNotifications());
    }

    public function logout(User $user)
    {
        Auth::logout($user);
        return response()->json([
            'message' => 'Logut succesfully',
        ]);
    }
}
