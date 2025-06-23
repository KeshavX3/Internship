<?php
include 'db.php';

$id = $_POST['id'];

$sql = "SELECT * FROM users WHERE id = $id";
$result = $conn->query($sql);
$row = $result->fetch_assoc();

// Validate YouTube embed link (should start with https://www.youtube.com/embed/)
$yt = trim($row['youtube_video'] ?? '');
$is_embed = (strpos($yt, 'https://www.youtube.com/embed/') === 0);
?>
<div class="container-fluid p-0 d-flex justify-content-center align-items-center" style="min-height: 100%;">
  <div class="card shadow-lg border-0 rounded-4 px-5 pt-5 pb-4 position-relative" style="max-width: 800px; width:100%; background: #fff;">
    <!-- Profile Image Overlapping -->
    <div class="position-absolute top-0 start-50 translate-middle" style="z-index:2;">
      <?php if (!empty($row['image'])): ?>
        <img src="uploads/<?php echo $row['image']; ?>" class="rounded-circle border border-3 border-white shadow" style="width:96px;height:96px;object-fit:cover;">
      <?php else: ?>
        <img src="https://via.placeholder.com/96" class="rounded-circle border border-3 border-white shadow" style="width:96px;height:96px;object-fit:cover;">
      <?php endif; ?>
    </div>
    <div class="pt-5 mt-3 text-center">
      <h4 class="fw-bold mb-1 mt-2"><?php echo htmlspecialchars($row['name']); ?></h4>
      <div class="text-muted mb-2 small"><i class="bi bi-envelope me-1"></i><?php echo htmlspecialchars($row['email']); ?></div>
      <div class="mb-3">
        <span class="badge bg-light text-primary fw-semibold px-3 py-2 fs-6"><i class="bi bi-person-badge me-1"></i><?php echo htmlspecialchars($row['profile_title']); ?></span>
      </div>
    </div>
    <div class="row g-4 mt-2">
      <div class="col-md-6">
        <div class="d-flex align-items-center mb-3"><i class="bi bi-telephone me-2 text-primary"></i><span class="fw-semibold">Phone:</span> <span class="ms-2 text-muted"><?php echo htmlspecialchars($row['phone']); ?></span></div>
        <div class="d-flex align-items-center mb-3"><i class="bi bi-calendar-event me-2 text-primary"></i><span class="fw-semibold">DOB:</span> <span class="ms-2 text-muted"><?php echo htmlspecialchars($row['dob']); ?></span></div>
        <div class="d-flex align-items-center mb-3"><i class="bi bi-palette me-2 text-primary"></i><span class="fw-semibold">Color:</span> <span class="ms-2"><span class="rounded-2 border d-inline-block" style="width:28px;height:18px;background:<?php echo $row['profile_color']; ?>;"></span></span></div>
        <?php if (!empty($row['bio'])): ?>
        <div class="d-flex align-items-start mb-3"><i class="bi bi-info-circle me-2 text-primary"></i><span class="fw-semibold">Bio:</span> <span class="ms-2 text-muted"><?php echo nl2br(htmlspecialchars($row['bio'])); ?></span></div>
        <?php endif; ?>
      </div>
      <div class="col-md-6">
        <?php if ($is_embed): ?>
        <div class="mb-3">
          <label class="fw-semibold mb-1"><i class="bi bi-youtube me-2"></i>Favorite YouTube Video:</label>
          <div class="ratio ratio-16x9 rounded-3 overflow-hidden bg-dark-subtle">
            <iframe src="<?php echo htmlspecialchars($yt); ?>" allowfullscreen style="border:0;"></iframe>
          </div>
        </div>
        <?php elseif (!empty($yt)): ?>
        <div class="alert alert-warning p-2">Invalid YouTube embed link.<br>Use format: <code>https://www.youtube.com/embed/...</code></div>
        <?php endif; ?>
        <?php if (!empty($row['intro_video'])): ?>
        <div class="mb-2">
          <label class="fw-semibold mb-1"><i class="bi bi-camera-video me-2"></i>Intro Video:</label>
          <div class="ratio ratio-16x9 rounded-3 overflow-hidden bg-dark-subtle">
            <video controls style="width:100%;height:100%;object-fit:cover;">
              <source src="uploads/<?php echo $row['intro_video']; ?>" type="video/mp4">
            </video>
          </div>
        </div>
        <?php endif; ?>
      </div>
    </div>
  </div>
</div>
