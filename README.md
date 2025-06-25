# User Management POC

## Project Overview
This project is a Proof of Concept (POC) for a complete User Management System, demonstrating a full-stack workflow using HTML5, PHP, MySQL, Node.js, and Angular. The project is divided into several steps, each focusing on a different technology stack and feature set.

---

## Project Structure

```
MyProjects/
  ├── user-management/         # PHP + MySQL (HTML5, server-side rendering)
  ├── user-management-api/     # Node.js REST API (CRUD, image upload)
  └── user-management-ng/      # Angular (Not implemented yet)
```

---

## 1. user-management (PHP + MySQL)
This module implements the user management system using PHP and MySQL with classic server-side rendering.

### Features Implemented
- **User Listing**: Paginated, sortable, and searchable user table with fields: Image, Name, Email, DOB, Actions (View, Edit, Delete)
- **Add User**: Form to add a new user with fields: profile title, name, email, password, image, DOB, phone, intro video, favorite video, bio, and profile color
- **Edit User**: Edit form with prefilled data
- **Delete User**: Confirmation dialog and delete without page refresh
- **View User**: Modal popup with user details
- **File Uploads**: Image and video upload support
- **Validation**: Server-side validation for required fields

### Files
- `index.html` - Main entry point
- `add-user.php`, `edit-user.php`, `view-user.php`, `view-user-modal.php` - User CRUD pages
- `user-list.php` - User listing with pagination
- `save_user.php`, `update-user.php`, `delete-user.php` - Backend logic for CRUD
- `db.php` - Database connection
- `uploads/` - Uploaded files (images, videos)

---

## 2. user-management-api (Node.js + Express)
This module provides a RESTful API for user management, intended for use with the Angular frontend (to be implemented).

### Features Implemented
- **CRUD Operations**: Create, Read, Update, Delete users via REST API
- **Image Upload**: Upload user images (Cloudinary/S3 integration)
- **Delete Image**: Remove images from storage
- **API Endpoints**: `/users`, `/upload`

### Files
- `index.js` - Main server entry
- `db.js` - Database connection
- `routes/users.js` - User CRUD routes
- `routes/upload.js` - Image upload routes
- `utils/cloudinary.js` - Cloudinary integration

---

## 3. user-management-ng (Angular)
**Note:** This part is not yet implemented.

### Planned Features
- Angular frontend for user management
- Material Design UI
- Integration with Node.js API for CRUD operations
- Admin dashboard, user add/edit forms, and authentication

---

## Setup Instructions

### PHP + MySQL (user-management)
1. Set up a local web server (XAMPP/WAMP/LAMP)
2. Import the MySQL database (create `poc` DB and `users` table as per requirements)
3. Place the `user-management` folder in your web root
4. Update `db.php` with your database credentials
5. Access via `http://localhost/user-management/index.html`

### Node.js API (user-management-api)
1. Navigate to `user-management-api`
2. Run `npm install` to install dependencies
3. Configure environment variables for DB and Cloudinary/S3
4. Start the server: `node index.js`

### Angular (user-management-ng)
- **Not implemented yet**

---

## Progress & Next Steps
- [x] PHP + MySQL implementation (user-management)
- [x] Node.js REST API (user-management-api)
- [ ] Angular frontend (user-management-ng) **(To be implemented)**
