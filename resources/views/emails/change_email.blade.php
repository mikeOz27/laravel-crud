<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Questrial&display=swap');

        * {
            margin: 0;
            padding: 0;
            border: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Questrial', sans-serif;
        }

        @media screen and (max-width: 666px) {

            th,
            td {
                padding: 4px !important;
                font-size: 14px !important;
            }

            .title {
                font-size: 14px !important;
            }

            .warning {
                font-size: 8px !important;
            }
        }

        @media screen and (max-width: 480px) {
            .image {
                display: none;
            }

            img {
                display: none;
            }

            th,
            td {
                font-size: 10px !important;
            }

            .body-mail {
                padding: 20px 0;
            }

            button {
                font-size: 10px;
            }
        }
    </style>
</head>

<body style="font-family: system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;">
    <div style="width: 100%; max-width: 800px; display: flex; justify-content: center; padding: 5px 10px;">
        <div style="background-color: #1F7AC3; width:13%; border-top-left-radius: 20px; border-bottom-left-radius: 20px;"></div>
        <div class="body-mail" style="border-radius: 20px; border-top-left-radius: 0; border-bottom-left-radius: 0; border: solid 1px rgb(199, 196, 196); width: 100%; padding: 50px 20px;">
            <h1 class="title" style="padding: 15px; text-align: justify; font-size: 16px; display: flex; flex-direction: column; font-weight: 400;">
            Hola <strong style="display: contents;">{{ $name }}</strong>, tu usuario <strong style="display: contents;">{{ $nickname }} </strong> le fue modificado el correo electronico a <strong style="display: contents;">{{ $email }}.</strong>
            Estás recibiendo este correo por parte de la plartaforma E-Franco 4.0 del usuario calificado <strong style="display: contents;">{{ $qualifiedUser }}</strong>
            </h1>
        </div>
    </div>
</body>

</html>
