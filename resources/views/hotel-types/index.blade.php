@extends('layouts.app')

@push('title', 'Topics')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    @include('partials.search-form', [
                        'actionUrl' => route('hotel_types'),
                        'placeholder' => 'Enter Title'
                    ])
                </div>
                <form method="POST" action="{{ route('hotel_types.sync') }}">
                    @csrf
                    @method('PUT')
                    <div class="card-body">
                        <div id="hotel-type-list" class="row">
                            @php
                                $hotelTypes = !empty(old('hotel_types')) ? old('hotel_types') : $hotelTypes;
                            @endphp
                            @foreach($hotelTypes as $hotelTypeId => $hotelTypeName)
                                @include('hotel-types._hotel-type-item')
                            @endforeach
                        </div>
                        <hr>
                        <button type="button" class="btn btn-success btn-sm btn-icon btn-round add-hotel-type">
                            <i class="fa fa-plus"></i>
                        </button>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-info btn-round">Save</button>
                    </div>
                </form>
            </div>
            <div id="hotel-type-item-wrapper" class="d-none">
                @include('hotel-types._hotel-type-item', ['hotelTypeId' => null, 'hotelTypeName' => null])
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('js/modules/hotel-types.js') }}"></script>
@endpush
