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
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Bootstrap Icons -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">
  <style>
    body { background: transparent; font-family: 'Inter', sans-serif; margin: 0; padding: 0; }
    .user-profile-card {
      max-width: 98vw;
      margin: 2.5rem auto 0 auto;
      padding: 2.5rem 2vw 2.5rem 2vw;
      background: #f8fafc;
      box-shadow: 0 4px 24px 0 rgba(31, 38, 135, 0.08);
      border-radius: 1.2rem;
      border: 1px solid #e3e8ef;
      width: 100%;
    }
    .profile-pic {
      display: block; margin: 0 auto 1.5rem auto;
      width: 140px; height: 140px;
      border-radius: 50%; object-fit: cover;
      box-shadow: 0 2px 12px rgba(0,0,0,0.10);
      border: 4px solid #e0f7fa;
    }
    .profile-title {
      text-align: center;
      color: #185a9d;
      font-size: 2.1rem;
      font-weight: 700;
      margin-bottom: 2.2rem;
      letter-spacing: 1px;
    }
    .user-info-row {
      display: flex;
      align-items: flex-start;
      gap: 3.5rem;
      flex-wrap: wrap;
      margin-bottom: 2.5rem;
    }
    .user-info-col {
      flex: 1 1 480px;
      min-width: 380px;
    }
    .field {
      margin-bottom: 2.1rem;
    }
    .field label {
      font-weight: 600;
      color: #185a9d;
      display: flex;
      align-items: center;
      gap: 0.5rem;
      font-size: 1.08rem;
    }
    .field p, .field .field-value {
      background: #f9f9f9;
      padding: 12px 16px;
      border-radius: 0.8rem;
      margin-top: 6px;
      font-size: 1.08rem;
      color: #222;
      word-break: break-word;
    }
    .color-box {
      width: 40px; height: 24px;
      border-radius: 8px; border: 1px solid #ccc;
      display: inline-block;
      margin-left: 0.5rem;
      vertical-align: middle;
    }
    .video-section, .youtube-section {
      margin-bottom: 1.5rem;
    }
    .bio-section {
      margin-bottom: 1.5rem;
    }
    @media (max-width: 991.98px) {
      .user-profile-card {
        padding: 1.2rem 0.7rem;
        max-width: 100vw;
      }
      .user-info-row {
        flex-direction: column;
        gap: 1.2rem;
      }
      .user-info-col {
        min-width: 0;
      }
    }
    @media (max-width: 767.98px) {
      .user-profile-card {
        padding: 0.7rem 0.1rem;
        max-width: 100vw;
      }
    }
  </style>
</head>
<body>
  <div class="container py-5">
    <div class="row justify-content-center">
      <div class="col-lg-10">
        <div class="card shadow-lg border-0 rounded-4 p-4 mb-4" style="background:#fff;">
          <div class="row g-4 align-items-center">
            <div class="col-md-4 text-center">
            <?php
$image = $user['image'];
if (!empty($image)) {
    // If it's a Cloudinary URL, use it directly with optimization
    if (str_contains($image, 'res.cloudinary.com')) {
        $optimizedImage = str_replace('/upload/', '/upload/w_130,h_130,c_fill,q_auto,f_auto/', $image);
        echo "<img src='{$optimizedImage}' class='rounded-circle shadow mb-3' style='width:130px;height:130px;object-fit:cover;border:4px solid #e0f7fa;'>";
    } else {
        // Otherwise treat as local image (for older records)
        echo "<img src='uploads/{$image}' class='rounded-circle shadow mb-3' style='width:130px;height:130px;object-fit:cover;border:4px solid #e0f7fa;'>";
    }
} else {
    echo "<img src='https://via.placeholder.com/130' class='rounded-circle shadow mb-3' style='width:130px;height:130px;object-fit:cover;border:4px solid #e0f7fa;'>";
}
?>

              <h3 class="fw-bold text-primary mt-2 mb-0"><i class="bi bi-person-circle me-2"></i><?= htmlspecialchars($user['profile_title']) ?></h3>
            </div>
            <div class="col-md-8">
              <div class="row g-3">
                <div class="col-sm-6">
                  <div class="mb-2"><i class="bi bi-person me-2"></i><strong>Name:</strong><br><?= htmlspecialchars($user['name']) ?></div>
                  <div class="mb-2"><i class="bi bi-envelope me-2"></i><strong>Email:</strong><br><?= htmlspecialchars($user['email']) ?></div>
                  <div class="mb-2"><i class="bi bi-telephone me-2"></i><strong>Phone:</strong><br><?= htmlspecialchars($user['phone']) ?></div>
                  <div class="mb-2"><i class="bi bi-calendar-event me-2"></i><strong>Date of Birth:</strong><br><?= htmlspecialchars($user['dob']) ?></div>
                  <div class="mb-2"><i class="bi bi-palette me-2"></i><strong>Profile Color:</strong> <span class="color-box" style="background: <?= $user['profile_color'] ?>"></span></div>
                </div>
                <div class="col-sm-6">
                  <?php if (!empty($user['intro_video'])): ?>
                    <div class="mb-3">
                      <label class="fw-semibold mb-1"><i class="bi bi-camera-video me-2"></i>Intro Video:</label>
                      <div class="ratio ratio-16x9 rounded-3 overflow-hidden bg-dark-subtle">
                        <video controls style="width:100%;height:100%;object-fit:cover;">
                          <source src="uploads/<?= $user['intro_video'] ?>" type="video/mp4">
                        </video>
                      </div>
                    </div>
                  <?php endif; ?>
                  <?php
                  // Validate YouTube embed link (should start with https://www.youtube.com/embed/)
                  $yt = trim($user['youtube_video'] ?? '');
                  $is_embed = (strpos($yt, 'https://www.youtube.com/embed/') === 0);
                  ?>
                  <div class="mb-3">
                    <label class="fw-semibold mb-1"><i class="bi bi-youtube me-2"></i>Favorite YouTube Video:</label>
                    <?php if ($is_embed): ?>
                      <div class="ratio ratio-16x9 rounded-3 overflow-hidden bg-dark-subtle">
                        <iframe src="<?= htmlspecialchars($yt) ?>" allowfullscreen style="border:0;"></iframe>
                      </div>
                    <?php elseif (!empty($yt)): ?>
                      <div class="alert alert-warning p-2">Invalid YouTube embed link.<br>Use format: <code>https://www.youtube.com/embed/...</code></div>
                    <?php endif; ?>
                  </div>
                  <?php if (!empty($user['bio'])): ?>
                    <div class="mb-3">
                      <label class="fw-semibold mb-1"><i class="bi bi-info-circle me-2"></i>Bio:</label>
                      <div class="field-value bg-light border rounded-3 p-2"><?= nl2br(htmlspecialchars($user['bio'])) ?></div>
                    </div>
                  <?php endif; ?>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Bootstrap JS Bundle -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
