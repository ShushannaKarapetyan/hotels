@extends('layouts.app')

@push('title', "{$hotel->name}: Rooms")

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    @include('partials.search-form', [
                        'actionUrl' => route('hotel.rooms', $hotel),
                        'placeholder' => 'Enter Room Name'
                    ])
                    <a class="btn btn-round btn-success"
                       href="{{ route('hotel_rooms.create', $hotel) }}">
                        Create new Room
                    </a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead class="text-primary">
                            <tr>
                                <th>N</th>
                                <th>Name</th>
                                <th>Hotel</th>
                                <th>Created On</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($rooms as $index => $room)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $room->name }}</td>
                                    <td>{{ $hotel->name }}</td>
                                    <td>{{ $room->created_at->toDateString() }}</td>
                                    <td class="d-flex">
                                        <a class="btn btn-round btn-warning btn-icon btn-sm mr-1"
                                           title="Edit"
                                           href="{{ route('hotel_rooms.edit', [$hotel, $room]) }}">
                                            <i class="fa fa-pencil-alt"></i>
                                        </a>
                                        <form id="delete-form-{{ $room->id }}"
                                              method="POST"
                                              class="float-right"
                                              action="{{ route('hotel_rooms.delete', [$hotel, $room]) }}">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-round btn-danger btn-icon btn-sm delete-hotel-room"
                                                    title="Delete"
                                                    data-room_id="{{ $room->id }}">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td class="text-center" colspan="5">No Hotel Rooms</td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer">
                    {{ $rooms->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
