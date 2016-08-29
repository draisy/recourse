(function ($) {
    var $loader = $('#loader').hide(),
        didSign = false;
    
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
            url = 'send-form.php';
        /* Send the data using post */
        var data = { email: $('#email').val(), name: $('#name').val(),
                    message: $('#contact_message').val()},
            email = $('#email').val();

        if (data.email == "" || data.name == "" || data.message == "") {
            alert("Please complete all fields and resubmit.");
        } else if (!validateEmail(data.email)) {
            alert("Please enter a valid email address.")
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
    
    $('#signupForm').submit(function (event) {
        event.preventDefault();
        $('#loader2').show();
        
        var $form = $(this),
            url = 'send-signup.php',
            image = $('#signature').jSignature('getData', 'svgbase64'),
            empty = false,
            postFinal,
            data = {
                firstName:  $('#fname').val(),
                lastName: $('#lname').val(),
                email: $('#email').val(),
                address: $('#address').val(),
                city: $('#city').val(),
                state: $('#state').val(),
                zip: $('#zip').val(),
                phone: $('#hphone').val(),
                cell: $('#mphone').val(),
                sms: $('input[name=sms]:checked').val(),
                classChange: $('input[name=classchange]:checked').val(),
                contactChange: $('#contactchange').val(),
                level: $('#level').val(),
                eng: $('input[name=eng]:checked').val(),
                yid: $('input[name=yid]:checked').val(),
                time: $('input[name=time]:checked').val(),
                business: $('#business').val(),
                occupation: $('#occupation').val(),
                kollel: $('#kollel').val(),
                re: $('input[name=re]:checked').val(),
                length: $('#length').val(),
                ecname: $('#ecname').val(),
                ecphone: $('#ecphone').val(),
                ecname2: $('#ec2name').val(),
                ecphone2: $('#ec2phone').val(),
                referrals: [],
                image: ''
                },
        referrals = new Array();
        $("input[name=referral]:checked").each(function() {
            data['referrals'].push($(this).val());
        });
        data['image'] = "data:" + image.join(",");
        
        $form.find( 'input[type!="hidden"]' ).each(function () {
            if (!$(this).val()) { 
                $(this).css('border-color', '#e44c65');
                empty = true;
            } else {
                $(this).css('border-color', 'rgba(255, 255, 255, 0.3)');
            }
        });
        
        if (empty) {
            alert('Please complete all required fields and resubmit.');
            $('#loader2').hide();
            return;
        } else if(!validateEmail(data.email)) {
            alert('Please enter a valid email address and resubmit.');
            $('#loader2').hide();
            return;
        } else if ($('#signatureVal').val() !== "true") {
            alert('Please sign the signature pad with mouse click or finger tap on touchscreen.');
            $('#loader2').hide();
            return;
        } else {
            postFinal = $.post(url, data)
            postFinal.done(function (data) {
                console.log('done', data);
                $('#loader2').hide();
                $('#page1')[0].reset();
                $('#signupForm')[0].reset();
                $("#signature").jSignature('reset');
                window.scrollTo(0, 0);
                alert('Thank you. Your registration has been sent successfully. We will be in touch with you shortly.')
            });    
        }  
        
            
            
            // $('#submitsig').attr('src', "data:" + image.join(","));
            // posting.done(function (data) {
            //     console.log('done', data);
            //     $('#loader2').hide();
            // });      
    });
    
    $('#page1').submit(function (event) {
        event.preventDefault();
        $('#loader').show();
        var $form = $(this),
            url = 'send-initial.php',
            empty = false,
            posting, 
            data = {
                firstName:  $('#fname').val(),
                lastName: $('#lname').val(),
                email: $('#email').val(),
                address: $('#address').val(),
                city: $('#city').val(),
                state: $('#state').val(),
                zip: $('#zip').val(),
                phone: $('#hphone').val(),
                cell: $('#mphone').val(),
                sms: $('input[name=sms]:checked').val(),
                classChange: $('input[name=classchange]:checked').val(),
                contactChange: $('#contactchange').val(),
                level: $('#level').val(),
                eng: $('input[name=eng]:checked').val(),
                yid: $('input[name=yid]:checked').val(),
                time: $('input[name=time]:checked').val(),
                business: $('#business').val(),
                occupation: $('#occupation').val(),
                kollel: $('#kollel').val(),
                re: $('input[name=re]:checked').val(),
                length: $('#length').val(),
                ecname: $('#ecname').val(),
                ecphone: $('#ecphone').val(),
                ecname2: $('#ec2name').val(),
                ecphone2: $('#ec2phone').val(),
                referrals: []
                },
            referrals = new Array();
            $("input[name=referral]:checked").each(function() {
                data['referrals'].push($(this).val());
            });
        
        $form.find( 'input[type!="hidden"]' ).each(function () {
            if (!$(this).val()) { 
                $(this).css('border-color', '#e44c65');
                empty = true;
            } else {
                $(this).css('border-color', 'rgba(255, 255, 255, 0.3)');
            }
        });
        
        if (empty) {
            alert('Please complete all required fields and resubmit.');
            $('#loader').hide();
            return;
        } else if(!validateEmail(data.email)) {
            alert('Please enter a valid email address and resubmit.');
            $('#loader').hide();
            return;
        } else {
            posting = $.post(url, data);
            posting.done(function (data) {
                console.log('done', data);
                $('#loader').hide();
                $('#page2').css("visibility","visible");
            });    
        }  
    });
    
       $('#friendForm').submit(function (event) {
        /* stop form from submitting normally */
        event.preventDefault();

        /* get some values from elements on the page: */
        var $form = $(this),
            url = $form.attr('action');
        /* Send the data using post */
        var data = { femail: $('#friendEmail').val(), fname: $('#friendName').val(),
                    email: $('#myEmail').val(), name: $('#myName').val(),},
            email = $('#email').val();

        if (data.email == "" || data.name == "" || data.femail == "" || data.fname == "") {
            alert("Please complete all fields and resubmit.");
        } else if (!validateEmail(data.email) || !validateEmail(data.femail)) {
            alert("Please enter valid email addresses.")
        } else {
            var emailLink = document.createElement("a"),
                mailto="draisy@gmail.com?subject=" + data.name + " Recommends NY Real Estate Course&body=Hi " + data.fname +", check out www.nyrecourse.com!";
            
            emailLink.setAttribute("href", "mailto:" + mailto);
            emailLink.click();
            $('#friendForm')[0].reset();
        }
    });
    
        $('#contactHiringForm').submit(function (event) {
        /* stop form from submitting normally */
        event.preventDefault();
        $('#loader').show();

        /* get some values from elements on the page: */
        var $form = $(this),
            url = 'send-hiring.php';
        /* Send the data using post */
        var data = {
            name: $('#name').val(),
            email: $('#email').val(),
            position: $('#position').val(),
            location: $('#location').val(),
            experience: $('#experience').val(),
            hire: $('input[name=hire]:checked').val(),
            days: $('#days').val(),
            hours: $('#hours').val(),
            compensation: $('#compensation').val(),
            contact: $('#contact').val(),
            message: $('#contact_message').val()
        },
            email = $('#email').val();

        // if (data.email == "" || data.name == "" || data.message == "") {
        //     alert("Please complete all fields and resubmit.");
        // } else
         if (!validateEmail(data.email)) {
            alert("Please enter a valid email address.")
        } else {
            var posting = $.post(url, data);
            /* Alerts the results */
            posting.done(function (data) {
               $('#loader').hide();
               $('#successResponse').html('Thank you for contacting the NY Real Estate Course. We will reply to ' +
                    email + ' shortly. <br/><div class="small">(If this email is not correct, please resubmit with the correct information.)</div>');
                $('#contactHiringForm')[0].reset();
            });
        }
    });

        $('#pricingForm').submit(function (event) {
        /* stop form from submitting normally */
        event.preventDefault();

        /* get some values from elements on the page: */
        var $form = $(this),
            url = 'send-pricing-form.php';
        /* Send the data using post */
        var data = { 
                email: $('#email').val(), 
                fname: $('#fname').val(),
                lname: $('#lname').val(),
                message: $('#contact_message').val(),
                phone: $('#phone').val()
            },
            email = $('#email').val(); // store for use in successresponse

        if (data.fname == "" || data.lname == "" || data.email == "" || data.phone == "") {
            alert("Please complete required fields and resubmit.");
        } else if (!validateEmail(data.email)) {
            alert("Please enter a valid email address.")
        } else {
            var posting = $.post(url, data);
            /* Alerts the results */
            posting.done(function (data) {
               $('#successResponse').html('Thank you for your request. We will reply to ' +
                    email + ' shortly. <br/><div class="small">(If this email is not correct, please resubmit with the correct information.)</div>');
                $('#pricingForm')[0].reset();
            });
        }
    });
    
})(jQuery);   


