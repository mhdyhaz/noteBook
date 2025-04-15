<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jstree/3.3.12/themes/default/style.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jstree/3.3.12/jstree.min.js"></script>
    <style>
        .container {
            display: flex;
            justify-content: space-between;
        }

        .list-container {
           
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

        table {
            width: 100%;
            table-layout: fixed;
        }

        #cancel {
            position: relative;
            padding: 2px 15px;
            right: 355px;
        }

        #delete2 {
            position: relative;
            padding: 2px 9px;
            right: 344px;
        }

        table th,
        table td {
            white-space: nowrap;
            text-align: center;
            padding: 10px;
        }

        #eye {
            background: none;
            font-size: 18px;
            border: none;
        }

        #delete {
            background: none;
            color: rgb(182, 10, 10);
            border: none;
            font-size: 18px;
        }

        .modal-content {
            text-align: right;
        }

        .modal-dialog {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .modal-content.tree-modal {
            margin-top: 100px;
        }

        .li {
            direction: rtl;
        }
        #lM{
            font-size: 18px;
            margin-bottom: 2rem;
            text-align: right;
            padding: 14px 0px;
        }

    </style>
</head>

<body>
    @extends('Layouts.app')
    @section('content')
        @php
            function convertToPersianNumbers($number)
            {
                $persianNumbers = ['۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹'];
                return str_replace(range(0, 9), $persianNumbers, $number);
            }
        @endphp
        <div class="container">
            <div class="list-container">
                <h1 id="lM">منوهای دریافتی</h1>
                <table class="table table-striped table-hover">
                    <thead>
                        <tr style="border-block-end-style: double;border: solid 1px #cacaca;">
                            <th>عملیات</th>
                            <th>ارسال‌کننده</th>
                            <th>تگ</th>
                            <th>منوی اصلی</th>
                            <th>نام منو</th>
                            <th>شناسه</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($menus as $menu)
                            <tr>
                                <td>

                                    <button id="eye" class="btn btn-info btn-sm" data-bs-toggle="modal"
                                        data-bs-target="#menuModal-{{ $menu->id }}">
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

                            <div class="modal fade" id="deleteModal-{{ $menu->id }}" tabindex="-1"
                                aria-labelledby="deleteModalLabel-{{ $menu->id }}" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content" style="position: absolute;bottom: 47rem;">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="deleteModalLabel-{{ $menu->id }}"
                                                style="position: absolute; left: 162px;">حذف منو دریافت شده</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body" style="text-align: center; ">
                                            آیا می‌خواهید منو "{{ $menu->name }}" حذف شود؟
                                        </div>
                                        <div class="modal-footer">
                                            <button id="cancel" type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">لغو</button>
                                            <form action="{{ route('Share.removeShared') }}" method="POST"
                                                style="display:inline;">
                                                @csrf
                                                <input type="hidden" name="menu_id" value="{{ $menu->id }}">
                                                <button id="delete2" type="submit" class="btn btn-danger">حذف</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Modal نمایش درختی -->
                            <!-- Modal برای هر منو -->
                            <div class="modal fade" id="menuModal-{{ $menu->id }}" tabindex="-1"
                                aria-labelledby="menuModalLabel-{{ $menu->id }}" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content" style="position: absolute; bottom: 30rem;">
                                        <div class="modal-header">
                                            <h5 style="position: absolute;left: 209px;" class="modal-title"
                                                id="menuModalLabel-{{ $menu->id }}">منوی درختی</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div style=" direction: rtl;" id="jstree-{{ $menu->id }}"
                                                class="jstree-wrapper">
                                                <ul>
                                                    <li>{{ $menu->name }}
                                                        @if ($menu->children->isNotEmpty())
                                                            <ul>
                                                                @foreach ($menu->children as $child)
                                                                    <li>{{ $child->name }}
                                                                        @if ($child->children->isNotEmpty())
                                                                            <ul>
                                                                                @foreach ($child->children as $grandchild)
                                                                                    <li>{{ $grandchild->name }}</li>
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
                                        </div>
                                        <div class="modal-footer">
                                            <button
                                                style="padding: 2px 12px;text-align: center;position: relative;right: 26rem;"
                                                type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">بستن</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @empty
                                <tr  >
                                    <td colspan="6" class="text-center">منویی دریافت نشده</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <script>
                $(document).ready(function() {
                    @foreach ($menus as $menu)
                        $('#menuModal-{{ $menu->id }}').on('shown.bs.modal', function() {
                            $('#jstree-{{ $menu->id }}').jstree({
                                "core": {
                                    "themes": {
                                        "variant": "large"
                                    }
                                }
                            });
                        });
                    @endforeach
                });
            </script>

        @endsection
    </body>

    </html>
