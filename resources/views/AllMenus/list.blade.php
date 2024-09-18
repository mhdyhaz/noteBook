<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Menu</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<style>

    .list-container {
        font-family: initial;
        color: black;
        width: 80rem;
        margin: auto;
        margin-bottom: 30rem;
        background-color: #f8f9fa;
        padding: 1.5rem;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        height: 43rem;
    }

    #lM {
        font-size: 30px;
        font-weight: bold;
        text-align: center;
        padding-bottom: 10px;
    }

    .table-container {
        max-height: 400px;
        overflow-y: auto;
        margin-top: 1rem;
    }

    thead th {
        position: sticky;
        top: 0;
        background-color: #007bff;
        color: white;
        z-index: 1;
    }

    #edit {
        background-color: rgb(38, 38, 148);
        padding: 3px 9px;
        margin: 2px 31px;
    }

    #delete {
        padding: 3px 14px;
    }
</style>

<body>

    @extends('Layouts.app')

    @section('content')
        <div class="container mt-5">
          
            <div class="list-container">
                <h1 id="lM">لیست منوها</h1>

                <!-- جدول درون یک کادر با قابلیت اسکرول -->
                <div class="table-container">
                    <table class="table table-striped table-hover">

                        <thead>
                            <tr>
                                <th>عملیات</th>
                                <th>تگ</th>
                                <th>منوی اصلی</th>
                                <th>نام منو</th>
                                <th>شناسه</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($menus as $menu)
                                <tr>
                                    <td>
                                        <a id="edit" href="{{ route('AllMenus.editMenu', $menu->id) }}"
                                            class="btn btn-primary btn-sm">ویرایش</a>
                                        <button id="delete" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                            data-bs-target="#deleteModal-{{ $menu->id }}">حذف</button>
                                    </td>
                                    <td>
                                        @foreach ($menu->tags as $tag)
                                            {{ $tag->name }}@if (!$loop->last), @endif
                                        @endforeach
                                    </td>
                                    <td>{{ optional($menu->parent)->name }}</td>
                                    <td>{{ $menu->name }}</td>
                                    <td>{{ $menu->id }}</td>
                                </tr>

                                <!-- مودال حذف -->
                                <div class="modal fade" id="deleteModal-{{ $menu->id }}" tabindex="-1"
                                    aria-labelledby="deleteModalLabel-{{ $menu->id }}" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 style="position: relative; left: 13rem;" class="modal-title"
                                                    id="deleteModalLabel-{{ $menu->id }}">حذف منو</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div style="text-align: center;" class="modal-body">
                                                آیا می‌خواهید منو "{{ $menu->name }}" حذف شود؟
                                            </div>
                                            <div class="modal-footer">
                                                <button style="position: relative; padding: 4px 15px;right: 355px;"
                                                    type="button" class="btn btn-secondary" data-bs-dismiss="modal">لغو</button>
                                                <form action="{{ route('AllMenus.destroy', $menu->id) }}" method="POST"
                                                    style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button style="padding: 4px 9px;" type="submit"
                                                        class="btn btn-danger">حذف</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @endsection
</body>

</html>
