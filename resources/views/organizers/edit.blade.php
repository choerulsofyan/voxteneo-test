@extends('layouts.app')

@section('content')
    <div class="card mb-4 col-md-7">
        <div class="card-header">
            Edit Organizer
        </div>

        <form action="{{ route('organizers.update', $organizer['id']) }}" method="POST">
            @csrf
            @method('PUT') <!-- Add the method spoofing for PUT -->

            <div class="card-body">

                @if (session('success'))
                    <div class="alert alert-success" role="alert">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="mb-3">
                    <label for="name" class="form-label">Organizer Name</label>
                    <input class="form-control rounded-0 @error('name') is-invalid @enderror" type="text" id="name"
                        name="name" placeholder="Organizer Name" value="{{ old('name', $organizer['organizerName']) }}"
                        required>
                    @error('name')
                        <span class="invalid-feedback">
                            {{ $message }}
                        </span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="image" class="form-label">Image Location</label>
                    <input class="form-control rounded-0 @error('image') is-invalid @enderror" type="text" id="image"
                        name="image" placeholder="Image Location" value="{{ old('image', $organizer['imageLocation']) }}"
                        required>
                    @error('image')
                        <span class="invalid-feedback">
                            {{ $message }}
                        </span>
                    @enderror
                </div>
            </div>
            <div class="card-footer">
                <button class="btn btn-primary col-md-12 rounded-0" type="submit">Update</button>
            </div>
        </form>

    </div>
@endsection
