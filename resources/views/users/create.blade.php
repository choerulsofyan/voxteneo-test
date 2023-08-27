@extends('layouts.app')

@section('content')
    <div class="card mb-4 col-md-7">
        <div class="card-header">
            Add User
        </div>

        <form action="{{ route('users.store') }}" method="POST">
            @csrf

            <div class="card-body">

                @if (session('success'))
                    <div class="alert alert-success" role="alert">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="mb-3">
                    <label for="first_name" class="form-label">First Name</label>
                    <input class="form-control rounded-0 @error('first_name') is-invalid @enderror" type="text"
                        id="first_name" name="first_name" placeholder="Organizer Name" value="{{ old('first_name') }}"
                        required>
                    @error('first_name')
                        <span class="invalid-feedback">
                            {{ $message }}
                        </span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="last_name" class="form-label">Last Name</label>
                    <input class="form-control rounded-0 @error('last_name') is-invalid @enderror" type="text"
                        id="last_name" name="last_name" placeholder="Organizer Name" value="{{ old('last_name') }}"
                        required>
                    @error('last_name')
                        <span class="invalid-feedback">
                            {{ $message }}
                        </span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input class="form-control rounded-0 @error('email') is-invalid @enderror" type="text" id="email"
                        name="email" placeholder="Email" value="{{ old('email') }}" required>
                    @error('email')
                        <span class="invalid-feedback">
                            {{ $message }}
                        </span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input class="form-control rounded-0 @error('password') is-invalid @enderror" type="password"
                        id="password" name="password" placeholder="Password" value="{{ old('password') }}" required>
                    @error('password')
                        <span class="invalid-feedback">
                            {{ $message }}
                        </span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="confirm_password" class="form-label">Confirm Password</label>
                    <input class="form-control rounded-0 @error('password') is-invalid @enderror" type="password"
                        id="confirm_password" name="confirm_password" placeholder="confirm_Password"
                        value="{{ old('confirm_password') }}" required>
                    @error('confirm_password')
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
