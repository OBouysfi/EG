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
        @media print {
            body, html {
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
                margin: 0;
                padding: 0;
                height: 100%;
                width: 100%;
            }
            .background {
                background: url('{{ asset('assets/img/diplome.jpg') }}') no-repeat center center;
                background-size: cover;
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                z-index: -1;
            }
        }
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            height: 100vh;
            width: 100vw;
            display: flex;
            justify-content: center;
            align-items: center;
            text-align: center;
            position: relative;
            overflow: hidden;
        }
        .background {
            background: url('{{ asset('assets/img/diplome.jpg') }}') no-repeat center center;
            background-size: cover;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1;
        }
        .field {
            position: absolute;
            font-size: 16px;
            font-weight: 700;
        }
        #nom {
            top: 45%;
            left: 30%;
        }
        #cin {
            top: 45%;
            left: 60%;
        }
        #date_naissance {
            top: 50%;
            left: 40%;
        }
        #lieu_naissance {
            top: 50%;
            right: 30%;
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
    <div class="background"></div>
    <div id="nom" class="field">{{ $participant->nom_prenom }}</div>
    <div id="cin" class="field">CIN:  {{ $participant->numero_cin }}</div>
    <div id="date_naissance" class="field">{{ $participant->date_naissance }}</div>
    <div id="lieu_naissance" class="field">{{ $participant->ville_naissance }}</div>
    <div id="annee" class="field">{{ $participant->created_at->format('Y') }}</div>
    <div id="date_delivrance" class="field">{{ $participant->created_at->format('d/m/Y') }}</div>
</body>
</html>
