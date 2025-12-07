<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Login Notification</title>
</head>
<body>
    <h2>Login Notification</h2>
    <p>Hello, {{ $user->name ?? $user->email }}!</p>
    <p>You have just logged in to your account using Google.</p>
    <p>If this was not you, please secure your account immediately.</p>
    <br>
    <p>Thank you,<br>Thrifting Store Team</p>
</body>
</html>
