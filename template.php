<?php include_once 'authentification.php'; ?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/bootstrap-utilities.css">
    <title>TsaraLait</title>
  </head>
  <body>
    <div class="container-fluide ct">
        <div class="cnt row">
            <?php include_once('sidebar.php'); ?>
            <?php include_once('navb.php'); ?>
            <div class="col-12 ctnt">
                <?php echo $view_in; ?>
            </div>
        </div>
    </div>
    
        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        
    <script src="js/jquery.min.js"></script>
    <script src="js/circle-progress.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/Chart.js"></script>
    <script src="js/default.js"></script>
    <script src="js/all.js"></script>

    
    <div class="alert alert-success text-center message" role="alert" style="width:250px !important;display: none !important; position:fixed; top:50%; left:40%; background-color:white !important; box-shadow: 0 0 1rem rgba(0, 0, 0, 0.12) !important;">
    </div>

    </body>
    <script>
        $(document).ready(function(){
            //$('#overlay').fadeIn().delay(2000).fadeOut();
        });

    </script>

</html>
