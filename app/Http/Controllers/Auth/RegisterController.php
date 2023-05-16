<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Profile;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function register(Request $request)
    {

        $user = User::where('email', $request['email'])->first();

        if ($user) {
            return response()->json(['message' => 'Email already registered'], 409);
        }

        $user = User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
        ]);

        $token = $user->createToken('AuthToken')->plainTextToken;

        return response()->json(['message' => 'Successful registration', 'user' => $user, 'token' => $token], 201);
    }
}
