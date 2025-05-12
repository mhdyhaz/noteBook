<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.12.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jstree/3.2.1/themes/default/style.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jstree/3.2.1/jstree.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

    <title>Menu</title>

    <style>
        body {
            background-color: #f8f9fa;
            height: 100vh;
            margin: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .menu-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 35px;
            max-width: 800px;
            right: 300px;
            position: relative;
        }

        .icon-box {
            border: 2px solid #17042670;
            border-radius: 8px;
            width: 8rem;
            background: #f2f0fd7a;
            transition: all 0.3s;
            box-shadow: 0 8px 16px rgba(110, 107, 114, 0.51);
            height: 11rem;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
        }

        .icon-box i {
            font-size: 2.5rem;
            /* کاهش اندازه آیکون */
            color: #521bac;
            margin-bottom: 10px;
        }

        .icon-box:hover {
            border-width: 3px;
            box-shadow: 0 8px 16px rgba(149, 17, 182, 0.651);
        }

        .icon-box a {
            text-decoration: none;
            color: #521bac;
            font-size: 1.2rem;
        }

        .sidebar {
            position: relative;
            margin-top: 64px;
            width: 300px;
            height: 96%;
            overflow-y: auto;
            padding: 27px;
            border-left: 2px dashed #560c58;
            box-sizing: border-box;
            left: 62rem;
        }

        #jstree {
            margin: 35px 7px 33px 27px;
            text-align: right;
            direction: rtl;
        }

        #menu {
            left: 136px;
            position: absolute;
            font-size: 1.4rem;
            font-weight: bold;
            color: #030107;
            text-align: right;
        }

        .modal-content {
            border-radius: 10px;
            text-align: center;
        }

        .modal-title {
            font-weight: bold;
            font-size: 1.2rem;
            color: #343a40;
        }

        .modal-body .form-label {
            font-size: 1rem;
        }

        .btn-primary {
            padding: 10px 20px;
            font-size: 1rem;
            border-radius: 5px;
        }

        #a {
            font-size: 16px;
        }
    </style>
</head>

