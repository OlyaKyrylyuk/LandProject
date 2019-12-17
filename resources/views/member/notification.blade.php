@extends('layouts.member')
@section('content_2')
    <div class="all1">
        <div class="usrs">
            <div class="inline">
                <div class="notification1">
                    <h1>Справи на сьогодні</h1>
                    <table class="table table-striped">
                        <thead>
                        <th class="tt">№ справи</th>
                        <th class="tt">Інстанція</th>
                        <th class="tt"></th>

                        </thead>

                        <tbody>
                        @foreach($deals_today as $dtoday)
                            <tr>
                                <td>{{$dtoday->number}}</td>
                                <td>{{$dtoday->type}}</td>
                                <td><a href="/admin/deals/find/{{$dtoday->id}}">Детальніше</a></td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="notification2">
                    <h1>Справи на завтра</h1>
                    <table class="table table-striped">
                        <thead>
                        <th class="tt">№ справи</th>
                        <th class="tt">Інстанція</th>
                        <th class="tt"></th>

                        </thead>

                        <tbody>
                        @foreach($deals_tommorow as $dtommorow)
                            <tr>
                                <td>{{$dtommorow->number}}</td>
                                <td>{{$dtommorow->type}}</td>
                                <td><a href="/admin/deals/find/{{$dtommorow->id}}">Детальніше</a></td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>

    </div>
@endsection