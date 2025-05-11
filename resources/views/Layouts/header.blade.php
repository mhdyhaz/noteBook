<!DOCTYPE html>
<html lang="fa">

<head>
    <meta charset="UTF-8">
    <title>دفترچه یادداشت</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        * {
            box-sizing: border-box;
        }

        html,
        body {
            margin: 0;
            padding: 0;
            direction: rtl;
            font-family: 'Vazirmatn', sans-serif;
            background-color: #f7f7f7;
        }

        .header {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            height: 80px;
            background: linear-gradient(270deg, rgb(58, 17, 61), rgb(74, 4, 115), rgb(115, 29, 136), rgb(50, 40, 53));
            background-size: 600% 600%;
            animation: gradientMove 10s ease infinite;
            color: white;
            z-index: 999;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .header h1 {
            font-size: 28px;
            margin: 0;
            font-weight: bold;
        }

        #backButton,
        #logout {
            position: fixed;
            top: 20px;
            background: none;
            border: none;
            font-size: 24px;
            padding: 6px 10px;
            cursor: pointer;
        }

        #backButton {
            right: 20px;
            color: #f2b4ff;
        }

        #logout {
            left: 20px;
            color: white;
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
    </style>
</head>

<body>

    @if (!isset($hideBackButton) || !$hideBackButton)
        <button id="backButton" type="button" onclick="window.history.back()">
            <i class="bi bi-arrow-right"></i>
        </button>
    @endif

    @if (!isset($hidelogout) || !$hidelogout)
        <form action="{{ route('Dashborde.home') }}" method="GET">
            <button id="logout" type="submit">
                <i class="bi bi-box-arrow-right"></i>
            </button>
        </form>
    @endif

    <div class="header">
        <h1>دفترچه یادداشت</h1>
    </div>


</body>

</html>