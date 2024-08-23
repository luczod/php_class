@extends('layouts.main')
@section('title','HDC EVENTS | create')

@section('content')

<div id="event-create-container" class="col-md-6 offset-md-3">
  <h1 class="mb-3">Create your event</h1>
  <form action="/events/update/{{ $event->id }}" method="POST"  enctype="multipart/form-data">
    @csrf
    <label class="form-label" for="title">Event Image:</label>
    <div class="upload_dropZone text-center mb-3 p-4">
        <legend class="visually-hidden">Image uploader</legend>
        <svg class="upload_svg" width="60" height="60" aria-hidden="true">
            <use href="#icon-imageUpload"></use>
        </svg>
        <p class="small my-2">Drag &amp; Drop background image(s) inside dashed region<br><i>or</i></p>
        <input id="upload_image_background" data-post-name="image_background"
            data-post-url="/events"
                name="image"
                class="position-absolute invisible"
                type="file"
                accept="image/jpeg, image/png, image/jpg" />
        <label class="btn btn-upload mb-3" for="upload_image_background">Choose file(s)</label>
        <div class="upload_gallery d-flex flex-wrap justify-content-center gap-3 mb-0">
            <img class="upload_img mt-2" src="/img/events/{{ $event->image }}" alt="{{ $event->title }}">
        </div>
    </div>
    <div class="mb-3">
      <label class="form-label" for="title">Event:</label>
      <input id="title" type="text" class="form-control"  name="title" placeholder="Event Name" value="{{ $event->title }}">
    </div>
    <div class="mb-3">
      <label class="form-label" for="date">Evento Date:</label>
      <input id="date" type="date" class="form-control"  name="date" value="{{ substr($event->date,0,10) }}">
    </div>
    <div class="mb-3">
      <label class="form-label" for="title">City:</label>
      <input id="city" type="text" class="form-control"  name="city" placeholder="Event location" value="{{ $event->city }}">
    </div>
    <div class="mb-3">
      <label class="form-label" for="title">Is the event private?</label>
      <select id="private" name="private"  class="form-control">
        <option value="0">No</option>
        <option value="1" {{ $event->private == 1 ? "selected='selected'" : "" }}>Yes</option>
      </select>
    </div>
    <div class="mb-3">
      <label class="form-label" for="title">Description:</label>
      <textarea name="description" id="description" class="form-control" placeholder="What will happen at the event?">{{ $event->description }}</textarea>
    </div>
     <div class="mb-3">
      <label for="title" class="mb-3">Add Infrastructure Items:</label>
      <div class="mb-3">
        <input type="checkbox" name="items[]" value="Chairs"> Chairs
      </div>
      <div class="mb-3">
        <input type="checkbox" name="items[]" value="Stage"> Stage
      </div>
      <div class="mb-3">
        <input type="checkbox" name="items[]" value="Free beer"> Free beer
      </div>
      <div class="mb-3">
        <input type="checkbox" name="items[]" value="Open Food"> Open food
      </div>
      <div class="mb-3">
        <input type="checkbox" name="items[]" value="Gifts"> Gifts
      </div>
    </div>
    <input type="submit" class="btn btn-primary" value="Edit Event">
  </form>
  <svg style="display:none">
    <defs>
        <symbol id="icon-imageUpload" clip-rule="evenodd" viewBox="0 0 96 96">
        <path d="M47 6a21 21 0 0 0-12.3 3.8c-2.7 2.1-4.4 5-4.7 7.1-5.8 1.2-10.3 5.6-10.3 10.6 0 6 5.8 11 13 11h12.6V22.7l-7.1 6.8c-.4.3-.9.5-1.4.5-1 0-2-.8-2-1.7 0-.4.3-.9.6-1.2l10.3-8.8c.3-.4.8-.6 1.3-.6.6 0 1 .2 1.4.6l10.2 8.8c.4.3.6.8.6 1.2 0 1-.9 1.7-2 1.7-.5 0-1-.2-1.3-.5l-7.2-6.8v15.6h14.4c6.1 0 11.2-4.1 11.2-9.4 0-5-4-8.8-9.5-9.4C63.8 11.8 56 5.8 47 6Zm-1.7 42.7V38.4h3.4v10.3c0 .8-.7 1.5-1.7 1.5s-1.7-.7-1.7-1.5Z M27 49c-4 0-7 2-7 6v29c0 3 3 6 6 6h42c3 0 6-3 6-6V55c0-4-3-6-7-6H28Zm41 3c1 0 3 1 3 3v19l-13-6a2 2 0 0 0-2 0L44 79l-10-5a2 2 0 0 0-2 0l-9 7V55c0-2 2-3 4-3h41Z M40 62c0 2-2 4-5 4s-5-2-5-4 2-4 5-4 5 2 5 4Z"/>
        </symbol>
    </defs>
   </svg>
</div>

@endsection
