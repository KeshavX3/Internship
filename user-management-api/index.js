const express = require('express');
const cors = require('cors');
const bodyParser = require('body-parser');
require('dotenv').config();

const uploadRoute = require('./routes/upload');
const usersRoute = require('./routes/users'); 

const app = express();
app.use(cors());
app.use(bodyParser.json());

// Mount your routes
app.use('/api/upload', uploadRoute);      // Upload
app.use('/api/users', usersRoute);        // Users CRUD

app.listen(3000, () => {
  console.log('🚀 User Management API running on port 3000');
});
