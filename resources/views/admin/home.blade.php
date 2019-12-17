@extends('layouts.admin')
@section('scripts')
    {!! $calendar_details->script() !!}
@endsection
@section('content2')
    <div class="container">


    </div>

    <div class="panel panel-primary">
        <div class="panel-heading">MY Event Details</div>
        <div class="panel-body" >
            {!! $calendar_details->calendar() !!}
        </div>
    </div>

    </div>
@endsection