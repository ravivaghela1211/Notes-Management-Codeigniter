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
        <link rel="stylesheet" href="<?php echo base_url('assets/css/style.css'); ?>">
        <link rel="stylesheet" href="<?php echo base_url('assets/css/loader.css'); ?>">
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
    <?php include('header2.php')?>
    <div id="spiner" class="spinner" style="display: none;">
        <div class="rect1"></div>
        <div class="rect2"></div>
        <div class="rect3"></div>
        <div class="rect4"></div>
        <div class="rect5"></div>
    </div>
    <section id="login" >
        <form action="<?php echo base_url('Notes/updateNotesProcess')?>" method="post">
            <div class="form-group">
              
              <input type="hidden" name="note_id" value="<?php echo $notes[0]->note_id?>">
              
              <label for="exampleInputEmail1">Notes Title</label>
              <input name="note_title" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Write Your Notes Title here..." value="<?php echo $this->encrypt->decode($notes[0]->title)?>">
              
            </div>
            <div class="form-group">
                <label for="exampleFormControlTextarea1">Notes</label>
                <textarea name="note_body" placeholder="Write Your Notes here..." class="form-control" id="exampleFormControlTextarea1" rows="3" ><?php echo $this->encrypt->decode($notes[0]->note)?></textarea>
              </div>
            
            <button type="submit" class=" btn btn-primary btn-lg">Update Note</button>
          </form>
    </section>
    
    <?php include('footer.php');?> 
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