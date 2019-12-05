@extends('layouts.app')

@section('content')

@include('calendar.calendar')

    <!-- Bootstrap Boilerplate... -->
    <div class="container">
<div class="col-sm-offset-2 col-sm-8">
    <div class="panel panel-default">
        <div class="panel-heading">
            New Event
        </div>

        <div class="panel-body">
            <!-- Display Validation Errors -->
            @include('common.errors')

            <!-- New event Form -->
            <form action="{{ url('event') }}" method="POST" class="form-horizontal" autocomplete="off">
                {!! csrf_field() !!}

                <!-- event Name -->
                <div class="form-group">
                    <label for="event-name" class="col-sm-3 control-label">Event</label>

                    <div class="col-sm-6">
                        <input type="text" name="event" id="event-name" class="form-control">
                    </div>
                </div>

                <div class="form-group">
                    <label for="event_date" class="col-sm-3 control-label">Date</label>

                    <div class="col-sm-6">
                        <input type="text" name="event_date" id="event_date" class="form-control">
                        <span class='help-block'>(Date format: yyyy-mm-dd)</span>
                    </div>
                </div>

                <!-- Add event Button -->
                <div class="form-group">
                    <div class="col-sm-offset-3 col-sm-6">
                        <button type="submit" class="btn btn-default">
                            <i class="fa fa-plus"></i> Add Event
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- TODO: Current events -->
    @if (!empty($events) && count($events) > 0)
        <div class="panel panel-default">
            <div class="panel-heading">
                Current events
            </div>

            <div class="panel-body">
                <table class="table table-striped event-table">
                    <thead>
                        <th>event</th>
                        <th>date</th>
                        <th>&nbsp;</th>
                    </thead>
                    <tbody>
                        @foreach ($events as $event)
                            <tr>
                                <td class="table-text"><div>{{ $event->event }}</div></td>
                                <td class="table-text">{{$event->event_date}}</td>
                                <!-- event Delete Button -->
                                <td>
                                    <form action="/event/{{ $event->id }}" method="POST">
                                        {{ csrf_field() }}
                                        {{ method_field('DELETE') }}

                                        <button type="submit" id="delete-event-{{ $event->id }}" class="btn btn-danger">
                                            <i class="fa fa-btn fa-trash"></i>Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endif
</div>
</div>

@endsection