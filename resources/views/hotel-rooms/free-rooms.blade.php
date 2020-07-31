@extends('layouts.app')

@push('title', "{$hotel->name}: Free Rooms")

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/_room-fields.css') }}">

    <style>
        .room-name {
            font-size: 17px;
            font-weight: bold;
        }
    </style>
@endpush

@section('content')
    <div class="row">
        <div class="col-md-12">
            @foreach($rooms as $index => $room)
                <div class="card col-md-4 float-left">
                    <div class="card-header">
                        <div class="room-name">
                            <span>{{$room->name}}</span>
                        </div>
                        <div class="adults-count float-left mr-1">
                            <span class="badge badge-secondary">{{$room->adults}} Adults</span>
                        </div>
                        <div class="children-count float-left">
                            <span class="badge badge-secondary">{{$room->children}} Children</span>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                {{--@foreach($freeRooms as $freeRoom)--}}
                                    <tr>
                                        <td>
                                            {{--{{ \Carbon\Carbon::now()->format('D d.m') }}--}}
                                        </td>
                                        <td>
                                            <input type="number"
                                                   id="adult"
                                                   class="form-control"
                                                   name="rooms"
                                                   min="0"
                                                   value="{{--{{ $freeRooms[$index]->free}}--}}">
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
                                {{--@endforeach--}}
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer">

                    </div>
                </div>
            @endforeach

        </div>
    </div>
@endsection


