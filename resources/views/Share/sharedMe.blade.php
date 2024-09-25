<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jstree/3.3.12/themes/default/style.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jstree/3.3.12/jstree.min.js"></script>
    <style>
        .list-container {
            font-family: initial;
            color: black;
            width: 80rem;
            margin: auto;
            margin-bottom: auto;
            margin-bottom: 30rem;
            background-color: #f8f9fa;
            padding: 6px 62px;
            border-radius: 12px;
            box-shadow: 0 4px 8px rgba(186, 178, 204, 0.41);
            height: 42rem;
            position: absolute;
            top: 9rem;
            text-align: center;
            background: #e0dfe114;


        }

        #lM {
            font-size: 18px;
            margin-bottom: 2rem;
            text-align: right;
            padding: 14px 0px;
        }

        #delete {
            background: none;
            color: rgb(182, 10, 10);
            border: none;
            font-size: 17px;
        }

        .modal-footer button[type="submit"] {
            position: relative;
            padding: 2px 9px;
            right: 344px;
        }

        .modal-footer button[type="button"] {
            position: relative;
            padding: 2px 15px;
            right: 355px;
        }

        #eye {
            background: none;
            font-size: 18px;
            border: none;
        }

        #jstree {
            margin: 35px 7px 33px 27px;
            text-align: right;
            direction: rtl;
        }

        .collapse {
            direction: rtl;
            /* راست‌چین کردن محتویات درخت */
            text-align: right;
            display: table-row;
            /* نمایش به عنوان سطر جدول */
        }

        td.collapse-container {
            padding: 0;

        }

        li {
            text-align: right;
            /* راست‌چین کردن هر عنصر لیست */
        }
    </style>
</head>

<body>
    @extends('Layouts.app')
    @php
        function convertToPersianNumbers($number)
        {
            $persianNumbers = ['۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹'];
            return str_replace(range(0, 9), $persianNumbers, $number);
        }
    @endphp
    @section('content')
        <div class="container">
            <div class="list-container">
                <h1 id="lM">منوهای دریافتی</h1>
                <table style="text-align: center;" class="table table-striped table-hover">
                    <thead>
                        <tr style="border-block-end-style: double;border: double;">
                            <th>عملیات</th>
                            <th>ارسال‌کننده</th>
                            <th>تگ</th>
                            <th>منوی اصلی</th>
                            <th>نام منو</th>
                            <th>شناسه</th>
                        </tr>
                    </thead>
                    <tbody style="border:" >
                        @forelse($menus as $menu)
                            <tr>
                                <td>
                                    <button id="eye" class="btn btn-info btn-sm toggle-children"
                                        data-target="#collapse-{{ $menu->id }}">
                                        <i class="bi bi-eye"></i>
                                    </button>
                                    <button id="delete" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                        data-bs-target="#deleteModal-{{ $menu->id }}">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </td>
                                <td>{{ $menu->user->name }}</td>
                                <td>
                                    @foreach ($menu->tags as $tag)
                                        {{ $tag->name }}@if (!$loop->last)
                                            ,
                                        @endif
                                    @endforeach
                                </td>
                                <td>{{ optional($menu->parent)->name }}</td>
                                <td>{{ $menu->name }}</td>
                                <td>{{ convertToPersianNumbers($menu->id) }}</td>
                            </tr>
                            <tr class="collapse" id="collapse-{{ $menu->id }}">
                         
                                <td class="collapse-container" colspan="5">

                                    <div id="jstree-{{ $menu->id }}">
                                        <ul>
                                            <li>{{ $menu->name }}
                                                @if ($menu->children->isNotEmpty())
                                                    <ul>
                                                        @foreach ($menu->children as $child)
                                                            <li>{{ $child->name }}
                                                                @if ($child->children->isNotEmpty())
                                                                    <ul>
                                                                        @foreach ($child->children as $grandchild)
                                                                            <li>{{ $grandchild->name }}
                                                                                @if ($grandchild->children->isNotEmpty())
                                                                                    <ul>
                                                                                        @foreach ($grandchild->children as $greatGrandchild)
                                                                                            <li>{{ $greatGrandchild->name }}
                                                                                            </li>
                                                                                        @endforeach
                                                                                    </ul>
                                                                                @endif
                                                                            </li>
                                                                        @endforeach
                                                                    </ul>
                                                                @endif
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                @endif
                                            </li>
                                        </ul>
                                    </div>

                                </td>
                            </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center">منویی دریافت نشده</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            </td>
        


            @foreach ($menus as $menu)
                <div class="modal fade" id="deleteModal-{{ $menu->id }}" tabindex="-1"
                    aria-labelledby="deleteModalLabel-{{ $menu->id }}" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 style="position: absolute;left: 162px;" class="modal-title"
                                    id="deleteModalLabel-{{ $menu->id }}">حذف منو دریافت شده</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div style="text-align: center;" class="modal-body">
                                آیا می‌خواهید منو "{{ $menu->name }}" حذف شود؟
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">لغو</button>
                                <form action="{{ route('Share.removeShared') }}" method="POST" style="display:inline;">
                                    @csrf
                                    <input type="hidden" name="menu_id" value="{{ $menu->id }}">
                                    <button type="submit" class="btn btn-danger">حذف</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach

            <script>
                $(document).ready(function() {
                    $('.toggle-children').click(function() {
                        var target = $(this).data('target');
                        $(target).toggle();
                        $('#jstree-' + target.split('-')[1]).jstree({
                            "core": {
                                "themes": {
                                    "variant": "large"
                                }
                            }
                        });
                    });
                });
            </script>
        @endsection
    </body>

    </html>
