<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SaveNotes</title>
    <!--Bootsrap -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Goblin+One&family=Slabo+27px&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/style.css'); ?>">

    <!--Font awesome-->
    <script src="https://kit.fontawesome.com/13bc66d938.js" crossorigin="anonymous"></script>
    <!--Scripts-->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous">
    </script>
</head>

<body>
    <?php include('header1.php'); ?>
    <div class="row">
        <div class="login-heading col-lg">
            <h1><i class="fa fa-user-circle-o"></i>&nbsp Signup...</h1>
        </div>
    </div>
    </div>

    </section>
    <section id="login">

        <form id="form_id" action="<?php echo base_url('Signup/SignupProcess') ?>" method="post">
            <div class="form-group" style="text-align: center;">
                <label>Create Your Account</label>
            </div>
            <div class="form-group">
                <label>Name</label>

                <input name="username" type="text" class="form-control" id="exampleInputEmail1" value="<?php echo set_value('username'); ?>" placeholder="Enter name">
                <label class="error-msg"><?php echo form_error('username'); ?></label><br>



                <label>Email </label>
                <input name="email" type="email" value="<?php echo set_value('email'); ?>" class="form-control" id="" aria-describedby="emailHelp" placeholder="Enter email">

                <label class="error-msg">

                    <?php

                    echo form_error('email');
                    ?></label><br>

            </div>
            <div class="form-group">
                <label>Password</label>
                <input name="password" type="password" value="<?php echo set_value('password'); ?>" class="form-control" id="password" placeholder="Password">
                <label id="pswerror" class="error-msg"><?php echo form_error('password'); ?></label><br>
            </div>
            <div class="form-group">
                <label>Confirm Password</label>
                <input name="passconf" type="password" value="<?php echo set_value('passconf'); ?>" class="form-control" placeholder="Password">
                <label class="error-msg"><?php echo form_error('passconf'); ?></label><br>
            </div>

            <button type="submit" class=" btn btn-primary btn-lg">Submit</button>
        </form>
    </section>

    <?php include('footer.php'); ?>
</body>

</html>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="<?php echo base_url('assets/js/custom.js') ?>"></script>
<script>
    $(document).ready(function() {

        $("#password").focusout(function() {
            var psw = $("#password").val();
            $.ajax({
                type: "POST",
                url: "<?php echo base_url('Signup/passwordValidation'); ?>",
                data: {
                    psw: psw
                },
                success: function(response) {
                    if (response == "fail") {
                        $("#pswerror").text("Password must include at least 1 lowercase character, 1 uppercase characters, 1 number, and 1 special character in (!@#$%^&*)");
                        $(":submit").attr("disabled", true);
                    }
                    else if(response == "success"){
                        $(":submit").removeAttr("disabled");  
                        $("#pswerror").text("");
                       
                    }

                }

            });
        });
    });
</script>