@extends('layouts.member')
@section('content_2')

    <div class="usrs">
        <div class="wow">
            <h1 class="forh1_2">Cправа № "{{$deal->number}}"</h1>
            <table class="table1">


                <td>Заява</td>
                <td>{{$deal->number2}}, Скарга: {{$deal->reason}}</td>
                </tr>
                <tr>
                    <td>Інстанція</td>
                    <td>{{$deal->type}}</td>
                </tr>
                <tr>
                    <td>Початок справи/кінець справи</td>
                    <td>{{$deal->deal_start}} / {{$deal->deal_end}}</td>
                </tr>
                <tr>
                    <td>Позивач</td>
                    <td>{{$deal->name2}}, {{$deal->phone}}</td>
                </tr>

                <tr>
                    <td>Адвокат</td>
                    <td>{{$deal->surname}} {{$deal->name}} {{$deal->fathersname}}</td>
                </tr>
                <tr>
                    <td>Місце проведення справи</td>
                    <td>{{$deal->name3}}, {{$deal->email}}</td>
                </tr>
            </table>
        </div>
    </div>

@endsection