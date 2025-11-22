<?php
include "db.php";

$message = "";

// Save blog
if(isset($_POST['save'])){

    // Escape strings
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);

    // Create Base Slug
    $base_slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $title)));
    $slug = $base_slug;

    // Check if slug already exists → make unique
    $count = 1;
    while(true){
        $check = mysqli_query($conn, "SELECT id FROM blogs WHERE slug='$slug'");
        if(mysqli_num_rows($check) == 0){
            break; // slug available
        }
        $slug = $base_slug . "-" . $count;
        $count++;
    }

    // Create uploads folder
    if(!is_dir("uploads")){
        mkdir("uploads", 0777, true);
    }

    // Handle image upload
    $imageName = $_FILES['featured_image']['name'];
    $imageTmp  = $_FILES['featured_image']['tmp_name'];
    $uploadPath = "uploads/" . $imageName;

    if(move_uploaded_file($imageTmp, $uploadPath)){

        // Insert blog
        $sql = "INSERT INTO blogs (title, slug, featured_image, description)
                VALUES ('$title', '$slug', '$imageName', '$description')";

        if(mysqli_query($conn, $sql)){
            $message = "<div class='alert alert-success'>Blog Published Successfully!</div>";
        } else {
            $message = "<div class='alert alert-danger'>DB Error: ".mysqli_error($conn)."</div>";
        }

    } else {
        $message = "<div class='alert alert-danger'>Image Upload Failed!</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Blog</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/6.7.0/tinymce.min.js"></script>

    <script>
        tinymce.init({
            selector: 'textarea#blog_description',
            height: 400,
            plugins: 'image link lists table code',
            toolbar: 'undo redo | styles | bold italic | alignleft aligncenter alignright | ' +
                     'bullist numlist | image link | code',
            menubar: true,
            branding: false
        });
    </script>
</head>

<body>

<div class="container mt-4">

    <h2>Add New Blog</h2>
    <hr>

    <?php echo $message; ?>

    <form method="POST" enctype="multipart/form-data">

        <div class="mb-3">
            <label><strong>Blog Title</strong></label>
            <input type="text" name="title" class="form-control" required>
        </div>

        <div class="mb-3">
            <label><strong>Featured Image</strong></label>
            <input type="file" name="featured_image" class="form-control" required>
        </div>

        <div class="mb-3">
            <label><strong>Description</strong></label>
            <textarea id="blog_description" name="description"></textarea>
        </div>

        <button name="save" class="btn btn-primary w-100">Publish Blog</button>

    </form>

</div>

</body>
</html>
