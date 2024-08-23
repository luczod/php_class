@extends('layouts.main')

@section('title', 'HDC Events')

@section('content')

<div id="search-container" class="col-md-12">
    <h1>Search for an event</h1>
    <form action="/" method="GET">
        <input id="search" type="text"  name="search" class="form-control" placeholder="Search..." required>
    </form>
</div>
<div id="events-container" class="col-md-12">
    @if($search)
        <h2 class="search-title">Searching for: <span>{{ $search }}</span></h2>
    @else
    <h2>Upcoming Events</h2>
    <p class="subtitle">See the events of the next few days</p>
    @endif
    <div id="cards-container" class="row">
        @foreach($events as $event)
        <div class="card col-md-3">
            <img src="/img/events/{{ $event->image }}" alt="{{ $event->title }}">
            <div class="card-body">
                <p class="card-date">{{ date('d/m/Y', strtotime($event->date)) }}</p>
                <h5 class="card-title">{{ $event->title }}</h5>
                <p class="card-participants">X Participants</p>
                <a href="/events/{{ $event->id }}" class="btn btn-primary">Learn more</a>
            </div>
        </div>
        @endforeach

        @if(count($events) == 0 && $search)
            <p>Could not find any event with {{ $search }}! <a href="/">See all</a></p>
        @elseif(count($events) == 0)
            <p>There are no events available</p>
        @endif
    </div>
</div>

@endsection


