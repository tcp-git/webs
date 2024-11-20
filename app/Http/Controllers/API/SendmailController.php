<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use App\Mail\SendMail;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;

class SendmailController extends Controller
{
    public function sendEmail()
    {
        $toEmail = 'teerawat.jo@invitracehealth.com';
        $message = 'Welcome to Programming Fields';
        $subject = 'Setting Password';
        $name = 'Teerawat';
        $otp = '999999';
        $ref = 'AsDx';

        $response =  Mail::to($toEmail)->send(new SendMail($message, $subject, $name, $otp, $ref ));
        dd($response);
    }
    public function sendEmailbyEmail(string $email)
    {

        $user = User::where('email', $email)->first();
       
        if($user){
            $toEmail = $email;
            $message = 'Welcome to Programming Fields';
            $subject = 'Setting Password';
            $name = $user->name;
            $otp = str_pad(mt_rand(0, 999999), 6, '0', STR_PAD_LEFT);
            $ref = Str::random(4);
    
            $response =  Mail::to($toEmail)->send(new SendMail($message, $subject, $name, $otp, $ref));
            return response()->json(['message'=> 'ok'],201);
        }
        return response()->json(['message' => 'email error'], 403);
        
    }


}
