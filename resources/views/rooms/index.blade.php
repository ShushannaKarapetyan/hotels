@extends('layouts.app')

@push('title', 'Rooms')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/_room-fields.css') }}">
@endpush

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    @include('partials.search-form', [
                        'actionUrl' => route('rooms', $hotel),
                        'placeholder' => 'Enter Room Name'
                    ])
                </div>
                <form method="POST" action="{{ route('rooms.sync', $hotel) }}">
                    @csrf
                    @method('PUT')
                    <div class="card-body">
                        <div id="hotel-room-list" class="row">
                            @php
                                $roomsWithIdKeys = !empty(old('rooms')) ? old('rooms') : $roomsWithIdKeys;
                            @endphp
                            @if($roomsWithIdKeys)
                                @foreach($roomsWithIdKeys as $id => $room)
                                    @include('rooms._room-item')
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
                @include('rooms._room-item', ['id' => null, 'room' => null])
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('js/modules/hotel-rooms.js') }}"></script>
@endpush

