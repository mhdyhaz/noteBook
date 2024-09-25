<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
     
          .main-container {
            display: flex;
            justify-content: center;
            align-items: center;
            position: relative;
            border-radius: 3%;
            box-shadow:0px 0px 10px rgba(194, 178, 204, 0.56);
            width: 51rem;
            height: 40rem;
            background: #f4f0f978;

        }

        .girl-image {
            width: 30rem;
            height: 37rem;
            border-radius:3%;
            margin: 6px 165px 6px 0px;

        }

        .circle {
            width: 130px;
            height: 59px;
            background-color:#4e3d9f;
            border-radius: 12%;
            display: flex;
            justify-content: center;
            align-items: center;
            color: white;
            font-size: 19px;
            font-weight: bold;
            cursor: pointer;
            transition: transform 0.3s ease, opacity 0.5s ease;
            position: relative;
            font-family: initial;
            top: 29px;
  right: 69px;
        }

        .circle:hover {
            transform: scale(1.1);
        }

        .button-container {
            display: none;
            flex-direction: column;
            align-items: center;
            gap: 15px;
            position: absolute;
            top: 10px;
        }

        .button-container button {
            background-color: #4e3d9f;
            width: 120px;
            height: 40px;
            color: white;
            text-align: center;
            display: flex;
            justify-content: center;
            align-items: center;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-family: initial;
        }

        .button-container button:hover {
            background-color: #090952;
        }

        .close-btn {
            background-color: red;
            width: 30px;
            height: 30px;
            display: flex;
            justify-content: center;
            align-items: center;
            border-radius: 50%;
            color: white;
            cursor: pointer;
            position: absolute;
            top: -10px;
            right: -10px;
        }

        .circle.active {
            opacity: 0;
        }

        .circle.active+.button-container {
            display: inline-grid;
            animation: fadeIn 0.5s forwards;
            top: 17rem;
  right: 95px;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>

<body>
    @extends('Layouts.app')

    @section('content')
        @php
            $hideBackButton = true;
            $hidelogout = true;
        @endphp
        <div class="content" style="background-color:wiht">

            <div class="main-container">
                <img src="{{ asset('images/Cart1011722www.tiktarh.com_.jpg') }}" alt="Girl Working on Laptop"
                    class="girl-image">

                <div class="circle" id="circle" onclick="showButtons()">کلیک کنید</div>

                <div class="button-container" id="buttons">
                    <button onclick="window.location.href='{{ route('Dashborde.login') }}'">ورود</button>
                    <button onclick="window.location.href='{{ route('Dashborde.register') }}'">ثبت نام</button>
                    <div class="close-btn" onclick="hideButtons()">×</div>
                </div>
            </div>
        </div>
    @endsection

    <script>
        // تابع برای نمایش دکمه‌ها و مخفی کردن دایره
        function showButtons() {
            const circle = document.getElementById('circle');
            circle.classList.add('active');
        }

        // تابع برای مخفی کردن دکمه‌ها و بازگرداندن دایره
        function hideButtons() {
            const circle = document.getElementById('circle');
            const buttons = document.getElementById('buttons');
            circle.classList.remove('active');
            buttons.style.display = 'none';
        }
    </script>
</body>

</html>
