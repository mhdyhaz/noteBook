<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    
    <style>
        .menu-container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 50vh;
            position: relative;
            z-index: 1;
        }

        #cM {
            font-size: 30px;
            color: rgb(20, 20, 80);
            font-family: initial;
            position: fixed;
            top: 17rem;
        }

        .menu-form {
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            width: 32rem;
            display: flex;
            flex-direction: column;
            z-index: 2;
        }

        .menu-form label {
            margin-bottom: 5px;
            font-family: initial;
            font-weight: bold;
        }

        .menu-form input[type="text"],
        .menu-form input[type="Tags"] {
            width: 100%;
            padding: 4px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 13px;
        }

        .menu-form button[type="submit"] {
            background-color: rgb(11, 11, 100);
            color: white;
            padding: 3px 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-family: initial;
            font-size: 14px;
        }

        .menu-form button[type="submit"]:hover {
            background-color: #e5ebf0;
        }

        #parent-menu {
            background-color: rgb(11, 11, 100);
            color: white;
            padding: 3px 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-family: initial;
            font-size: 14px;
        }

        
        }
    </style>
</head>

<body>
    @extends('Layouts.app')

    @section('content')


        <h2 id="cM">Create A New Menu</h2>
        <div class="menu-container">
            <div class="menu-form">
                <form method="POST" action="{{ route('AllMenus.createMenu') }}">
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            {{-- پیام ارور برا اینکه از اعتبارسنجی استفاده شد --}}
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                    @csrf
                    <div>
                        <label for="name">Name</label>
                        <input type="text" name="name" required autofocus>
                    </div>

                    <div>
                        <label for="parent-menu">Parent Menu</label>
                        <select id="parent-menu" name="parent_menu">
                            <option value=""> root </option>
                            @foreach ($menus as $menu)
                                <option value="{{ $menu->id }}">{{ $menu->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label for="tags">Tags</label>
                        <input type="text" name="tag">
                    </div>

                    <div>
                        <button type="submit">Create</button>
                    </div>
                </form>
            </div>
        </div>
    @endsection
</body>

</html>
