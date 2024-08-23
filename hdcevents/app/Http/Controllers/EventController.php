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
    public function index()
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

    public function show($id)
    {

        $event = Event::findOrFail($id);

        $event = Event::findOrFail($id);

        $eventOwner = User::where('id', $event->user_id)->first()->toArray();

        return view('events.show', ['event' => $event, 'eventOwner' => $eventOwner]);
    }

    public function dashboard()
    {

        $user = Auth::user();

        $events = $user->events;

        return view('events.dashboard', ['events' => $events]);
    }
}
