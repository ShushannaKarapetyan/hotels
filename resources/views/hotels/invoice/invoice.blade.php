<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Invoice</title>
    <style>
        table, td, tr, th {
            border: 1px solid;
            font-weight: bold;
        }

        table {
            margin: 30px 30px;
            border-collapse: collapse;
            font-size: 13px;
        }

        td p {
            margin: 0;
        }

        .rotate-date {
            -webkit-transform: rotate(90deg);
            -moz-transform: rotate(90deg);
            -ms-transform: rotate(90deg);
            -o-transform: rotate(90deg);
            margin-left: -20px;
            margin-right: -20px;
        }
    </style>
</head>
<body>
<div class="container mt-5">
    <h2 style="text-align: center">Free Rooms - {{ $dates[0] }} - {{ $dates[count($dates)-1] }}
        / {{ config('app.name') }}
    </h2>
    <table>
        <thead>
        <tr>
            <th colspan="2">Rooms</th>
            @foreach($dates as $date)
                <th style="height: 90px">
                    <div class="rotate-date">{{ $date }}</div>
                </th>
            @endforeach
        </tr>
        </thead>
        @foreach($hotels as $hotel)
            @foreach($hotel->rooms as $room)
                <tr>
                    <td rowspan="{{ count($hotel->rooms) }}"
                        style="{{ $loop->first ?  '' : 'display:none' }}">
                        <p style="margin-top: 10px;">
                            <span>{{ $hotel->name }}</span>
                        </p>
                        <p>
                            <span>E-mail: {{ $hotel->email }}</span>
                        </p>
                        <p style="margin-bottom: 10px;">
                            Tel: <span>{{ $hotel->phone }}</span>
                        </p>
                    </td>
                    <td>{{ $room->name }}</td>

                    @foreach($freeRoomsByRooms[$room->id] as $freeRoom)
                        <td style="text-align: center">{{ $freeRoom ? $freeRoom : '' }}</td>
                    @endforeach
                </tr>
            @endforeach
        @endforeach
    </table>
</div>
</body>
</html>
