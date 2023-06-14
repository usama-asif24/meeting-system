<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Google\Client as GoogleClient;
use Google\Service\Calendar;
use Illuminate\Http\Request;
class GoogleCalendarController extends Controller
{
    private $googleClient;

    public function __construct()
    {
        $this->googleClient = new GoogleClient();
        $this->googleClient->setApplicationName('meeting-system');
        $this->googleClient->setScopes([Calendar::CALENDAR]);
        $this->googleClient->setAuthConfig(storage_path('app/credentials/credentials-file.json'));
        $this->googleClient->setAccessType('offline');
        $this->googleClient->setPrompt('select_account consent');
    }

    public function createMeeting(Request $request)
    {

        $calendarService = new Calendar($this->googleClient);
        $event = new \Google_Service_Calendar_Event([
            'summary' => $request->input('summary'),
            'description' => $request->input('description'),
            'start' => [
                'dateTime' => $request->input('start_datetime'),
                'timeZone' => 'Your Timezone',
            ],
            'end' => [
                'dateTime' => $request->input('end_datetime'),
                'timeZone' => 'Your Timezone',
            ],
        ]);
        $calendarService->events->insert('primary', $event);

        return response()->json(['message' => 'Meeting created successfully']);
    }

    public function updateMeeting(Request $request, $id)
    {

        $calendarService = new Calendar($this->googleClient);
        $event = $calendarService->events->get('primary', $id);
        $event->setSummary($request->input('summary'));
        $event->setDescription($request->input('description'));
        $event->setStart([
            'dateTime' => $request->input('start_datetime'),
            'timeZone' => 'Your Timezone',
        ]);
        $event->setEnd([
            'dateTime' => $request->input('end_datetime'),
            'timeZone' => 'Your Timezone',
        ]);
        $calendarService->events->update('primary', $event->getId(), $event);

        return response()->json(['message' => 'Meeting updated successfully']);
    }

    public function deleteMeeting($id)
    {
     
        $calendarService = new Calendar($this->googleClient);
        $calendarService->events->delete('primary', $id);

        return response()->json(['message' => 'Meeting deleted successfully']);
    }
}
