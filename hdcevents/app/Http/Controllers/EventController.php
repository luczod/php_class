<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;

class EventController extends Controller
{
    public function index(): View
    {

        $search = request('search');

        if ($search) {

            $events = Event::where([
                ['title', 'like', '%' . $search . '%']
            ])->get();
        } else {
            $events = Event::all();
        }

        return view('welcome', ['events' => $events, 'search' => $search]);
    }

    public function create(): View
    {
        return view('events.create');
    }

    public function store(Request $req): RedirectResponse
    {
        $event = new Event;

        $event->title = $req->title;
        $event->date = $req->date;
        $event->city = $req->city;
        $event->private = $req->private;
        $event->description = $req->description;
        $event->items = $req->items;

        // Image Upload
        if ($req->hasFile('image') && $req->file('image')->isValid()) {

            $reqImage = $req->image;
            $extension = $reqImage->extension();
            $imageName = md5($reqImage->getClientOriginalName() . strtotime("now")) . "." . $extension;
            $reqImage->move(public_path('img/events'), $imageName);
            $event->image = $imageName;
        }


        $event->user_id = Auth::id();
        $event->save();

        return redirect('/')->with('msg', 'Event created successfully!');
    }

    public function show(int $id): View
    {

        $event = Event::findOrFail($id);

        $user = Auth::user();
        $hasUserJoined = false;

        if ($user) {

            $userEvents = $user->eventsAsParticipant->toArray();

            foreach ($userEvents as $userEvent) {
                if ($userEvent['id'] == $id) {
                    $hasUserJoined = true;
                }
            }
        }

        $eventOwner = User::where('id', $event->user_id)->first()->toArray();

        return view(
            'events.show',
            [
                'event' => $event,
                'eventOwner' => $eventOwner,
                'hasUserJoined' => $hasUserJoined
            ]
        );
    }

    public function dashboard(): View
    {

        $user = Auth::user();

        $events = $user->events;

        $eventsAsParticipant = $user->eventsAsParticipant;

        return view(
            'events.dashboard',
            ['events' => $events, 'eventsasparticipant' => $eventsAsParticipant]
        );
    }

    public function destroy(int $id): RedirectResponse
    {

        Event::findOrFail($id)->delete();

        return redirect('/dashboard')->with('msg', 'Event deleted successfully!');
    }

    public function edit(int $id): View
    {
        $user = Auth::user();

        $event = Event::findOrFail($id);

        if ($user->id != $event->user_id) {
            return redirect('/dashboard');
        }

        return view('events.edit', ['event' => $event]);
    }

    public function update(Request $req): RedirectResponse
    {
        $event = Event::findOrFail($req->id);
        $data = $req->all();

        // Image Upload
        if ($req->hasFile('image') && $req->file('image')->isValid()) {

            unlink(public_path('img/events/' . $event->image));

            $reqImage = $req->image;

            $extension = $reqImage->extension();

            $imageName = md5($reqImage->getClientOriginalName() . strtotime("now")) . "." . $extension;

            $reqImage->move(public_path('img/events'), $imageName);

            $data['image'] = $imageName;
        }

        Event::findOrFail($req->id)->update($data);

        return redirect('/dashboard')->with('msg', 'Event edited successfully!');
    }

    public function joinEvent(int $id): RedirectResponse
    {
        $user_id = Auth::id();

        $user = User::findOrFail($user_id);

        $user->eventsAsParticipant()->attach($id);

        $event = Event::findOrFail($id);

        return redirect('/dashboard')->with('msg', 'Your presence is confirmed at the event: ' . $event->title);
    }

    public function leaveEvent(int $id): RedirectResponse
    {

        $user_id = Auth::id();

        $user = User::findOrFail($user_id);

        $user->eventsAsParticipant()->attach($id);

        $event = Event::findOrFail($id);

        return redirect('/dashboard')->with('msg', 'You have successfully exited the event: ' . $event->title);
    }
}
