<?php
include 'db.php';
$id = $_GET['id'];
$result = $conn->query("SELECT * FROM users WHERE id = $id");
$user = $result->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>View User</title>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">
  <style>
    body { background: #f0f2f5; font-family: 'Inter', sans-serif; padding: 40px; }
    .card {
      background: white; max-width: 700px; margin: auto;
      border-radius: 12px; padding: 30px; box-shadow: 0 12px 25px rgba(0, 0, 0, 0.08);
    }
    h2 { text-align: center; color: #00796b; margin-bottom: 25px; }
    .field { margin: 15px 0; }
    .field label { font-weight: 600; color: #333; }
    .field p {
      background: #f9f9f9; padding: 10px 14px;
      border-radius: 8px; margin-top: 6px;
    }
    .profile-pic {
      display: block; margin: auto;
      width: 120px; height: 120px;
      border-radius: 50%; object-fit: cover;
    }
    .color-box {
      width: 40px; height: 20px;
      border-radius: 6px; border: 1px solid #ccc;
    }
  </style>
</head>
<body>
  <div class="card">
    <?php if (!empty($user['image'])): ?>
      <img src="uploads/<?= $user['image'] ?>" class="profile-pic" alt="Profile Picture">
    <?php else: ?>
      <img src="https://via.placeholder.com/120" class="profile-pic" alt="Default Pic">
    <?php endif; ?>

    <h2><?= htmlspecialchars($user['profile_title']) ?></h2>

    <div class="field">
      <label>Name:</label>
      <p><?= htmlspecialchars($user['name']) ?></p>
    </div>

    <div class="field">
      <label>Email:</label>
      <p><?= htmlspecialchars($user['email']) ?></p>
    </div>

    <div class="field">
      <label>Phone:</label>
      <p><?= htmlspecialchars($user['phone']) ?></p>
    </div>

    <div class="field">
      <label>Date of Birth:</label>
      <p><?= htmlspecialchars($user['dob']) ?></p>
    </div>

    <?php if (!empty($user['intro_video'])): ?>
      <div class="field">
        <label>Intro Video:</label>
        <video controls width="100%">
          <source src="uploads/<?= $user['intro_video'] ?>" type="video/mp4">
        </video>
      </div>
    <?php endif; ?>

    <?php if (!empty($user['youtube_video'])): ?>
      <div class="field">
        <label>Favorite YouTube Video:</label>
        <iframe width="100%" height="280" src="<?= htmlspecialchars($user['youtube_video']) ?>" frameborder="0" allowfullscreen></iframe>
      </div>
    <?php endif; ?>

    <?php if (!empty($user['bio'])): ?>
      <div class="field">
        <label>Bio:</label>
        <p><?= nl2br(htmlspecialchars($user['bio'])) ?></p>
      </div>
    <?php endif; ?>

    <div class="field">
      <label>Profile Color:</label>
      <div class="color-box" style="background: <?= $user['profile_color'] ?>"></div>
    </div>
  </div>
</body>
</html>
