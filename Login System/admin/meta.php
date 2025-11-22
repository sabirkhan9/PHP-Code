<?php
session_start();

// Check login
if(!isset($_SESSION['admin_login'])){
    header("Location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Meta Page</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

<nav class="navbar navbar-dark bg-dark">
  <div class="container-fluid">
    <span class="navbar-brand">Admin Panel</span>
    <a href="logout.php" class="btn btn-danger btn-sm">Logout</a>
  </div>
</nav>

<div class="container mt-5">
    <h2>Welcome, <?php echo $_SESSION['admin_login']; ?> </h2>
    <p>This is a protected page (meta.php).</p>
</div>

</body>
</html>
