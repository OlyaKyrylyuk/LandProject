@extends('layouts.users')

@section('content2')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Заява</div>

                    <div class="panel-body">
                        <form class="form-horizontal" method="POST" action="{{ url('insert_claim') }}">
                            {{ csrf_field() }}

                            <div class="form-group{{ $errors->has('reason') ? ' has-error' : '' }}">
                                <label for="reason" class="col-md-4 control-label">Причина скарги</label>

                                <div class="col-md-6">
                                    <input id="reason" type="text" class="form"  name="reason" value="{{ old('reason') }}" required>

                                    @if ($errors->has('reason'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('reason') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        Відправити заяву
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
