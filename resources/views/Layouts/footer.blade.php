<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <style>
        .footer {
            position: fixed;
            left: 0;
            background: linear-gradient(270deg, rgb(78, 16, 83), rgb(74, 4, 115), rgb(76, 14, 92), rgb(50, 40, 53));
            background-size: 600% 600%;
            animation: gradientMove 10s ease infinite;
            bottom: 0;
            width: 100%;
            color: white;
            text-align: center;
            padding: 3px;
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
            color: rgb(255, 255, 255);
            font-size: 20px;
            text-align: center;
            font-weight: bold;

        }
    </style>
</head>




<body>

    <div class="footer">
        <p id="id-p"> Az </p>
    </div>



</body>

</html>