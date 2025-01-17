<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Auth\LoginRequest;
use App\Http\Requests\Admin\Auth\resetPasswordRequest;
use App\Models\Admin;
use App\Notifications\SendOtpNotification;
use Ichtrojan\Otp\Otp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public $otp2;
    public function __construct()
    {
        $this->otp2 = new Otp();
    }

    public function loginPage()
    {
        return view('Dashboard.Auth.login');
    }
    public function login(LoginRequest $request)
    {
        $credentials = [
            'email' => $request->input('email'),
            'password' => $request->input('password'),
            'remember_token' => $request->input('remember_token', false),
        ];
        if (Auth::attempt(['email' => $credentials['email'], 'password' => $credentials['password']],$credentials['remember_token'])) {
            toast("Login Successful", "success");
            return redirect()->intended(route('admin.dashboard'));
        }
        return to_route('auth.loginPage')->with("error", "Email or Password invalid");
    }
    public function logout()
    {
        Auth::logout();
        return redirect()->intended(route('auth.loginPage'));
    }

    public function forgotPasswordPage()
    {
        return view('Dashboard.Auth.forgotPassword');
    }
    public function forgotPassword(Request $request)
    {
        $validated = $request->validate(['email' => 'required|email|exists:admins,email']);
        $admin = Admin::where('email', $validated['email'])->first();
        if ($admin) {
            $admin->notify(new SendOtpNotification());
            return to_route('auth.confirmPage',["email"=>$admin->email])->with("success", "OTP send to your email");
        }
    }
    public function confirmPage($email)
    {
        return view('Dashboard.Auth.confirm', compact('email'));
    }
    public function verifyOtp(Request $request)
    {
             $request->validate([
                'email' => 'required|email|exists:admins,email',
                'otp' => 'required|numeric|digits:4',
            ]);
          $otp =  $this->otp2->validate($request->email , $request->otp);

          if ($otp->status == false) {
              return back();
          }
          return to_route('auth.resetPasswordPage',['email'=>$request->email])->with("success", "OTP verified");
    }
    public function resetPasswordPage($email)
    {
        return view('Dashboard.Auth.resetPassword', compact('email'));
    }
    public function resetPassword(resetPasswordRequest $request)
    {
        $admin = Admin::where("email",$request->get('email'))->first();
        if (!$admin) {
            return back()->with("error", "Admin not found");
        }
        $admin->update(['password' => Hash::make($request->get('password'))]);
        return to_route('auth.loginPage')->with("success", "Password reset successfully");
    }
}
