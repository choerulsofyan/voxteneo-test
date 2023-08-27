@extends('layouts.app')

@section('content')
    <div class="card mb-4 col-md-7">
        <div class="card-header">
            Edit User
        </div>

        <form action="{{ route('users.update', $user['id']) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="card-body">

                @if (session('success'))
                    <div class="alert alert-success" role="alert">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="mb-3">
                    <label for="first_name" class="form-label">First Name</label>
                    <input class="form-control rounded-0 @error('first_name') is-invalid @enderror" type="text"
                        id="first_name" name="first_name" placeholder="First Name"
                        value="{{ old('first_name', $user['firstName']) }}" required>
                    @error('name')
                        <span class="invalid-feedback">
                            {{ $message }}
                        </span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="last_name" class="form-label">Last Name</label>
                    <input class="form-control rounded-0 @error('last_name') is-invalid @enderror" type="text"
                        id="last_name" name="last_name" placeholder="Last Name"
                        value="{{ old('last_name', $user['lastName']) }}" required>
                    @error('last_name')
                        <span class="invalid-feedback">
                            {{ $message }}
                        </span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input class="form-control rounded-0 @error('email') is-invalid @enderror" type="text" id="email"
                        name="email" placeholder="Email" value="{{ old('email', $user['email']) }}" required>
                    @error('email')
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
