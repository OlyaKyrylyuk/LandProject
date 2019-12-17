@extends('layouts.admin')
@section('content2')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Редагувати справу</div>

                    <form class="form-horizontal" method="POST" action="{{ url('admin/deals/edit'.$id) }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('number') ? ' has-error' : '' }}">
                            <label for="number" class="col-md-4 control-label">Номер справи</label>

                            <div class="col-md-6">
                                <input id="number" type="text" value="{{$deals->number}}" class="form-control" name="number" value="{{ old('number') }}" required autofocus>

                                @if ($errors->has('number'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('number') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('judge') ? ' has-error' : '' }}">
                            <label for="judge" class="col-md-4 control-label">Суддя</label>

                            <div class="col-md-6">
                                <input id="judge" type="text"  value="{{$deals->judge}}" class="form-control" name="judge" value="{{ old('judge') }}" >

                                @if ($errors->has('judge'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('judge') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('subject_claim') ? ' has-error' : '' }}">
                            <label for="subject_claim" class="col-md-4 control-label">Предмет позову</label>

                            <div class="col-md-6">
                                <input id="subject_claim"  value="{{$deals->subject_claim}}" type="text" class="form-control" name="subject_claim" required>

                                @if ($errors->has('subject_claim'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('subject_claim') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('defendant_id') ? ' has-error' : '' }}">
                            <label for="defendant_id" class="col-md-4 control-label">Адвокат</label>

                            <div class="col-md-6">
                                <select id="defendant_id" name="defendant_id" type="text" class="form-control"  value="{{$deals->defendant_id}}" required autofocus>
                                    @foreach($defendants as $defendant)
                                        <option  value="{{$defendant->id}}">{{$defendant->surname}} {{$defendant->name}} {{$defendant->fathersname}}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('defendant_id'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('defendant_id') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('claim_id') ? ' has-error' : '' }}">
                            <label for="claim_id" class="col-md-4 control-label">Номер заяви</label>

                            <div class="col-md-6">
                                <select id="claim_id" type="text" class="form-control" name="claim_id"  value="{{$deals->claim_id}}" required autofocus>
                                    @foreach($claims as $claim)
                                        <option name = "{{$claim->id}}" value="{{$claim->id}}">{{$claim->number}}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('claim_id'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('claim_id') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Редагувати
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection