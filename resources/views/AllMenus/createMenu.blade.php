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

        .select2-container {
            text-align: right;
        }

        #cM {
            font-size: 30px;
            color: rgb(20, 20, 80);
            font-family: initial;
            opacity: inherit;
            text-align: center;
        }



        .menu-form {
            padding: 62px;
            border-radius: 8px;
            box-shadow: 0px 0px 10px rgba(83, 74, 74, 0.56);
            width: 48rem;
            display: flex;
            flex-direction: column;
            bottom: 5rem;
            opacity: revert;
            position: absolute;
        }

        .menu-form label {
            margin-bottom: 5px;
            font-family: initial;
            font-weight: bold;
        }

        .menu-form input[type="text"],
        .menu-form input[type="Tags"],
        #parent-menu {
            background: white;
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
            padding: 2px 11px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-family: initial;
            font-size: 16px;
            position: absolute;
            margin: 16px -45px;
        }

        .menu-form button[type="submit"]:hover {
            background-color: #e5ebf0;
        }

      
    </style>
</head>

<body>

    @extends('Layouts.app')

    @section('content')

        <div class="menu-container">
            <div class="menu-form">
                <h2 id="cM">ایجاد منوی جدید</h2>
                <form autocomplete="off" method="POST" action="{{ route('AllMenus.store') }}">
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
                        <input type="text" name="name" required autofocus>
                    </div>

                    <div>
                        <label for="parent-menu">منو اصلی</label>
                        <select  id="parent-menu" name="parent_menu">
                            <option value="">انتخاب کنید</option>
                            @foreach ($menus as $menu)
                                <option value="{{ $menu->id }}">{{ $menu->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="tags">تگ‌ها</label>
                        <select  name="tags[]" class="form-control select2" multiple="multiple">
                            @foreach ($tags as $tag)
                                <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <button type="submit">ثبت</button>
                    </div>
                </form>
            </div>
        </div>

        <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
        <script>
            $(document).ready(function() {
                $('.select2').select2({
                    tags: true,
                    tokenSeparators: [',', ' '],
                    allowClear: true
                });
            });
        </script>
    @endsection
</body>

</html>
