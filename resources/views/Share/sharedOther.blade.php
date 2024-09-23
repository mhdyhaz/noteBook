<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <style>
        .share-container {
            font-family: initial;
            color: black;
            width: 80rem;
            margin: auto;
            margin-bottom: 30rem;
            background-color: #f8f9fa;
            padding: 6px 62px;
            border-radius: 12px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.41);
            height: 42rem;
            position: absolute;
            top: 9rem;
            text-align: center; 
        }

        #lM {
            font-size: 30px;
            margin-bottom: 2rem; /* Increased margin-bottom to create space */
        }
    </style>

</head>

@extends('Layouts.app')

@section('content')

    <div class="container">
        <div class="share-container">
        
        <h2 id="lM">منوهای ارسال‌شده</h2>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

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

                    <!-- Modal for Delete -->
                    <div class="modal fade" id="deleteModal-{{ $menuShare->menu->id }}" tabindex="-1"
                         aria-labelledby="deleteModalLabel-{{ $menuShare->menu->id }}" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="deleteModalLabel-{{ $menuShare->menu->id }}">حذف منو ارسال‌شده</h5>
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">لغو</button>
                                </div>
                                <div class="modal-body">
                                    آیا مطمئنید که می‌خواهید منوی "{{ $menuShare->menu->name }}" را از {{ $menuShare->user->name }} حذف کنید؟
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">لغو</button>
                                    <form action="{{ route('shared-menu.remove-as-sender') }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <input type="hidden" name="menu_id" value="{{ $menuShare->menu->id }}">
                                        <input type="hidden" name="receiver_id" value="{{ $menuShare->user->id }}">
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
</div>

@endsection
