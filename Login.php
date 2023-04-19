<?php 
session_start();

if(isset($_SESSION['auth']))
{
    $_SESSION['message'] = "You already logged in";
    header("Location: http://localhost/modal/Controller.php?r=Acceuil");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/bootstrap-utilities.css">
    <title>Document</title>
</head>
<body>

    
            <div class="card log-card">
                <div class="card-header cdx" style="color:blue; text-align:center;"><h1>Login</h1></div>
                <div class="card-body bodyx">
                    <form action="includes/LoginM.php" method="post">
                        <div class="form-group mb-3">
                            <label for="">Username</label>
                            <input type="text" class ="use" name="username" placeholder="Entrer le nom de l'utilisateur">
                        </div>
                        <div class="form-group mb-3">
                            <label for="">Passeword</label>
                            <input type="password" class ="pass" name="password" placeholder="Entrer le mot de passe de l'utilisateur">
                        </div>
                        <div class="mb-3 bout">
                            <button type="submit" name="login_btn" class="btnx">Se Connecté</button>
                        </div>
                    </form>

                </div>
            </div>

</body>
</html>