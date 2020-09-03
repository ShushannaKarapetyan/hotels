<div class="hotel-room-item col-md-6">
    <div class="form-group">
        <label for="hotel-rooms" class="col-form-label text-md-right">Room Name</label>
        <div class="input-group">
            <input type="text"
                   name="rooms[{{ @$id ?? 'HOTEL_ROOM_ID' }}][name]"
                   required
                   value="{{ @$room['name'] }}"
                   class="form-control {{ $errors->has("rooms." . @$id . ".name") ? 'is-invalid' : '' }}"
                   placeholder="Enter Room Name">
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
                           class="form-control people {{ $errors->has("rooms." . @$id . ".adults") ? 'is-invalid' : '' }}"
                           name="rooms[{{ @$id ?? 'HOTEL_ROOM_ID' }}][adults]"
                           min="0"
                           value="{{ @$room['adults'] ?? 0 }}">
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
                           class="form-control people {{ $errors->has("rooms." . @$id . ".children") ? 'is-invalid' : '' }}"
                           name="rooms[{{ @$id ?? 'HOTEL_ROOM_ID' }}][children]"
                           min="0"
                           value="{{ @$room['children'] ?? 0 }}">
                    <button type="button" class="btn-secondary btn-sm decrement">
                        <i class="fa fa-minus"></i>
                    </button>
                    <button type="button" class="btn-success btn-sm increment">
                        <i class="fa fa-plus"></i>
                    </button>
                </div>
            </div>
        </div>
        @if($errors->has("rooms." . @$id . ".name"))
            <span class="invalid-feedback d-block" role="alert">
                <strong>{{ $errors->first("rooms." . @$id .".name") }}</strong>
            </span>
        @endif

        @if($errors->has("rooms." . @$id . ".adults"))
            <span class="invalid-feedback d-block" role="alert">
                <strong>{{ $errors->first("rooms." . @$id . ".adults") }}</strong>
            </span>
        @endif

        @if($errors->has("rooms." . @$id . ".children"))
            <span class="invalid-feedback d-block" role="alert">
                <strong>{{ $errors->first("rooms." . @$id . ".children") }}</strong>
            </span>
        @endif
    </div>
</div>
