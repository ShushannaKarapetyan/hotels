@extends('layouts.app')

@push('title', 'Create Hotel')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <form method="POST" action="{{ route('hotels.store') }}">
                    @csrf
                    <div class="card-body">
                        @include('hotels._fields')
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary btn-round">
                            Save
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('admin_assets/js/modules/hotels.js') }}"></script>
@endpush


