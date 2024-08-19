<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Attestation de Formation</title>
    <style>
        /* Page and print settings */
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

        /* Body styling */
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

        /* Container styling */
        .container {
            position: relative;
            width: 100%;
            height: 100%;
        }

        /* Background image styling */
        .background-image {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1;
        }

        /* Content styling */
        .content {
            position: relative;
            width: 100%;
            height: 100%;
        }

        /* Styling for participant's full name */
        #participant-name {
            position: absolute;
            top: 300px; /* Adjust this value to change the vertical position */
            left: 50%;
            transform: translateX(-50%);
            font-size: 23px;
            font-weight: 700;
        }

        /* Styling for date and center information */
        #p-center {
            position: absolute;
            top: 575px; /* Adjust this value to change the vertical position */
            left: 50%;
            transform: translateX(-50%);
            font-size: 18px;
        }

        /* Styling for category information */
        #p-categ {
            position: absolute;
            top: 610px; /* Adjust this value to change the vertical position */
            left: 45%;
            transform: translateX(-50%);
            font-size: 18px;
        }
    </style>
</head>
<body>
    <div class="container">
        <img src="{{ asset('assets/img/attestation.png') }}" class="background-image">

        <div class="content">
            <!-- Participant's full name -->
            <p id="participant-name">{{ $participant->nom_prenom }}</p>

            <!-- Date and center information -->
            <p id="p-center">Date Centre: {{ $participant->created_at->format('d/m/Y') }}</p>

            <!-- Category information -->
            <p id="p-categ">Catégorie: {{ $participant->categorie }}</p>
        </div>
    </div>
</body>
</html>
