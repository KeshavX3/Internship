<?php
include 'db.php';
$id = $_GET['id'];
$result = $conn->query("SELECT * FROM users WHERE id = $id");
$data = $result->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Edit User</title>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">
  <style>
    body { background: #f4f6f9; font-family: 'Inter', sans-serif; padding: 40px; }
    .container {
      max-width: 650px;
      background: white;
      margin: auto;
      padding: 30px;
      border-radius: 12px;
      box-shadow: 0 10px 30px rgba(0,0,0,0.1);
    }
    h2 { text-align: center; color: #00796b; margin-bottom: 30px; }
    .form-group { margin-bottom: 20px; }
    label { display: block; font-weight: 600; margin-bottom: 8px; }
    input, textarea, select {
      width: 100%; padding: 10px 14px;
      border-radius: 8px; border: 1px solid #ccc;
      background: #f9f9f9;
    }
    img.preview {
      margin-top: 10px;
      width: 100px; border-radius: 8px;
    }
    .submit-btn {
      padding: 12px; background: #00796b; color: white;
      border: none; border-radius: 8px;
      font-size: 1rem; width: 100%;
      cursor: pointer;
    }
  </style>
</head>
<body>
  <div class="container">
    <h2>✏️ Edit User</h2>
    <form action="update_user.php" method="POST" enctype="multipart/form-data">
      <input type="hidden" name="id" value="<?= $data['id'] ?>">

      <div class="form-group">
        <label>Profile Title *</label>
        <input type="text" name="profile_title" value="<?= $data['profile_title'] ?>" required>
      </div>

      <div class="form-group">
        <label>Name *</label>
        <input type="text" name="name" value="<?= $data['name'] ?>" required>
      </div>

      <div class="form-group">
        <label>Email *</label>
        <input type="email" name="email" value="<?= $data['email'] ?>" required>
      </div>

      <div class="form-group">
        <label>Phone *</label>
        <input type="tel" name="phone" value="<?= $data['phone'] ?>" required>
      </div>

      <div class="form-group">
        <label>Date of Birth *</label>
        <input type="date" name="dob" value="<?= $data['dob'] ?>" required>
      </div>

      <div class="form-group">
        <label>Profile Color *</label>
        <input type="color" name="profile_color" value="<?= $data['profile_color'] ?>">
      </div>

      <div class="form-group">
        <label>Intro Video (optional)</label>
        <input type="file" name="intro_video">
      </div>

      <div class="form-group">
        <label>YouTube Video (Embed URL)</label>
        <textarea name="youtube_video"><?= $data['youtube_video'] ?></textarea>
      </div>

      <div class="form-group">
        <label>Bio</label>
        <textarea name="bio"><?= $data['bio'] ?></textarea>
      </div>

      <div class="form-group">
        <label>Current Image:</label><br>
        <img src="uploads/<?= $data['image'] ?>" class="preview">
      </div>

      <div class="form-group">
        <label>Change Image:</label>
        <input type="file" name="image">
      </div>

      <button class="submit-btn">💾 Update User</button>
    </form>
  </div>
</body>
</html>
