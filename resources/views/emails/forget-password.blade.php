<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Password Reset</title>
</head>
<body>
<h2>Password Reset Request</h2>
<p>We received a request to reset your password. To reset your password, click the link below:</p>
<a href="{{ route('auth.resetPasswordPage', ['token' => $token]) }}">Reset Password</a>
<p>If you did not request a password reset, please ignore this email.</p>
</body>
</html>
