<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <style>
        .share-container {
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
            font-size: 18px;
        }

        .modal-footer button[type="submit"] {
            position: relative;
            padding: 2px 9px;
            right: 360px;
            background-color:#dc3545;
            color: #ffe4e4;
        }

        .modal-footer button[type="button"] {
            position: relative;
            padding: 2px 15px;
            right: 355px;


        }
    </style>

</head>

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
        <div class="share-container">

            <h2 id="lM">منوهای اشتراک‌ گذاشته شده</h2>


            @if (session('error'))
                <div style="text-align: left;width: 32rem;position: relative;left: 61px;" class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif

            <table style="text-align: center;" class="table table-striped table-hover">
                <thead>
                    <tr style="border: solid 1px #cacaca; border-block-end-style: double;">
                        <th>عملیات</th>
                        <th>دریافت کننده</th>
                        <th>تگ</th>
                        <th>منو اصلی</th>
                        <th>نام منو</th>
                        <th>شناسه</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($sharedMenus->isNotEmpty())
                        @foreach ($sharedMenus as $menuShare)
                            <tr>
                                <td>
                                    <button id="delete" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                        data-bs-target="#deleteModal-{{ $menuShare->menu->id }}">
                                        <i class="bi bi-trash"></i></button>
                                </td>
                                <td>{{ $menuShare->user->name }}</td>
                                <td>
                                    @foreach ($menuShare->menu->tags as $tag)
                                        {{ $tag->name }}@if (!$loop->last)
                                            ,
                                        @endif
                                    @endforeach
                                </td>
                                <td>{{ optional($menuShare->menu->parent)->name }}</td>
                                <td>{{ $menuShare->menu->name }}</td>
                                <td>{{ convertToPersianNumbers($menuShare->menu->id) }}</td>

                            </tr>

                            <!-- Modal for Delete -->
                            <div class="modal fade" id="deleteModal-{{ $menuShare->menu->id }}" tabindex="-1"
                                aria-labelledby="deleteModalLabel-{{ $menuShare->menu->id }}" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" style="position: absolute;left: 178px;"
                                                id="deleteModalLabel-{{ $menuShare->menu->id }}">حذف اشتراک‌گذاری</h5>

                                        </div>
                                        <div class="modal-body">
                                            آیا مطمئنید که می‌خواهید منوی "{{ $menuShare->menu->name }}" را حذف کنید؟
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">لغو</button>
                                            <form action="{{ route('shared-menu.remove-as-sender') }}" method="POST"
                                                style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <input type="hidden" name="menu_id" value="{{ $menuShare->menu->id }}">
                                                <input type="hidden" name="receiver_id"
                                                    value="{{ $menuShare->user->id }}">
                                                <button type="submit" class="btn btn-danger-building">حذف</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="6" class="text-center">منویی به اشتراک گذاشته نشده </td>
                        </tr>
                    @endif

                </tbody>
            </table>
        </div>
    </div>

@endsection
