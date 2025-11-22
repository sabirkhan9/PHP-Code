<?php
include "db.php";

$message = "";

// Get ID from URL
if(!isset($_GET['id'])){
    die("Blog ID is missing");
}

$id = $_GET['id'];

// Fetch existing blog data
$blog = mysqli_query($conn, "SELECT * FROM blogs WHERE id=$id");
$data = mysqli_fetch_assoc($blog);

if(!$data){
    die("Blog not found!");
}

// UPDATE blog
if(isset($_POST['update'])){

    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $slug  = mysqli_real_escape_string($conn, $_POST['slug']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);

    $imageName = $data['featured_image']; // default old image

    // If new image uploaded
    if(!empty($_FILES['featured_image']['name'])){
        
        $imageName = $_FILES['featured_image']['name'];
        $imageTmp  = $_FILES['featured_image']['tmp_name'];

        // Upload new image (DON'T DELETE OLD ONE — Option 2)
        move_uploaded_file($imageTmp, "uploads/" . $imageName);
    }

    // Update DB
    $sql = "UPDATE blogs SET 
                title='$title',
                slug='$slug',
                featured_image='$imageName',
                description='$description'
            WHERE id=$id";

    if(mysqli_query($conn, $sql)){
        $message = "<div class='alert alert-success'>Blog Updated Successfully!</div>";
    } else {
        $message = "<div class='alert alert-danger'>DB Error: ".mysqli_error($conn)."</div>";
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Blog</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- TinyMCE -->
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

    <style>
        img.preview {
            width: 150px;
            height: 100px;
            object-fit: cover;
            border-radius: 6px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
        }
    </style>
</head>

<body>

<div class="container mt-4">

    <h2>Edit Blog</h2>
    <a href="blog-manage.php" class="btn btn-secondary btn-sm mb-3">← Back to Manage</a>

    <?php echo $message; ?>

    <form method="POST" enctype="multipart/form-data">

        <div class="mb-3">
            <label><strong>Title</strong></label>
            <input type="text" name="title" value="<?= $data['title']; ?>" class="form-control" required>
        </div>

        <div class="mb-3">
            <label><strong>Slug</strong></label>
            <input type="text" name="slug" value="<?= $data['slug']; ?>" class="form-control" required>
            <small class="text-muted">Do not use spaces — use hyphens (-)</small>
        </div>

        <div class="mb-3">
            <label><strong>Current Featured Image</strong></label><br>
            <img src="uploads/<?= $data['featured_image']; ?>" class="preview">
        </div>

        <div class="mb-3">
            <label><strong>Upload New Image (Optional)</strong></label>
            <input type="file" name="featured_image" class="form-control">
        </div>

        <div class="mb-3">
            <label><strong>Description</strong></label>
            <textarea id="blog_description" name="description"><?= $data['description']; ?></textarea>
        </div>

        <button name="update" class="btn btn-primary w-100">Update Blog</button>

    </form>

</div>

</body>
</html>
