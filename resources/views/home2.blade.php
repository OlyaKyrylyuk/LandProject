@if(Auth::user()->role=='admin')
    <script>window.location = "/admin/home";</script>
@elseif(Auth::user()->role=='user')
    @extends('layouts.app')
@section('content')
    <script>

        if($alert=true) {
            swal("Ваша заява відправлена!", "Очікуйте на відповідь", "success");
        }
    </script>
    <div class="content2">

        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="menuuser">
                        <table>
                            <tr>
                                <td><img src="{{asset('img/pic2.png')}}" alt="profile Pic" height="100" width="100"></td>
                                <td><h1>Вітаємо, <?= Auth::user()->name?> !!!</h1></td>
                            </tr>
                        </table>
                    </div>
                </div></div></div>

        <div class="center">
            <div class = "contentuser">
                <div class="block_container">

                    <div class="bloc1">
                        <div class="form-group">
                            <form class="form-horizontal" method="POST" action="{{ url('insert_claim') }}">
                                {{ csrf_field() }}
                                <h1>Форма заповнення заяви</h1><br>
                                <textarea id="reason" name="reason"  class="form" rows="8" cols="85" placeholder="Введіть скаргу для заповнення заяви"></textarea><br>
                                <button type="submit" class="btn btn-primary">
                                    Відправити заяву
                                </button>
                            </form>
                        </div>
                        <div class="form-group">
                            <form class="form-horizontal" method="POST" action="{{ url('send_email') }}">
                                {{ csrf_field() }}
                                <h1>Відправлення повідомлення стосовно справи</h1><br>
                                <textarea id="gmail" name="gmail"  class="form" rows="7" cols="85" placeholder="Відправити на пошту"></textarea><br>
                                <button type="submit" class="btn btn-primary">
                                    Відправити повідомлення
                                </button>
                            </form>
                        </div>
                    </div>
                    <div class="bloc2">
                        <div class="form-group">
                            <form action="/claims/edit/{{$profile->id}}" method="post">
                                {{csrf_field()}}
                                <h1>Профіль</h1><br>
                                <label>ПІБ/Компанія*</label><br>
                                <input id="name" name="name" type="text" class="form-control" value="{{$profile->name}}" name="name" required>
                                <label>Дата народження*</label><br>
                                <input id="date_of_birth" name="date_of_birth" type="date" class="form-control" value="{{$profile->date_of_birth}}" name="date_birth">
                                <label>Номер телефону*</label><br>
                                <input id="phone" type="number" name="phone" class="form-control" value="{{$profile->phone}}"required>
                                <label>Поштовий індекс*</label><br>
                                <input id="index" type="number" name="index" class="form-control" value="{{$profile->index}}"required>
                                <label>Місце проживання(область,місто,смт)*</label><br>
                                <input id="place" name="place" type="text" class="form-control" value="{{$profile->place}}"required>
                                <label>Вулиця*</label><br>
                                <input id="street" type="text" name="street" class="form-control" name="street" value="{{$profile->street}}" required>
                                <label>Номер будинку*</label><br>
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
            </div></div>
@endsection
@endif


