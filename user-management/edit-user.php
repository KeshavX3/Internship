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
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Bootstrap Icons -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">
  <style>
    body { background: transparent; font-family: 'Inter', sans-serif; margin: 0; padding: 0; }
    .edit-user-container {
      max-width: 1100px;
      margin: 3.5rem auto 0 auto;
      padding: 2.5rem 3.5rem 2.5rem 3.5rem;
      background: #f8fafc;
      box-shadow: 0 4px 24px 0 rgba(31, 38, 135, 0.08);
      border-radius: 1.5rem;
      border: 1px solid #e3e8ef;
    }
    .row.g-3 {
      --bs-gutter-x: 2.5rem;
      --bs-gutter-y: 2.2rem;
    }
    h2 { text-align: center; color: #185a9d; margin-bottom: 2.2rem; font-weight: 700; letter-spacing: 1px; }
    .form-label { font-weight: 600; color: #185a9d; }
    .form-control, .form-select {
      border-radius: 0.8rem;
      background: rgba(255,255,255,0.92);
      font-size: 1.08rem;
      padding: 0.85rem 1.1rem;
    }
    .input-group-text {
      background: #e0f7fa;
      border-radius: 0.8rem 0 0 0.8rem;
      color: #185a9d;
      font-size: 1.2rem;
    }
    .img-preview {
      margin-top: 10px;
      max-width: 120px;
      border-radius: 0.7rem;
      box-shadow: 0 2px 6px rgba(0,0,0,0.10);
      display: block;
    }
    .submit-btn {
      width: 100%;
      padding: 0.95rem;
      background: linear-gradient(90deg, #43cea2 0%, #185a9d 100%);
      color: white;
      font-size: 1.15rem;
      font-weight: bold;
      border: none;
      border-radius: 1rem;
      cursor: pointer;
      transition: background 0.3s;
      margin-top: 1.2rem;
    }
    .submit-btn:hover {
      background: linear-gradient(90deg, #185a9d 0%, #43cea2 100%);
    }
    .optional {
      font-weight: normal;
      font-size: 0.95rem;
      color: #888;
    }
    @media (max-width: 991.98px) {
      .edit-user-container {
        padding: 1.2rem 0.7rem;
      }
      .row.g-3 {
        --bs-gutter-x: 1.2rem;
        --bs-gutter-y: 1.2rem;
      }
    }
    @media (max-width: 767.98px) {
      .edit-user-container {
        padding: 0.7rem 0.1rem;
      }
      .row.g-3 {
        --bs-gutter-x: 0.5rem;
        --bs-gutter-y: 0.7rem;
      }
    }
  </style>
</head>
<body>
  <div class="edit-user-container">
    <h2><i class="bi bi-pencil-square me-2"></i>Edit User</h2>
    <form action="update_user.php" method="POST" enctype="multipart/form-data">
      <input type="hidden" name="id" value="<?= $data['id'] ?>">
      <div class="row g-3">
        <div class="col-12">
          <label class="form-label">Profile Title *</label>
          <div class="input-group">
            <span class="input-group-text"><i class="bi bi-person-badge"></i></span>
            <input type="text" name="profile_title" class="form-control" value="<?= $data['profile_title'] ?>" required>
          </div>
        </div>
        <div class="col-12 col-md-6">
          <label class="form-label">Name *</label>
          <div class="input-group">
            <span class="input-group-text"><i class="bi bi-person"></i></span>
            <input type="text" name="name" class="form-control" value="<?= $data['name'] ?>" required>
          </div>
        </div>
        <div class="col-12 col-md-6">
          <label class="form-label">Email *</label>
          <div class="input-group">
            <span class="input-group-text"><i class="bi bi-envelope"></i></span>
            <input type="email" name="email" class="form-control" value="<?= $data['email'] ?>" required>
          </div>
        </div>
        <div class="col-12 col-md-6">
          <label class="form-label">Phone *</label>
          <div class="input-group">
            <span class="input-group-text"><i class="bi bi-telephone"></i></span>
            <input type="tel" name="phone" class="form-control" value="<?= $data['phone'] ?>" required>
          </div>
        </div>
        <div class="col-12 col-md-6">
          <label class="form-label">Date of Birth *</label>
          <div class="input-group">
            <span class="input-group-text"><i class="bi bi-calendar-event"></i></span>
            <input type="date" name="dob" class="form-control" value="<?= $data['dob'] ?>" required>
          </div>
        </div>
        <div class="col-12 col-md-6">
          <label class="form-label">Profile Color *</label>
          <div class="input-group">
            <span class="input-group-text"><i class="bi bi-palette"></i></span>
            <input type="color" name="profile_color" class="form-control form-control-color" value="<?= $data['profile_color'] ?>">
          </div>
        </div>
        <div class="col-12 col-md-6">
          <label class="form-label">Intro Video <span class="optional">(Optional - MP4 only)</span></label>
          <input type="file" name="intro_video" accept="video/mp4" class="form-control">
        </div>
        <div class="col-12">
          <label class="form-label">YouTube Video <span class="optional">(Embed URL)</span></label>
          <textarea name="youtube_video" class="form-control"><?= $data['youtube_video'] ?></textarea>
        </div>
        <div class="col-12">
          <label class="form-label">Bio <span class="optional">(Optional)</span></label>
          <textarea name="bio" rows="4" class="form-control"><?= $data['bio'] ?></textarea>
        </div>
        <div class="col-12 col-md-6">
          <label class="form-label">Current Image:</label><br>
          <img src="uploads/<?= $data['image'] ?>" class="img-preview">
        </div>
        <div class="col-12 col-md-6">
          <label class="form-label">Change Image:</label>
          <input type="file" name="image" class="form-control">
        </div>
      </div>
      <button class="submit-btn mt-4"><i class="bi bi-save me-2"></i>Update User</button>
    </form>
  </div>
  <!-- Bootstrap JS Bundle -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
