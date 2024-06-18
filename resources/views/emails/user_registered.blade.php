<!DOCTYPE html>
<html>
<head>
    <title>Account Registration Details</title>
</head>
<body>
    <h1>Hello, {{ $name }}</h1>
    <p>Your account has been successfully created. Here are your login details:</p>
    <p>Email: {{ $email }}</p>
    <p>Password: {{ $password }}</p>
    <p>Please log in to your account and change your password immediately. Additionally, we highly recommend enabling two-factor authentication (2FA) for added security.</p>
    <p>To change your password, log in to your account, go to the account settings, and follow the instructions to update your password.</p>
    <p>To enable 2FA, go to profile settings and scroll down to 2FA. Use authenticator app.</p>
    <p>Thank you!</p>
</body>
</html>
