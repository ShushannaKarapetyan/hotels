$(document).ready(function () {
    $(document).on('click', '.increment', function () {
        let freeRoomsInput = $(this).closest('tr').find('input.free-rooms');
        let count = freeRoomsInput.val();
        freeRoomsInput.val(parseInt(count) + 1);
    });

    $(document).on('click', '.decrement', function () {
        let freeRoomsInput = $(this).closest('tr').find('input.free-rooms');
        let count = freeRoomsInput.val();
        if (parseInt(count) > 0) {
            freeRoomsInput.val(parseInt(count) - 1);
        }
    });
});
