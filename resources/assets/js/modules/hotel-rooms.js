$(document).ready(function () {
    if (window.location.href.indexOf("create") > -1 && !$('.invalid-feedback.d-block strong').text()) {
        addRoomFields();
    }

    if (window.location.href.indexOf("edit") > -1) {
        addRoomFields();
    }

    $('.add-hotel-room').on('click', function () {
        addRoomFields();
    });

    $(document).on('click', '.remove-hotel-room', function () {
        $(this).closest('.hotel-room-item').remove();
    });

    $(document).on('click', '.increment', function () {
        let peopleInput = $(this).closest('.input-group-append').find('input.people');
        let count = peopleInput.val();
        peopleInput.val(parseInt(count) + 1);
    });

    $(document).on('click', '.decrement', function () {
        let peopleInput = $(this).closest('.input-group-append').find('input.people');
        let count = peopleInput.val();
        if (parseInt(count) > 0) {
            peopleInput.val(parseInt(count) - 1);
        }
    });

    function addRoomFields() {
        let $hotelRoomItem = $('#hotel-room-item-wrapper').html();

        $hotelRoomItem = $hotelRoomItem.replace(/HOTEL_ROOM_ID/g, 'temp_' + Math.random().toString(36).substring(2));

        $('#hotel-room-list').append($hotelRoomItem);
    }
});
