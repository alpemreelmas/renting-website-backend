<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Api\ApiController;
use App\Http\Requests\Auth\AuthLogin;
use App\Http\Requests\Auth\AuthRegister;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends ApiController
{
    public function register(AuthRegister $request){
        $user = User::create($request->validated());
        $user->assignRole("user");
        $user->sendEmailVerificationNotification();
        return $this->successResponse("Başarılı bir şekilde giriş yaptınız. Lütfen email adresinizi onaylayınız.");
    }

    public function login(AuthLogin $request)
    {
        if(Auth::attempt(["email"=>$request->email,"password"=>$request->password],$request->remember_me)){
            $response = [
                "user" => auth()->user(),
                "token" => auth()->user()->createToken("token_name")->plainTextToken
            ];
            return $this->successResponse($response);
        }
        return $this->errorResponse("Böyle bir kullanıcı bulunamadı.",404);
    }


    public function verify_resend(Request $request) {
        $request->user()->sendEmailVerificationNotification();
        return back()->with('success', 'Onaylama e-postası terkardan gönderildi.');
    }
}
