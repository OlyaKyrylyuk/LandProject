@extends('layouts.app')

@section('content')
    @if (Auth::user()->role =='member')

        <div class="menuadmin">
            <nav class="dws-menu">
                <ul>
                    <li><a href="/member/home"><i class="fa fa-calendar" aria-hidden="true"></i>Головна</a></li>
                    <li><a href="/member/deals"><i class="fa fa-clipboard"></i>Справи</a>
                    </li>
                    <li><a href="/member/charts"><i class="fa fa-pie-chart" aria-hidden="true"></i>Статитика</a>
                    </li>
                    <li><a href="/member/notifications"><i class="fa fa-bell" aria-hidden="true"></i><span class="badge badge-light">{{$dealss1}}</span></a></li>
                </ul>
            </nav>
        </div>

        <div class="contentadmin">
            @yield('content_2')
        </div>
@endif
@endsection