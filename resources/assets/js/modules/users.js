$(document).ready(function () {
    const $emailModal = $('#sendEmailModal');
    const $emailForm = $('#userEmailForm');

    $(document).on('click', '.send-email', function () {
        const userId = $(this).data('user_id');
        const userEmail = $(this).data('user_email');

        $emailModal.find('#userId').val(userId);
        $emailModal.find('#email').val(userEmail);
        $emailForm.attr('action', $emailForm.data('route').replace('USER_ID', userId));
    });

    $emailModal.on('hidden.bs.modal', function () {
        $emailForm.find('input').val('').removeClass('is-invalid');
        $emailForm.find('textarea').val('').removeClass('is-invalid');
        $emailForm.find('.invalid-feedback').remove();
    });

    $(document).on('click', '.approve', function () {
        const userId = $(this).data('user_id');

        Swal.fire({
            title: 'Confirmation',
            text: 'Are you sure you want to approve this account?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3d8bfc',
            cancelButtonColor: '#bd2130',
        }).then((result) => {
            if (result.value) {
                document.getElementById(`approve-form-${userId}`).submit();
            }
        });
    });
    $(document).on('click', '.block', function () {
        const userId = $(this).data('user_id');
        const action = $(this).attr('title');

        Swal.fire({
            title: 'Confirmation',
            text: `Are you sure you want to ${action} this account?`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3d8bfc',
            cancelButtonColor: '#bd2130',
        }).then((result) => {
            if (result.value) {
                document.getElementById(`block-form-${userId}`).submit();
            }
        }).catch(Swal.noop);
    });
});
