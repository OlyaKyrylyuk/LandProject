@extends('layouts.admin')
@section('content2')
    <div class="all1">
<div class="usrs">
    <h1>Користувачі</h1>
    <div class="tables">
        <table class="table table-striped">
        <thead>
        <th class="tt">№</th>
        <th class="tt">Користувачі</th>
        <th class="tt">Email</th>
        <th class="tt">ПІБ</th>
        <th class="tt">Номер телефону</th>
        </thead>

        <tbody>
    @foreach($users as $user)
       <tr>
           <td>{{$loop->index+1}}</td>
           <td>{{$user->name}}</td>
           <td>{{$user->email}}</td>
           <td>{{$user->name2}}</td>
           <td>{{$user->index}}</td>
           <td>{{$user->phone}}</td>
       </tr>
    @endforeach
    </tbody>
        </table>
    </div>
    {{$users->links()}}
        </div>

    </div>

    </div>
@endsection