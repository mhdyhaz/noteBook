<!DOCTYPE html>
<html lang="en">

<head>
    <title>Page Title</title>
  

    <style>
        .header {
            padding: 48px 0;
            text-align: center;
            background: linear-gradient(0deg, rgb(225, 165, 230) 0%, rgb(90, 31, 123) 100%);
            color: white;
            font-size: 16px;
            width: 100%;
            height: 42px;
            overflow: hidden;
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
            color:white;
            font-weight: bold;
            border: none;
            opacity: inherit;
            position: absolute;
            top: 30px;
            font-size:27px;
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
