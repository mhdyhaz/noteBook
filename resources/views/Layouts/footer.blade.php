<!DOCTYPE html>
<html lang="fa">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Footer درست</title>
    <style>
        html,
        body {
            height: 100%;
            margin: 0;
        }

        .wrapper {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        .content {
            flex: 1;
            padding: 20px;
        }
        .footer {
            background: linear-gradient(270deg, rgb(78, 16, 83), rgb(74, 4, 115), rgb(76, 14, 92), rgb(50, 40, 53));
            background-size: 600% 600%;
            animation: gradientMove 10s ease infinite;
            color: white;
            text-align: center;
            padding: 10px;
            width: 100%;
        }

        @keyframes gradientMove {
            0% {
                background-position: 0% 50%;
            }

            50% {
                background-position: 100% 50%;
            }

            100% {
                background-position: 0% 50%;
            }
        }

        #id-p {
            font-size: 20px;
            font-weight: bold;
        }
    </style>
</head>

<body>

    <div class="footer">
        <p id="id-p">Az</p>
    </div>

</body>

</html>