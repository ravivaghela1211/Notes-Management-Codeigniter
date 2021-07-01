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
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
    <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
    <link rel="stylesheet" href="<?php echo base_url('assets/css/style.css') ?>">

</head>

<body>
   

    <?php
     include 'header.php';
    if (isset($inactiveUsers)) {
        if ($inactiveUsers != null) {
    ?>

            <section id="user-table">
                <h2 style="color: #000; text-align: center; margin-bottom: 30px;"><u>Unverified Users</u> </h2>
                <table class="table table-striped" id="mytable">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Username</th>
                            <th scope="col">Email</th>
 
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = 0;
                        foreach ($inactiveUsers as $user) {
                            $i++;
                        ?>
                            <tr>
                                <th scope="row"><?php echo $i ?></th>
                                <td><?php echo $user->username ?></td>
                                <td><?php echo $user->email ?></td>
        
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
            </section>
    <?php
        } else {
            echo "<h2>No User Found</h2>";
        }
    } ?>
   

    <footer id="footer" style="background-color:#ff4c68; color:#fff">
        <i class="social-icon fab fa-facebook"></i>
        <i class="social-icon fab fa-twitter"></i>
        <i class="social-icon fab fa-instagram"></i>
        <i class="social-icon fas fa-envelope"></i>
        <p>© Copyright 2021 SaveNotes</p>

    </footer>
</body>



<?php
if ($msg = $this->session->flashdata('login') or $msg = $this->session->flashdata('note')) {
?>
<script src="<?php echo base_url('assets/js/sweetalert.js') ?>"></script>
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

<script>
  $(document).ready(function() {
    $('#mytable').DataTable({
      "pagingType": "full_numbers"
    });
  });
</script>