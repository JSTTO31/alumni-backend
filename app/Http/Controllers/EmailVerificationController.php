<?php

namespace App\Http\Controllers;

use App\Models\OTP;
use App\Notifications\EmailVerification;
use App\Notifications\EmailVerificationNotification;
use Carbon\Carbon;
use Illuminate\Http\Request;

class EmailVerificationController extends Controller
{
    public function sendVerification(Request $request){
        $otp = OTP::where('user_id', $request->user()->id)->first();

        if(!$otp){
            $random = rand(100000, 999999);
            $otp = $request->user()->otp()->create([
                'otp_code' => $random,
                'expires_at' => now()->addMinutes(2),
            ]);
            $request->user()->notify(new EmailVerificationNotification($otp));
        }

        if(Carbon::now() > Carbon::parse($otp->expires_at)){
            $random = rand(100000, 999999);

            $otp->otp_code = $random;
            $otp->expires_at = now()->addMinutes(2);
            $otp->save();

            $request->user()->notify(new EmailVerificationNotification($otp));
        }

        return [
            'expires_at' => $otp->expires_at,
        ];
    }

    public function verify(Request $request){
        $request->validate([
            'codes' => ['required'],
        ]);

        $otp = OTP::where('user_id', $request->user()->id)->first();

        if(!$otp || Carbon::now() > Carbon::parse($otp->expires_at)){
            return response([
                'message' => ['The verification code has expired. Please request a new code to proceed with the verification process.'],
            ], 410);
        }

        if($otp->otp_code == $request->codes){
            $request->user()->email_verified_at = now();
            $request->user()->save();
            return response($request->user(), 200);
        }

        return response([
            'message' => ['Sorry, the given code does not match our records.']
        ], 400);
    }
}
