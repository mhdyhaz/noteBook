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
            height: 89vh;
            
          
        }

        .login-form {
    
            
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1)  ;
            width: 32rem;
            display: flex;
            flex-direction: column;
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
            
        }

        .login-form button[type="submit"] {
            background-color:  rgb(11, 11, 100);
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
        <div class="login-container">
            <div class="login-form">
                <h2>Login</h2>
                <form method="POST" action="{{ route('Dashborde.login') }}">
                    @csrf
                    <div>
                        <label for="email">Email</label>
                        <input type="text" id="email" name="email">
                    </div>
                    <div>
                        <label for="password">Password</label>
                        <input type="password" id="password" name="password">
                    </div>
                    <div>
                        <button type="submit">Login</button>
                    </div>
                </form>
            </div>
        </div>
    @endsection
    
</body>
</html>
