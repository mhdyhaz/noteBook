<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jstree/3.3.12/themes/default/style.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jstree/3.3.12/jstree.min.js"></script>

    <style>
        body {
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
            height: 100vh;
            overflow: hidden;
        }

        .menu-container {
            text-align: center;
            position: absolute;
            top: 42%;
            left: 50%;
            transform: translate(-50%, -50%);
            max-width: 44rem;
            display: flex;
            flex-wrap: unset;
            gap: 21px;
        }

        .icon-box {
            border: 2px solid #3000dd;
            border-radius: 8px;
            padding: 19px;
            box-shadow: 0 4px 8px rgba(23, 22, 22, 0.55);
            flex: 1;
            max-width: 132px;
            margin: 1px;
            background: #f2f0fd7a;
            transition: border-width 0.1s ease, box-shadow 0.1s ease;
        }

        .icon-box:hover {
            border-width: 4px;
            box-shadow: 0 8px 16px rgba(4, 0, 0, 0.79);
        }

        .icon-box i {
            font-size: 3rem;
            color: #0d021f;
        }

        .sidebar {
            position: fixed;
            bottom: 140px;
            left: 50px;
            padding: 20px;
            border-radius: 8px;
            width: 250px;
            max-height: calc(100vh - 50px);
            overflow-y: auto;
        }

        #jstree {
            margin: 35px 7px 33px 27px;
        }

        #a {
            text-decoration: none;
            font-family: initial;
            color: #030107;
        }

        #menu {
            font-family: initial;
            color: #030107;
            font-size: 22px;
        }

        .jstree-icon.jstree-folder {
            background: url('https://cdnjs.cloudflare.com/ajax/libs/jstree/3.3.12/themes/default/files/jstree-folder.png') no-repeat center center;
        }

        .jstree-icon.jstree-file {
            background: url('https://cdnjs.cloudflare.com/ajax/libs/jstree/3.3.12/themes/default/files/jstree-file.png') no-repeat center center;
        }

        .jstree-icon.jstree-closed {
            background: url('https://cdnjs.cloudflare.com/ajax/libs/jstree/3.3.12/themes/default/files/jstree-closed.png') no-repeat center center;
        }

        .jstree-icon.jstree-open {
            background: url('https://cdnjs.cloudflare.com/ajax/libs/jstree/3.3.12/themes/default/files/jstree-open.png') no-repeat center center;
        }
    </style>
</head>

<body>
    @extends('Layouts.app')

    @section('content')
        @php
            $hideBackButton = true;
        @endphp

        <div class="menu-container">
             <div class="icon-box">
                <a id="a" href="{{ route('AllMenus.createMenu') }}"><i class="bi  bi-folder-plus"></i> Create New Menu</a>
            </div>
            <div class="icon-box">
                <a id="a" href="{{ route('AllMenus.list') }}">
                    <i class="bi bi-list-columns"></i> Edit Menus
                </a>
            </div>

           
            <div class="icon-box">
                <a id="a" href="{{ route('Tag.addTag') }}"><i class="bi bi-tag"></i> Add A New Tag</a>
            </div>
            <div class="icon-box">
                <a id="a" href="{{ route('Share.sharedMe') }}"><i class="bi bi-share-fill"></i> Shared With Me Menus</a>
            </div>
            <div class="icon-box">
                <a id="a" href="{{ route('Share.sharedOther') }}"><i class="bi bi-folder-symlink"></i> Shared With Others</a>
            </div>
        </div>

        <div class="sidebar">
            <h4 id="menu">Your Menus : </h4>
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
            
        <script>
         $(function() {
    $('#jstree').jstree({
        "core": {
            "themes": {
                "variant": "large"
            },
            "data": function(obj, callback) {
                var data = [
                    @foreach ($menus as $menu)
                        @if ($menu->parent_id == null)
                            {
                                "text": "{{ $menu->name }}",
                                "icon": "{{ $menu->children->isNotEmpty() ? 'jstree-folder' : 'jstree-file' }}",
                                "children": [
                                    @foreach ($menu->children as $child)
                                        {
                                            "text": "{{ $child->name }}",
                                            "icon": "{{ $child->children->isNotEmpty() ? 'jstree-folder' : 'jstree-file' }}",
                                            "children": [
                                                @foreach ($child->children as $grandchild)
                                                    {
                                                        "text": "{{ $grandchild->name }}",
                                                        "icon": "{{ $grandchild->children->isNotEmpty() ? 'jstree-folder' : 'jstree-file' }}",
                                                        "children": [
                                                            @foreach ($grandchild->children as $greatGrandchild)
                                                                {
                                                                    "text": "{{ $greatGrandchild->name }}",
                                                                    "icon": "jstree-file"
                                                                }
                                                            @endforeach
                                                        ]
                                                    }
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
        }
    });
});

        
        </script>
    @endsection
</body>
</html>
