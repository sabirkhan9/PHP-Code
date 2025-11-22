<?php
include "db.php";

$result = mysqli_query($conn, "SELECT * FROM blogs ORDER BY id DESC");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Blog Listing</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container py-5">
    <h1 class="mb-4">Blogs</h1>

    <div class="row">
        <?php while($row = mysqli_fetch_assoc($result)) { ?>
        
        <div class="col-md-4 mb-4">
            <div class="card shadow-sm">
                <img src="uploads/<?php echo $row['featured_image']; ?>" 
                     class="card-img-top" 
                     style="height:250px; object-fit:cover;">
                
                <div class="card-body">
                    <h5><?php echo $row['title']; ?></h5>

                    <a href="blog-details/<?php echo $row['slug']; ?>" class="btn btn-primary mt-3">
                        View Details
                    </a>
                </div>
            </div>
        </div>

        <?php } ?>
    </div>
</div>

</body>
</html>
