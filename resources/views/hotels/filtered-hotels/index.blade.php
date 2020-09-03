@foreach($hotels as $index => $hotel)
    <div class='col-md-12 mt-3 d-flex'>
        <div class='col-md-6'>
            <h5 class='hotel-name font-weight-bold'>{{ $hotel->name }}</h5>
            <div class='rooms'>
                <div class='title font-weight-bold'>Rooms</div>
                @foreach($hotel->rooms as $room)
                    <span>{{ $room->name }}</span><br>
                @endforeach
            </div>
        </div>
        <div class='col-md-6'>
            <div class='email'>E-mail: {{ $hotel->email }}</div>
            <div class='phone'>Tel: {{ $hotel->phone }}</div>
        </div>
    </div>
@endforeach
