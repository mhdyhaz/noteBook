<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>اشتراک‌گذاری منو</title>
</head>
<body>
    <h1>اشتراک‌گذاری منو</h1>
    <p>سلام،</p>
    <p>منو {{ $menu->name }} توسط {{ $user->name }} با شما به اشتراک گذاشته شده است.</p>
    <p>تگ‌ها:</p>
    <ul>
        @foreach ($menu->tags as $tag)
            <li>{{ $tag->name }}</li>
        @endforeach
    </ul>
    <p>با تشکر</p>
</body>
</html>
