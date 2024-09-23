<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <title>Login</title>
    <style>
        /* استایل برای فرم */
        .login-container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 50vh;
            position: relative;
            z-index: 1;
            text-align: right;
        }

        .login-form {


            padding: 62px;
            border-radius: 8px;
            box-shadow: 0px 0px 10px rgba(83, 74, 74, 0.56);
            width: 48rem;
            display: flex;
            flex-direction: column;
            bottom: 3rem;
            opacity: revert;
            position: absolute;
        }

        .login-form h2 {
            text-align: center;
            margin-bottom: 20px;
            font-family: initial;
        }

        .login-form label {
            margin-bottom: 5px;
            font-weight: bold;
            font-family: initial;
        }

        .login-form input[type="text"],
        .login-form input[type="password"] {
            width: 100%;
            padding: 4px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 13px;
            text-align: right;

        }

        .login-form button[type="submit"] {
            background-color: rgb(11, 11, 100);
            color: white;
            padding: 3px 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 13px;
            font-family: initial;
        }

        .login-form button[type="submit"]:hover {
            background-color: #e5ebf0;
        }
    </style>
</head>

<body>
    @extends('Layouts.app')

    @section('title', 'Login')

    @section('content')
        @php
            $hidelogout = true;

        @endphp
        <div class="login-container">
            <div class="login-form">
                <h2>ورود</h2>
                <form method="POST" action="{{ route('Dashborde.login') }}">
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
                        <label for="email">ایمیل</label>
                        <input style="text-align: left;" type="text" id="email" name="email">
                    </div>
                    <div>
                        <label for="password">رمزعبور</label>
                        <input type="password" id="password" name="password">
                    </div>
                    <div>
                        <button type="submit">ورود</button>
                    </div>
                </form>
            </div>
        </div>
    @endsection

</body>

</html>
