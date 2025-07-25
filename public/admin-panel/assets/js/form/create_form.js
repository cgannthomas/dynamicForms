$(document).on('click', '#add-fields', function(){
    if($('#dynamic-form').hasClass('dynamic_form_class')) {
        $('#dynamic-form').removeClass('dynamic_form_class');
        
    }
        cloneTrcontent();

    
    rearrangeTableAttribute(true);    

});

$(document).on('click', '#reset-form', function(){
    window.location.reload();
})

$(document).on('click', '.remove_field', function(){
    $(this).parents('tr').remove();

    if($('#dynamic-form tbody tr').length == 0) {
        $('#dynamic-form').addClass('dynamic_form_class');

        cloneTrcontent();

        return;
    }

    rearrangeTableAttribute();
})

$(document).on('change', '.field_type', function() {
    var value = $(this).val();

    if(value) {
        $(this).removeClass('field_required');
        $(this).parent('td').find('span.field_required').removeClass('field_required');

        if ($.inArray(value , ['radio', 'checkbox', 'select']) !== -1 ) {
            var cloneMultipleOptionTextBox = $('#clone-multiple-option-textbox input').clone();
            $(this).parents('tr').find('.multiple_option').html(cloneMultipleOptionTextBox);
            rearrangeTableAttribute();
        } else {
            $(this).parents('tr').find('.multiple_option').html('');
        }
    }

    
})


function cloneTrcontent() {
    var clone_tr = $('#clone-tr').find('tr').clone();
        $('#dynamic-form tbody').append(clone_tr);
}


function rearrangeTableAttribute(is_new = null) {
    var i=0;
	$.each($('#dynamic-form tbody').find('tr'), function(index, element) {
		i++;
		$(element).attr('id', 'tr-' + i)
			.find('.field_label').attr('id', 'field-label-' + i).attr('name', 'field[' + i + '][field_label]').end()
			.find('.field_name').attr('id', 'field-name-' + i).attr('name', 'field[' + i + '][field_name]').end()
			.find('.field_type').attr('id', 'field-type-' + i).attr('name', 'field[' + i + '][field_type]').end()
			.find('.multi_options').attr('id', 'multi-options-' + i).attr('name', 'field[' + i + '][options]').end()
			.find('.is_required').attr('id', 'is-required-' + i).attr('name', 'field[' + i + '][is_required]').end()			
			.find('.remove_field').attr('id', 'remove-field-' + i);

	});

    if(is_new) {
        $('#dynamic-form tbody tr:last-child .field_type').select2();
    }
}

$('#create-dynamic-form').submit(function(e){
    e.preventDefault();
    if(validateForm()) {

        let data = new FormData($(this)[0]),
	 	formDiv = $(this);
        
        $.ajax({
        url: formDiv.data('url'),
        type: formDiv.attr('method'),
        data : data,
        dataType:"JSON",
        processData : false,
        contentType:false,
        
     success: function(response) {
console.log(response)
			if (response.errors) {
				Swal.fire({
					text: response.msg,
					icon: "error",
					buttonsStyling: !1,
					confirmButtonText:
						"Ok",
					customClass: {
						confirmButton:
							"btn btn-primary",
					},
				}).then(function (t) {
					// location.reload();

				});
			} else {
				Swal.fire({
					text: response.msg,
					icon: "success",
					buttonsStyling: !1,
					confirmButtonText:
						"Ok",
					customClass: {
						confirmButton:
							"btn btn-primary",
					},
				}).then(function (t) {
					location.reload();
				});
			}
		},
		error: function(response, status, error) {
			if(response.status == 422) { 
				$.each(response.responseJSON.errors, function(field, errors){

                    let arrayStyleName = field.replace(/\.(\w+)/g, '[$1]');

					$('[name="'+ arrayStyleName +'"]').addClass('field_required');

                    if(field == 'form_name') {
                        $('<div class="fv-plugins-message-container invalid-feedback">'+ errors +'</div>').insertAfter($('[name="' + field +'"]')); 
                    } 
                    if(field == 'field') {
                        Swal.fire('Warning!', errors[0], 'error');
                    }
				});
			} else if(response.status == 419) {
                $('<div class="alert alert-danger">'+ response.responseJSON.message +'</div>').insertBefore('div.btn-div');

                setTimeout(function() {
                    $('div.alert').remove();
                    location.reload();
                }, 2000);
            }
            setTimeout(function() {
                $('div.invalid-feedback').remove();
            }, 3000); 
		}
      });
    } else {
        return false;
    }

});

function validateForm() {
    return true;
    var isValid = true;
    $('.field_required').removeClass('field_required');

    if(!$('input[name="form_name"]').val()) {
        $('input[name="form_name"]').addClass('field_required');
        isValid = false;
    }
    $.each($('#create-dynamic-form tbody').find('tr'), function(index, element) {
        
        if(!$(element).find('.field_label').val()) {
            $(element).find('.field_label').addClass('field_required');
            isValid = false;            
        }
        if(!$(element).find('.field_name').val()) {
            $(element).find('.field_name').addClass('field_required');
            isValid = false;            
        }
        if(!$(element).find('.field_type').val()) {
            $(element).find('.field_type').addClass('field_required');
            isValid = false;            
        }
        
        if ($.inArray($(element).find('.field_type').val() , ['radio', 'checkbox', 'select']) !== -1 ) {
            
            if(!($(element).find('.multiple_option input').val())) {
                $(element).find('.multiple_option input').addClass('field_required');
                isValid = false;
            }            
        }

    });
    return isValid;

}

$(document).on('blur', '.field_required', function() {
    var value = $(this).val();

    if (value ) {
        $(this).removeClass('field_required');
    }
})