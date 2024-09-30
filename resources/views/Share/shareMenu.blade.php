@extends('Layouts.app')

@section('content')


<div class="container">
    <div class="share-container">
        <h1 class="share-header">اشتراک‌گذاری منو</h1>
        <form class="share-form" action="{{ route('Share.shareMenu') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="email" class="form-label">ایمیل کاربر:</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="mb-3">
                <label for="menu_id" class="form-label">شناسه منو:</label>
                <input type="text" class="form-control" id="menu_id" name="menu_id" required>
            </div>
            <button type="submit" class="share-button">اشتراک‌گذاری</button>
        </form>
    </div>
</div>
@endsection
