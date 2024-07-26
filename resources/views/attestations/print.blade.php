<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Attestation de Formation</title>
    <style>
        @page {
            size: A4 portrait;
            margin: 0;
        }
        @media print {
            body {
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
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
            background: none;
        }
        .container {
            position: relative;
            width: 100%;
            height: 100%;
        }
        .background-image {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1;
        }
        .content {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            padding: 20px;
            border-radius: 10px;
        }
        h1 {
            font-size: 36px;
            margin-bottom: 20px;
        }
        p {
            font-size: 23px;
            margin-bottom: 120px;
            font-weight: 700;
        }
        #formation {
            margin: 180px 0;
        }
        #p-center{
            font-size: 18px;
            margin-bottom: 120px;
        }
        #p-categ{
            font-size: 18px;
            margin-bottom: 40px;
        }
    </style>
</head>
<body>
    <div class="container">
        <img src="{{ asset('assets/img/attestation.png') }}" class="background-image">
        <div class="content">
            <p>{{ $participant->nom_prenom }}</p>
            <p id="p-center">Date Centre: {{ $participant->created_at->format('d/m/Y') }}</p>
            {{-- <p id="formation">Nom de la formation: {{ $participant->formation }}</p> --}}
            <p id="p-categ">Catégorie: {{ $participant->categorie }}</p>
        </div>
    </div>
</body>
</html>
