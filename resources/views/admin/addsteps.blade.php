@extends('layouts.deals')

@section('content3')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Додати інстанцію справи</div>
                        <form class="form-horizontal" method="POST" action="{{ url('/admin/steps') }}">
                            {{ csrf_field() }}
                            <div class="form-group{{ $errors->has('type') ? ' has-error' : '' }}">
                                <label for="type" class="col-md-4 control-label">Тип інстанції</label>
                                <div class="col-md-6">
                                    <select id="type" type="text" class="form-control" name="type" value="{{ old('type') }}" required autofocus>
                                            <option name = "перша" value="перша">Перша</option>
                                            <option name = "друга" value="друга">Друга</option>
                                            <option name = "третя" value="третя">Третя</option>
                                    </select>
                                    @if ($errors->has('type'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('type') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('deal_start') ? ' has-error' : '' }}">
                                <label for="deal_start" class="col-md-4 control-label">Початок справи</label>

                                <div class="col-md-6">
                                    <input id="deal_start" type="datetime-local" class="form-control" name="deal_start" value="{{ old('deal_start') }}" >
                                    @if ($errors->has('deal_start'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('deal_start') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('deal_end') ? ' has-error' : '' }}">
                                <label for="deal_end" class="col-md-4 control-label">Кінець справи</label>
                                <div class="col-md-6">
                                    <input id="deal_end" type="datetime-local" class="form-control" name="deal_end" required>
                                    @if ($errors->has('deal_end'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('deal_end') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('decision') ? ' has-error' : '' }}">
                                <label for="decision" class="col-md-4 control-label">Рішення</label>

                                <div class="col-md-6">
                                    <input id="decision" type="text" class="form-control" name="decision">
                                    @if ($errors->has('decision'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('decision') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('defendant_id') ? ' has-error' : '' }}">
                                <label for="defendant_id" class="col-md-4 control-label">Суд</label>

                                <div class="col-md-6">
                                    <select id="institution_id" name="institution_id" type="text" class="form-control" value="{{ old('institution_id') }}" required autofocus>
                                        @foreach($institutions as $institution)
                                            <option  value="{{$institution->id}}">{{$institution->name}}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('institution_id'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('institution_id') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('deal_id') ? ' has-error' : '' }}">
                                <label for="deal_id" class="col-md-4 control-label">Справа</label>

                                <div class="col-md-6">
                                    <select id="deal_id" name="deal_id" type="text" class="form-control" value="{{ old('deal_id') }}" required autofocus>
                                        @foreach($deals as $deal)
                                            <option  value="{{$deal->id}}">{{$deal->number}}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('deal_id'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('deal_id') }}</strong>
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
@endsection