<body>

    @extends('Layouts.app')

    @section('content')
        @if ($errors->any())
            <div style="text-align: left;width: 31rem;position: relative;left: 61px;" class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="menu-container">
            <div class="icon-box">
                <a id="a" href="{{ route('AllMenus.createMenu') }}">
                    <i class="bi bi-folder-plus"></i><br>منوی جدید
                </a>
            </div>
            <div class="icon-box">
                <a id="a" href="{{ route('AllMenus.list') }}">
                    <i class="bi bi-list-columns"></i><br>لیست منوها
                </a>
            </div>
            <div class="icon-box">
                <a id="a" href="{{ route('Tag.addTag') }}">
                    <i class="bi bi-tag"></i><br>تگ جدید
                </a>
            </div>
            <div class="icon-box">
                <a id="a" href="{{ route('Share.sharedMe') }}">
                    <i class="bi bi-folder-symlink"></i><br>دریافت شده
                </a>
            </div>
            <div class="icon-box">
                <a id="a" href="{{ route('Share.sharedOther') }}">
                    <i class="bi bi-share-fill"></i><br>اشتراک‌گذاری
                </a>
            </div>

        </div>

        <div class="sidebar">
            <h4 id="menu">منوهای ویژه</h4>
            <div id="jstree">
                <ul>

                    @foreach ($menus as $menu)
                        @if ($menu->parent_id == null)
                            <li>
                                {{ $menu->name }}
                                @if ($menu->children->isNotEmpty())
                                    <ul>
                                        @foreach ($menu->children as $child)
                                            <li>
                                                {{ $child->name }}
                                                @if ($child->children->isNotEmpty())
                                                    <ul>
                                                        @foreach ($child->children as $grandchild)
                                                            <li>
                                                                {{ $grandchild->name }}
                                                                @if ($grandchild->children->isNotEmpty())
                                                                    <ul>
                                                                        @foreach ($grandchild->children as $greatGrandchild)
                                                                            <li>{{ $greatGrandchild->name }}</li>
                                                                        @endforeach
                                                                    </ul>
                                                                @endif
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                @endif
                                            </li>
                                        @endforeach
                                    </ul>
                                @endif
                            </li>
                        @endif
                    @endforeach
                </ul>
            </div>
        </div>


        <div class="modal fade" id="shareMenuModal" tabindex="-1" aria-labelledby="shareMenuModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">

                    <div class="modal-header">
                        <h5 style="position: relative;left: 160px;" class="modal-title" id="shareMenuModalLabel">
                            اشتراک‌گذاری منو</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            style="position: absolute;"></button>
                    </div>
                    <div class="modal-body">
                        <form id="shareMenuForm">
                            <div class="mb-3">
                                <label for="email" class="form-label">ایمیل کاربر</label>
                                <input type="email" class="form-control" id="email" required>
                            </div>
                            <input type="hidden" id="menuId">
                            <button style="position: relative;left: 199px; background-color:#581a6f; border:none;"
                                type="submit" class="btn btn-primary">ارسال</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>


        <script>
            $(function () {
                $('#jstree').jstree({
                    // برای کشیدن ورها کردن
                    "core": {
                        'check_callback': true, // این اجازه می‌ده که گره‌ها رو جابه‌جا کنیم
                        "themes": {
                            "variant": "large"
                        },
                        "data": function (obj, callback) {
                            var data = [
                                @foreach ($menus as $menu)
                                    @if ($menu->parent_id == null)                                                                                                                                                                                                                                                                                                                                                                                             
                                                {
                                            "text": "{{ $menu->name }} <i class='bi bi-share-fill share-icon' onclick='openShareModal({{ $menu->id }})'></i>",
                                            "id": "{{ $menu->id }}",
                                            "li_attr": {
                                                "style": "color: black;"
                                            },
                                            "icon": "{{ $menu->children->isNotEmpty() ? 'jstree-folder' : 'jstree-file' }}",
                                            "state": {
                                                "opened": false
                                            },
                                            "children": [
                                                @foreach ($menu->children as $child)
                                                                                                                                                                                                        {
                                                        "text": "{{ $child->name }} <i class='bi bi-share-fill share-icon' onclick='openShareModal({{ $child->id }})'></i>",
                                                        "id": "{{ $child->id }}",
                                                        "icon": "{{ $child->children->isNotEmpty() ? 'jstree-folder' : 'jstree-file' }}",
                                                        "children": [
                                                            @foreach ($child->children as $grandchild)
                                                                                                                                                                                                                                                {
                                                                    "text": "{{ $grandchild->name }} <i class='bi bi-share-fill share-icon' onclick='openShareModal({{ $grandchild->id }})'></i>",
                                                                    "id": "{{ $grandchild->id }}",
                                                                    "icon": "{{ $grandchild->children->isNotEmpty() ? 'jstree-folder' : 'jstree-file' }}",
                                                                    "children": [
                                                                        @foreach ($grandchild->children as $greatGrandchild)
                                                                                                                                                                                                                                                                                        {
                                                                                "text": "{{ $greatGrandchild->name }} <i class='bi bi-share-fill share-icon' onclick='openShareModal({{ $greatGrandchild->id }})'></i>",
                                                                                "id": "{{ $greatGrandchild->id }}",
                                                                                "icon": "{{ $greatGrandchild->children->isNotEmpty() ? 'jstree-folder' : 'jstree-file' }}"
                                                                            },
                                                                        @endforeach
                                                                                                                                                                                                                                                    ]
                                                                },
                                                            @endforeach
                                                                                                                                                                                                            ]
                                                    },
                                                @endforeach
                                                                                                                                                                    ]
                                        },
                                    @endif
                                @endforeach
                                                                ];
                            callback(data);
                        }
                    },
                    //  drag&dropفعال کردن 
                    'plugins': ["dnd"]
                });
            });

            function openShareModal(menuId) {
                // نمایش مودال و پردازش لازم برای اشتراک‌گذاری منو
                $('#shareMenuModal').modal('show'); // نمایش مودال صحیح
                $('#menuId').val(menuId); // مقداردهی صحیح ID منو به فیلد مخفی در مودال
            }

            $('#shareMenuForm').on('submit', function (event) {
                event.preventDefault();

                var email = $('#email').val();
                var menuId = $('#menuId').val();

                // بررسی وجود ایمیل
                $.ajax({
                    url: '/check-email',
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        email: email
                    },
                    success: function (response) {
                        if (response.success) {
                            // ایمیل معتبر است، حالا منو را ارسال کنید
                            $.ajax({
                                url: '{{ route('Share.shareMenu') }}',
                                method: 'POST',
                                data: {
                                    _token: '{{ csrf_token() }}',
                                    email: email,
                                    menu_id: menuId
                                },
                                success: function (response) {
                                    if (response.message ===
                                        'منو با موفقیت به اشتراک گذاشته شد') {
                                        alert('منو با موفقیت به ایمیل ارسال شد.');
                                        $('#shareMenuModal').modal('hide');
                                    } else {
                                        alert(response.message);
                                    }
                                },
                                error: function (xhr) {
                                    console.error(xhr.responseText);
                                    alert('خطایی رخ داده است. دوباره تلاش کنید.');
                                }
                            });
                        } else {
                            alert(response.message);
                        }
                    },
                    error: function (xhr) {
                        console.error(xhr.responseText);
                        alert('خطایی در بررسی ایمیل رخ داده است.');
                    }
                });
            });
            $('#jstree').on('move_node.jstree', function (e, data) {
                let movedNodeId = data.node.id;
                let newParentId = data.parent;
                let oldParentId = data.old_parent;
                let position = data.position;

                $.ajax({
                    url: '/save-menu-order',
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        id: movedNodeId,
                        parent_id: newParentId === "#" ? null : newParentId,
                        position: position
                    },
                    success: function (response) {
                        console.log('ذخیره شد:', response);

                        const tree = $('#jstree').jstree(true);

                        // به‌روزرسانی آیکون گره جابجا شده
                        const movedNodeHasChildren = tree.get_node(movedNodeId).children.length > 0;
                        tree.set_icon(movedNodeId, movedNodeHasChildren ? 'jstree-folder' : 'jstree-file');

                        // به‌روزرسانی آیکون پدر جدید
                        if (newParentId !== "#") {
                            const newParentHasChildren = tree.get_node(newParentId).children.length > 0;
                            tree.set_icon(newParentId, newParentHasChildren ? 'jstree-folder' : 'jstree-file');
                        }

                        // به‌روزرسانی آیکون پدر قدیمی
                        if (oldParentId !== "#") {
                            const oldParentHasChildren = tree.get_node(oldParentId).children.length > 0;
                            tree.set_icon(oldParentId, oldParentHasChildren ? 'jstree-folder' : 'jstree-file');
                        }
                    },
                    error: function (xhr) {
                        console.error('خطا در ذخیره:', xhr.responseText);
                    }
                });
            });
        </script>

    @endsection
</body>



</html>