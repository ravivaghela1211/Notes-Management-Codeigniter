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
        <div class="col-lg-6">
            <h1>Create Your Notes </h1>

            <button type="button" class="btn btn-dark btn-lg heading-button"><i class="fa fa-external-link"></i>
                &nbsp<a href="<?php echo base_url('Home/Login') ?>" style="color: #fff;">Login</a></button>


            <button type="button" class="btn btn-outline-light btn-lg heading-button"><i class="fa fa-user-circle-o"></i>&nbsp
                <a href="<?php echo base_url('Home/SignUp') ?>" style="color: black;">Signin </a></button>


        </div>
        <div class="title-image-div col-lg-6">
            <img class="title-image" src="<?php echo base_url('assets/images/title.png'); ?>" alt="note-image">
        </div>
    </div>
    </div>

    </section>
    <!-- Button trigger modal -->


    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Feedback</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="loginform" class="form-class" method="post" action="<?php echo base_url('Feedback'); ?>">
                         <div class="form-group">

                            <label for="exampleInputPassword1">Name</label>
                            <input type="text" name="name" class="form-control" minlength="2" required>
                            
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Email address</label>
                            <input name="email" type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email"  pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" required>
                            <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                        </div>
                        <div class="form-group">

                            <label for="exampleInputPassword1">Feedback</label>
                            <textarea name ="feedback" class="form-control" required></textarea>
                            
                        </div>  
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Submit Feedback</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <section id="features">
        <div class="row">
            <div class="feature-box col-lg-4">
                <i class="icon far fa-sticky-note fa-4x"></i>
                <h3>Easy to use.</h3>
                <p>So easy to create notes.</p>
            </div>

            <div class="feature-box col-lg-4">
                <i class="icon fas fa-lock fa-4x"></i>
                <h3>Secure</h3>
                <p>Your All Data Is Secure.</p>
            </div>

            <div class="feature-box col-lg-4">
                <i class="icon fas fa-universal-access fa-4x"></i>
                <h3>Access Any Way</h3>
                <p>Acess Your Notes in Mobile,Tablets,Laptop,PC.</p>
            </div>
        </div>
    </section>
    <section id="review">

        <div id="review-carousel" class="carousel slide" data-ride="false">
            <div class="carousel-inner">
                <?php
                if(isset($feedbacks)){
                $counter = 0;
                foreach ($feedbacks as $feedback) {
                $counter++;
                if($counter === 1)
                {
                    $class = "active";
                }
                else{
                   $class =""; 
                }
                ?>
                <div class="carousel-item <?php echo $class?>">
                    <h3><?php echo $feedback->feedback?>
                    </h3>

                    <em class="user-name"><?php echo $feedback->name?></em>
                </div>
               
                <?php
                }
                }
                ?>
            </div>
            <a class="carousel-control-prev" href="#review-carousel" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon"></span>

            </a>
            <a class="carousel-control-next" href="#review-carousel" role="button" data-slide="next">
                <span class="carousel-control-next-icon"></span>

            </a>
        </div>
    </section>
    <?php include('footer.php'); ?>
</body>


<script src="<?php echo base_url('assets/js/sweetalert.js') ?>"></script>
<script src="<?php echo base_url('assets/js/custom.js') ?>"></script>



<?php
if ($msg = $this->session->flashdata('acccount_deleted') or $msg = $this->session->flashdata('feedback') ) {
    
?>
    
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




</html>