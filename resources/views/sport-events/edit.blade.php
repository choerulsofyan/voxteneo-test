@extends('layouts.app')

@section('content')
    <div class="card mb-4 col-md-7">
        <div class="card-header">
            Edit Sport Event
        </div>

        <form action="{{ route('sport-events.update', $sportEvent['id']) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="card-body">

                @if (session('success'))
                    <div class="alert alert-success" role="alert">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="mb-3">
                    <label for="date" class="form-label">Event Date</label>
                    <input class="form-control rounded-0 @error('date') is-invalid @enderror" type="date" id="date"
                        name="date" placeholder="Event Date" value="{{ old('date', $sportEvent['eventDate']) }}"
                        required>
                    @error('date')
                        <span class="invalid-feedback">
                            {{ $message }}
                        </span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="name" class="form-label">Event Name</label>
                    <input class="form-control rounded-0 @error('name') is-invalid @enderror" name="name" id="name"
                        name="name" placeholder="Event Name" value="{{ old('name', $sportEvent['eventName']) }}"
                        required>
                    @error('name')
                        <span class="invalid-feedback">
                            {{ $message }}
                        </span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="type" class="form-label">Event Type</label>
                    <input class="form-control rounded-0 @error('type') is-invalid @enderror" type="text" id="type"
                        name="type" placeholder="Event Type" value="{{ old('type', $sportEvent['eventType']) }}"
                        required>
                    @error('type')
                        <span class="invalid-feedback">
                            {{ $message }}
                        </span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="organizer_id" class="form-label">Organizer Id</label>
                    <input class="form-control rounded-0 @error('organizer_id') is-invalid @enderror" name="organizer_id"
                        id="organizer_id" name="organizer_id" placeholder="Organizer Id"
                        value="{{ old('organizer_id', $sportEvent['organizer']['id']) }}" required>
                    @error('organizer_id')
                        <span class="invalid-feedback">
                            {{ $message }}
                        </span>
                    @enderror
                </div>
            </div>
            <div class="card-footer">
                <button class="btn btn-primary col-md-12 rounded-0" type="submit">Save</button>
            </div>
        </form>
    </div>
@endsection
