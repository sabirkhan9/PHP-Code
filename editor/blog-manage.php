<?php
include "db.php";

// DELETE blog
if(isset($_GET['delete'])){
    $delete_id = $_GET['delete'];

    // Delete image also
    $img_q = mysqli_query($conn, "SELECT featured_image FROM blogs WHERE id=$delete_id");
    $img = mysqli_fetch_assoc($img_q);
    if($img){
        $filepath = "uploads/" . $img['featured_image'];
        if(file_exists($filepath)){
            unlink($filepath);
        }
    }

    mysqli_query($conn, "DELETE FROM blogs WHERE id=$delete_id");
    header("Location: blog-manage.php");
    exit;
}

// Fetch all blogs
$result = mysqli_query($conn, "SELECT * FROM blogs ORDER BY id DESC");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Blogs</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        img.thumb {
            width: 80px;
            height: 60px;
            object-fit: cover;
            border-radius: 6px;
        }
    </style>
</head>

<body>

<div class="container mt-4">

    <h2>Manage Blogs</h2>
    <a href="blog-add.php" class="btn btn-primary btn-sm mb-3">+ Add New Blog</a>

    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th width="50">ID</th>
                <th>Title</th>
                <th>Slug</th>
                <th>Thumbnail</th>
                <th>Short Description</th>
                <th width="120">Action</th>
            </tr>
        </thead>

        <tbody>
        <?php while($row = mysqli_fetch_assoc($result)){ ?>
            <tr>
                <td><?= $row['id']; ?></td>

                <td><?= $row['title']; ?></td>

                <td><?= $row['slug']; ?></td>

                <td>
                    <img src="uploads/<?= $row['featured_image']; ?>" class="thumb">
                </td>

                <td>
                    <?= substr(strip_tags($row['description']), 0, 60); ?>...
                </td>

                <td>
                    <a href="blog-edit.php?id=<?= $row['id']; ?>" class="btn btn-warning btn-sm">Edit</a>
                    <a href="blog-manage.php?delete=<?= $row['id']; ?>" 
                       class="btn btn-danger btn-sm"
                       onclick="return confirm('Delete this blog?')">Delete</a>
                </td>
            </tr>
        <?php } ?>
        </tbody>
    </table>

</div>

</body>
</html>
