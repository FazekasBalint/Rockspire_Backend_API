<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RockSpire Fesztivál - Üdvözlünk!</title>
    <style>
        body {
            font-family: 'Courier New', monospace;
            color: white;
            margin: 0;
            padding: 0;
            text-align: center;
        }
        .container {
            max-width: 1000px;
            margin: 100px auto;
            background: rgba(0, 0, 0, 0.9);
            padding: 50px;
            border-radius: 25px;
            border: 4px solid #ff6600;
            text-align: center;
            box-shadow: 0 0 25px rgba(255, 0, 0, 1);
        }
        .logo {
            width: 250px;
            margin-bottom: 40px;
        }
        .headline {
            font-size: 42px;
            font-weight: bold;
            text-transform: uppercase;
            color: #ff6600;
            text-shadow: 4px 4px 10px rgba(255, 100, 0, 0.9);
        }
        .content {
            font-size: 26px;
            line-height: 2.2;
            margin-top: 40px;
            color: #ffffff;
            text-align: center;
        }
        .footer {
            margin-top: 50px;
            font-size: 18px;
            color: #bbbbbb;
            border-top: 2px solid #ff6600;
            padding-top: 20px;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="headline">RockSpire Fesztivál - Üdvözlünk!</div>
        <div class="content">
            <p>Kedves {{ $user->name }}🤘</p>
            <p>Üdvözlünk a <strong>RockSpire Fesztivál</strong> közösségében! Köszönjük, hogy regisztráltál  mostantól első kézből értesülhetsz a legfrissebb hírekről, fellépőkről és programokról.</p>
            <p>A fesztivállal kapcsolatos minden részletet, jegyinformációt és további tudnivalókat megtalálsz hivatalos weboldalunkon</p>
            <p>Ha bármilyen kérdésed van, fordulj hozzánk bizalommal! 🎸</p>
        </div>
        <div class="footer">
            {{ date('Y') }} RockSpire Fesztivál. Minden jog fenntartva.
        </div>
    </div>
</body>
</html>
