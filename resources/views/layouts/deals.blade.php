@extends('layouts.admin')
@section('content2')
<div class="all">
    <div class="menudeals">
        <div class='dd'>
            <ul>
                <li class="lookmenu">Меню</li>
                <li><a href="/admin/deals">Інформація</a></li>
                <li><a href="#">Додати справу..</a>
                    <ul>
                        <li><a href="/admin/adddeals">Додати справу</a></li>
                        <li><a href="/admin/steps">Додати інстанцію</a></li>
                    </ul>
                </li>
                <li><a href="/admin/charts">Статистика</a></li>
                <li><a href="/admin/charts2">Статистика2</a></li>
                <li><a href="/admin/charts3">Статистика3</a></li>
            </ul>
        </div>
    </div>
    <div class="contentdeals">
        @yield('content3')
    </div>
</div>
@endsection