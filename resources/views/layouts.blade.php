<!DOCTYPE html>
<html lang="ar">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EL-HEFNAWY</title>
    <link rel="shortcut icon" sizes="1024x1024" href="{{ asset('images/toktok.jpg') }}" >

    <link rel="stylesheet" type="text/css" href="{{ asset('css/jquery.dataTables.min.css')}}">
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/fontawsome/all.css') }}" rel="stylesheet">
    <link href="{{asset('css/sweetalert.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('css/styles.css')}}" rel="stylesheet" type="text/css" />
    <link href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.dataTables.min.css" rel="stylesheet" type="text/css" />
</head>

<body>

    <div class="row w-100 mx-0 px-0 ">
        <div class="col-12 mx-0 px-0">
            <img src="{{ asset('images/pannar.jpg') }}" alt="الحفناوي" id="pannar">
        </div>
    </div>
    <div class=" container-main mx-3 px-3 mr-5">
        @yield('content')
    </div>
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('js/sweetalert2.js') }}"></script>

    @yield('scripts')

</body>

</html>
