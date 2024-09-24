@extends('Layouts.app')

@section('content')
<style>
    .share-container {
        background-color: #f8f9fa;
        border-radius: 12px;
        padding: 20px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        margin: auto;
        width: 80%;
        max-width: 600px;
        text-align: center;
    }

    .share-header {
        font-size: 24px;
        margin-bottom: 20px;
        color: #333;
    }

    .share-form {
        margin-bottom: 20px;
    }

    .share-button {
        background-color: #007bff;
        color: white;
        padding: 10px 15px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        transition: background-color 0.3s;
    }

    .share-button:hover {
        background-color: #0056b3;
    }
</style>

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
