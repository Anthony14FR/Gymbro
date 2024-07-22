<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invitation à rejoindre Gymbro</title>
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
        <h1>Vous êtes invité à rejoindre Gymbro !</h1>
        <p>Madame, Monsieur,</p>
        <p>Nous sommes ravis de vous inviter à rejoindre notre plateforme, Gymbro, où vous pouvez accéder à des programmes de fitness exclusifs, suivre vos progrès et vous connecter avec d'autres passionnés de fitness.</p>
        <p>En tant que membre privilégié, vous aurez accès à :</p>
        <ul>
            <li>Plans d'entraînement personnalisables</li>
            <li>Outils de suivi des progrès</li>
            <li>Événements communautaires exclusifs</li>
            <li>Et bien plus encore !</li>
        </ul>
        <p>Cliquez sur le lien ci-dessous pour nous rejoindre dès maintenant et commencer votre parcours de remise en forme avec nous :</p>
        <div style="text-align: center;">
            <a href="{{route('register')}}" class="button">Rejoindre Gymbro</a>
        </div>
        <p>Si vous avez des questions ou besoin d'assistance, n'hésitez pas à contacter notre équipe de support.</p>
        <p>Nous avons hâte de vous voir sur Gymbro !</p>
        <div class="signature">
            <p>Meilleures salutations,<br>L'équipe Gymbro</p>
        </div>
    </div>
    <div class="footer">
        <p>&copy; 2024 Gymbro. Tous droits réservés.</p>
    </div>
</div>
</body>

</html>
