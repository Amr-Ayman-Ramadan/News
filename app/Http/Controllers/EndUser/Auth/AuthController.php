<?php

namespace App\Http\Controllers\EndUser\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\EndUser\Auth\ResetPasswordRequest;
use App\Http\Requests\EndUser\Auth\ForgetPasswordRequest;
use App\Http\Requests\EndUser\Auth\LoginRequest;
use App\Http\Requests\EndUser\Auth\RegisterRequest;
use App\Http\Traits\FileUploader;
use App\Models\PasswordResetToken;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    use FileUploader;
    public function registerPage()
    {
        return view('EndUser.auth.register');
    }

    public function register(RegisterRequest $request)
    {
        $image = $request->hasFile('image') ? $this->uploadFile($request->file('image'), User::PATH) : null;

        $user = User::create([
            "name" => $request->name,
            "username" => $request->username,
            "phone" => $request->phone,
            "email" => $request->email,
            "password" => bcrypt($request->password),
            "country" => $request->country,
            "city" => $request->city,
            "street" => $request->street,
            "image" => $image,
        ]);
            Auth::login($user);
        toast("User Register Successfully!", "success");
        return to_route('endUser.home');
    }
    public function loginPage()
    {
        return view('EndUser.auth.login');
    }

    public function login(LoginRequest $request)
    {
        $credentials = $request->only('email', 'password');
        $remember = $request->has('remember');
        if (Auth::attempt($credentials, $remember)) {
            toast("User Login Successfully!", "success");
            return to_route('endUser.home');
        }else{
            toast("Wrong Username or Password!", "error");
            return to_route('auth.loginPage');
        }
    }

    public function logout()
    {
        Auth::logout();
        toast("User Logged Out!", "success");
        return to_route('endUser.home');
    }

    public function forgotPasswordPage()
    {
        return view('EndUser.auth.forgot-password');
    }

    public function forgotPassword(ForgetPasswordRequest $request)
    {
        $user = User::where('email', $request->email)->first();

        if (!$user) {
            toast("User Not Found!", "error");
            return to_route('auth.forgotPasswordPage');
        } else {
            $token = Str::random(64);

            PasswordResetToken::create([
                'email' => $request->email,
                'token' => $token,
                'created_at' => now(),
            ]);

            // Send reset email
            Mail::send("emails.forget-password", ["token" => $token], function ($message) use ($request) {
                $message->to($request->email);
                $message->subject("Reset Password");
            });

            toast("Password reset link has been sent to your email.", "success");
            return to_route('auth.login');
        }
    }

    public function resetPasswordPage($token)
    {
        return view('EndUser.auth.reset-password', ['token' => $token]);
    }

    public function resetPassword(ResetPasswordRequest $request)
    {
        // Validate the token
        $resetToken = PasswordResetToken::where('token', $request->token)->first();

        if (!$resetToken) {
            toast("Invalid or expired token", "error");
            return to_route('auth.forgotPasswordPage');
        }

        $user = User::where('email', $resetToken->email)->first();

        if (!$user) {
            toast("User not found!", "error");
            return to_route('auth.forgotPasswordPage');
        }

        $user->password = bcrypt($request->password);
        $user->update([
            'password' => $user->password,
        ]);

        $resetToken->delete();

        toast("Your password has been successfully reset!", "success");
        return to_route('auth.login');
    }

}
