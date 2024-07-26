<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Certificat de Formation</title>
    <style>
        @page {
            size: A4 landscape;
            margin: 0;
        }
        body {
            font-family: Arial, sans-serif;
            background: url('{{ asset('assets/img/diplome.jpg') }}') no-repeat center center;
            background-size: 100% 100%;
            margin: 0;
            height: 100vh;
            width: 100vw;
            position: relative;
        }
        .field {
            position: absolute;
            font-size: 16px;
            font-weight: 700;
        }
        #nom {
            top: 41%;
            left: 13%;
        }
        #cin {
            top: 44%;
            left: 14%;
        }
        #date_naissance {
            top: 50%;
            left: 40%;
        }
        #lieu_naissance {
            top: 50%;
            right: 45%;
        }
        #formation {
            top: 45%;
            left: 50%;
            transform: translateX(-50%);
            width: 80%;
            text-align: center;
        }
        #annee {
            bottom: 34.5%;
            left: 21%;
        }
        #date_delivrance {
            bottom: 30%;
            left: 20%;
        }
    </style>
</head>
<body>
    <div id="nom" class="field">{{ $participant->nom_prenom }}</div>
    <div id="cin" class="field">{{ $participant->numero_cin }}</div>
    <div id="date_naissance" class="field">{{ $participant->date_naissance }}</div>
    <div id="lieu_naissance" class="field">{{ $participant->ville_naissance }}</div>
    <div id="annee" class="field">{{ $participant->created_at->format('Y') }}</div>
    <div id="date_delivrance" class="field">{{ $participant->created_at->format('d/m/Y') }}</div>
</body>
</html>