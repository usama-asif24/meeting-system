@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Create Meeting</h1>
        <hr>

        <form action="{{ route('meetings.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="subject">Subject</label>
                <input type="text" class="form-control" id="subject" name="subject" required>
            </div>

            <div class="form-group">
                <label for="date_time">Date/Time</label>
                <input type="datetime-local" class="form-control" id="date_time" name="date_time" required>
            </div>

            <div class="form-group">
                <label for="attendees">Attendees</label>
                <input type="email" class="form-control" id="attendees" name="attendees[]" required>
                <input type="email" class="form-control" id="attendees" name="attendees[]" required>
            </div>

            <button type="submit" class="btn btn-primary">Create</button>
        </form>
    </div>
@endsection
