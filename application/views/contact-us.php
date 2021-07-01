<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SaveNotes</title>
    <!--Bootsrap -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Goblin+One&family=Slabo+27px&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css"
        integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/style.css')?>">

    <!--Font awesome-->
    <script src="https://kit.fontawesome.com/13bc66d938.js" crossorigin="anonymous"></script>
    <!--Scripts-->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous">
    </script>
</head>

<body>
            <?php include('header1.php'); ?>
            <div class="row">
                <div class="login-heading col-lg">
                    <h1><i class="fa fa-user-circle-o"></i>&nbsp Contact-us...</h1>
                </div>
            </div>
        </div>

    </section>
    <section id="login" >
        <form action="<?php echo base_url('ContactUs/contactProcess')?>" method="post">
            <div class="form-group">
                
              <label for="exampleInputEmail1">Email address</label>
              <input name="email" type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
              <small id="emailHelp" class="info form-text error-msg"><?php echo form_error('email'); ?></small>
              
            </div>
            <div class="form-group">
                <label for="exampleFormControlTextarea1">Message</label>
                <textarea name="message" placeholder="Enter Your Message" class="form-control" id="exampleFormControlTextarea1" rows="6"></textarea>
                <label class="error-msg"><?php echo form_error('message'); ?></label><br>
              </div>
            
            <button type="submit" class=" btn btn-primary btn-lg">Submit</button>
          </form>
    </section>
    
    
    <?php include('footer.php');?> 
</body>
<script src="<?php echo base_url('assets/js/sweetalert.js')?>"></script>
<script src="<?php echo base_url('assets/js/custom.js') ?>"></script>
    <?php
    if($msg=$this->session->flashdata('contact'))
    {
    ?>
    <script type="text/javascript">
      swal({
      title: "<?php echo $msg['title']?>",
      text: "<?php echo $msg['msg']?>",
      icon: "<?php echo $msg['status']?>",
    });
    </script>
    <?php  
    }
    ?>
</html>