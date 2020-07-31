@extends('layouts.app')

@push('title', "Edit Room : {$room->name}")

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/_room-fields.css') }}">
@endpush

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <form method="POST" action="{{ route('hotel_rooms.update', [$hotel, $room]) }}">
                    @csrf
                    @method('PUT')
                    <div class="card-body">
                        <div id="hotel-room-list" class="row"></div>
                        <hr>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-info btn-round">Update</button>
                    </div>
                </form>
            </div>
            <div id="hotel-room-item-wrapper" class="d-none">
                @include('hotel-rooms._fields', ['hotelRoomId' => null, 'hotelRoomName' => null])
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('js/modules/hotel-rooms.js') }}"></script>
@endpush
