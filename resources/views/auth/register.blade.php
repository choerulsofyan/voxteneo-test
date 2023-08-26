@extends('layouts.guest')

@section('content')
    <div class="col-md-6">
        <div class="card mb-4 mx-4">
            <div class="card-body p-4">
                <h1>Register</h1>

                <form method="POST" action="{{ route('register2') }}">
                    @csrf

                    <div class="input-group mb-3"><span class="input-group-text">
                            <svg class="icon">
                                <use xlink:href="{{ asset('icons/coreui.svg#cil-user') }}"></use>
                            </svg></span>
                        <input class="form-control" type="text" name="first_name" placeholder="First Name" required
                            autocomplete="name" autofocus>
                        @error('name')
                            <span class="invalid-feedback">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>

                    <div class="input-group mb-3"><span class="input-group-text">
                            <svg class="icon">
                                <use xlink:href="{{ asset('icons/coreui.svg#cil-user') }}"></use>
                            </svg></span>
                        <input class="form-control" type="text" name="last_name" placeholder="Last Name" required
                            autocomplete="name" autofocus>
                        @error('name')
                            <span class="invalid-feedback">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>

                    <div class="input-group mb-3"><span class="input-group-text">
                            <svg class="icon">
                                <use xlink:href="{{ asset('icons/coreui.svg#cil-envelope-open') }}"></use>
                            </svg></span>
                        <input class="form-control" type="text" name="email" placeholder="Email" required
                            autocomplete="email">
                        @error('email')
                            <span class="invalid-feedback">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>

                    <div class="input-group mb-3"><span class="input-group-text">
                            <svg class="icon">
                                <use xlink:href="{{ asset('icons/coreui.svg#cil-lock-locked') }}"></use>
                            </svg></span>
                        <input class="form-control @error('password') is-invalid @enderror" type="password" name="password"
                            placeholder="Password" required autocomplete="new-password">
                        @error('password')
                            <span class="invalid-feedback">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>

                    <div class="input-group mb-4"><span class="input-group-text">
                            <svg class="icon">
                                <use xlink:href="{{ asset('icons/coreui.svg#cil-lock-locked') }}"></use>
                            </svg></span>
                        <input class="form-control @error('password_confirmation') is-invalid @enderror" type="password"
                            name="password_confirmation" placeholder="Confirm Password" required
                            autocomplete="new-password">
                    </div>

                    <button class="btn btn-block btn-success" type="submit">Register</button>

                </form>
            </div>
        </div>
    </div>
@endsection