<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginUserRequest;
use App\Http\Requests\RegisterUserRequest;
use App\Mail\SendMail;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Request;

class AuthController extends Controller
{
    public function register(RegisterUserRequest $request){
        $validated = $request->validated();

        $user = User::create($validated);
        $token = $user->createToken('authToken')->plainTextToken;
        $validated['password'] = bcrypt($validated['password']);

        Mail::to($user->email)->send(new SendMail($user));

        return response()->json([
            'user' => $user,
            'token' => $token
        ], 201);
    }

    public function login(LoginUserRequest $request){
        $validated = $request->validated();
        if (!Auth::attempt($validated)) {
            return response()->json(['message' => 'Hibás felhasználónév vagy jelszó'], 401);
        }

        /** @var User $user */
        $user = Auth::user();
        $token = $user->createToken('authToken',['*'],now()->addMinutes(30))->plainTextToken;

        return response()->json([
            'user' => $user,
            'token' => $token
        ], 200);
    }

    public function logout() {
        /** @var User $user */
        $user = Auth::user();

        $user->currentAccessToken()->delete();
        return response()->json(['message' => 'Kijelentkezve'], 200);
    }


    public function sendEmail(Request $request){
        $user=Auth::user();

        $Nametext = $user->name;
        Mail::to($user->email)->send(new SendMail($Nametext));
        return response()->json(["error" => false, "message" => "Email sikeresen elküldve."], 200);
    }


}


