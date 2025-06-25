// routes/users.js
const express = require('express');
const router = express.Router();
const db = require('../db.js');

// GET all users
router.get('/', (req, res) => {
  db.query('SELECT * FROM users', (err, results) => {
    if (err) return res.status(500).send(err);
    res.json(results);
  });
});

// POST create user
router.post('/', (req, res) => {
  const {
    profile_title,
    name,
    email,
    password,
    image,
    dob,
    phone,
    intro_video,
    fav_video,
    bio,
    profile_color,
    status,
    created,
    updated,
    youtube_video
  } = req.body;

  const sql = `
    INSERT INTO users (
      profile_title, name, email, password, image, dob, phone,
      intro_video, fav_video, bio, profile_color, status,
      created, updated, youtube_video
    )
    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
  `;

  db.query(sql, [
    profile_title, name, email, password, image, dob, phone,
    intro_video, fav_video, bio, profile_color, status,
    created, updated, youtube_video
  ], (err, result) => {
    if (err) return res.status(500).send(err);
    res.json({ id: result.insertId, message: 'User added successfully' });
  });
});

// PUT update user
router.put('/:id', (req, res) => {
  const {
    profile_title,
    name,
    email,
    password,
    image,
    dob,
    phone,
    intro_video,
    fav_video,
    bio,
    profile_color,
    status,
    updated,
    youtube_video
  } = req.body;

  const sql = `
    UPDATE users SET
      profile_title = ?, name = ?, email = ?, password = ?, image = ?, dob = ?, phone = ?,
      intro_video = ?, fav_video = ?, bio = ?, profile_color = ?, status = ?, updated = ?, youtube_video = ?
    WHERE id = ?
  `;

  db.query(sql, [
    profile_title, name, email, password, image, dob, phone,
    intro_video, fav_video, bio, profile_color, status, updated, youtube_video,
    req.params.id
  ], (err) => {
    if (err) return res.status(500).send(err);
    res.json({ message: 'User updated successfully' });
  });
});

// DELETE user
router.delete('/:id', (req, res) => {
  db.query('DELETE FROM users WHERE id = ?', [req.params.id], (err) => {
    if (err) return res.status(500).send(err);
    res.json({ message: 'User deleted successfully' });
  });
});

module.exports = router;
