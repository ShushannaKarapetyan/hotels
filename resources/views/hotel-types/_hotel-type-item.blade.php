<div class="hotel-type-item col-md-6">
    <div class="form-group">
        <div class="input-group">
            <input type="text"
                   name="hotel_types[{{ $hotelTypeId ?? '{HOTEL_TYPE_ID}' }}]"
                   required
                   class="lang-input form-control {{ $errors->has("hotel_types.{$hotelTypeId}") ? ' is-invalid' : '' }}"
                   value="{{ @$hotelTypeName }}"
                   placeholder="Enter Hotel Type Name">
            <div class="input-group-append">
                <button type="button" class="input-group-text btn-danger remove-hotel-type">
                    <i class="fa fa-times"></i>
                </button>
            </div>
            @if ($errors->has("hotel_types.{$hotelTypeId}"))
                <span class="invalid-feedback d-block" role="alert">
                    <strong>{{ $errors->first("hotel_types.{$hotelTypeId}") }}</strong>
                </span>
            @endif
        </div>
    </div>
</div>
