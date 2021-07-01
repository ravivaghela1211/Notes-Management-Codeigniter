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

        .spinner {
            margin: 30px auto;
            width: 100px;
            height: 100px;
            text-align: center;

            font-size: 30px;

        }
    </style>
</head>

<body>
    <?php include('header1.php'); ?>

    </div>
    </div>
    </section>
    <div id="spiner" class="spinner" style="display: none;">
        <div class="rect1"></div>
        <div class="rect2"></div>
        <div class="rect3"></div>
        <div class="rect4"></div>
        <div class="rect5"></div>
        
    </div>
    <section id="login">

        <h3 style="color:black; text-align:center;padding-bottom:20px;">Forgot Password</h3>

        <form id="loginform" class="form-class" method="post">


            <div id="successmsg" class="alert alert-success" role="alert" style="display:none;">

            </div>

            <div class="form-group">
                <label for="exampleInputEmail1">Email address</label>
                <input name="email" type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter your email to retrieve your password" required>
                <small id="emailHelp" class="form-text text-muted">We'll send your password to your email.</small>
            </div>

            <label class="error-msg" id="errormsg"></label><br>


            <button type="submit" class=" btn btn-primary btn-lg">Forgot Password</button>
        </form>
    </section>

    <?php include('footer.php'); ?>
</body>

</html>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="<?php echo base_url('assets/js/custom.js') ?>"></script>
<script type="text/javascript">
   
    
    $(function() {

        $("#loginform").submit(function() {
            $("#spiner").css("display", "block");
            data = $("#loginform").serialize();

            $.ajax({
                type: "POST",
                url: "<?php echo base_url('Login/forgotPassword'); ?>",
                data: data,
                success: function(response) {
                    $("#spiner").css("display", "none");
                    if (response == "emailnotvalid") {
                        $('#errormsg').text('Email not exists in our database');
                    } else if (response == "success") {
                        $('#successmsg').css('display', 'block');
                        $('#successmsg').text('We Have Send Your Password to your email');
                        // $("#error_msg").html(response);
                    } else {
                        alert('something wrong... please try again later');
                    }

                }

            });

            return false; //stop the actual form post !important!

        });
    });
</script>