<?php
include("sk_connection.php");

if (isset($_POST['update_meta'])) {

    $id = $_POST['id'];
    $slug = $_POST['slug'];
    $meta_title = $_POST['meta_title'];
    $meta_description = $_POST['meta_description'];

    // STEP 1: Check if same slug exists in another record
    $check = "SELECT * FROM meta_data WHERE slug='$slug' AND id != '$id'";
    $run_check = mysqli_query($conn, $check);

    if (mysqli_num_rows($run_check) > 0) {
        echo "<script>
                alert('Slug already exists! Please use a different slug.');
                window.location.href = '/admin/sk_meta.php';
              </script>";
        exit;
    }

    // STEP 2: Update record if slug is unique
    $query = "UPDATE meta_data SET 
                slug = '$slug', 
                meta_title = '$meta_title', 
                meta_description = '$meta_description' 
              WHERE id = '$id'";

    $result = mysqli_query($conn, $query);

    if ($result) {
        echo "<script>
                alert('Meta Updated Successfully!');
                window.location.href = '/admin/sk_meta.php';
              </script>";
    } else {
        echo "Error updating record!";
    }
}
?>
