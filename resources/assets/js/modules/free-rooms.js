$(document).ready(function () {
    $('.increment').click(function () {
        let freeRoomsInput = $(this).closest('tr').find('input.free-rooms');
        let count = freeRoomsInput.val();
        freeRoomsInput.val(parseInt(count) + 1);
    });

    $('.decrement').click(function () {
        let freeRoomsInput = $(this).closest('tr').find('input.free-rooms');
        let count = freeRoomsInput.val();
        if (parseInt(count) > 0) {
            freeRoomsInput.val(parseInt(count) - 1);
        }
    });

    $('.for-all button').click(function () {
        let value = $(this).closest('.card').find('.for-all input').val();

        $(this).closest('.card').find('.free-rooms').val(value);
    })
});
