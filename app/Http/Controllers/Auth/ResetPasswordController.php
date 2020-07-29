<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\ResetsPasswords;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    // protected $redirectTo = RouteServiceProvider::HOME;
    protected $redirectTo;
    public function redirectTo()
    {
        switch(Auth::user()->role){
            case 1 : //role 1 adalah admin
                $this->redirectTo = '/admin';
                return $this->redirectTo;
                break;
            case 2 : // role 2 adalah pengurus
                $this->redirectTo = '/pengurus';
                return $this->redirectTo;
                break;
            case 3 : // role 3 adalah jamaah_web
                    $this->redirectTo = '/jamaah_web';
                    return $this->redirectTo;
                    break;
            default :
                $this->redirectTo = '/';
        }
    }
}
