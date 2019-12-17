@extends('layouts.admin')
@section('content2')


    <div class="all1">
        <div class="usrs">

            <div class="inline">
            <div class="inline1">
                <div class="container-fluid">
                    <h1>Представники в суді</h1> </div></div><div class="inline2">

                    <div class="container-fluid">
                <button type="button" class="btn btn-success btn-lg btn-block"  data-toggle="modal" data-target="#SignUp">
                    Додати представника
                </button></div>
            </div></div>
        <!-- Button trigger modal -->


        <!-- Modal -->

        <!-- Modal add -->
        <div class="modal fade" id="SignUp" tabindex="-1" role="dialog" aria-labelledby="addSignUpLabel">
            <form action="workers/insert" method = "POST" id="frm-insert">
                {{csrf_field()}}

                <div class="modal-dialog" role="document">
                    <div class="modal-content">

                        <div class="modal-header">

                            <button type="button" class="close" data-dismiss="modal"  aria-label="Close"><span aria-hidden="true">&times;</span></button>

                            <h4 class="modal-title" id="addCategoryLabel">Додати нового представника в суді</h4>

                        </div>



                        <div class="modal-body">
                            {{csrf_field()}}

                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                </button>

                        </div>

                        <div class="modal-body">
                            {{csrf_field()}}

                                <input type="text" id="user_name" name="user_name" value="{{ old('user_name') }}" class="form-control" placeholder="Username">

                        </div>
                        <div class="modal-body">
                            {{csrf_field()}}

                                <input type="text" id="name" name="name" value="{{ old('name') }}" class="form-control" placeholder="ПІБ">

                        </div>

                        <div class="modal-body">
                            {{csrf_field()}}

                                <input type="email" id="email" name="email" value="{{ old('email') }}" class="form-control" placeholder="Email">

                        </div>

                        <div class="modal-body">
                            {{csrf_field()}}

                                <input type="password" id="password" name="password" class="form-control" placeholder="Пароль">

                        </div>
                        <div class="modal-body">
                            {{csrf_field()}}

                                <input type="text" id="phone" name="phone" class="form-control" placeholder="Номер телефону">

                        </div>
                        <div class="modal-body">
                            {{csrf_field()}}

                                <input type="text" id="index" name="index" class="form-control" placeholder="Індекс">


                        </div>
                        <div class="modal-body">
                            {{csrf_field()}}


                                <input type="text" id="place" name="place" class="form-control" placeholder="Місто">


                        </div>
                        <div class="modal-body">
                            {{csrf_field()}}


                                <input type="text" id="street" name="street" class="form-control" placeholder="Вулиця">


                        </div>
                        <div class="modal-body">
                            {{csrf_field()}}


                                <input type="text" id="street_number" name="street_number" class="form-control" placeholder="Номер будинку">



                        </div>
                        <div class="modal-body">
                            {{csrf_field()}}


                                <input type="text" id="flat" name="flat" class="form-control" placeholder="Квартира">


                        </div>
                                <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">


                        <div class="modal-footer">
                            {{csrf_field()}}
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="button" id = "save" class="btn btn-primary">Save</button>

                        </div>


                    </div>

                </div>
            </form>
        </div>
            <div class="tables">
        <table class="table table-striped">
            <thead>
            <th class="tt">Користувачі</th>
            <th class="tt">Email</th>
            <th class="tt">ПІБ</th>
            <th class="tt">Місце проживання</th>
            <th class="tt">Номер телефону</th>
            </thead>

            <tbody>
            @foreach($workers as $worker)
                <tr>
                    <td>{{$worker->name}}</td>
                    <td>{{$worker->email}}</td>
                    <td>{{$worker->name2}}</td>
                    <td>Вул. {{$worker->street}}  {{$worker->street_number}}, {{$worker->flat}}</td>
                    <td>{{$worker->phone}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
            </div>

            {{$workers->links()}}
    </div>
    </div>
    <script>
        $(function() {
            $.ajaxSetup({
                headers:
                    { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
            });
            $('#save').on('click',function(){
                var user_name = $('#user_name').val();
                var name = $('#name').val();
                var email = $('#email').val();
                var password= $('#password').val();
                var phone= $('#phone').val();
                var index= $('#index').val();
                var place = $('#place').val();
                var street= $('#street').val();
                var street_number= $('#street_number').val();
                var flat= $('#flat').val();
                console.log(user_name);
                console.log(name);
                console.log(email);
                console.log(password);
                console.log(phone);
                console.log(index);
                console.log(place);
                console.log(street);
                console.log(street_number);
                console.log(flat);

                $.ajax({
                    url:  'workers/insert',
                    method: "POST",
                    data:{ user_name:user_name,name:name,email:email,password:password, phone:phone,index:index, place:place, street:street,street_number:street_number,flat:flat, "_token": $('#token').val()},
                    dataType: 'html',
                    headers: {
                        'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                    },

                    success: function (data) {

                        $('#SignUp').modal('hide');

                        console.log(name);
                        window.location.reload();
                    },

                    error: function (msg) {

                        alert('Ошибка');

                    }

                });

            });

        })

    </script>

    <script src="{{ asset('js/app.js') }}"></script>

@endsection