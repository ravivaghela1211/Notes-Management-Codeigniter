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


    <!--Font awesome-->
    <script src="https://kit.fontawesome.com/13bc66d938.js" crossorigin="anonymous"></script>
    <!--Scripts-->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous">
    </script>
    <link rel="stylesheet" href="<?php echo base_url('assets/css/style.css') ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/loader.css'); ?>">
    <style>
        .container-fluid {
            padding: 3% 15% 1%;

        }
    </style>
</head>

<body>
    <?php include('header2.php'); ?>
    <div id="spiner" class="spinner" style="display: none;">
        <div class="rect1"></div>
        <div class="rect2"></div>
        <div class="rect3"></div>
        <div class="rect4"></div>
        <div class="rect5"></div>
    </div>
    </div>
    </div>
    </section>
    <section id="login">

        <h3 style="color:black; text-align:center;padding-bottom:20px;">Reset Password</h3>

        <form class="form-class" action="<?php echo base_url('Settings/ResetPasswordProcess'); ?>" method="post">
            <?php if ($this->session->flashdata('verify')) { ?>
                <div class="form-group">
                    <label class="" style="font-size: 20px; color:green"><?php echo  $this->session->flashdata('verify') ?></label>
                </div>
            <?php } ?>
            <?php if ($this->session->flashdata('forgot_psw')) { ?>
                <div class="form-group">
                    <label class="error-msg" style="font-size: 20px;"><?php echo  $this->session->flashdata('login') ?></label>
                </div>
            <?php } ?>
            <div class="form-group">
                <label for="exampleInputEmail1">Current Password</label>
                <input name="current_psw" type="password" class="form-control" value="<?php echo set_value('current_psw'); ?>" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Current password" required>
                <label class="error-msg">
                    <?php echo form_error('current_psw') ?></label>
                <br>
                <label for="exampleInputEmail1">Create Password</label>
                <input id="newpassword" name="create_psw" type="password" class="form-control" id="exampleInputEmail1" value="<?php echo set_value('create_psw'); ?>" aria-describedby="emailHelp" placeholder="Create a password" required>
                <label class="error-msg" id="pswerror">
                    <?php echo form_error('create_psw') ?></label><br>
                <label for="exampleInputEmail1">Confirm New Password</label>
                <input name="confirm_psw" type="password" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Confirm new password" required>
                <label class="error-msg">
                    <?php echo form_error('confirm_psw') ?></label><br>

            </div>

            <label class="error-msg">

                <?php

                echo form_error('email');
                ?></label><br>
            <button type="submit" class=" btn btn-primary btn-lg">Reset Password</button>
        </form>
    </section>

    <?php include('footer.php'); ?>
</body>

</html>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="<?php echo base_url('assets/js/custom.js') ?>"></script>
<script>
    function delteAllNotes() {
        $("#spiner").css("display", "block");
        $.ajax({

            url: "<?php echo base_url('Settings/DeleteAllNotes'); ?>",

            success: function(response) {
                $("#spiner").css("display", "none");
                if (response == "fail") {
                    alert('Something wrong plz try again later');
                }
                if (response == "success") {

                    $(location).attr('href', '<?php echo base_url() ?>Settings/DeleteAllNotesView');
                    // $("#error_msg").html(response);
                } else {
                    $(location).attr('href', '<?php echo base_url() ?>Home/Login');
                }
            }


        });
    }

    function deleteAccount() {
        $("#spiner").css("display", "block");
        $.ajax({

            url: "<?php echo base_url('Settings/DeleteAccount'); ?>",

            success: function(response) {
                $("#spiner").css("display", "none");
                if (response == "fail") {
                    alert('Something wrong plz try again later');
                }
                if (response == "success") {

                    $(location).attr('href', '<?php echo base_url() ?>Settings/DeleteAccountView');
                    // $("#error_msg").html(response);
                } else {
                    $(location).attr('href', '<?php echo base_url() ?>Home/Login');
                }
            }


        });
    }
</script>
<script>
    $(document).ready(function() {

        $("#newpassword").focusout(function() {
            var psw = $("#newpassword").val();
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
                    } else if (response == "success") {
                        $(":submit").removeAttr("disabled");
                        $("#pswerror").text("");

                    }

                }

            });
        });
    });
</script>