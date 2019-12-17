@extends('layouts.app2')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Дані користувача</div>

                    <div class="panel-body">
                        <form class="form-horizontal" method="POST" action="{{ route('home') }}">
                            {{ csrf_field() }}

                            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                <label for="name" class="col-md-4 control-label">ПІБ/Назва компанії*</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>

                                    @if ($errors->has('name'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('date_of_birth') ? ' has-error' : '' }}">
                                <label for="date_of_birth" class="col-md-4 control-label">Дата народження</label>

                                <div class="col-md-6">
                                    <input id="date_of_birth" type="date" class="form-control" name="date_of_birth" value="{{ old('date_of_birth') }}" >

                                    @if ($errors->has('date_of_birth'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('date_of_birth') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
                                <label for="phone" class="col-md-4 control-label">Номер телефону*</label>

                                <div class="col-md-6">
                                    <input id="phone" type="phone" class="form-control" name="phone" required>

                                    @if ($errors->has('phone'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('phone') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('index') ? ' has-error' : '' }}">
                                <label for="index" class="col-md-4 control-label">Поштовий індекс</label>

                                <div class="col-md-6">
                                    <input id="index" type="number" class="form-control" name="index" required>

                                    @if ($errors->has('index'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('index') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>


                            <div class="form-group{{ $errors->has('place') ? ' has-error' : '' }}">
                                <label for="place" class="col-md-4 control-label">Місце проживання(місто, смт)*</label>

                                <div class="col-md-6">
                                    <input id="place" type="text" class="form-control" name="place" required>

                                    @if ($errors->has('place'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('place') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('street') ? ' has-error' : '' }}">
                                <label for="street" class="col-md-4 control-label">Вулиця*</label>

                                <div class="col-md-6">
                                    <input id="street" type="text" class="form-control" name="street" required>

                                    @if ($errors->has('street'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('street') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('street_number') ? ' has-error' : '' }}">
                                <label for="street_number" class="col-md-4 control-label">Будинок*</label>

                                <div class="col-md-6">
                                    <input id="street_number" type="text" class="form-control" name="street_number" required>

                                    @if ($errors->has('street_number'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('street_number') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('flat') ? ' has-error' : '' }}">
                                <label for="flat" class="col-md-4 control-label">Квартира</label>

                                <div class="col-md-6">
                                    <input id="flat" type="number" class="form-control" name="flat" >

                                    @if ($errors->has('flat'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('flat') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        Заповнити дані
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
