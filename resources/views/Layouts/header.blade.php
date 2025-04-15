<!DOCTYPE html>
<html lang="en">

<head>
    <title>Page Title</title>

    <style>
        .header {
            padding: 48px 0;
            text-align: center;
            background: linear-gradient(270deg, rgb(58, 17, 61), rgb(74, 4, 115), rgb(115, 29, 136), rgb(50, 40, 53));
            background-size: 600% 600%;
            animation: gradientMove 10s ease infinite;
            color: white;
            font-size: 16px;
            width: 100%;
            height: 42px;
            overflow: hidden;
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

        #b-id {
            font-size: 38px;
            text-align: center;
            color: white;
            font-family: 'Vazirmatn';
            font-weight: bold;
            display: contents;
        }

        #backButton[type="submit"] {
            background: none;
            color: #581a6f;
            font-weight: bold;
            border: none;
            opacity: inherit;
            position: absolute;
            top: 96px;
            font-size: 27px;
            border-radius: 5px;
            padding: 4px 11px;
            left: 10px;
        }

        #logout[type="submit"] {
            background: none;
            color: white;
            font-weight: bold;
            border: none;
            opacity: inherit;
            position: absolute;
            top: 30px;
            font-size: 27px;
            border-radius: 5px;
            padding: 3px 15px;
            left: 10px;
        }
    </style>
</head>

<body>

    @if (!isset($hideBackButton) || !$hideBackButton)
    <button id="backButton" type="submit" onclick="window.history.back()">
        <i class="bi bi-arrow-left"></i>
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
        <h1 id="b-id">دفترچه یادداشت</h1>
    </div>

</body>

</html>
