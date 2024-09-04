<!DOCTYPE html>
<html>
<head>
    <title>{{ config('app.name') }}</title>
</head>
<body>
    <h1>Hello, {{ $user->name }}</h1>
    <p>Your account has been created successfully. Here are your login details:</p>
    <p>Email: {{ $user->email }}</p>
    <p>Password: {{ $password }}</p>
    <p>Please change your password after logging in.</p>
</body>
</html>
