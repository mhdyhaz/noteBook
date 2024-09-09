<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <title>Register</title>
    <style>
        .register-container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 90vh;
            position: relative;
            z-index: 1;
        }

        .register-background {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: url('path-to-your-background-image.jpg') no-repeat center center fixed;
            background-size: cover;
            filter: blur(8px);
            -webkit-filter: blur(8px);
            z-index: -1;
        }

        .register-form {

            padding: 20px;
            border-radius: 8px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            width: 32rem;
            display: flex;
            flex-direction: column;
            z-index: 2;
        }

        .register-form h2 {
            text-align: center;
            font-family: initial;
            margin-bottom: 20px;
        }

        .register-form label {
            margin-bottom: 5px;
            font-family: initial;
            font-weight: bold;
        }

        .register-form input[type="text"],
        .register-form input[type="email"],
        .register-form input[type="password"] {
            width: 100%;
            padding: 4px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 13px;
        }

        .register-form button[type="submit"] {
            background-color: rgb(11, 11, 100);
            color: white;
            padding: 3px 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-family: initial;
            font-size: 13px;
        }

        .register-form button[type="submit"]:hover {
            background-color: #e5ebf0;
        }
    </style>
</head>

<body>
    @extends('Layouts.app')

    @section('title', 'Register')

    @section('content')

        @php
            $hidelogout = true;
        @endphp

        <div class="register-container">
            <di class="register-background"></di>
            <div class="register-form">
                <h2>Register</h2>
                    <form method="POST" action="{{ route('Dashborde.register') }}">
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
                            <label for="name">Name</label>
                            <input type="text" id="name" name="name" required autofocus>
                        </div>
                        <div>
                            <label for="email">Email</label>
                            <input type="email" id="email" name="email" required>
                        </div>
                        <div>
                            <label for="password">Password</label>
                            <input type="password" id="password" name="password" required>
                        </div>
                        <div>
                            <label for="password_confirmation">Confirm Password</label>
                            <input type="password" id="password_confirmation" name="password_confirmation" required>
                        </div>
                        <div>
                            <button type="submit">Register</button>
                        </div>
                    </form>
            </div>
        </div>
    @endsection

</body>

</html>
