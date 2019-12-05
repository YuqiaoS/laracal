@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Welcome, login to use the Event Calendar app built with Lavarel 5.2.</div>

                <div class="panel-body">
                @include('calendar/calendar')
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
