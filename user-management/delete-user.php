<?php
include 'db.php';

if (isset($_POST['id'])) {
    $id = $_POST['id'];
    
    // Delete from database
    $query = "DELETE FROM users WHERE id = $id";
    if ($conn->query($query)) {
        echo "success";
    } else {
        echo "error";
    }
}
?>
