<!-- resources/views/verification.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email Verification</title>
</head>
<body>
    <h1>Welcome to YourApp!</h1>
    <p>Thank you for signing up. To get started, please verify your email address by clicking the link below:</p>

   <a href="{{$url}}">verify</a>

    <p>If you did not create an account, no further action is required.</p>

    <p>Thanks,<br>
    YourApp Team</p>
</body>
</html>
