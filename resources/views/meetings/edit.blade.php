@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Edit Meeting</h1>
        <hr>

        <form action="{{ route('meetings.update', $meeting) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="subject">Subject</label>
                <input type="text" class="form-control" id="subject" name="subject" value="{{ $meeting->subject }}" required>
            </div>

            <div class="form-group">
                <label for="date_time">Date/Time</label>
                <input type="datetime-local" class="form-control" id="date_time" name="date_time" value="{{ $meeting->date_time }}" required>
            </div>

            <div class="form-group">
                <label for="attendees">Attendees</label>
                @foreach (json_decode($meeting->attendees) as $attendee)
                    <input type="email" class="form-control" id="attendees" name="attendees[]" value="{{ $attendee }}" required>
                @endforeach
            </div>

            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
@endsection
