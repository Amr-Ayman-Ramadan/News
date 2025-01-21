@extends("Layouts.EndUser.app")

@section("content")
    <div class="user-form-container">
        <h2>Login</h2>
        <form id="loginForm" action="{{ route('auth.login') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" placeholder="Enter email address" value="{{ old('email') }}" required>
                @error('email')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" placeholder="Enter password" required>
                @error('password')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label>
                    <input type="checkbox" name="remember" id="remember"> Remember Me
                </label>
            </div>

            <div class="form-group">
                <button type="submit" class="btn-submit">Login</button>
            </div>

            <div class="form-group">
                <a href="{{ route('auth.forgotPasswordPage') }}" class="forgot-password">Forgot Password?</a>
            </div>
        </form>
    </div>
@endsection

@push("css")
    <style>
        #loginForm {
            width: 100%;
            max-width: 400px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 8px;
            background-color: #f9f9f9;
        }

        .form-group {
            margin-bottom: 15px;
        }

        label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }

        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 14px;
        }

        .btn-submit {
            display: inline-block;
            background-color: #007bff;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }

        .btn-submit:hover {
            background-color: #0056b3;
        }

        .forgot-password {
            display: inline-block;
            margin-top: 10px;
            color: #007bff;
            text-decoration: none;
            font-size: 14px;
        }

        .forgot-password:hover {
            text-decoration: underline;
        }

        .text-danger {
            color: #dc3545;
            font-size: 13px;
            margin-top: 5px;
        }
    </style>
@endpush
