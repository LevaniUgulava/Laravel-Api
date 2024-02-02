<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Resources\UserResource;
use App\Mail\VerifyNotification;
use App\Models\User;
use Illuminate\Auth\Events\Login;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

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
            'verification_token' => Str::random(60),
        ]);
        $this->emailurl($user);
        return response()->json([
            'message' => 'Registered',
            'token' => $user->createToken("API TOKEN")->plainTextToken,
        ]);
    }

    protected function emailurl(User $user)
    {
        $url = url('/verfiy/' . $user->verification_token . '/' . $user->email);
        Mail::to($user->email)->send(new VerifyNotification($url));
    }

    public function verify($token, $email)
    {
        $user = User::where('verification_token', $token)
            ->where('email', $email)
            ->first();

        if (!$user) {
            return response()->json([
                'error' => 'error',
            ], 401);
        }

        $user->update([
            'verification_token' => null,
            'email_verified_at' => now(),
        ]);

        return response()->json([
            'message' => 'verified succesfully',
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
        app(\App\Observers\UserObserver::class)->login($user);
        return response()->json([
            'message' => 'login succesfully',
            'token' => $user->createToken("API TOKEN")->plainTextToken,
        ]);

    }

    public function logout(User $user)
    {
        Auth::logout($user);
        return response()->json([
            'message' => 'Logut succesfully',
        ]);
    }
}
