@extends('layouts.app')

@push('title', 'Create Room')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/_room-fields.css') }}">
@endpush

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <form method="POST" action="{{ route('hotel_rooms.store', $hotel) }}">
                    @csrf
                    <div class="card-body">
                        <div id="hotel-room-list" class="row">
                            @php
                                $hotelRooms = !empty(old('rooms')) ? old('rooms') : '';
                            @endphp
                            @if($hotelRooms)
                                @foreach($hotelRooms as $hotelRoomId => $hotelRoomName)
                                    @include('hotel-rooms._fields')
                                @endforeach
                            @endif
                        </div>
                        <hr>
                        <button type="button" class="btn btn-success btn-sm btn-icon btn-round add-hotel-room">
                            <i class="fa fa-plus"></i>
                        </button>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-info btn-round">Save</button>
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

