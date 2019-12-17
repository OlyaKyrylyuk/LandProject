@extends('layouts.deals')
@section('content3')

    <div class="usrs">

<div class="wow">
    <div class="tables">
        <form action="/admin/edit_deal_step/{{$deal->id}}" method="post">
            {{csrf_field()}}
        <h1 class="forh1_2">Cправа № "{{$deal->number}}"</h1>
        <table class="table1">

            <tr>
                <td>Заява</td>
                <td>  <input id="number2" name="number2" value="{{$deal->number2}}" class="form-control" style="background-color: #2ab27b;  height:50px; text-align:center; color:#ffffff; border: 1px solid #ffffff;"></td>
            </tr>
            <tr>
                <td>Скарга</td>
                <td><input id="reason" name="reason" value="{{$deal->reason}}" class="form-control" style="background-color: #2ab27b;  height:50px; text-align:center; color:#ffffff; border: 1px solid #ffffff;"></td>
            </tr>
            <tr>
                <td>Інстанція</td>
                <td><input id="type" name="type" value="{{$deal->type}}" class="form-control" style="background-color: #2ab27b;  height:50px; text-align:center; color:#ffffff; border: 1px solid #ffffff;"></td>
            </tr>
            <tr>
                <td>Початок справи/кінець справи</td>
                <td><input id="deal_start" name="deal_start" value="{{$deal->deal_start}}" class="form-control" style="background-color: #2ab27b;  height:50px; text-align:center; color:#ffffff; border: 1px solid #ffffff;">
                    <input id="deal_end" name="deal_end" value="{{$deal->deal_end}}" class="form-control" style="background-color: #2ab27b;  height:50px; text-align:center; color:#ffffff; border: 1px solid #ffffff;"></td>
            </tr>
            <tr>
                <td>Позивач</td>
                <td><input id="name2" name="name2" value="{{$deal->name2}}" class="form-control" style="background-color: #2ab27b;  height:50px; text-align:center; color:#ffffff; border: 1px solid #ffffff;">
                    <input id="phone2" name="phone2" value="{{$deal->phone}}" class="form-control" style="background-color: #2ab27b;  height:50px; text-align:center; color:#ffffff; border: 1px solid #ffffff;"></td>
            </tr>
            <tr>
                <td>Представник в суді</td>
                <td><input id="name" name="name" value="{{$deal2->name}}" class="form-control" style="background-color: #2ab27b;  height:50px; text-align:center; color:#ffffff; border: 1px solid #ffffff;">
                    <input id="phone" name="phone" value="{{$deal2->phone}}" class="form-control" style="background-color: #2ab27b;  height:50px; text-align:center; color:#ffffff; border: 1px solid #ffffff;"></td>
            </tr>
            <tr>
                <td>Адвокат</td>
                <td><input id="surname" name="surname" value="{{$deal->surname}} {{$deal->name}} {{$deal->fathersname}}" class="form-control" style="background-color: #2ab27b;  height:50px; text-align:center; color:#ffffff; border: 1px solid #ffffff;"></td>
            </tr>
            <tr>
                <td>Місце проведення справи</td>
                <td><input id="name3" name="name3" value="{{$deal->name3}}" class="form-control" style="background-color: #2ab27b;  height:50px; text-align:center; color:#ffffff; border: 1px solid #ffffff;">
                    <input id="email" name="email" value="{{$deal->email}}" class="form-control" style="background-color: #2ab27b;  height:50px; text-align:center; color:#ffffff; border: 1px solid #ffffff;"></td>
            </tr>

        </table>
            <button type="submit" class="btn btn-success form-control" style="">
                Змінити
            </button>
        </form>
    </div></div>
    </div>

@endsection