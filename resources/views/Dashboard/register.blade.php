<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <title>Register</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            height: 100vh;
            overflow: hidden;
        }

        .background-image {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: url('{{ asset('images/Cart1027302www.tiktarh.com_.jpg') }}') no-repeat center center fixed;
            background-size:53rem;
            filter: blur(3px);
            z-index: -1;
        }

        .login-container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            position: relative;
            z-index: 1;
        }

        .login-form {
            padding: 40px;
            font-weight: bold;
            border-radius: 8px;
            background-color: rgba(255, 255, 255, 0.8); /* برای وضوح بیشتر */
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
            width: 400px;
            z-index: 2;
        }

        .login-form h2 {
            text-align: center;
            margin-bottom: 20px;
            font-weight: bold;
            
        }

        .login-form label {
            display: block;
  margin-bottom: 10px;
  text-align: right;
        }

        .login-form input[type="text"],
        .login-form input[type="password"],
        .login-form input[type="email"] {
            width: 100%;
            padding: 8px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
            text-align: right;
        }

        .login-form button {
            width: 105%;
            font-weight: bold;
            padding: 5px;
            background-color:#581a6f;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .login-form button:hover {
            background-color: #3e0b50;
        }
    </style>
</head>

<body>

    <div class="background-image"></div>

    <div class="login-container">
        <div class="login-form">
            <h2>ثبت‌نام</h2>
            <form  autocomplete="off" method="POST" action="{{ route('Dashboard.register') }}">
                @csrf
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div>
                    <label for="name">نام</label>
                    <input  autocomplete="false" type="text" id="name" name="name" required>
                </div>
                <div>
                    <label for="email">ایمیل</label>
                    <input   autocomplete="false"  style="text-align: left;" type="email" id="email" name="email" required  autocomplete="off"> 
                </div>
                <div>
                    <label for="password">رمز عبور</label>
                    <input  autocomplete="false"  type="password" id="password" name="password" required>
                </div>
                <div>
                    <label for="password_confirmation">تأیید رمز عبور</label>
                    <input  autocomplete="false"  type="password" id="password_confirmation" name="password_confirmation" required>
                </div>
                <div>
                    <button type="submit">ثبت‌نام</button>
                </div>
            </form>
        </div>
    </div>

</body>

</html>
