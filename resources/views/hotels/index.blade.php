@extends('layouts.app')

@push('title', 'Hotels')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    @include('partials.search-form', [
                        'actionUrl' => route('hotels'),
                        'placeholder' => 'Enter Hotel Name'
                    ])
                    <div class="float-left">
                        <a class="btn btn-round btn-success"
                           href="{{ route('hotels.create') }}">
                            Create new Hotel
                        </a>
                    </div>
                    <div class="float-right">
                        <a class="btn btn-primary btn-round" href="{{route('invoice')}}" target="_blank">
                            Export to PDF
                            <i class="far fa-file-pdf"></i>
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead class="text-primary">
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Type</th>
                                <th>Free Rooms Updated At</th>
                                <th>Created On</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($hotels as $hotel)
                                <tr>
                                    <td>{{ $hotel->id }}</td>
                                    <td>{{ $hotel->name }}</td>
                                    <td>{{ $hotel->type ? $hotel->type->type : '-' }}</td>
                                    <td>
                                        {{ $hotel->rooms_updated_at }}
                                    </td>
                                    <td>{{ $hotel->created_at->toDateString() }}</td>
                                    <td class="d-flex">
                                        <a class="btn btn-round btn-success btn-icon btn-sm mr-1"
                                           title="Rooms"
                                           href="{{ route('rooms', $hotel) }}">
                                            <i class="fas fa-bed"></i>
                                        </a>
                                        <a class="btn btn-round btn-primary btn-icon btn-sm mr-1"
                                           title="Free Rooms"
                                           href="{{ route('free_rooms', $hotel) }}">
                                            <i class="fas fa-bed"></i>
                                        </a>
                                        <a class="btn btn-round btn-warning btn-icon btn-sm mr-1"
                                           title="Edit"
                                           href="{{ route('hotels.edit', $hotel) }}">
                                            <i class="fa fa-pencil-alt"></i>
                                        </a>
                                        <form id="delete-form-{{ $hotel->id }}"
                                              method="POST"
                                              class="float-right"
                                              action="{{ route('hotels.delete', $hotel) }}">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-round btn-danger btn-icon btn-sm delete-hotel"
                                                    title="Delete"
                                                    data-hotel_id="{{ $hotel->id }}">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td class="text-center" colspan="5">No Hotels</td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer">
                    {{ $hotels->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
