<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
* {
  box-sizing: border-box;
}

body {
  font-family: Arial, Helvetica, sans-serif;
}

/* Float four columns side by side */
.column {
  float: left;
  width: 100%;
  padding: 0 10px;
}

/* Remove extra left and right margins, due to padding */
.row {margin: 0 -5px;}

/* Clear floats after the columns */
.row:after {
  content: "";
  display: table;
  clear: both;
}

/* Responsive columns */
@media screen and (max-width: 600px) {
  .column {
    width: 100%;
    display: block;
    margin-bottom: 20px;
  }
}

/* Style the counter cards */
.card {
  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
  margin-top: 20px;
  padding: 16px;
  text-align: center;
  background-color: #f1f1f1;
}

</style>
</head>
<body>
<h6 style="margin-left: 500px; margin-top: -1;"><?php echo date("Y-m-d")."  ".date("h:i:sa");?></h6>

<h2 style="text-align:center;">Your Notes </h2>

 
<div class="row">
   <?php if (!empty($notes)) {

  foreach ($notes as $nt) {?>
  <div class="column">
    <div class="card">
      <h3><?php echo $this->encrypt->decode($nt->title) ?></h3>
      <p><?php echo $this->encrypt->decode($nt->note) ?></p>
      
    </div>
  </div>
<?php } }  ?>

</div>

</body>
</html>