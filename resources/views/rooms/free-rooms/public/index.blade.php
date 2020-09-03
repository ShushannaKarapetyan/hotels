@extends('layouts.app')

@push('title', "{$hotel->name}: Free Rooms")

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/free-rooms.css') }}">
@endpush

@section('content')
    <div class="row">
        <div class="flex-container">
            <form method="POST" action="{{ route('public_free_rooms.update', $uuid) }}" class="form-free-rooms">
                @csrf
                @method('PUT')
                @forelse($rooms as $index => $room)
                    <div class="card float-left ml-3">
                        <div class="card-header">
                            <div class="room-name">
                                <span>{{$room->name}}</span>
                            </div>
                            <div class="badges d-flex">
                                <div class="adults-count mr-1">
                                    <span class="badge badge-secondary">{{$room->adults}} Adults</span>
                                </div>
                                <div class="children-count">
                                    <span class="badge badge-secondary">{{$room->children}} Children</span>
                                </div>
                            </div>
                            <div class="for-all mt-2 d-flex">
                                <input type="number"
                                       class="form-control w-50"
                                       value=0
                                >
                                <button type="button" class="btn-success w-50">
                                    SET FOR ALL
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table current-week">
                                    <tbody>
                                    @foreach($allDays[0] as $i => $day)
                                        <tr>
                                            <td>
                                                {{ \Carbon\Carbon::parse($day)->format('D d.m') }}
                                            </td>
                                            <td>
                                                <input type="number"
                                                       id="free-room"
                                                       class="form-control free-rooms {{ $errors->has("free_rooms.$room->id.$day") ? 'is-invalid' : '' }}"
                                                       name="free_rooms[{{ $room->id }}][{{ $day }}]"
                                                       required
                                                       min="0"
                                                       value="{{ (@$freeRoomsByWeeks[$room->id] && count($freeRoomsByWeeks[$room->id]) === 3) ? $freeRoomsByWeeks[$room->id][$weekNumbers[0]][$i]['free'] : 0}}">
                                            </td>
                                            <td>
                                                <button type="button" class="btn-secondary btn-sm decrement">
                                                    <i class="fa fa-minus"></i>
                                                </button>
                                            </td>
                                            <td>
                                                <button type="button" class="btn-success btn-sm increment">
                                                    <i class="fa fa-plus"></i>
                                                </button>
                                            </td>
                                        </tr>
                                        @if($errors->has("free_rooms.$room->id.$day"))
                                            <tr>
                                                <td colspan="4">
                                                        <span class="invalid-feedback d-block" role="alert">
                                                        <strong>{{ $errors->first("free_rooms.$room->id.$day") }}</strong>
                                                    </span>
                                                </td>
                                            </tr>
                                        @endif
                                    @endforeach
                                    </tbody>
                                </table>
                                <table class="table second-week">
                                    <tbody>
                                    @foreach($allDays[1] as $i=>$day)
                                        <tr>
                                            <td>
                                                {{ \Carbon\Carbon::parse($day)->format('D d.m') }}
                                            </td>
                                            <td>
                                                <input type="number"
                                                       id="free-room"
                                                       class="form-control free-rooms {{ $errors->has("free_rooms.$room->id.$day") ? 'is-invalid' : '' }}"
                                                       name="free_rooms[{{ $room->id }}][{{ $day }}]"
                                                       min="0"
                                                       value="{{ (@$freeRoomsByWeeks[$room->id] && count($freeRoomsByWeeks[$room->id]) === 3) ? $freeRoomsByWeeks[$room->id][$weekNumbers[1]][$i]['free'] : 0}}">
                                            </td>
                                            <td>
                                                <button type="button" class="btn-secondary btn-sm decrement">
                                                    <i class="fa fa-minus"></i>
                                                </button>
                                            </td>
                                            <td>
                                                <button type="button" class="btn-success btn-sm increment">
                                                    <i class="fa fa-plus"></i>
                                                </button>
                                            </td>
                                        </tr>
                                        @if($errors->has("free_rooms.$room->id.$day"))
                                            <tr>
                                                <td colspan="4">
                                                        <span class="invalid-feedback d-block" role="alert">
                                                        <strong>{{ $errors->first("free_rooms.$room->id.$day") }}</strong>
                                                    </span>
                                                </td>
                                            </tr>
                                        @endif
                                    @endforeach
                                    </tbody>
                                </table>
                                <table class="table next-week">
                                    <tbody>
                                    @foreach($allDays[2] as $i=>$day)
                                        <tr>
                                            <td>
                                                {{ \Carbon\Carbon::parse($day)->format('D d.m') }}
                                            </td>
                                            <td>
                                                <input type="number"
                                                       id="free-room"
                                                       class="form-control free-rooms {{ $errors->has("free_rooms.$room->id.$day") ? 'is-invalid' : '' }}"
                                                       name="free_rooms[{{ $room->id }}][{{ $day }}]"
                                                       min="0"
                                                       value="{{ (@$freeRoomsByWeeks[$room->id] && count($freeRoomsByWeeks[$room->id]) === 3) ? $freeRoomsByWeeks[$room->id][$weekNumbers[2]][$i]['free'] : 0}}">
                                            </td>
                                            <td>
                                                <button type="button" class="btn-secondary btn-sm decrement">
                                                    <i class="fa fa-minus"></i>
                                                </button>
                                            </td>
                                            <td>
                                                <button type="button" class="btn-success btn-sm increment">
                                                    <i class="fa fa-plus"></i>
                                                </button>
                                            </td>
                                        </tr>
                                        @if($errors->has("free_rooms.$room->id.$day"))
                                            <tr>
                                                <td colspan="4">
                                                        <span class="invalid-feedback d-block" role="alert">
                                                        <strong>{{ $errors->first("free_rooms.$room->id.$day") }}</strong>
                                                    </span>
                                                </td>
                                            </tr>
                                        @endif
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                @empty
                    <p class="text-center">No Free Rooms</p>
                @endforelse
                @if(count($rooms))
                    <div class="d-flex w-100 ml-2">
                        <button type="submit" class="btn btn-primary btn-round">
                            Save
                        </button>
                    </div>
                @endif
            </form>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('js/modules/free-rooms.js') }}"></script>
@endpush
