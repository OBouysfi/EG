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
            position: relative;
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

        .btn {
            position: fixed;
            bottom: 20px;
            right: 20px;
            padding: 15px 25px;
            font-size: 18px;
            font-weight: 600;
            color: #fff;
            background-color: #17a2b8;
            border: none;
            border-radius: 50px;
            cursor: pointer;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
            transition: background-color 0.3s, box-shadow 0.3s;
            z-index: 10;
            display: flex;
            align-items: center;
        }

        .btn:hover {
            background-color: #138496;
            box-shadow: 0px 6px 12px rgba(0, 0, 0, 0.2);
        }

        .btn .icon {
            margin-right: 10px;
            display: flex;
            align-items: center;
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
        <p>1. Glissez les informations à la bonne position.<br>2. Cliquez sur le bouton <strong>Imprimer</strong> pour générer l'attestation.</p>
        <button class="close-btn" onclick="closeGuide()">Fermer</button>
    </div>

    <div class="container">
        <img src="{{ asset('assets/img/attestation.png') }}" class="background-image">

        <div class="content">
            <p id="participant-name" class="draggable">{{ $participant->nom_prenom }}</p>
            <p id="p-center" class="draggable">Date Centre: {{ $participant->created_at->format('d/m/Y') }}</p>
            <p id="p-categ" class="draggable">Catégorie: {{ $participant->categorie }}</p>
        </div>
    </div>
    <div class="no-print">
        <button class="btn btn-info" onclick="printAttestation()">
            Imprimer
        </button>
    </div>

    <script>
        function closeGuide() {
            document.querySelector('.guide-popup').style.display = 'none';
        }

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
