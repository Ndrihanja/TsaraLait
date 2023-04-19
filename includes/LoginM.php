<?php
    session_start();
    include_once 'Database.php';
    $db = new Database();
    if(isset($_POST['login_btn'])){
        $username = $_POST['username'];
        $password = sha1($_POST['password']);

        $sql = "SELECT * FROM user WHERE username = '$username' AND password = '$password' LIMIT 1";
        $stmt = $db->conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if($result) {

            foreach($result as $data){
                $user_id = $data['id_use'];
                $usename = $data['username'];
                $pass = $data['password'];
            }
            $_SESSION['auth'] = true;
            $_SESSION['auth_user'] = [
                'user_id' => $user_id,
                'user_name' => $usename,
            ];

            $_SESSION['message'] = "Tongasoa eto amin'ny Appli TsaraLait";
            header("Location: http://localhost/modal/Controller.php?r=Acceuil");
        }
        else{
            $_SESSION['message'] = "Invalid Username or Password";
            header("Location: http://localhost/modal/Login.php");
        }
    }
    else
    {
        $_SESSION['message'] = "Probleme be namana!";
        header("Location: http://localhost/modal/Login.php");
        exit(0);
    }