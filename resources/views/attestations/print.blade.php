<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Attestation de Formation</title>
    <style>
        @page {
            size: A4 portrait;
        }
        body {
            font-family: Arial, sans-serif;
            background: url('{{ asset('assets/img/attestation.png') }}') no-repeat center center fixed;
            background-size: cover;
            margin: 0;
            height: 100vh;
            width: 100vw;
            display: flex;
            justify-content: center;
            align-items: center;
            text-align: center;
        }
        .container {
            background: rgba(255, 255, 255, 0.8); /* Optional: To make the text more readable against the background */
            padding: 20px;
            border-radius: 10px;
        }
        h1 {
            font-size: 36px;
            margin-bottom: 20px;
        }
        p {
            font-size: 24px;
            margin: 10px 0;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Attestation</h1>
        <p>Nom complet: {{ $participant->nom_prenom }}</p>
        <p>Date Centre: {{ $participant->created_at->format('d/m/Y') }}</p>
        <p>Nom de la formation: {{ $participant->formation }}</p>
        <p>Catégorie: {{ $participant->categorie }}</p>
    </div>
</body>
</html>
