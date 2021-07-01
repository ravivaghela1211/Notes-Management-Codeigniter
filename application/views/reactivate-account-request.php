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
    
    <section id="login">

        <h3 style="color:black; text-align:center;padding-bottom:20px;">Request To Reactivate Account</h3>

        <form id="loginform" class="form-class" method="post">


            <div id="successmsg" class="alert alert-success" role="alert" style="display:none;">

            </div>
            <div id="errormsg" class="alert alert-danger" role="alert" style="display:none;">

            </div>

            <div class="form-group">
                <label for="exampleInputEmail1">Email address</label>
                <input name="email" type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter your email to reactivate your account" required>
                <small id="emailHelp" class="form-text text-muted">We'll send your account notification to your email.</small>
            </div>

            


            <button type="submit" class=" btn btn-primary btn-lg">Request</button>
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
           
            data = $("#loginform").serialize();

            $.ajax({
                type: "POST",
                url: "<?php echo base_url('Settings/ReactivateAccount'); ?>",
                data: data,
                success: function(response) {
                    
                    if(response == "yes")
                    {
                        $('#successmsg').css('display','block');
                      
                        $('#successmsg').text('Your Account reactivation request is received . Your Account is reactivate soon as posible');  
                    }
                    else if(response == "notblock")
                    {
                        $('#successmsg').css('display','block');
                      
                        $('#successmsg').text('Your Account is not block..!!');  
                    }
                    else if(response == "acc_not_exists")
                    {
                        $('#errormsg').css('display','block');
                      
                       
                        $("#errormsg").text('Account not available on this email!!!');
                    }
                    else if(response == "pending")
                    {
                        $('#successmsg').css('display','block');
                      
                      $('#successmsg').text('Your Request in pending we will reactive Your account soon as possible');  
                    }
                    else{
                        alert('something is wrong please try again later');
                    }
                    
                }

            });

            return false; //stop the actual form post !important!

        });
    });
</script>