<?php

namespace App\Http\Controllers;

use App\Models\Meeting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MeetingsController extends Controller
{
    public function index()
    {
        $meetings = Meeting::where('user_id', Auth::id())->paginate(10);
        return view('meetings.index', compact('meetings'));
    }

    public function create()
    {
        return view('meetings.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'subject' => 'required',
            'date_time' => 'required',
            'attendees.*' => 'required|email',
        ]);

        $meeting = Meeting::create([
            'subject' => $request->input('subject'),
            'date_time' => $request->input('date_time'),
            'user_id' => Auth::id(),
            'attendees' => json_encode($request->input('attendees')),
        ]);

        return redirect()->route('meetings.index')->with('success', 'Meeting created successfully.');
    }

    public function edit(Meeting $meeting)
    {
        return view('meetings.edit', compact('meeting'));
    }

    public function update(Request $request, Meeting $meeting)
    {
        $request->validate([
            'subject' => 'required',
            'date_time' => 'required',
            'attendees.*' => 'required|email',
        ]);

        $meeting->update([
            'subject' => $request->input('subject'),
            'date_time' => $request->input('date_time'),
            'attendees' => json_encode($request->input('attendees')),
        ]);

        return redirect()->route('meetings.index')->with('success', 'Meeting updated successfully.');
    }

    public function destroy(Meeting $meeting)
    {
        $meeting->delete();
        return redirect()->route('meetings.index')->with('success', 'Meeting deleted successfully.');
    }
}
