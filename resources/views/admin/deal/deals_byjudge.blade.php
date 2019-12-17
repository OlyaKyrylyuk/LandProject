@extends('layouts.deals')
@section('content3')

    <h1 class="forh1">Cправи</h1>

        <table class="table table-striped">
            <thead>
            <th class="tt">Номер справи</th>
            <th class="tt">Предмет позову</th>
            <th class="tt">Заява</th>
            <th class="tt">Адвокат</th>
            <th class="tt">Інстанція</th>
            <th class="tt">Дата проведення справи</th>

            </thead>

            @foreach($deals as $deal)

            <tbody>
            <tr>
                <td>{{$deal->judge}}</td>
            </tr>
<tr>
                <td>{{$deal->number}}</td>
                <td>{{$deal->subject_claim}}</td>
                <td>{{$deal->number2}}</td>
                <td>{{$deal->surname}} {{$deal->name}} {{$deal->fathersname}}</td>
                <td>{{$deal->type}}</td>
                @if($deal->deal_start!=NULL)<td> Початок {{$deal->deal_start}} Кінець {{$deal->deal_end}}</td>@endif



            </tr>
            @endforeach
            </tbody>
        </table>
        </div>
        </div>
@endsection