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
                <h1 style="font-size: 25px; font-weight: 500; margin: 20px 0;">
                    {{$name}}
            </h1>
            <h2 style="font-weight: 400; font-size: 14px;">
                El restablecimiento de contraseña para tu cuenta ha sido exitoso.
            </h2>
        </div>
    </div>
</body>
</html>
