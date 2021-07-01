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
    <link rel="stylesheet" href="<?php echo base_url('assets/css/style.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/loader.css'); ?>">
    <style>
        .container-fluid {
            padding: 3% 15% 1%;

        }
    </style>

</head>

<body>

    <?php include('header2.php') ?>
    <div id="spiner" class="spinner" style="display: none;">
        <div class="rect1"></div>
        <div class="rect2"></div>
        <div class="rect3"></div>
        <div class="rect4"></div>
        <div class="rect5"></div>
    </div>
    <section id="notes">

        <h1 class="notes-heading">Your Notes</h1>

        <?php if (!empty($notes)) { ?>
            <button type="button" class="btn btn-dark btn-lg heading-button"><i class="far fa-plus-square"></i>
                &nbsp<a href="<?php echo base_url('Notes/addNotes') ?>" style="color: #fff;">Add Notes</a></button>
            <button type="button" class="btn btn-dark btn-lg heading-button"><i class="fa fa-download"></i>
                &nbsp<a href="<?php echo base_url('Notes/downloadNotes') ?>" style="color: #fff;">Download All Notes</a></button>
        <?php } ?>

        <div class="row">

            <?php if (!empty($notes)) {

                foreach ($notes as $nt) {

            ?>
                    <div class="col-lg-4 col-md-6 data" style="display: flex;">
                        <div class="card" style="width: 18rem;">
                            <div class="card-body">
                                <h5 class="card-title"><b><?php echo $this->encrypt->decode($nt->title) ?></b></h5>
                                <p class="card-text"><?php echo $this->encrypt->decode($nt->note) ?>
                                </p>

                            </div>
                            <div class="card-footer">
                                <a href="<?php echo base_url('Notes/updateNotes/') . $nt->note_id ?>"><i class="action fa fa-edit"> Edit</i></a>
                                <a href="<?php echo base_url('Notes/deleteNotes/') . $nt->note_id ?>"><i class="action fa fa-trash"> Delete</i></a>
                                 <a href="<?php echo base_url('Notes/downloadNotes/') . $nt->note_id ?>"><i class="action fa fa-download"> Download</i></a>
                            </div>
                        </div>
                    </div>
                <?php }
            } else {
                ?>
                <div class="col-lg-12" style="margin-top:12px;">
                    <div class="card  mobile-div">
                        <div class="card-body" style="text-align: center;">

                            <p class="card-text">No Notes Found</p>
                            </p>
                            <a href="<?php echo base_url('Notes/addNotes') ?>"><i class="action fa fa-plus"> Add Notes</i></a>

                        </div>
                    </div>
                </div>
            <?php
            }
            ?>


        </div>
    </section>

    <?php include('footer.php'); ?>

    </footer>
</body>


</html>

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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="<?php echo base_url('assets/js/custom.js') ?>"></script>
<script>
    function delteAllNotes() {
    $("#spiner").css("display", "block");
    $.ajax({

        url: "<?php echo base_url('Settings/DeleteAllNotes'); ?>",

        success: function(response) {
            $("#spiner").css("display", "none");
            if(response == "fail")
            {
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
function deleteAccount()
{
    $("#spiner").css("display", "block");
    $.ajax({

        url: "<?php echo base_url('Settings/DeleteAccount'); ?>",

        success: function(response) {
            $("#spiner").css("display", "none");
            if(response == "fail")
            {
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