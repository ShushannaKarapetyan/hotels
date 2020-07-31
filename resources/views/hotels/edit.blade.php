@extends('layouts.app')

@push('title', "Edit Hotel: {$hotel->name}")

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <form method="POST"
                      action="{{ route('hotels.update', $hotel) }}"
                      enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="card-body">
                        @include('hotels._fields')
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary btn-round">
                            Update
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://cdn.ckeditor.com/ckeditor5/15.0.0/classic/ckeditor.js"></script>
    <script src="{{ asset('admin_assets/js/modules/hotels.js') }}"></script>
    <script>
        ClassicEditor.create(document.querySelector('#hotelText_en'));
        ClassicEditor.create(document.querySelector('#hotelText_it'));
    </script>
@endpush
