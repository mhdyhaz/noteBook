<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.12.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jstree/3.2.1/themes/default/style.min.css" />
    <title>Menu</title>

    <style>
        body {
            background-color: #f8f9fa;
            height: 100vh;
            overflow: hidden;
        }

        .menu-container {
            text-align: center;
            position: absolute;
            top: 40%;
            left: 50%;
            transform: translate(-50%, -50%);
            display: flex;
            gap:35px;
            
        }

        .icon-box {
            border: 2px solid #3000dd;
            border-radius: 8px;
            padding: 20px;
            width: 9rem;
            background: #f2f0fd7a;
            transition: all 0.3s;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.43);
            height: 11rem;
        }

        .icon-box:hover {
            border-width: 4px;
            box-shadow: 0 8px 16px rgba(4, 0, 0, 0.877);
        }

        .icon-box i {
            font-size: 3rem;
            color: #0d021f;
        }

        .sidebar {
            position: fixed;
            bottom: 12rem;
            width: 92rem;
            overflow-y: auto;
            display: block;
        }

        #jstree {
            margin: 35px 7px 33px 27px;
            text-align: right;
            direction: rtl;
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
            text-align: right;
        }

        .modal-content {
            border-radius: 10px;
            text-align: center;
        }

        .modal-title {
            font-weight: bold;
            color: #343a40;
        }
    </style>
</head>

<body>

    @extends('Layouts.app')

    @section('content')
    @php
        $hideBackButton = true;
    @endphp
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    
    <div class="menu-container">
        <div class="icon-box">
            <a id="a" href="{{ route('Share.sharedOther') }}">
                <i class="bi bi-share-fill"></i><br>اشتراک‌گذاری
            </a>
        </div>
        <div class="icon-box">
            <a id="a" href="{{ route('Share.sharedMe') }}">
                <i class="bi bi-folder-symlink"></i><br>اشتراک گذاشته شده با من
            </a>
        </div>
        <div class="icon-box">
            <a id="a" href="{{ route('Tag.addTag') }}">
                <i class="bi bi-tag"></i><br>تگ جدید
            </a>
        </div>
        <div class="icon-box">
            <a id="a" href="{{ route('AllMenus.list') }}">
                <i class="bi bi-list-columns"></i><br>لیست منوها
            </a>
        </div>
        <div class="icon-box">
            <a id="a" href="{{ route('AllMenus.createMenu') }}">
                <i class="bi bi-folder-plus"></i><br>منوی جدید
            </a>
        </div>
    </div>

    <div class="sidebar">
        <h4 id="menu">:منوهای من </h4>
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
                    <h5  style="position: relative;left: 154px;" class="modal-title" id="shareMenuModalLabel">اشتراک‌گذاری منو</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form id="shareMenuForm">
                        <div class="mb-3">
                            <label for="email" class="form-label">ایمیل کاربر</label>
                            <input type="email" class="form-control" id="email" required>
                        </div>
                        <input type="hidden" id="menuId">
                        <button style="position: relative;left: 199px"  type="submit" class="btn btn-primary">ارسال</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
    <script>
        $(function () {
          $('#jstree').jstree({
              "core": {
                  "themes": {
                      "variant": "large"
                  },
                  "data": function (obj, callback) {
                      var data = [
                          @foreach ($menus as $menu)
                          @if ($menu->parent_id == null)
                          {
                              "text": "{{ $menu->name }} <i class='bi bi-share-fill share-icon' onclick='openShareModal({{ $menu->id }})'></i>",
                              "icon": "{{ $menu->children->isNotEmpty() ? 'jstree-folder' : 'jstree-file' }}",
                              "state": { "opened": false },
                              "children": [
                                  @foreach ($menu->children as $child)
                                  {
                                      "text": "{{ $child->name }} <i class='bi bi-share-fill share-icon' onclick='openShareModal({{ $child->id }})'></i>",
                                      "icon": "{{ $child->children->isNotEmpty() ? 'jstree-folder' : 'jstree-file' }}",
                                      "children": [
                                          @foreach ($child->children as $grandchild)
                                          {
                                              "text": "{{ $grandchild->name }} <i class='bi bi-share-fill share-icon' onclick='openShareModal({{ $grandchild->id }})'></i>",
                                              "icon": "{{ $grandchild->children->isNotEmpty() ? 'jstree-folder' : 'jstree-file' }}",
                                              "children": [
                                                  @foreach ($grandchild->children as $greatGrandchild)
                                                  {
                                                      "text": "{{ $greatGrandchild->name }} <i class='bi bi-share-fill share-icon' onclick='openShareModal({{ $greatGrandchild->id }})'></i>",
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
              }
          });
      });
      
      function openShareModal(menuId) {
          // نمایش مودال و پردازش لازم برای اشتراک‌گذاری منو
          $('#shareMenuModal').modal('show');  // نمایش مودال صحیح
          $('#menuId').val(menuId); // مقداردهی صحیح ID منو به فیلد مخفی در مودال
      }
      
      $('#shareMenuForm').on('submit', function(event) {
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
              success: function(response) {
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
                          success: function(response) {
                              if (response.message === 'منو با موفقیت به اشتراک گذاشته شد') {
                                  alert('منو با موفقیت به ایمیل ارسال شد.');
                                  $('#shareMenuModal').modal('hide');
                              } else {
                                  alert(response.message);
                              }
                          },
                          error: function(xhr) {
                              console.error(xhr.responseText);
                              alert('خطایی رخ داده است. دوباره تلاش کنید.');
                          }
                      });
                  } else {
                      alert(response.message);
                  }
              },
              error: function(xhr) {
                  console.error(xhr.responseText);
                  alert('خطایی در بررسی ایمیل رخ داده است.');
              }
          });
      });
      </script>
      
@endsection
</body>



</html>
