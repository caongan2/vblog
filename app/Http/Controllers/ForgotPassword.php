<?php

namespace App\Http\Controllers;

use App\Jobs\SendEmail;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ForgotPassword extends Controller
{
    public function showFormForgotPass()
    {
        return view('customer.forgot_pass');
    }

    public function sendMailReset(Request $request)
    {
        $user = User::where('email', $request->email)->get()->first();
        $timestamp = Carbon::now()->toDateTimeString();
        $token = Hash::make($timestamp);
        $user->remember_token = $token;
        $user->save();

        $users = User::all();
        $message = [
            'type' => 'Success',
            'task' => $user->name,
            'content' => 'Email reset your password',
            'reset_link' => 'http://v-blog-low-bubget.herokuapp.com/public/resetPass?token='.$token
        ];

        SendEmail::dispatch($message, $users)->delay(now()->addMinute(1));
        return redirect()->back();
    }

    public function formResetPassword(Request $request)
    {
        $token = $request->token;
        return view('customer.reset_pass', compact('token'));
    }

    public function resetPassword(Request $request)
    {
        $token = $request->token;
//        dd($token);
        $password = Hash::make($request->password);
        $user = User::where('remember_token', $token)->get()->first();
//        dd($user->name);
        $user->password = $password;
//        dd($user->password);
        $user->save();
        return redirect()->route('login');
    }
}
