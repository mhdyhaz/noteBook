<!DOCTYPE html>
<html lang="en">

<head>
    <title>Page Title</title>
    <link rel="stylesheet" href="../bootstrap/bootstrap.min.css">
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jstree/3.3.12/themes/default/style.min.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jstree/3.3.12/jstree.min.js"></script>

    <style>
        .header {
            padding: 48px 0;
            text-align: center;
            background: linear-gradient(0deg, rgb(215, 221, 240) 0%, rgb(125, 119, 168) 100%);
            color: white;
            font-size: 16px;
            width: 100%;
            height: 42px;
            overflow: hidden;
        }

        #b-id {
            font-size: 38px;
            text-align: center;
            color: black;
            font-family: initial;
            display: contents;
        }

        #backButton[type="submit"] {
            color: white;
            border: none;
            opacity: inherit;
            position: absolute;
            top: 96px;
            font-size: 15px;
            border-radius: 5px;
            background-color: rgb(11, 11, 100);
            padding: 4px 11px;
            left: 10px;
            font-family: initial;
        }

        #logout[type="submit"] {
            color: white;
            border: none;
            opacity: inherit;
            position: absolute;
            top: 36px;
            font-size: 15px;
            border-radius: 5px;
            background-color: rgb(11, 11, 100);
            padding: 3px 15px;
            left: 10px;
            font-family: initial;
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
