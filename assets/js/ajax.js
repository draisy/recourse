(function ($) {
    var $loader = $('#loader').hide();
    
    function validateEmail(email) {
        var regex = /\S+@\S+\.\S+/;
        return regex.test(email);
    }
    $(document)
        .ajaxStart(function () {
            $loader.show();
        })
        .ajaxStop(function () {
            $loader.hide();
        });
                  
    /* attach a submit handler to the form */
    $('#contactForm').submit(function (event) {
        /* stop form from submitting normally */
        event.preventDefault();

        /* get some values from elements on the page: */
        var $form = $(this),
            url = $form.attr('action');
        /* Send the data using post */
        var data = { email: $('#email').val(), name: $('#name').val(),
                    message: $('#contact_message').val() },
            email = $('#email').val();

        if (data.email == "" || data.name == "" || data.message == "") {
            alert("Please complete all fields and resubmit.");
        } else if (!validateEmail(data.email)) {
            alert("Pleas enter a valid email address.")
        } else {
            var posting = $.post(url, data);
            /* Alerts the results */
            posting.done(function (data) {
               $('#successResponse').html('Thank you for contacting the NY Real Estate Course. We will reply to ' +
                    email + ' shortly. <br/><div class="small">(If this email is not correct, please resubmit with the correct information.)</div>');
                $('#contactForm')[0].reset();
            });
        }
    });
})(jQuery);   