<?php
session_start();
include "db.php";

$message = "";

if(isset($_POST['login'])){

    $username = $_POST['username'];
    $password = $_POST['password'];

    // DB se username check
    $sql = "SELECT * FROM admin_users WHERE username='$username' LIMIT 1";
    $res = mysqli_query($conn, $sql);

    if(mysqli_num_rows($res) > 0){

        $row = mysqli_fetch_assoc($res);

        // Direct password match (no hashing)
        if($password == $row['password']){
            $_SESSION['admin_login'] = $row['username'];
            header("Location: meta.php");
            exit;
        } else {
            $message = "❌ Wrong Password!";
        }

    } else {
        $message = "❌ Username Not Found!";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body{ background:#f1f1f1; }
        .login-box{
            max-width:420px;
            margin:100px auto;
            padding:30px;
            background:white;
            border-radius:8px;
            box-shadow:0 0 20px rgba(0,0,0,0.1);
        }
    </style>
</head>
<body>

<div class="login-box">
    <h2 class="text-center">Admin Login</h2>

    <?php if($message != ""){ ?>
        <div class="alert alert-danger text-center"><?php echo $message; ?></div>
    <?php } ?>

    <form method="POST">
        <div class="mb-3">
            <label>Username</label>
            <input type="text" name="username" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Password</label>
            <input type="password" name="password" class="form-control" required>
        </div>

        <button name="login" class="btn btn-primary w-100">Login</button>
    </form>
</div>

</body>
</html>
