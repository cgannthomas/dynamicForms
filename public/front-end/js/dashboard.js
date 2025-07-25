$('#Form-name').on('change', function() {
    const url = $(this).val();
    if (url) {
      window.location.href = url;
    }
  });

  setTimeout(function () {
    $.each($('.alert'), function(index, element) {
        element.style.transition = 'opacity 0.5s ease';
            element.style.opacity = 0;
            setTimeout(() => element.remove(), 500);
    });
    }, 3000); // 3 seconds

  $('#reset-form').click(function(){
    location.reload();
  })