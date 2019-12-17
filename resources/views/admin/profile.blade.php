@extends('layouts.admin')
@section('content2')
    <div class="fulladminprofile">
    <div class="adminprofile">
    <div class="form-group">

        <form action="/admin/editprofile/1" method="post">
            {{csrf_field()}}
            <h1 class="forh1">Профіль</h1><br>
            <label>Прізвище, Ім'я, По батькові</label><br>
            <input id="name" name="name" type="text" class="form-control" value="{{$profile->name}}" required>
            <label>Email</label><br>
            <input id="email" name="email" type="text" class="form-control" value="{{$profile->email}}" required>
            <label>Пароль</label><br>
            <input id="password" name="password" type="password" class="form-control" value="{{$profile->password}}"  required>
            <label>Дата народження</label><br>
            <input id="date_of_birth" name="date_of_birth" type="date" class="form-control" value="{{$profile->date_of_birth}}" name="date_birth">
            <label>Номер телефону</label><br>
            <input id="phone" type="number" name="phone" class="form-control" value="{{$profile->phone}}"required>
            <label>Поштовий індекс</label><br>
            <input id="index" type="number" name="index" class="form-control" value="{{$profile->index}}"required>
            <label>Місце проживання(область,місто,смт)</label><br>
            <input id="place" name="place" type="text" class="form-control" value="{{$profile->place}}"required>
            <label>Вулиця</label><br>
            <input id="street" type="text" name="street" class="form-control" value="{{$profile->street}}" required>
            <label>Номер будинку</label><br>
            <input id="street_number" name="street_number" type="text" class="form-control" name="street_number" value="{{$profile->street_number}}" required>
            <label>Квартира</label><br>
            <input id="flat"  name="flat" value="{{$profile->flat}}" type="number" class="form-control"><br>
            <button type="submit" class="btn btn-primary">
                Змінити
            </button>
        </form>
        </div>
    </div>
    </div>
@endsection