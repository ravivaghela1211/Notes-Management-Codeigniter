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
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

  <!--data table jquery-->



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
  <section id="user-table">
    <h2 style="color: #000; text-align: center; margin-bottom: 30px;">Your Account Login History</h2>
    <table class="table table-striped" id="mytable">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">Browser and Version Name</th>
          <th scope="col">Platform</th>
          <th scope="col">Login Time</th>
          <th scope="col">Logout Time</th>

          <th scope="col">Login Status</th>
          <th scope="col">Delete Login History</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $i = 0;
        foreach ($log_history as $log) {
          $i++;
        ?>
          <tr>
            <th scope="row"><?php echo $i ?></th>
            <td><?php echo $log->browser_name ?></td>
            <td><?php echo $log->platform_name ?></td>
            <td><?php echo $log->login_time ?></td>
            <td><?php
                if ($log->logout_time != null) {
                  echo $log->logout_time;
                } else {
                  echo "-----";
                }
                ?></td>
            <td><?php echo $log->status ?></td>
            <td><a href="<?php echo base_url('Settings/DeleteLoginHistory/') . $log->history_id ?>"><i class="delete-user fa fa-trash-o" style="font-size: 20px; color:red;"></i></a></td>
          </tr>
        <?php
        }
        ?>
      </tbody>
    </table>
  </section>
  
  <?php include('footer.php'); ?>
</body>

</html>
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
  <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
  <script src="<?php echo base_url('assets/js/custom.js') ?>"></script>
<script>
  $(document).ready(function() {
    $('#mytable').DataTable({
      "pagingType": "full_numbers"
    });
  });
</script>

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