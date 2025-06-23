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
    echo '<!DOCTYPE html>';
    echo '<html lang="en">';
    echo '<head>';
    echo '    <meta charset="UTF-8">';
    echo '    <title>Add User - Error</title>';
    echo '    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">';
    echo '    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">';
    echo '    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">';
    echo '    <style>';
    echo '        body { margin: 0; padding: 0; background: transparent; font-family: \'Inter\', sans-serif; }';
    echo '        .add-user-container { max-width: 700px; margin: 3.5rem auto 0 auto; padding: 2.5rem 2rem 2rem 2rem; background: #f8fafc; box-shadow: 0 4px 24px 0 rgba(31, 38, 135, 0.08); border-radius: 1.5rem; border: 1px solid #e3e8ef; }';
    echo '        h2 { text-align: center; color: #185a9d; margin-bottom: 2.2rem; font-weight: 700; letter-spacing: 1px; }';
    echo '        .form-label { font-weight: 600; color: #185a9d; }';
    echo '        .form-control, .form-select { border-radius: 0.8rem; background: rgba(255,255,255,0.92); font-size: 1.08rem; padding: 0.85rem 1.1rem; }';
    echo '        .input-group-text { background: #e0f7fa; border-radius: 0.8rem 0 0 0.8rem; color: #185a9d; font-size: 1.2rem; }';
    echo '        .form-group img, #imgPreview { margin-top: 10px; max-width: 120px; border-radius: 0.7rem; box-shadow: 0 2px 6px rgba(0,0,0,0.10); display: block; }';
    echo '        .submit-btn { width: 100%; padding: 0.95rem; background: linear-gradient(90deg, #43cea2 0%, #185a9d 100%); color: white; font-size: 1.15rem; font-weight: bold; border: none; border-radius: 1rem; cursor: pointer; transition: background 0.3s; margin-top: 1.2rem; }';
    echo '        .submit-btn:hover { background: linear-gradient(90deg, #185a9d 0%, #43cea2 100%); }';
    echo '        .toggle-pass { margin-top: 6px; font-size: 0.95rem; color: #185a9d; cursor: pointer; display: inline-block; }';
    echo '        .optional { font-weight: normal; font-size: 0.95rem; color: #888; }';
    echo '        @media (max-width: 767.98px) { .add-user-container { padding: 1.2rem 0.3rem; } }';
    echo '    </style>';
    echo '</head>';
    echo '<body>';
    echo '<div class="add-user-container">';
    echo '<div class="alert alert-danger d-flex align-items-center" role="alert">';
    echo '<i class="bi bi-exclamation-triangle-fill me-2"></i> <div><strong>Validation Errors:</strong><ul style="margin-bottom:0;">';
    foreach ($errors as $err) {
        echo "<li>$err</li>";
    }
    echo '</ul></div></div>';
    echo '<form action="save_user.php" method="POST" enctype="multipart/form-data" id="userForm">';
    echo '<div class="row g-3">';
    // Profile Title
    echo '<div class="col-12">';
    echo '<label class="form-label">Profile Title *</label>';
    echo '<div class="input-group">';
    echo '<span class="input-group-text"><i class="bi bi-person-badge"></i></span>';
    echo '<input type="text" name="profile_title" class="form-control" required value="' . htmlspecialchars($_POST['profile_title'] ?? "") . '">';
    echo '</div></div>';
    // Name
    echo '<div class="col-12 col-md-6">';
    echo '<label class="form-label">Name *</label>';
    echo '<div class="input-group">';
    echo '<span class="input-group-text"><i class="bi bi-person"></i></span>';
    echo '<input type="text" name="name" class="form-control" required value="' . htmlspecialchars($_POST['name'] ?? "") . '">';
    echo '</div></div>';
    // Email
    echo '<div class="col-12 col-md-6">';
    echo '<label class="form-label">Email *</label>';
    echo '<div class="input-group">';
    echo '<span class="input-group-text"><i class="bi bi-envelope"></i></span>';
    echo '<input type="email" name="email" class="form-control" required value="' . htmlspecialchars($_POST['email'] ?? "") . '">';
    echo '</div></div>';
    // Password
    echo '<div class="col-12 col-md-6">';
    echo '<label class="form-label">Password *</label>';
    echo '<div class="input-group">';
    echo '<span class="input-group-text"><i class="bi bi-lock"></i></span>';
    echo '<input type="password" name="password" id="passwordInput" class="form-control" required>';
    echo '</div>';
    echo '<span class="toggle-pass" onclick="togglePassword()"><i class="bi bi-eye"></i> Show/Hide Password</span>';
    echo '</div>';
    // Phone
    echo '<div class="col-12 col-md-6">';
    echo '<label class="form-label">Phone Number *</label>';
    echo '<div class="input-group">';
    echo '<span class="input-group-text"><i class="bi bi-telephone"></i></span>';
    echo '<input type="tel" name="phone" class="form-control" required value="' . htmlspecialchars($_POST['phone'] ?? "") . '">';
    echo '</div></div>';
    // DOB
    echo '<div class="col-12 col-md-6">';
    echo '<label class="form-label">Date of Birth *</label>';
    echo '<div class="input-group">';
    echo '<span class="input-group-text"><i class="bi bi-calendar-event"></i></span>';
    echo '<input type="date" name="dob" class="form-control" required value="' . htmlspecialchars($_POST['dob'] ?? "") . '">';
    echo '</div></div>';
    // Profile Image
    echo '<div class="col-12 col-md-6">';
    echo '<label class="form-label">Profile Image *</label>';
    echo '<input type="file" name="image" accept="image/*" class="form-control" onchange="previewImage(event)" required>';
    echo '<img id="imgPreview" src="#" style="display:none;">';
    echo '</div>';
    // Profile Color
    echo '<div class="col-12 col-md-6">';
    echo '<label class="form-label">Profile Color *</label>';
    echo '<div class="input-group">';
    echo '<span class="input-group-text"><i class="bi bi-palette"></i></span>';
    echo '<input type="color" name="profile_color" class="form-control form-control-color" required value="' . htmlspecialchars($_POST['profile_color'] ?? "") . '">';
    echo '</div></div>';
    // Intro Video
    echo '<div class="col-12 col-md-6">';
    echo '<label class="form-label">Intro Video <span class="optional">(Optional - MP4 only)</span></label>';
    echo '<input type="file" name="intro_video" accept="video/mp4" class="form-control">';
    echo '</div>';
    // YouTube Video
    echo '<div class="col-12">';
    echo '<label class="form-label">Favorite YouTube Video <span class="optional">(Embed link)</span></label>';
    echo '<textarea name="youtube_video" class="form-control" placeholder="https://www.youtube.com/embed/...">' . htmlspecialchars($_POST['youtube_video'] ?? "") . '</textarea>';
    echo '</div>';
    // Bio
    echo '<div class="col-12">';
    echo '<label class="form-label">Bio <span class="optional">(Optional)</span></label>';
    echo '<textarea name="bio" rows="4" class="form-control" placeholder="Write something about the user...">' . htmlspecialchars($_POST['bio'] ?? "") . '</textarea>';
    echo '</div>';
    echo '</div>';
    echo '<button class="submit-btn mt-4"><i class="bi bi-save me-2"></i>Save User</button>';
    echo '<a href="add-user.php" class="btn btn-outline-secondary w-100 mt-3"><i class="bi bi-arrow-left me-2"></i>Go Back</a>';
    echo '</form>';
    echo '</div>';
    echo '<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>';
    echo '<script>';
    echo 'function togglePassword() {';
    echo '  const input = document.getElementById("passwordInput");';
    echo '  input.type = input.type === "password" ? "text" : "password";';
    echo '}';
    echo 'function previewImage(event) {';
    echo '  const output = document.getElementById(\'imgPreview\');';
    echo '  output.style.display = \'block\';';
    echo '  output.src = URL.createObjectURL(event.target.files[0]);';
    echo '}';
    echo '</script>';
    echo '</body></html>';
    exit;
}

// Handle image
$image = $_FILES['image']['name'];
$imagePath = "uploads/" . $image;
if (!empty($image)) {
    move_uploaded_file($_FILES['image']['tmp_name'], $imagePath);
}
// Handle intro video
$intro_video = $_FILES['intro_video']['name'];
$videoPath = "uploads/" . $intro_video;
if (!empty($intro_video)) {
    move_uploaded_file($_FILES['intro_video']['tmp_name'], $videoPath);
}

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
        VALUES ('$profile_title', '$name', '$email', '$password', '$image', '$dob', '$phone', '$intro_video', '$youtube_video', '$bio', '$color', $status)";

if ($conn->query($sql) === TRUE) {
  header("Location: user-list.php");
  exit;
} else {
  echo "Error: " . $conn->error;
}
?>
