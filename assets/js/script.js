jQuery(document).ready(function($) {
    $('#birthdate').datetimepicker({
        format: 'DD/MM/YYYY',
        viewMode: 'years',
        enabledHours: false
    });

    $('.list-users').find('.delete-user').on('click', function(event) {
        event.preventDefault();
        var result = confirm("Want to delete this user?");
        if (result) {
            var delete_url = $(this).attr('href');
            $.ajax({
                url: delete_url,
                dataType: 'json'
                }).done(function(response) {
                    if (response.message) {
                        alert(response.message);
                        if (response.redirect) {
                            setInterval(function(){
                                window.location.replace(response.redirect);
                            }, 1000);
                        }
                    }else{
                        alert('bug somewhere!!!');
                    }
                });
        }
    });
});
