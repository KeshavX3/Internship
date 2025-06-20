<?php
include 'db.php';

// Server-side validation
$required_fields = ['profile_title', 'name', 'email', 'password', 'dob', 'phone', 'bio'];
$errors = [];

foreach ($required_fields as $field) {
  if (empty($_POST[$field])) {
    $errors[] = "$field is required.";
  }
}

if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
  $errors[] = "Invalid email format.";
}

if (!empty($errors)) {
  echo "<h3>Validation Errors:</h3>";
  foreach ($errors as $err) {
    echo "<p style='color:red;'>$err</p>";
  }
  echo "<a href='add_user.html'>Go Back</a>";
  exit;
}

// File handling
$image = $_FILES['image']['name'];
$intro_video = $_FILES['intro_video']['name'];
$imagePath = "uploads/" . $image;
$videoPath = "uploads/" . $intro_video;

move_uploaded_file($_FILES['image']['tmp_name'], $imagePath);
move_uploaded_file($_FILES['intro_video']['tmp_name'], $videoPath);

// Prepare data
$profile_title = $_POST['profile_title'];
$name = $_POST['name'];
$email = $_POST['email'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Encrypted
$dob = $_POST['dob'];
$phone = $_POST['phone'];
$youtube_video = $_POST['youtube_video'];
$bio = $_POST['bio'];
$color = $_POST['profile_color'];
$status = 1;

// Insert into DB
$sql = "INSERT INTO users (profile_title, name, email, password, image, dob, phone, intro_video, youtube_video, bio, profile_color, status)
        VALUES ('$profile_title', '$name', '$email', '$password', '$imagePath', '$dob', '$phone', '$videoPath', '$youtube_video', '$bio', '$color', $status)";

if ($conn->query($sql) === TRUE) {
  header("Location: user-list.php");
  exit;
} else {
  echo "Error: " . $conn->error;
}
?>
