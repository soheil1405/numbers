<script>
    function sendForgotPassCode() {


        var mobile = $('#number').val();

        $('#type').val('forgot');


        formDate = {
            'number': mobile
        };

        $.ajax({

            type: "POST",
            url: "/checkNumber",
            data: formDate,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(data) {


                $('#loginForm').submit();


            },
            error: function(data) {

                console.log(data);

                $('#shomareAjax').html('شماره وارد شده معتبر نیست');

            }

        });




    }



</script>
