$(document).on('click', '.js-delete-btn', function( e ){
    event.preventDefault();
    var form_url = $(this).data('url');

    Swal.fire({
        text: 'Do you want to delete this form?',
        icon: "warning",
        buttonsStyling: !1,
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Yes, delete it!',
        cancelButtonText: 'Cancel',
        customClass: {
			confirmButton:
				"btn btn-primary",
            cancelButton:
                "btn btn-primary",
		},
	}).then(function (t) {
        if(t.isConfirmed) {
            $.ajax({
                url: form_url,
                type: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf"]').attr('content')
                },
                success: function (response) {
                    Swal.fire('Deleted!', response.message, 'success');
                    $('#form-list-table').DataTable().ajax.reload(); // optional
                },
                error: function (response) {
                    Swal.fire('Error!', response.message ? response.message : 'Something went wrong! Try again later.' , 'error');
                }
            });
        } else {
		    location.reload();
        }
    });
})