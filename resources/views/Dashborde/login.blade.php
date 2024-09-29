<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <title>Login</title>
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
            background-size: 53rem;
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
            border-radius: 8px;
            background-color: rgba(255, 255, 255, 0.8);
            /* برای وضوح بیشتر */
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
            width: 400px;
            z-index: 2;
            top: 13rem;
            position: absolute;
        }

        .login-form h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        .login-form label {
            display: block;
            margin-bottom: 10px;
            text-align: right;
        }

        .login-form input[type="text"],
        .login-form input[type="password"] {
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
            padding: 5px;
            background-color: #1b1340;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .login-form button:hover {
            background-color: #555;
        }
    </style>
</head>

<body>

    <div class="background-image"></div>

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
                    <label for="password">رمز عبور</label>
                    <input type="password" id="password" name="password">
                </div>
                <div>
                    <button type="submit">ورود</button>
                </div>
            </form>
        </div>
    </div>

</body>

</html>
