@extends('layouts.app')

@section('content')
    <div class="card mb-4">
        <div class="card-header">
            Organizers
        </div>

        <form action="{{ route('organizers.store') }}" method="POST">
            @csrf

            <div class="card-body">

                @if ($message = Session::get('success'))
                    <div class="alert alert-success" role="alert">{{ $message }}</div>
                @endif

                <div class="input-group mb-3"><span class="input-group-text">
                        <svg class="icon">
                            <use xlink:href="{{ asset('icons/coreui.svg#cil-user') }}"></use>
                        </svg></span>
                    <input class="form-control" type="text" name="name" placeholder="Organizer Name"
                        value="{{ old('name') }}" required>
                    @error('name')
                        <span class="invalid-feedback">
                            {{ $message }}
                        </span>
                    @enderror
                </div>

                <div class="input-group mb-3"><span class="input-group-text">
                        <svg class="icon">
                            <use xlink:href="{{ asset('icons/coreui.svg#cil-photo') }}"></use>
                        </svg></span>
                    <input class="form-control" type="text" name="image" placeholder="Image Location"
                        value="{{ old('image') }}" required>
                    @error('email')
                        <span class="invalid-feedback">
                            {{ $message }}
                        </span>
                    @enderror
                </div>
            </div>

            <div class="card-footer">
                <button class="btn btn-sm btn-primary" type="submit">{{ __('Submit') }}</button>
            </div>

        </form>

    </div>
@endsection
