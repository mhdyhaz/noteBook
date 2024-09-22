<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <style>
        .share-container {
            font-family: initial;
            display: flex;
            justify-content: center;
            align-items: center;
            width: 70rem;
            text-align: center;
        }

        #lM {
            font-size: 30px;
            position: fixed;
            top: 13rem;
            left: 41rem;
        }
    </style>

</head>

@extends('Layouts.app')

@section('content')

    <div class="container">
        <h2 id="lm">منوهای ارسال‌شده</h2>

        <table style="text-align: center;" class="table table-striped table-hover">
            <thead>
                <tr>
                    <th>عملیات</th>
                    <th>دریافت کننده</th>
                    <th>تگ</th>
                    <th>منو اصلی</th>
                    <th>نام منو</th>
                    <th>شناسه</th>
                </tr>
            </thead>
            <tbody>
                @if($sharedMenus->isNotEmpty())
                @foreach ($sharedMenus as $menuShare)
                <tr>
                    <td>
                        <button id="delete" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                data-bs-target="#deleteModal-{{ $menuShare->menu->id }}">حذف</button>
                    </td>
                       <td>{{ $menuShare->user->name }}</td>
                        <td>
                            @foreach ($menuShare->menu->tags as $tag)
                                {{ $tag->name }}@if (!$loop->last), @endif
                            @endforeach
                        </td>
                        <td>{{ optional($menuShare->menu->parent)->name }}</td>
                        <td>{{ $menuShare->menu->name }}</td>
                        <td>{{ $menuShare->menu->id }}</td>
                    </tr>

            
                <div class="modal fade" id="deleteModal-{{ $menuShare->menu->id }}" tabindex="-1"
                     aria-labelledby="deleteModalLabel-{{ $menuShare->menu->id }}" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="deleteModalLabel-{{ $menuShare->menu->id }}">حذف منو ارسال‌شده</h5>
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">لغو</button>
                            </div>
                            <div class="modal-body">
                                آیا مطمئنید که می‌خواهید منوی "{{ $menuShare->menu->name }}" را حذف کنید؟
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">لغو</button>
                                <form action="{{ route('Share.removeShared') }}" method="POST" style="display:inline;">
                                    @csrf
                                    <input type="hidden" name="menu_id" value="{{ $menuShare->menu->id }}">
                                    <button type="submit" class="btn btn-danger">حذف</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
          
            @else
                <tr>
                    <td colspan="6" class="text-center">منویی ارسال نشده</td>
                </tr>
            @endif
            
            </tbody>
        </table>
    </div>

@endsection
