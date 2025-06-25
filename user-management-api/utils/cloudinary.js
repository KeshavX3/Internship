require('dotenv').config(); // Load environment variables

const cloudinary = require('cloudinary').v2;
const { CloudinaryStorage } = require('multer-storage-cloudinary');

// Cloudinary configuration
cloudinary.config({
  cloud_name: process.env.CLOUDINARY_CLOUD_NAME,
  api_key: process.env.CLOUDINARY_API_KEY,
  api_secret: process.env.CLOUDINARY_API_SECRET
});

// Setup for file uploads (image, video etc.)
const storage = new CloudinaryStorage({
  cloudinary,
  params: {
    folder: 'user-profile-uploads', // Folder name in Cloudinary
    allowed_formats: ['jpg', 'png', 'jpeg', 'mp4']
  }
});

module.exports = {
  cloudinary,
  storage
};
