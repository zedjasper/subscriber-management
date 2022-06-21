<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{config('app.name')}}</title>

        <meta name="csrf-token" content="{{ csrf_token() }}">

        <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
        <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/MaterialDesign-Webfont/6.7.96/css/materialdesignicons.min.css" integrity="sha512-q0UoFEi8iIvFQbO/RkDgp3TtGAu2pqYHezvn92tjOq09vvPOxgw4GHN3aomT9RtNZeOuZHIoSPK9I9bEXT3FYA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css" />
        <link href="/css/app.css" rel="stylesheet" />
    </head>
    <body>
        <div class="container pt-4 pb-4" id="app">
            <div class="row">
                <div class="col-md-12 mb-3 d-flex flex-row-reverse">
                    <a href="/users/logout" class="btn btn-sm btn-danger">Logout</a>
                    <span class="pl-3">{{auth()->user()->name}}</span>
                </div>
            </div>
            
            @include('messages')
            
            @yield('content')
        </div>
    </body>
</html>