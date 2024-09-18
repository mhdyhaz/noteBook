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

        .menu-form input[type="text"] {
            width: 100%;
            padding: 4px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            text-align: right;
            font-size: 13px;
        }

        .menu-form select {
            width: 100%;
            padding: 4px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            text-align: right;
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
    </style>
</head>

<body>
    @extends('Layouts.app')

    @section('content')
        <h2 id="cM">ویرایش منو</h2>
        <div class="menu-container">
            <div class="menu-form">
                <form autocomplete="off" method="POST" action="{{ route('AllMenus.update', $menu->id) }}">
                    @csrf
                    @method('PUT')
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
                        <input type="text" name="name" value="{{ $menu->name }}" required autofocus>
                    </div>

                    <div>
                        <label for="parent-menu">منو اصلی</label>
                        <select id="parent-menu" name="parent_id">
                            <option value="">انتخاب کنید</option>
                            @foreach ($parentMenus as $parentMenu)
                                <option value="{{ $parentMenu->id }}" {{ $menu->parent_id == $parentMenu->id ? 'selected' : '' }}>
                                    {{ $parentMenu->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="tags">تگ‌ها</label>
                        <select name="tags[]" class="form-control select2" multiple="multiple">
                            @foreach ($tags as $tag)
                                <option value="{{ $tag->id }}" {{ $menu->tags->contains($tag->id) ? 'selected' : '' }}>
                                    {{ $tag->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    
                    <div>
                        <button type="submit">بروزرسانی</button>
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
                    tokenSeparators: [',', ' ']
                });
            });
        </script>
    @endsection
</body>
</html>
