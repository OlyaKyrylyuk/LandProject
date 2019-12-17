@extends('layouts.app')

@section('content')


    <div class="menuadmin">
        <nav class="dws-menu">
            <div class="toggle">
            </div>
            <ul class="dwsmenuUl">
                <li><a href="/admin/home"><i class="fa fa-calendar" aria-hidden="true"></i>Головна</a></li>
                <li><a href="#"><i class="fa fa-users" aria-hidden="true"></i>Люди</a>
                    <ul>
                        <li><a href="/admin/workers">Представники в суді</a></li>
                        <li><a href="/admin/users">Користувачі</a></li>
                    </ul>
                </li>
                <li><a href="/admin/deals"><i class="fa fa-clipboard"></i>Справи</a>
                </li>
                <li><a href="/admin/claims"><i class="fa fa-file-text-o" aria-hidden="true"></i>Заяви</a></li>
                <li><a href="/admin/notifications"><i class="fa fa-bell" aria-hidden="true"></i><span class="badge badge-light">{{$dealss1}}</span></a></li>
                <li><a href="/admin/editprofile"><i class="fa fa-file-text-o" aria-hidden="true"></i>Профіль</a></li>
            </ul>

        </nav>
    </div>

    <div class="contentadmin">
        @yield('content2')
    </div>
=
@endsection