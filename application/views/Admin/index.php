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

</head>

<body>
    <?php  include 'header.php'; ?>


    <section id="dashboard">
        <div class="row">
            <div class="card text-center col-lg-4 infocard shadow-lg p-4 mb-5 bg-white rounded">
                <div class="card-header">
                    <h5 class="card-title">Total User</h5>
                </div>
                <div class="card-body">

                    <p class="card-text"><?php echo $all_users ?></p>

                </div>
                <div class="card-footer">
                    <h5 class="card-title"><a href="<?php echo base_url('Admin/Users/allUsers/')?>" style="color: black;"><i class="fas fa-eye" style="color: #ff4c68;"></i></a></h5>

                </div>

            </div>
            <div class="card text-center col-lg-4 infocard  shadow-lg p-3 mb-5 bg-white rounded">
                <div class="card-header">
                    <h5 class="card-title">Total verified User</h5>
                </div>
                <div class="card-body">

                    <p class="card-text"><?php echo $active_users?></p>

                </div>
                <div class="card-footer">
                    <h5 class="card-title"><a href="<?php echo base_url('Admin/Users/activeUsers')?>" style="color: black;"><i class="fas fa-eye" style="color: #ff4c68;"></i></a></h5>

                </div>

            </div>
            <div class="card text-center col-lg-4 infocard  shadow-lg p-3 mb-5 bg-white rounded">
                <div class="card-header">
                    <h5 class="card-title">Total unverified User</h5>
                </div>
                <div class="card-body">

                    <p class="card-text"><?php echo $inactive_users?></p>

                </div>
                <div class="card-footer">
                    <h5 class="card-title"><a href="<?php echo base_url('Admin/Users/inactiveUsers')?>" style="color: black;"><i class="fas fa-eye" style="color: #ff4c68;"></i></a></h5>

                </div>

            </div>
            <div class="card text-center col-lg-4 infocard  shadow-lg p-3 mb-5 bg-white rounded">
                <div class="card-header">
                    <h5 class="card-title">Account Reactivation Requests</h5>
                </div>
                <div class="card-body">

                    <p class="card-text"><?php echo $reactivate?></p>

                </div>
                <div class="card-footer">
                    <h5 class="card-title"><a href="<?php echo base_url('Admin/Users/requestAccount')?>" style="color: black;"><i class="fas fa-eye" style="color: #ff4c68;"></i></a></h5>

                </div>

            </div>
            <div class="card text-center col-lg-4 infocard  shadow-lg p-3 mb-5 bg-white rounded">
                <div class="card-header">
                    <h5 class="card-title">Total Contact Received</h5>
                </div>
                <div class="card-body">

                    <p class="card-text"><?php echo $contacts?></p>

                </div>
                <div class="card-footer">
                    <h5 class="card-title"><a href="<?php echo base_url('Admin/Users/userContact')?>" style="color: black;"><i class="fas fa-eye" style="color: #ff4c68;"></i></a></h5>

                </div>

            </div>
            <div class="card text-center col-lg-4 infocard  shadow-lg p-3 mb-5 bg-white rounded">
                <div class="card-header">
                    <h5 class="card-title">Total Feedbacks</h5>
                </div>
                <div class="card-body">

                    <p class="card-text"><?php echo $feedbacks?></p>

                </div>
                <div class="card-footer">
                    <h5 class="card-title"><a href="<?php echo base_url('Admin/Users/userFeedbacks')?>" style="color: black;"><i class="fas fa-eye" style="color: #ff4c68;"></i></a></h5>

                </div>

            </div>
        </div>
    </section>

    <footer id="footer" style="background-color:#ff4c68; color:#fff">
        <i class="social-icon fab fa-facebook"></i>
        <i class="social-icon fab fa-twitter"></i>
        <i class="social-icon fab fa-instagram"></i>
        <i class="social-icon fas fa-envelope"></i>
        <p>© Copyright 2021 SaveNotes</p>

    </footer>
</body>
<script src="<?php echo base_url('assets/js/sweetalert.js') ?>"></script>


<?php
if ($msg = $this->session->flashdata('login') or $msg = $this->session->flashdata('note')) {
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