<!DOCTYPE html>
<html lang="en">
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

            .no-print {
                display: none;
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
    </style>
</head>
<body>
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
        const fields = document.querySelectorAll('.field');

        fields.forEach(field => {
            field.addEventListener('mousedown', (e) => {
                const initialX = e.clientX - field.offsetLeft;
                const initialY = e.clientY - field.offsetTop;

                const onMouseMove = (event) => {
                    let newX = event.clientX - initialX;
                    let newY = event.clientY - initialY;

                    // Prevent moving out of bounds
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
