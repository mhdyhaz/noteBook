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
        text-align: center;
    }

    #lM {
        font-size: 30px;
        position: fixed;
        top: 13rem;
        left: 45rem;

    }
</style>

<body>

    @extends('Layouts.app')

    @section('content')
        <div class="container mt-5">
            <div class="list-container">

                <h1 id="lM">List Menus</h1>
                <table class="table table-striped table-hover">

                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Parent Menu</th>
                            <th>Tags</th>
                            <th>Actions</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($menus as $menu)
                            <tr>
                                <td>{{ $menu->id }}</td>
                                <td>{{ $menu->name }}</td>
                                <td>{{ optional($menu->parent)->name }}</td>
                                <td>
                                    @foreach ($menu->tags as $tag)
                                        {{ $tag->name }}@if (!$loop->last)
                                            ,
                                        @endif
                                    @endforeach
                                </td>
                                <td>
                                    <a href="{{ route('AllMenus.editMenu', $menu->id) }}"
                                        class="btn btn-primary btn-sm">Edit</a>
                                    <button class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                        data-bs-target="#deleteModal-{{ $menu->id }}">Delete</button>
                                </td>
                            </tr>

                            <div class="modal fade" id="deleteModal-{{ $menu->id }}" tabindex="-1"
                                aria-labelledby="deleteModalLabel-{{ $menu->id }}" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="deleteModalLabel-{{ $menu->id }}">Delete Menu
                                            </h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            Are you sure you want to delete the menu "{{ $menu->name }}"?
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Cancel</button>
                                            <form action="{{ route('AllMenus.destroy', $menu->id) }}" method="POST"
                                                style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">Delete</button>
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


        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @endsection
</body>

</html>
