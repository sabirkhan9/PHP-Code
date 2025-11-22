<?php
include "db.php";

// Check slug
if (!isset($_GET['slug'])) {
    echo "Invalid URL!";
    exit;
}

$slug = $_GET['slug'];

$sql = "SELECT * FROM blogs WHERE slug='$slug'";
$res = mysqli_query($conn, $sql);

if (mysqli_num_rows($res) == 0) {
    echo "Blog Not Found!";
    exit;
}

$row = mysqli_fetch_assoc($res);
?>

<!DOCTYPE html>
<html>
<head>
    <title><?php echo $row['title']; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container py-5">

    <h1 class="fw-bold"><?php echo $row['title']; ?></h1>
    <p class="text-muted mb-3"><?php echo date("d M Y", strtotime($row['created_at'] ?? date("Y-m-d"))); ?></p>

    <img src="../uploads/<?php echo $row['featured_image']; ?>"
         class="img-fluid rounded mb-4"
         style="max-height:420px; width:100%; object-fit:cover;">

    <div style="font-size:18px; line-height:1.8;">
        <?php echo $row['description']; ?>
    </div>

</div>

</body>
</html>
