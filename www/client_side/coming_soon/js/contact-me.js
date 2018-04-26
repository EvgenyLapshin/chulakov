$(document).ready(function () {
    $("#contact-form [type='submit']").click(function (e) {
        e.preventDefault();
        var $form = $(this).closest('form');

        // Datadata to be sent to server
        var post_data = $form.serializeObject();

        var getStingMessage = function (errors) {
            var result = '';

            $.each(errors, function (key, value) {
                result += (value.join('<br>') + '<br>');
            });

            return result;
        };

        // Ajax post data to server
        $.post($form.attr('action'), post_data, function (response) {

            // Load json data from server and output message    
            if (response.error_code !== 0) {

                output = '<div class="error-message"><p>' + getStingMessage(response.error_messages) + '</p></div>';

            } else {

                output = '<div class="success-message"><p>' + (response.result || "Ваше сообщение успешно отправлено!") + '</p></div>';

                // After, all the fields are reseted
                $form.find('input, textarea').val('');
            }

            $("#answer").hide().html(output).fadeIn();

        }, 'json');

    });

    // Reset and hide all messages on .keyup()
    $("#contact-form input, #contact-form textarea").keyup(function () {
        $("#answer").fadeOut();
    });

});