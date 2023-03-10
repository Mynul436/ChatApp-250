<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

/**
 * Summary of UserController
 */
class UserController extends Controller
{
    //
    /**
     * Summary of register
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(Request $request)
    {
        request()->validate([
            'name' => 'required|string',
            'email' => 'required|string|email|unique:users',
            'password' => 'required|string|confirmed',
            'tc' => 'required'
        ]);



        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'tc' => json_decode($request->tc)
        ]);
        $token = $user->createToken($request->email)
            ->plainTextToken;

        return response()->json([
            'token' => $token,
            'message' => 'User registered successfully',
            'status' => 'success',
        ], 201);
    }
    public function Login(Request $request)
    {
        $request->validate([

            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);
        $user = User::where('email', $request->email)->first();
        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json([
                'message' => 'Invalid login details',
                'status' => 'error',
            ], 401);
        } else {
            $token = $user->createToken($request->email)
                ->plainTextToken;
            return response()->json([
                'token' => $token,
                'message' => 'User logged in successfully',
                'status' => 'success',
            ], 201);
        }
    }

    // public function Logout()
    // {
    //     auth()->user()->tokens->delete();
    //     return response()->json([
    //         'message' => 'User logged out successfully',
    //         'status' => 'success',
    //     ], 200);
    // }
public function logout(Request $request)
{
    $request->user()->currentAccessToken()->delete();
    return response()->json([
        'message' => 'User logged out successfully',
        'status' => 'success',
    ], 200);
}

public function logged_user(){
    $getuser=auth()->user();
    return response()->json([
        'user' => $getuser,
        'message' => 'User fetched successfully',
        'status' => 'success',
    ], 200);

}
public function change_password(Request $request){
    $request->validate([
        'password' => 'required|string|confirmed',
    ]);
    $user=auth()->user();
    $user->password=Hash::make($request->password);
    $user->save();
    return response()->json([
        'message' => 'Password changed successfully',
        'status' => 'success',
    ], 200);
}


}