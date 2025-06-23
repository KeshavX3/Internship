<?php include 'db.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add User</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">
    <style>
        body {
            margin: 0;
            padding: 0;
            background: transparent;
            font-family: 'Inter', sans-serif;
        }
        .add-user-container {
            max-width: 700px;
            margin: 3.5rem auto 0 auto;
            padding: 2.5rem 2rem 2rem 2rem;
            background: #f8fafc;
            box-shadow: 0 4px 24px 0 rgba(31, 38, 135, 0.08);
            border-radius: 1.5rem;
            border: 1px solid #e3e8ef;
        }
        h2 {
            text-align: center;
            color: #185a9d;
            margin-bottom: 2.2rem;
            font-weight: 700;
            letter-spacing: 1px;
        }
        .form-label {
            font-weight: 600;
            color: #185a9d;
        }
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
        .form-group img, #imgPreview {
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
        .toggle-pass {
            margin-top: 6px;
            font-size: 0.95rem;
            color: #185a9d;
            cursor: pointer;
            display: inline-block;
        }
        .optional {
            font-weight: normal;
            font-size: 0.95rem;
            color: #888;
        }
        @media (max-width: 767.98px) {
            .add-user-container {
                padding: 1.2rem 0.3rem;
            }
        }
    </style>
</head>
<body>

<div class="add-user-container">
    <h2><i class="bi bi-person-plus me-2"></i>Add New User</h2>
    <form action="save_user.php" method="POST" enctype="multipart/form-data" id="userForm">
        <div class="row g-3">
            <div class="col-12">
                <label class="form-label">Profile Title *</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-person-badge"></i></span>
                    <input type="text" name="profile_title" class="form-control" required>
                </div>
            </div>
            <div class="col-12 col-md-6">
                <label class="form-label">Name *</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-person"></i></span>
                    <input type="text" name="name" class="form-control" required>
                </div>
            </div>
            <div class="col-12 col-md-6">
                <label class="form-label">Email *</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                    <input type="email" name="email" class="form-control" required>
                </div>
            </div>
            <div class="col-12 col-md-6">
                <label class="form-label">Password *</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-lock"></i></span>
                    <input type="password" name="password" id="passwordInput" class="form-control" required>
                </div>
                <span class="toggle-pass" onclick="togglePassword()"><i class="bi bi-eye"></i> Show/Hide Password</span>
            </div>
            <div class="col-12 col-md-6">
                <label class="form-label">Phone Number *</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-telephone"></i></span>
                    <input type="tel" name="phone" class="form-control" required>
                </div>
            </div>
            <div class="col-12 col-md-6">
                <label class="form-label">Date of Birth *</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-calendar-event"></i></span>
                    <input type="date" name="dob" class="form-control" required>
                </div>
            </div>
            <div class="col-12 col-md-6">
                <label class="form-label">Profile Image *</label>
                <input type="file" name="image" accept="image/*" class="form-control" onchange="previewImage(event)" required>
                <img id="imgPreview" src="#" style="display:none;">
            </div>
            <div class="col-12 col-md-6">
                <label class="form-label">Profile Color *</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-palette"></i></span>
                    <input type="color" name="profile_color" class="form-control form-control-color" required>
                </div>
            </div>
            <div class="col-12 col-md-6">
                <label class="form-label">Intro Video <span class="optional">(Optional - MP4 only)</span></label>
                <input type="file" name="intro_video" accept="video/mp4" class="form-control">
            </div>
            <div class="col-12">
                <label class="form-label">Favorite YouTube Video <span class="optional">(Embed link)</span></label>
                <textarea name="youtube_video" class="form-control" placeholder="https://www.youtube.com/embed/..."></textarea>
            </div>
            <div class="col-12">
                <label class="form-label">Bio <span class="optional">(Optional)</span></label>
                <textarea name="bio" rows="4" class="form-control" placeholder="Write something about the user..."></textarea>
            </div>
        </div>
        <button class="submit-btn mt-4"><i class="bi bi-save me-2"></i>Save User</button>
    </form>
</div>

<!-- Bootstrap JS Bundle -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
    function togglePassword() {
        const input = document.getElementById("passwordInput");
        input.type = input.type === "password" ? "text" : "password";
    }
    function previewImage(event) {
        const output = document.getElementById('imgPreview');
        output.style.display = 'block';
        output.src = URL.createObjectURL(event.target.files[0]);
    }
</script>

</body>
</html>
