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
    <!--jquery ui animation library css-->
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/smoothness/jquery-ui.css">
    
</head>

<body>

    <?php include('header1.php'); ?>
    <div class="row">
        <div class="login-heading col-lg">
            <h1><i class="fa fa-external-link"></i>&nbsp Login to continue...</h1>
        </div>
    </div>
    </div>
    </section>
   
    <section id="login">

        <div id="errorforlogin" class="alert alert-danger" role="alert" style="display:none">

        </div>
        <form id="loginform" class="form-class" method="post">
            <?php if ($this->session->flashdata('verify')) { ?>
                <div class="alert alert-success" role="alert">
                    <?php echo $this->session->flashdata('verify'); ?>
                </div>
            <?php } ?>


            <div class="form-group">
                <label for="exampleInputEmail1">Email address</label>
                <input name="email" type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
                <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
            </div>
            <div class="form-group">

                <label for="exampleInputPassword1">Password</label>
                <input name="password" type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">

                <small id="forgotpassword" class="info form-text text-muted"><a href="<?php echo base_url('Home/ForgotPassword'); ?>">Forgot Password</a></small>
                <small id="signup-link" class="info form-text text-muted">SaveNotes Account is blocked?<a href="<?php echo base_url('Settings/ReactivateAccountView') ?>"> Request to reactivate Your account.</a></small>
                <small id="signup-link" class="info form-text text-muted">New to SaveNotes?<a href="<?php echo base_url('Home/SignUp') ?>"> Create an account.</a></small>
            </div>

            <button type="submit" class=" btn btn-primary btn-lg">Submit</button>
        </form>
    </section>

    <?php include('footer.php'); ?>
</body>
<script src="<?php echo base_url('assets/js/sweetalert.js') ?>"></script>


<?php
if ($msg = $this->session->flashdata('login')) {
?>

</html>


<script type="text/javascript">
    swal({
        title: "<?php echo $msg['title'] ?>",
        text: "<?php echo $msg['msg'] ?>",
        icon: "<?php echo $msg['status'] ?>",
    });
</script>
<?php
}
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<!--jquery ui library-->
<script src="//code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="<?php echo base_url('assets/js/custom.js') ?>"></script>
<script type="text/javascript">
   
    $(function() {
        
        $("#loginform").submit(function() {
           
            data = $("#loginform").serialize();

            $.ajax({
                type: "POST",
                url: "<?php echo base_url('Login'); ?>",
                data: data,
                success: function(response) {
                    
                    if (response == "sucess") {

                        $(location).attr('href', '<?php echo base_url() ?>Notes');
                        // $("#error_msg").html(response);
                    } else {
                        $("#errorforlogin").css("display", "block");
                        $("#errorforlogin").html(response);
                        $("#errorforlogin").effect( "shake" );
                    }

                }

            });

            return false; //stop the actual form post !important!

        });
    });
</script>

</html>