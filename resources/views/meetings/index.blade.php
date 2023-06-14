@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Meetings</h1>
        <a href="{{ route('meetings.create') }}" class="btn btn-primary">Create Meeting</a>
        <hr>

        @if ($meetings->isEmpty())
            <p>No meetings found.</p>
        @else
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Subject</th>
                        <th>Date/Time</th>
                        <th>Attendees</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($meetings as $meeting)
                        <tr>
                            <td>{{ $meeting->subject }}</td>
                            <td>{{ $meeting->date_time }}</td>
                            <td>{{ implode(', ', json_decode($meeting->attendees)) }}</td>
                            <td>
                                <a href="{{ route('meetings.edit', $meeting) }}" class="btn btn-sm btn-primary">Edit</a>
                                <form action="{{ route('meetings.destroy', $meeting) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger"
                                        onclick="return confirm('Are you sure you want to delete this meeting?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            {{ $meetings->links() }}
        @endif
    </div>
@endsection
