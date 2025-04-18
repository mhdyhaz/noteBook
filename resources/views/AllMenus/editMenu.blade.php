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

        #LL {
            font-size: 30px;
            color: rgb(20, 20, 80);
            opacity: inherit;
            text-align: center;
            margin-bottom: 3rem;
        }

        .menu-form {
            padding: 62px;
            border-radius: 8px;
            box-shadow: 0px 0px 10px rgba(83, 74, 74, 0.56);
            width: 48rem;
            display: flex;
            flex-direction: column;
            bottom: 1rem;
            height: 28rem;
            opacity: revert;
            position: absolute;
        }

   
        .menu-form input[type="text"] {
            width: 100%;
            padding: 8px;
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
            background: #fff;
            /* راست چین شدن گزینه ها */
            direction: rtl;
         
        }

        .menu-form button[type="submit"] {
            background-color: #581a6f;
            color: white;
            padding:3px 289px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 18px;
            position: absolute;
            margin: 30px 0px;
        }
        
        .menu-form button[type="submit"]:hover {
            background-color: #3e0b50;
        }
       
        
    </style>
</head>

<body>
    @extends('Layouts.app')

    @section('content')
        
        <div class="menu-container">
            <div class="menu-form">
                <h2 id="LL" >ویرایش منو</h2>
                <form autocomplete="off" method="POST" action="{{ route('AllMenus.update', $menu->id) }}">
                    @csrf
                    @method('PUT')
                    @if ($errors->any())
                    <div style="text-align: left;width: 31rem;position: relative;left: 61px;" class="alert alert-danger">
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
                        <select id="parent-menu" name="parent_id"  class="float-end" >
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
                        <select  id="select2"  name="tags[]" class="form-control select2" multiple="multiple">
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
