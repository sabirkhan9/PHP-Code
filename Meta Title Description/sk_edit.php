<?php
include("sk_connection.php");

if (!isset($_GET['id'])) {
    die("ID not provided");
}

$id = $_GET['id'];

// Fetch existing record
$query = "SELECT * FROM meta_data WHERE id = '$id'";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($result);

if (!$row) {
    die("Record not found");
}
?>

<?include ("itophead.php")?> 
<?include ("isubheading.php")?>  
<?include ("iaction.php")?> 
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">


<div class="container mt-5">
    <div class="row d-flex justify-content-center">
    <div class="col-6">
        <h2 class="text-center mb-4">Edit Meta Data</h2>
    <form action="sk_update.php" method="POST">        
        <input type="hidden" name="id" value="<?= $row['id'] ?>">

        <div class="mb-3">
            <label class="form-label">URL (slug)</label>
            <input type="text" name="slug" class="form-control" value="<?= $row['slug'] ?>" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Meta Title</label>
            <input type="text" name="meta_title" class="form-control" value="<?= $row['meta_title'] ?>" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Meta Description</label>
            <textarea name="meta_description" class="form-control" rows="4" required><?= $row['meta_description'] ?></textarea>
        </div>

        <button type="submit" name="update_meta" class="btn btn-primary">Update</button>
        <a href="/admin/sk_meta.php" class="btn btn-secondary">Back</a>
    </form>
    </div>
    </div>
</div>

<?include ("isubheadingempty.php")?>
<?include ("inodata.php")?>

<?include ("ibottom.php")?>