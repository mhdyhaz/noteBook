<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.8.1/font/bootstrap-icons.min.css"
        rel="stylesheet">

    <style>
        body {
            background-color: #f1f0f4;
            margin: 0;
            padding: 0;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .main-container {
            display: flex;
            justify-content: center;
            align-items: center;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(194, 178, 204, 0.56);
            width: 52rem;
            height: 42rem;
            background: #f9f8ff;
            position: relative;
        }

        .girl-image {
            width: 27rem;
            height: 34rem;
            border-radius: 10px;
            object-fit: cover;
            margin-right: 327px;
        }

        .circle {
            width: 130px;
            height: 59px;
            background-color: #581a6f;
            border-radius: 10PX;
            display: flex;
            justify-content: center;
            align-items: center;
            color: white;
            font-size: 19px;
            font-weight: bold;
            cursor: pointer;
            transition: transform 0.3s ease, opacity 0.5s ease;
            position: absolute;
            right: 95px;
        }

        .circle:hover {
            transform: scale(1.1);
        }

        .text-box {
            width: 19rem;
            height: 34rem;
            position: absolute;
            bottom: 65px;
            right: 20px;
            background-color: #f0f0ff;
            border-radius: 7px;
            padding: 10px;
            display: none;
            overflow: hidden;
            text-align: center;
            background: #fefefe;

        }

        .text-box p {
            margin: 0;
            padding: 0;
            line-height: 2.2;
            animation: scrollText 6s linear 1;
        }

        @keyframes scrollText {
            0% {
                transform: translateY(100%);
            }

            100% {
                transform: translateY(0%);
            }
        }

        .scroll-arrow {
            font-weight: bold;
            width: 40px;
            height: 40px;
            background-color: #581a6f;
            color: white;
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            cursor: pointer;
            position: absolute;
            bottom: 80px;
            right: 35px;
            display: none;
            font-size: 20px;
        }

        .scroll-arrow:hover {
            background-color: #3e0b50;
        }

        .button-container {
            display: none;
            flex-direction: column;
            align-items: center;
            gap: 15px;
            position: absolute;
            right: 95px;
            animation: fadeIn 0.5s forwards;
        }

        .button-container button {
            font-weight: bold;
            background-color: #581a6f;
            width: 140px;
            height: 45px;
            color: white;
            text-align: center;
            display: flex;
            justify-content: center;
            align-items: center;
            border: none;
            border-radius: 10px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s ease;
        }

        .button-container button:hover {
            background-color: #3e0b50;
        }

        .close-btn {
            width: 36px;
            height: 30px;
            display: flex;
            justify-content: center;
            align-items: center;
            border-radius: 50%;
            cursor: pointer;
            position: absolute;
            bottom: 18rem;
            right: -15px;
            color: #b33ad5;
            font-size: 31px;
        }
    </style>
</head>

<body>

    <div class="main-container">
        <img src="{{ asset('images/Cart1027302www.tiktarh.com_.jpg') }}" alt="Girl Working on Laptop"
            class="girl-image">

        <div class="circle" id="circle" onclick="showText()">کلیک کنید</div>

        <div class="text-box" id="textBox">
            <p>
                آیا هنگام دسته‌بندی اطلاعات خود سردرگم می‌شوید؟ آیا دوست دارید همه چیز تحت کنترل شما باشد؟
                نگران نباشید! ما اینجا هستیم تا به شما کمک کنیم.
                سایت ما به شما در دسته‌بندی اطلاعاتتان، نمایش و به اشتراک‌گذاری محتوایی که می‌خواهید کمک می‌کند.
                امکاناتی همچون نمایش لیست‌ها به‌صورت درختی، اشتراک‌گذاری سریع و آسان، افزودن تگ و نمایش لیست‌های
                دریافتی همراه با جزئیات کامل در اختیار شما خواهد بود.
                با ما کار را برای خود راحت کنید و با خیالی آسوده اطلاعات خود را دسته‌بندی و به اشتراک بگذارید
            </p>
        </div>


        <div class="scroll-arrow" id="scrollArrow" onclick="showButtons()">
            <i class="bi bi-person"></i>
        </div>

        <div class="button-container" id="buttons">
            <button onclick="window.location.href='{{ route('Dashborde.login') }}'">ورود</button>
            <button onclick="window.location.href='{{ route('Dashborde.register') }}'">ثبت نام</button>
            <div class="close-btn" onclick="hideText()">×</div>
        </div>
    </div>

    <script>
        function showText() {
            const circle = document.getElementById('circle');
            const textBox = document.getElementById('textBox');
            const scrollArrow = document.getElementById('scrollArrow');


            circle.style.display = 'none';
            textBox.style.display = 'block';

            // نمایش آیکون پروفایل پس از تأخیر
            setTimeout(() => {
                scrollArrow.style.display = 'flex';
            }, 6030);

        }


        function showButtons() {
            const textBox = document.getElementById('textBox');
            const scrollArrow = document.getElementById('scrollArrow');
            const buttons = document.getElementById('buttons');

            textBox.style.display = 'none';
            scrollArrow.style.display = 'none';

            buttons.style.display = 'flex';
        }


        function hideText() {
            const circle = document.getElementById('circle');
            const buttons = document.getElementById('buttons');
            const textBox = document.getElementById('textBox');
            const scrollArrow = document.getElementById('scrollArrow');

            // مخفی‌سازی دکمه‌ها و نمایش دوباره دایره
            buttons.style.display = 'none';
            textBox.style.display = 'none';
            scrollArrow.style.display = 'none';
            circle.style.display = 'flex';
        }
    </script>
</body>

</html>
