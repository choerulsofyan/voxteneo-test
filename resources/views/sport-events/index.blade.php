@extends('layouts.app')

@section('content')
    <div class="card mb-4">
        <div class="card-header d-flex justify-content-between align-items-center">
            <span>Sport Events</span>
            <a class="btn btn-sm btn-primary" href="{{ route('sport-events.create') }}">
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
                        <th scope="col" class="align-middle text-center" style="width: 20%;">Event Date</th>
                        <th scope="col" class="align-middle text-left" style="width: 20%;">Event Name</th>
                        <th scope="col" class="align-middle text-left" style="width: 20%;">Event Type</th>
                        <th scope="col" class="align-middle text-center" style="width: 40%;">Actions </th>
                    </tr>
                </thead>
                <tbody>
                    @php $i = 1; @endphp
                    @foreach ($sportEvents['data'] as $item)
                        <tr>
                            <td class="align-middle text-center">{{ $i }}</td>
                            <td class="align-middle text-center">
                                {{ $item['eventDate'] }}
                            </td>
                            <td class="align-middle text-left">{{ $item['eventName'] }}</td>
                            <td class="align-middle text-left">{{ $item['eventType'] }}</td>
                            <td class="align-middle text-center">
                                <a href="{{ route('sport-events.edit', $item['id']) }}" class="btn btn-warning">
                                    <svg class="icon">
                                        <use xlink:href="{{ asset('icons/coreui.svg#cil-pencil') }}"></use>
                                    </svg>
                                </a>
                                <form action="{{ route('sport-events.destroy', $item['id']) }}" method="POST"
                                    style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger"
                                        onclick="return confirm('Are you sure you want to delete this sport event?')">
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
                    @if ($sportEvents['meta']['pagination']['current_page'] > 1)
                        <li
                            class="page-item {{ $sportEvents['meta']['pagination']['current_page'] == 1 ? 'disabled' : '' }}">
                            <a class="page-link" href="{{ route('sport-events.index', ['page' => 1]) }}">First</a>
                        </li>
                        <li class="page-item">
                            <a class="page-link"
                                href="{{ route('sport-events.index', ['page' => $sportEvents['meta']['pagination']['current_page'] - 1]) }}"
                                aria-label="Previous">
                                <span aria-hidden="true">&laquo;</span>
                            </a>
                        </li>
                    @endif

                    @php
                        $currentPage = $sportEvents['meta']['pagination']['current_page'];
                        $lastPage = $sportEvents['meta']['pagination']['total_pages'];
                        $nextLink = route('sport-events.index', ['page' => $sportEvents['meta']['pagination']['current_page'] + 1]);
                        $range = 2;
                    @endphp

                    @for ($i = max(1, $currentPage - $range); $i <= min($lastPage, $currentPage + $range); $i++)
                        <li class="page-item {{ $i == $currentPage ? 'active' : '' }}">
                            <a class="page-link"
                                href="{{ route('sport-events.index', ['page' => $i]) }}">{{ $i }}</a>
                        </li>
                    @endfor

                    @if ($sportEvents['meta']['pagination']['current_page'] < $sportEvents['meta']['pagination']['total_pages'])
                        <li class="page-item">
                            <a class="page-link" href="{{ $nextLink }}" aria-label="Next">
                                <span aria-hidden="true">&raquo;</span>
                            </a>
                        </li>
                        <li
                            class="page-item {{ $sportEvents['meta']['pagination']['current_page'] == $lastPage ? 'disabled' : '' }}">
                            <a class="page-link" href="{{ route('sport-events.index', ['page' => $lastPage]) }}">Last</a>
                        </li>
                    @endif
                </ul>
            </nav>
        </div>
    </div>
@endsection
