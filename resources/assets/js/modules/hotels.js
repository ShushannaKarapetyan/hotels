$(document).ready(function () {
    $(document).on('click', '.delete-hotel', function () {
        const hotelId = $(this).data('hotel_id');

        Swal({
            title: 'Confirmation',
            text: 'Are you sure you want to delete this hotel?',
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3d8bfc',
            cancelButtonColor: '#bd2130',
        }).then((result) => {
            if (result) {
                document.getElementById(`delete-form-${hotelId}`).submit();
            }
        }).catch(Swal.noop);
    });

    $('.custom-file-input').on('change', function () {
        let fileName = $(this).val().split('\\').pop();
        $(this).siblings('.custom-file-label').addClass('selected').html(fileName);
    });
});
