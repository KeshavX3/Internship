<?php
include 'db.php';

$id = $_POST['id'];
$profile_title = $_POST['profile_title'];
$name = $_POST['name'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$dob = $_POST['dob'];
$profile_color = $_POST['profile_color'];
$bio = $_POST['bio'];
$youtube_video = $_POST['youtube_video'];

// Handle video (optional)
$intro_video = "";
if (!empty($_FILES['intro_video']['name'])) {
    $intro_video = time() . "_" . $_FILES['intro_video']['name'];
    move_uploaded_file($_FILES['intro_video']['tmp_name'], "uploads/" . $intro_video);
}

$query = "UPDATE users SET 
    profile_title='$profile_title', 
    name='$name', 
    email='$email', 
    phone='$phone', 
    dob='$dob', 
    profile_color='$profile_color',
    bio='$bio',
    youtube_video='$youtube_video'";

if (!empty($intro_video)) {
    $query .= ", intro_video='$intro_video'";
}

$query .= " WHERE id=$id";

if ($conn->query($query)) {
    header("Location: user-list.php");
    exit;
    
} else {
    echo "Error: " . $conn->error;
}
?>
