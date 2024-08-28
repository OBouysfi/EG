<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Attestation de Formation</title>
    <style>
        @page {
            size: A4;
            margin: 0;
        }

        @media print {
            body {
                margin: 0;
                padding: 0;
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
            }

            .container {
                width: 100%;
                height: 100%;
                max-width: 210mm;
                max-height: 297mm;
                overflow: hidden;
                page-break-inside: avoid;
                position: relative;
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
            background: none;
        }

        .container {
            position: relative;
            width: 210mm; /* Fixe la largeur à celle d'une feuille A4 */
            height: 297mm; /* Fixe la hauteur à celle d'une feuille A4 */
            overflow: hidden;
            border: 1px solid #ddd; /* Juste pour visualiser les bordures */
        }

        .background-image {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1;
            object-fit: cover;
        }

        .content {
            position: relative;
            width: 100%;
            height: 100%;
        }

        .draggable {
            position: absolute;
            cursor: move;
            color: black;
            z-index: 1;
        }

        #participant-name {
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            font-size: 23px;
            font-weight: 700;
        }

        #p-center, #p-categ {
            left: 50%;
            transform: translateX(-50%);
            font-size: 18px;
        }

        #p-center {
            top: 75%;
        }

        #p-categ {
            top: 80%;
        }
    </style>
</head>
<body>
    <div class="container">
        <img src="{{ asset('assets/img/attestation.png') }}" class="background-image">

        <div class="content">
            <p id="participant-name" class="draggable">{{ $participant->nom_prenom }}</p>
            <p id="p-center" class="draggable">Date Centre: {{ $participant->created_at->format('d/m/Y') }}</p>
            <p id="p-categ" class="draggable">Catégorie: {{ $participant->categorie }}</p>
        </div>
    </div>
    <div class="no-print">
        <button class="btn btn-info" onclick="printAttestation()">Imprimer</button>
    </div>

    <script>
        const draggables = document.querySelectorAll('.draggable');

        draggables.forEach(draggable => {
            draggable.addEventListener('mousedown', (e) => {
                const initialX = e.clientX - draggable.offsetLeft;
                const initialY = e.clientY - draggable.offsetTop;

                const onMouseMove = (event) => {
                    const left = `${event.clientX - initialX}px`;
                    const top = `${event.clientY - initialY}px`;
                    draggable.style.left = left;
                    draggable.style.top = top;
                };

                document.addEventListener('mousemove', onMouseMove);

                document.addEventListener('mouseup', () => {
                    document.removeEventListener('mousemove', onMouseMove);
                    
                    // Save the new position in localStorage
                    const position = {
                        left: draggable.style.left,
                        top: draggable.style.top,
                    };
                    localStorage.setItem(`position-${draggable.id}`, JSON.stringify(position));
                }, { once: true });
            });
        });

        // Load saved positions from localStorage
        draggables.forEach(draggable => {
            const id = draggable.id;
            const savedPosition = localStorage.getItem(`position-${id}`);
            if (savedPosition) {
                const position = JSON.parse(savedPosition);
                draggable.style.left = position.left;
                draggable.style.top = position.top;
            }
        });

        function printAttestation() {
            window.print();
        }
    </script>
</body>
</html>
