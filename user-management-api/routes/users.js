// routes/users.js
const express = require('express');
const router = express.Router();
const db = require('../db');

// GET all users
router.get('/', async (req, res) => {
  const [users] = await db.query('SELECT * FROM users');
  res.json(users);
});

// POST create user
router.post('/', async (req, res) => {
  const { profile_title, name, email, phone, dob, image, color, bio } = req.body;
  await db.query(
    'INSERT INTO users (profile_title, name, email, phone, dob, image, color, bio) VALUES (?, ?, ?, ?, ?, ?, ?, ?)',
    [profile_title, name, email, phone, dob, image, color, bio]
  );
  res.status(201).json({ message: 'User created' });
});

// PUT update user
router.put('/:id', async (req, res) => {
  const { id } = req.params;
  const { profile_title, name, email, phone, dob, image, color, bio } = req.body;
  await db.query(
    'UPDATE users SET profile_title=?, name=?, email=?, phone=?, dob=?, image=?, color=?, bio=? WHERE id=?',
    [profile_title, name, email, phone, dob, image, color, bio, id]
  );
  res.json({ message: 'User updated' });
});

// DELETE user
router.delete('/:id', async (req, res) => {
  const { id } = req.params;
  await db.query('DELETE FROM users WHERE id=?', [id]);
  res.json({ message: 'User deleted' });
});

module.exports = router;
