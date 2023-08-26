@extends('layouts.app')

@section('content')
    <div class="card mb-4">
        <div class="card-header d-flex justify-content-between align-items-center">
            <span>Organizers</span>
            <a class="btn btn-sm btn-primary" href="{{ route('organizers.create') }}">
                <svg class="icon">
                    <use xlink:href="{{ asset('icons/coreui.svg#cil-plus') }}"></use>
                </svg>
                Add New
            </a>
        </div>

        {{-- <div class="alert alert-info" role="alert">Sample table page</div> --}}

        <div class="card-body">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col" class="align-middle text-center" style="width: 5%;">#</th>
                        <th scope="col" class="align-middle text-center" style="width: 15%;">Image</th>
                        <th scope="col" class="align-middle text-left" style="width: 40%;">Organizer Name</th>
                        <th scope="col" class="align-middle text-center" style="width: 20%;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @php $i = 1; @endphp
                    @foreach ($organizers['data'] as $item)
                        <tr>
                            <td class="align-middle text-center">{{ $i }}</td>
                            <td class="align-middle text-center"> <img src="{{ $item['imageLocation'] }}"
                                    alt="{{ $item['organizerName'] }}" height="80">
                            </td>
                            <td class="align-middle text-left">{{ $item['organizerName'] }}</td>
                            <td class="align-middle text-center">
                                <a href="{{ route('organizers.edit', $item['id']) }}" class="btn btn-warning">
                                    <svg class="icon">
                                        <use xlink:href="{{ asset('icons/coreui.svg#cil-pencil') }}"></use>
                                    </svg>
                                </a>
                                <form action="{{ route('organizers.destroy', $item['id']) }}" method="POST"
                                    style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger"
                                        onclick="return confirm('Are you sure you want to delete this organizer?')">
                                        <svg class="icon">
                                            <use xlink:href="{{ asset('icons/coreui.svg#cil-trash') }}"></use>
                                        </svg>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @php $i++; @endphp
                    @endforeach
                </tbody>
            </table>


        </div>

        <div class="card-footer pt-3">
            <nav>
                <ul class="pagination justify-content-end">
                    @if ($organizers['meta']['pagination']['current_page'] > 1)
                        <li
                            class="page-item {{ $organizers['meta']['pagination']['current_page'] == 1 ? 'disabled' : '' }}">
                            <a class="page-link" href="{{ route('organizers.index', ['page' => 1]) }}">First</a>
                        </li>
                        <li class="page-item">
                            <a class="page-link"
                                href="{{ route('organizers.index', ['page' => $organizers['meta']['pagination']['current_page'] - 1]) }}"
                                aria-label="Previous">
                                <span aria-hidden="true">&laquo;</span>
                            </a>
                        </li>
                    @endif

                    @php
                        $currentPage = $organizers['meta']['pagination']['current_page'];
                        $lastPage = $organizers['meta']['pagination']['total_pages'];
                        $nextLink = route('organizers.index', ['page' => $organizers['meta']['pagination']['current_page'] + 1]);
                        $range = 2;
                    @endphp

                    @for ($i = max(1, $currentPage - $range); $i <= min($lastPage, $currentPage + $range); $i++)
                        <li class="page-item {{ $i == $currentPage ? 'active' : '' }}">
                            <a class="page-link"
                                href="{{ route('organizers.index', ['page' => $i]) }}">{{ $i }}</a>
                        </li>
                    @endfor

                    @if ($organizers['meta']['pagination']['current_page'] < $organizers['meta']['pagination']['total_pages'])
                        <li class="page-item">
                            <a class="page-link" href="{{ $nextLink }}" aria-label="Next">
                                <span aria-hidden="true">&raquo;</span>
                            </a>
                        </li>
                        <li
                            class="page-item {{ $organizers['meta']['pagination']['current_page'] == $lastPage ? 'disabled' : '' }}">
                            <a class="page-link" href="{{ route('organizers.index', ['page' => $lastPage]) }}">Last</a>
                        </li>
                    @endif
                </ul>
            </nav>
        </div>
    </div>
@endsection
