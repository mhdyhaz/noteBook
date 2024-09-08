<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">

        <style>
            .share-container{
            font-family: initial;
            display: flex;
            justify-content: center;
            align-items: center;
            width: 70rem;
           text-align: center;
            }

        </style>

    </head>

    <body>

        @extends('Layouts.app')

        @section('content')
        <div class="share-container">
        <div class="container mt-5">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th> Id</th>
                        <th> Name</th>
                        <th>Parent</th>
                        <th>Tags</th>
                        <th>Shared with me </th>
                        <th>Action</th>

                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>محتوا ۱</td>
                        <td>محتوا ۱</td>
                        <td>محتوا ۱</td>
                        <td>محتوا ۱</td>
                        <td>محتوا ۱</td>
                        <td>محتوا ۱</td>
                    </tr>
                    <tr>
                        <td>محتوا ۴</td>
                        <td>محتوا ۱</td>
                        <td>محتوا ۱</td>
                        <td>محتوا ۱</td>
                        <td>محتوا ۱</td>
                        <td>محتوا ۱</td>
                    </tr>
              
                
                </tbody>
            </table>
        </div>
    
    </div>
        @endsection
    
    </body>
    </html>
    