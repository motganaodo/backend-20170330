jQuery(document).ready(function($) {
    $('#birthdate').datetimepicker({
        format: 'DD/MM/YYYY',
        viewMode: 'years',
        enabledHours: false
    });

    $('.list-users').find('.delete-user').click(function(event) {
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
                        $.ajax({
                            url: response.redirect,
                            dataType: 'html'
                        }).done(function(data) {
                            var content = $.parseHTML(data);
                            $('.list-users').html($(content).find('.list-users').html());
                        });
                    }else{
                        alert('bug somewhere!!!');
                    }
                });
        }
    });
});
