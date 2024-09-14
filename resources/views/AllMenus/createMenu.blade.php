<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style>
        .menu-container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 50vh;
            position: relative;
            z-index: 1;
            text-align: right;
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
            box-shadow: 0px 0px 10px rgba(83, 74, 74, 0.56);
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
        .menu-form input[type="Tags"],
        #parent-menu {
            width: 100%;
            padding: 4px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 13px;
            text-align: right;
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
    </style>
    </style>
</head>
<body>
    @extends('Layouts.app')

    @section('content')
        <h2 id="cM">ایجاد منو جدید</h2>
        <div class="menu-container">
            <div class="menu-form">
                <form method="POST" action="{{ route('AllMenus.createMenu') }}">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                {{-- پیام ارور برای اعتبارسنجی --}}
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    @csrf
                    <div>
                        <label for="name">اسم</label>
                        <input type="text" name="name" required autofocus>
                    </div>

                    <div>
                        <label for="parent-menu">منو اصلی</label>
                        <select id="parent-menu" name="parent_menu">
                            <option value="">انتخاب کنید</option>
                            @foreach ($menus as $menu)
                                <option value="{{ $menu->id }}">{{ $menu->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label for="tags">تگ</label>
                        <input type="text" name="tag">
                    </div>

                    <div>
                        <button type="submit">ثبت</button>
                    </div>
                </form>
            </div>
        </div>
    @endsection

    <!-- اضافه کردن جاوا اسکریپت select2 -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#parent-menu').select2({
                placeholder: 'انتخاب کنید',
                width: '100%'
            });
        });
    </script>
</body>

</html>
