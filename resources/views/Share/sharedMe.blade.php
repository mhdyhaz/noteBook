<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style>
        .list-container {
            font-family: initial;
            color: black;
            text-align: right;
            width: 75rem;
        }

        #lM {
            font-size: 30px;
            position: fixed;
            top: 13rem;
            left: 41rem;
        }

        #delete {
            padding: 3px 14px;
        }
    </style>
</head>

@extends('Layouts.app')

@section('content')
<div class="container">
    <h1 id="lM">منوهای ارسال‌شده به من</h1>
    
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table style="text-align: center;" class="table table-striped table-hover">
        <thead>
            <tr>
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
                        <button id="delete" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                data-bs-target="#deleteModal-{{ $menu->id }}">حذف</button>
                    </td>
                    <td>{{ $menu->user->name }}</td>
                    <td>
                        @foreach ($menu->tags as $tag)
                            {{ $tag->name }}@if (!$loop->last) , @endif
                        @endforeach
                    </td>
                    <td>{{ optional($menu->parent)->name }}</td>
                    <td>{{ $menu->name }}</td>
                    <td>{{ $menu->id }}</td>
                </tr>
             

                <div class="modal fade" id="deleteModal-{{ $menu->id }}" tabindex="-1"
                     aria-labelledby="deleteModalLabel-{{ $menu->id }}" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 style="position: relative; left: 13rem;" class="modal-title" id="deleteModalLabel-{{ $menu->id }}">حذف منو دریافت شده</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                            </div>
                            <div style="text-align: center;" class="modal-body">
                                آیامیخواهی منو "{{ $menu->name }}" حذف شود؟
                            </div>
                            <div class="modal-footer">
                                <button style="position: relative; padding: 4px 15px; right: 355px;" type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">لغو</button>
                                        <form action="{{ route('Share.removeShared') }}" method="POST" style="display:inline;">
                                            @csrf
                                            <input type="hidden" name="menu_id" value="{{ $menu->id }}">
                                            <button style="padding: 4px 9px;" type="submit" class="btn btn-danger">حذف</button>
                                        </form>
                                        
                            </div>
                        </div>
                    </div>
                </div>
                
            @empty
                <tr>
                    <td colspan="6" class="text-center">منویی دریافت نشده</td>
                </tr>
            @endforelse
            
        </tbody>
    </table>
</div>
@endsection
