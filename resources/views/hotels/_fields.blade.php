<div class="form-group">
    <label for="hotelName" class="col-form-label text-md-right">Hotel Name</label>
    <input type="text"
           id="hotelName"
           class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}"
           name="name"
           value="{{ old('name') ?? (@$hotel ? $hotel->name : '') }}"
           placeholder="Enter Name" required autofocus>
    @if($errors->has('name'))
        <span class="invalid-feedback d-block" role="alert">
            <strong>{{ $errors->first('name') }}</strong>
        </span>
    @endif
</div>

<div class="form-group">
    <label for="hotelEmail" class="col-form-label text-md-right">Hotel Email</label>
    <input type="text"
           id="hotelEmail"
           class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}"
           name="email"
           value="{{ old('email') ?? (@$hotel ? $hotel->email : '') }}"
           placeholder="Enter Email" required autofocus>
    @if($errors->has('email'))
        <span class="invalid-feedback d-block" role="alert">
            <strong>{{ $errors->first('email') }}</strong>
        </span>
    @endif
</div>

<div class="form-group">
    <label for="hotelPhone" class="col-form-label text-md-right">Hotel Phone</label>
    <input type="text"
           id="hotelPhone"
           class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}"
           name="phone"
           value="{{ old('phone') ?? (@$hotel ? $hotel->phone : '') }}"
           placeholder="Enter Phone" required autofocus>
    @if($errors->has('phone'))
        <span class="invalid-feedback d-block" role="alert">
            <strong>{{ $errors->first('phone') }}</strong>
        </span>
    @endif
</div>

<div class="form-group">
    <label for="hotelAddress" class="col-form-label text-md-right">Hotel Address</label>
    <input type="text"
           id="hotelAddress"
           class="form-control {{ $errors->has('address') ? 'is-invalid' : '' }}"
           name="address"
           value="{{ old('address') ?? (@$hotel ? $hotel->address : '') }}"
           placeholder="Enter Address" required autofocus>
    @if($errors->has('address'))
        <span class="invalid-feedback d-block" role="alert">
            <strong>{{ $errors->first('address') }}</strong>
        </span>
    @endif
</div>

<div class="form-group">
    <label for="hotelType" class="col-form-label text-md-right">Hotel Type</label>
    <select name="type_id"
            id="hotelType"
            class="form-control">
        @foreach($types as $type => $value)
            <option value="{{ $type }}"
                {{ ($value === @$hotel->type->type) ? 'selected' : '' }}>
                {{ $value }}
            </option>
        @endforeach
    </select>
</div>
