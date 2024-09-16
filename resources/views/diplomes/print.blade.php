<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Diplôme de Formation</title>
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
                height: 210mm;
                width: 297mm;
            }

            .background {
                width: 297mm;
                height: 210mm;
                background-size: cover;
                position: fixed;
                top: 0;
                left: 0;
                z-index: -1;
            }

            .no-print {
                display: none;
            }

            .field {
                position: absolute !important;
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
            position: relative;
            overflow: hidden;
        }

        .background {
            width: 297mm;
            height: 210mm;
            background: url('{{ asset('assets/img/diplome.jpg') }}') no-repeat center center;
            background-size: cover;
            position: fixed;
            top: 0;
            left: 0;
            z-index: -1;
        }

        .field {
            position: absolute;
            font-size: 16px;
            font-weight: 700;
            cursor: move;
            z-index: 1;
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

        .no-print {
            position: fixed;
            bottom: 20px;
            right: 20px;
            z-index: 10;
        }

        .no-print button {
            padding: 10px 20px;
            font-size: 18px;
            color: #fff;
            background-color: #007bff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .no-print button:hover {
            background-color: #0056b3;
        }

        .guide-popup {
            position: fixed;
            top: 20px;
            left: 50%;
            transform: translateX(-50%);
            background: rgba(0, 0, 0, 0.85);
            color: #fff;
            padding: 20px;
            border-radius: 8px;
            font-size: 16px;
            z-index: 20;
            max-width: 400px;
            text-align: center;
            box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.4);
        }

        .guide-popup .close-btn {
            margin-top: 10px;
            padding: 8px 15px;
            background-color: #f44336;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .guide-popup .close-btn:hover {
            background-color: #d32f2f;
        }
    </style>
</head>
<body>
    <div class="guide-popup">
        <p>1. Glissez les informations à la bonne position.<br>2. Cliquez sur le bouton <strong>Imprimer</strong> pour générer le diplôme.</p>
        <button class="close-btn" onclick="closeGuide()">Fermer</button> 
    </div>

    <div class="background"></div>

    <div id="nom" class="field">{{ $participant->nom_prenom }}</div>
    <div id="cin" class="field">CIN: {{ $participant->numero_cin }}</div>
    <div id="date_naissance" class="field">{{ $participant->date_naissance }}</div>
    <div id="lieu_naissance" class="field">{{ $participant->ville_naissance }}</div>
    <div id="formation" class="field">{{ $participant->formation }}</div>
    <div id="annee" class="field">{{ $participant->created_at->format('Y') }}</div>
    <div id="date_delivrance" class="field">{{ $participant->created_at->format('d/m/Y') }}</div>

    <div class="no-print">
        <button onclick="printDiplome()">Imprimer</button>
    </div>

    <script>
        function closeGuide() {
            document.querySelector('.guide-popup').style.display = 'none';
        }

        const fields = document.querySelectorAll('.field');

        fields.forEach(field => {
            field.addEventListener('mousedown', (e) => {
                const initialX = e.clientX - field.offsetLeft;
                const initialY = e.clientY - field.offsetTop;

                const onMouseMove = (event) => {
                    let newX = event.clientX - initialX;
                    let newY = event.clientY - initialY;

                    const rect = field.getBoundingClientRect();
                    if (newX < 0) newX = 0;
                    if (newY < 0) newY = 0;
                    if (newX + rect.width > window.innerWidth) newX = window.innerWidth - rect.width;
                    if (newY + rect.height > window.innerHeight) newY = window.innerHeight - rect.height;

                    field.style.left = `${newX}px`;
                    field.style.top = `${newY}px`;
                };

                document.addEventListener('mousemove', onMouseMove);

                document.addEventListener('mouseup', () => {
                    document.removeEventListener('mousemove', onMouseMove);

                    const position = {
                        left: field.style.left,
                        top: field.style.top,
                    };
                    localStorage.setItem(`position-${field.id}`, JSON.stringify(position));
                }, { once: true });
            });
        });

        fields.forEach(field => {
            const savedPosition = localStorage.getItem(`position-${field.id}`);
            if (savedPosition) {
                const position = JSON.parse(savedPosition);
                field.style.left = position.left;
                field.style.top = position.top;
            }
        });

        function printDiplome() {
            window.print();
        }
    </script>
</body>
</html>
