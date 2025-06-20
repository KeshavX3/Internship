<?php include 'db.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add User</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">
    <style>
        body {
            margin: 0;
            padding: 40px;
            background: #f5f7fa;
            font-family: 'Inter', sans-serif;
        }
        .form-wrapper {
            max-width: 600px;
            margin: auto;
            background: #fff;
            padding: 30px 40px;
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
        }
        h2 {
            text-align: center;
            color: #00796b;
            margin-bottom: 25px;
        }
        .form-group {
            margin-bottom: 20px;
        }
        label {
            font-weight: 600;
            display: block;
            margin-bottom: 6px;
            color: #333;
        }
        input, textarea, select {
            width: 100%;
            padding: 12px 14px;
            font-size: 1rem;
            border: 1px solid #ccc;
            border-radius: 8px;
            background: #f9f9f9;
        }
        textarea {
            resize: vertical;
        }
        .form-group img {
            margin-top: 10px;
            max-width: 120px;
            border-radius: 8px;
            box-shadow: 0 2px 6px rgba(0,0,0,0.1);
        }
        .submit-btn {
            width: 100%;
            padding: 14px;
            background: #00796b;
            color: white;
            font-size: 1.1rem;
            font-weight: bold;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            transition: background 0.3s;
        }
        .submit-btn:hover {
            background: #005b4f;
        }
        .toggle-pass {
            margin-top: 6px;
            font-size: 0.85rem;
            color: #555;
            cursor: pointer;
        }
        .optional {
            font-weight: normal;
            font-size: 0.85rem;
            color: #888;
        }
    </style>
</head>
<body>

<div class="form-wrapper">
    <h2>➕ Add New User</h2>

    <form action="save_user.php" method="POST" enctype="multipart/form-data" id="userForm">
        
        <div class="form-group">
            <label>Profile Title *</label>
            <input type="text" name="profile_title" required>
        </div>

        <div class="form-group">
            <label>Name *</label>
            <input type="text" name="name" required>
        </div>

        <div class="form-group">
            <label>Email *</label>
            <input type="email" name="email" required>
        </div>

        <div class="form-group">
            <label>Password *</label>
            <input type="password" name="password" id="passwordInput" required>
            <span class="toggle-pass" onclick="togglePassword()">👁 Show/Hide Password</span>
        </div>

        <div class="form-group">
            <label>Phone Number *</label>
            <input type="tel" name="phone" required>
        </div>

        <div class="form-group">
            <label>Date of Birth *</label>
            <input type="date" name="dob" required>
        </div>

        <div class="form-group">
            <label>Profile Image *</label>
            <input type="file" name="image" accept="image/*" onchange="previewImage(event)" required>
            <img id="imgPreview" src="#" style="display:none;">
        </div>

        <div class="form-group">
            <label>Profile Color *</label>
            <input type="color" name="profile_color" required>
        </div>

        <div class="form-group">
            <label>Intro Video <span class="optional">(Optional - MP4 only)</span></label>
            <input type="file" name="intro_video" accept="video/mp4">
        </div>

        <div class="form-group">
            <label>Favorite YouTube Video <span class="optional">(Embed link)</span></label>
            <textarea name="youtube_video" placeholder="https://www.youtube.com/embed/..."></textarea>
        </div>

        <div class="form-group">
            <label>Bio <span class="optional">(Optional)</span></label>
            <textarea name="bio" rows="4" placeholder="Write something about the user..."></textarea>
        </div>

        <button class="submit-btn">Save User</button>

    </form>
</div>

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
