@extends('layouts.app')

@section('content')
    <div class="card mb-4">
        <div class="card-header">
            Organizers
            <a class="btn btn-primary" href="{{ route('organizers.create') }}">Create</a>
        </div>

        {{-- <div class="alert alert-info" role="alert">Sample table page</div> --}}

        <div class="card-body">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">No.</th>
                        <th scope="col">Image</th>
                        <th scope="col">Organizer Name</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @php $i = 1; @endphp
                    @foreach ($organizers['data'] as $item)
                        <tr>
                            <td>{{ $i }}</td>
                            <td> <img src="{{ $item['imageLocation'] }}" alt="{{ $item['organizerName'] }}" height="100">
                            </td>
                            <td>{{ $item['organizerName'] }}</td>
                            <td>
                                <a href="{{ route('organizers.show', $item['id']) }}" class="btn btn-warning">
                                    <use xlink:href="path/to/flag.svg#cif-pencil"></use>
                                    Edit
                                </a>
                                <form action="{{ route('organizers.destroy', $item['id']) }}" method="POST"
                                    style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger"
                                        onclick="return confirm('Are you sure you want to delete this organizer?')">
                                        <svg class="icon">
                                            <use xlink:href="path/to/flag.svg#cif-trash"></use>
                                        </svg>
                                        Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @php $i++; @endphp
                    @endforeach
                </tbody>
            </table>

        </div>

        <div class="card-footer">
            {{-- {{ $organizers->links() }} --}}
        </div>
    </div>
@endsection
