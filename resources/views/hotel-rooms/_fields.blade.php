<div class="hotel-room-item col-md-6">
    <div class="form-group">
        <label for="hotel-rooms" class="col-form-label text-md-right">Room Name</label>
        <div class="input-group">
            <input type="text"
                   id="hotel-rooms"
                   name="rooms[{{ $hotelRoomId ?? 'HOTEL_ROOM_ID' }}][name]"
                   required
                   value="{{ old("rooms.{$hotelRoomId}.name") ?? (@$room ? $room->name : '') }}"
                   class="form-control {{ $errors->has("rooms.{$hotelRoomId}.name") ? 'is-invalid' : '' }}"
                   placeholder="Enter Hotel Room Name">
            <div class="input-group-append">
                <button type="button" class="input-group-text btn-danger remove-hotel-room">
                    <i class="fas fa-trash-alt"></i>
                </button>
            </div>
        </div>
    </div>
    <div class="form-group">
        <div class="input-group justify-content-between">
            <div class="adults col-md-12 col-lg-6">
                <label for="adult" class="adult-label">Adults</label>
                <div class="input-group-append">
                    <input type="number"
                           id="adult"
                           class="form-control people {{ $errors->has("rooms.{$hotelRoomId}.adults") ? 'is-invalid' : '' }}"
                           name="rooms[{{ $hotelRoomId ?? 'HOTEL_ROOM_ID' }}][adults]"
                           min="0"
                           value="{{ old("rooms.{$hotelRoomId}.adults") ?? (@$room ? $room->adults : 0) }}">
                    <button type="button" class="btn-secondary btn-sm decrement">
                        <i class="fa fa-minus"></i>
                    </button>
                    <button type="button" class="btn-success btn-sm increment">
                        <i class="fa fa-plus"></i>
                    </button>
                </div>
            </div>
            <div class="children col-md-12 col-lg-6">
                <label for="child" class="child-label">Children</label>
                <div class="input-group-append">
                    <input type="number"
                           id="child"
                           class="form-control people {{ $errors->has("rooms.{$hotelRoomId}.children") ? 'is-invalid' : '' }}"
                           name="rooms[{{ $hotelRoomId ?? 'HOTEL_ROOM_ID' }}][children]"
                           min="0"
                           value="{{ old("rooms.{$hotelRoomId}.children") ?? (@$room ? $room->children : 0) }}">
                    <button type="button" class="btn-secondary btn-sm decrement">
                        <i class="fa fa-minus"></i>
                    </button>
                    <button type="button" class="btn-success btn-sm increment">
                        <i class="fa fa-plus"></i>
                    </button>
                </div>
            </div>
        </div>

        @if(\Request::route()->getName() === 'hotel_rooms.edit')
            @if($errors->has("rooms.*.name"))
                <span class="invalid-feedback d-block" role="alert">
                <strong>{{ $errors->first("rooms.*.name") }}</strong>
            </span>
            @endif
        @else
            <span class="invalid-feedback d-block" role="alert">
                <strong>{{ $errors->first("rooms.{$hotelRoomId}.name") }}</strong>
            </span>
        @endif

       @if(\Request::route()->getName() === 'hotel_rooms.edit')
            @if($errors->has("rooms.*.adults"))
                <span class="invalid-feedback d-block" role="alert">
                <strong>{{ $errors->first("rooms.*adults") }}</strong>
            </span>
            @endif
        @else
            <span class="invalid-feedback d-block" role="alert">
                <strong>{{ $errors->first("rooms.{$hotelRoomId}.adults") }}</strong>
            </span>
        @endif

        @if(\Request::route()->getName() === 'hotel_rooms.edit')
            @if($errors->has("rooms.*children"))
                <span class="invalid-feedback d-block" role="alert">
                <strong>{{ $errors->first("rooms.*.children") }}</strong>
            </span>
            @endif
        @else
            <span class="invalid-feedback d-block" role="alert">
                <strong>{{ $errors->first("rooms.{$hotelRoomId}.children") }}</strong>
            </span>
        @endif
    </div>
</div>
