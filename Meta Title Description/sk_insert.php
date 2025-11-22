<?php 
include("sk_connection.php");

if(isset($_POST['add_meta'])){
    
    $slug = $_POST['slug'];
    $meta_title = $_POST['meta_title'];
    $meta_description = $_POST['meta_description'];

    // STEP 1: Check if slug already exists
    $check = "SELECT * FROM meta_data WHERE slug='$slug'";
    $result = mysqli_query($conn, $check);

    if(mysqli_num_rows($result) > 0){
        echo "<script>
            alert('Slug already exists! Please use a different slug.');
            window.location.href='/admin/sk_meta.php';
        </script>";
    } 
    else {
        // STEP 2: Insert data
        $query = "INSERT INTO meta_data (slug, meta_title, meta_description)
                  VALUES ('$slug', '$meta_title', '$meta_description')";

        $run = mysqli_query($conn, $query);

        if($run){
            echo "<script>
                alert('Added Successfully!');
                window.location.href='/admin/sk_meta.php';
            </script>";
        } else {
            echo "<p style='color:red;'>Error: Failed to insert!</p>";
        }
    }
}
?>
