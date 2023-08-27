@extends('layouts.app')

@section('content')
    <div class="card mb-4">
        <div class="card-header d-flex justify-content-between align-items-center">
            <span>Users</span>
        </div>

        {{-- <div class="alert alert-info" role="alert">Sample table page</div> --}}

        <div class="card-body">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col" class="align-middle text-center" style="width: 5%;">#</th>
                        <th scope="col" class="align-middle text-left" style="width: 20%;">First Name</th>
                        <th scope="col" class="align-middle text-left" style="width: 20%;">Last Name</th>
                        <th scope="col" class="align-middle text-left" style="width: 20%;">Email</th>
                        <th scope="col" class="align-middle text-center" style="width: 20%;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="align-middle text-center">1</td>
                        <td class="align-middle text-left">
                            {{ $users['firstName'] }}
                        </td>
                        <td class="align-middle text-left">{{ $users['lastName'] }}</td>
                        <td class="align-middle text-left">{{ $users['email'] }}</td>
                        <td class="align-middle text-center">
                            <a href="{{ route('users.edit', $users['id']) }}" class="btn btn-warning">
                                <svg class="icon">
                                    <use xlink:href="{{ asset('icons/coreui.svg#cil-pencil') }}"></use>
                                </svg>
                            </a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection
