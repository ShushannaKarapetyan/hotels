@php
    $notification = session()->has('flash_notification') ? session('flash_notification')->first() : false;
@endphp

@if (session()->has('flash_notification'))
    @push('scripts')
        <script>
            $(document).ready(function () {
                Swal.fire({
                    title: '{{ ucfirst($notification->level) }}!',
                    text: '{{ $notification->message }}',
                    icon: '{{ $notification->level }}'
                });
            });
        </script>
    @endpush
@endif
