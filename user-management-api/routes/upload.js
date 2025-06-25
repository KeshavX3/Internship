// routes/upload.js
const express = require('express');
const multer = require('multer');
const { cloudinary } = require('../utils/cloudinary');
const db = require('../db');
const router = express.Router();
const streamifier = require('streamifier');

// Use memory storage (no local uploads/)
const storage = multer.memoryStorage();
const upload = multer({ storage });

// POST /api/upload/:id
router.post('/:id', upload.single('image'), async (req, res) => {
  try {
    const userId = req.params.id;
    const fileBuffer = req.file.buffer;

    // Upload directly from memory to Cloudinary
    const streamUpload = (buffer) => {
      return new Promise((resolve, reject) => {
        const stream = cloudinary.uploader.upload_stream(
          { folder: 'users' }, // Optional: Save in Cloudinary 'users' folder
          (error, result) => {
            if (result) {
              resolve(result);
            } else {
              reject(error);
            }
          }
        );
        streamifier.createReadStream(buffer).pipe(stream);
      });
    };

    const result = await streamUpload(fileBuffer);
    const imageUrl = result.secure_url;

    // Update user's image in DB
    const sql = 'UPDATE users SET image = ? WHERE id = ?';
    db.query(sql, [imageUrl, userId], (err, _) => {
      if (err) {
        return res.status(500).json({ message: 'DB error', error: err });
      }

      res.json({
        success: true,
        message: 'Image uploaded to Cloudinary and user updated in DB',
        imageUrl,
      });
    });
  } catch (err) {
    console.error('Upload error:', err);
    res.status(500).json({ success: false, message: 'Upload failed', error: err });
  }
});

module.exports = router;
