$(document).ready(function () {
    $('.add-hotel-type').on('click', function () {
        let $hotelTypeItem = $('#hotel-type-item-wrapper').html();
        $hotelTypeItem = $hotelTypeItem.replace('{HOTEL_TYPE_ID}', 'temp_' + Math.random().toString(36).substring(2));
        $('#hotel-type-list').append($hotelTypeItem);
    });

    $(document).on('click', '.remove-hotel-type', function () {
        $(this).closest('.hotel-type-item').remove();
    });
});
