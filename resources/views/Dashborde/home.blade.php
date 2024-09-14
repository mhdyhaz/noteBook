<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <style>
        .button-container {
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        
        .button-container button {
            background-color: rgb(11, 11, 100);
            width: 100px;
            height: 50px;
            color: white;
            text-align: center;
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 13px 0;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-family: initial;
        }

        .button-container button:hover {
            background-color: rgb(11, 11, 100);
        }
    </style>
</head>
<body>
    @extends('Layouts.app')


    @section('content')
@php
$hideBackButton=true;  
    $hidelogout=true;
        
@endphp

    <div class="button-container">
        <button onclick="window.location.href='{{ route('Dashborde.login') }}'">ورود</button>
        <button onclick="window.location.href='{{ route('Dashborde.register') }}'">ثبت نام</button>
    </div>
    @endsection

</body>
</html>
