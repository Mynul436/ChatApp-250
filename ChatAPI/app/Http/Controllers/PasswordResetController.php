<?php

namespace App\Http\Controllers;

use App\Models\PasswordReset;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Mail\Message;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Str;
class PasswordResetController extends Controller
{
    //
    public function send_password_reset_email( Request $request){
$request -> validate([
'email' => 'required|email|exists:users'
]);
$email=$request->email;
//create password reset token
$token=Str::random(60);
PasswordReset::create([
'email' => $email,
'token' => $token,
'created_at' => Carbon::now()
]);

dump("http://127.0.0.1:8000/api/user/reset/".$token);
 
Mail::send('reset', ['token' => $token], function (Message $message)use ($email) {

$message->subject('Reset Password Notification');
$message->to($email);

});

return response()->json([
'message' => 'Password reset email sent successfully',
'status' => 'success',
], 201);


    }   
}
