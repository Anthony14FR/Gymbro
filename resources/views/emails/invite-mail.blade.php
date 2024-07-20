<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invitation to Join Gymbro</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            background-color: #F3F4F6;
            font-family: Arial, sans-serif;
        }
        .container {
            width: 100%;
            padding: 20px;
            background-color: #1F2937;
        }
        .content {
            max-width: 600px;
            margin: 0 auto;
            background-color: #111827;
            padding: 20px;
            border-radius: 8px;
            color: #FFFFFF;
        }
        .header, .footer {
            text-align: center;
            padding: 10px;
        }
        .header img {
            margin-left: auto;
            margin-right: auto;
            width: 6rem;
            height: auto;
        }
        h1 {
            color: #00B29F;
            font-size: 24px;
            margin-bottom: 20px;
        }
        p, ul {
            font-size: 16px;
            line-height: 1.5;
            margin-bottom: 20px;
        }
        ul {
            list-style-type: disc;
            padding-left: 20px;
        }
        .button {
            display: inline-block;
            padding: 10px 20px;
            background-color: #00B29F;
            color: #FFFFFF;
            text-decoration: none;
            border-radius: 4px;
            margin: 20px auto;
            text-align: center;
        }
        .footer {
            margin-top: 20px;
            font-size: 14px;
            color: #9CA3AF;
        }
        .signature {
            text-align: right;
            margin-top: 20px;
        }
    </style>
</head>

<body>
<div class="container">
    <div class="header">
        <img src="{{ asset('images/logo.svg') }}" alt="Gymbro">
    </div>
    <div class="content">
        <h1>You're Invited to Join Gymbro!</h1>
        <p>Dear Sir/Madam,</p>
        <p>We are excited to invite you to join our platform, Gymbro, where you can access exclusive fitness programs, track your progress, and connect with other fitness enthusiasts.</p>
        <p>As a valued member, you will have access to:</p>
        <ul>
            <li>Customizable workout plans</li>
            <li>Progress tracking tools</li>
            <li>Exclusive community events</li>
            <li>And much more!</li>
        </ul>
        <p>Click the link below to join now and start your fitness journey with us:</p>
        <div style="text-align: center;">
            <a href="{{route('register')}}" class="button">Join Gymbro</a>
        </div>
        <p>If you have any questions or need assistance, feel free to contact our support team.</p>
        <p>We look forward to seeing you on Gymbro!</p>
        <div class="signature">
            <p>Best regards,<br>The Gymbro Team</p>
        </div>
    </div>
    <div class="footer">
        <p>&copy; 2024 Gymbro. All rights reserved.</p>
    </div>
</div>
</body>

</html>
