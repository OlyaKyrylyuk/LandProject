@extends('layouts.app')
@section('styles')

    <!-- Styles -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js">
@endsection

@section('content')

        <div class="menuadmin">
            <nav class="dws-menu">
                <ul>

                    <li><a href="/claim"><i class="fa fa-address-book"></i>Заява</a></li>
                    <li><a href="/user_profile"><i class="fa fa-calendar-check"></i>Профіль</a></li>
                </ul>
            </nav>
        </div>
        <div class="contentadmin">
            @yield('content2')
        </div>
    </div>
</div>
@endsection