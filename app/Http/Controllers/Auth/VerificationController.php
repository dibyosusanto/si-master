<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\VerifiesEmails;
use Auth;

class VerificationController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Email Verification Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling email verification for any
    | user that recently registered with the application. Emails may also
    | be re-sent if the user didn't receive the original email message.
    |
    */

    use VerifiesEmails;

    /**
     * Where to redirect users after verification.
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
                $this->redirectTo = '/login';
        }
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('signed')->only('verify');
        $this->middleware('throttle:6,1')->only('verify', 'resend');
    }
}
