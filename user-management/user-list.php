<?php include 'db.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Users List</title>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <style>
        body {
            font-family: 'Inter', sans-serif;
            padding: 30px;
            background: #f5f7fa;
        }
        h2 {
            text-align: center;
            margin-bottom: 30px;
            color: #00796b;
        }
        table {
            background: #fff;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 0 12px rgba(0,0,0,0.1);
        }
        table th, table td {
            padding: 12px 14px;
            vertical-align: middle;
            text-align: center;
        }
        table th {
            background: #00796b;
            color: white;
        }
        img.thumb {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            object-fit: cover;
            box-shadow: 0 0 4px rgba(0,0,0,0.1);
        }
        .color-box {
            width: 30px;
            height: 30px;
            border-radius: 6px;
            border: 1px solid #ccc;
            margin: auto;
        }
        .btn {
            padding: 6px 10px;
            font-size: 0.85rem;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            margin: 2px;
            display: inline-block;
            text-decoration: none;
        }
        .editBtn {
            background: #4caf50;
            color: #fff;
        }
        .deleteBtn {
            background: #f44336;
            color: #fff;
        }
        .viewBtn {
            background: #2196f3;
            color: #fff;
        }
    </style>
</head>
<body>

<h2>📋 Users Directory</h2>

<table id="usersTable" class="display">
    <thead>
        <tr>
            <th>ID</th>
            <th>Profile</th>
            <th>Name</th>
            <th>Email</th>
            <th>DOB</th>
            <th>Phone</th>
            <th>Color</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $sql = "SELECT * FROM users ORDER BY id DESC";
        $result = $conn->query($sql);

        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>{$row['id']}</td>";
            echo "<td>";
            if (!empty($row['image']) && file_exists('uploads/' . $row['image'])) {
                echo "<img src='uploads/{$row['image']}' alt='img' class='thumb'>";
            } else {
                echo "<img src='https://via.placeholder.com/50' alt='img' class='thumb'>";
            }
            echo "</td>";
            echo "<td>{$row['name']}</td>";
            echo "<td><a href='mailto:{$row['email']}'>{$row['email']}</a></td>";
            echo "<td>{$row['dob']}</td>";
            echo "<td><a href='tel:{$row['phone']}'>{$row['phone']}</a></td>";
            echo "<td><div class='color-box' style='background: {$row['profile_color']};'></div></td>";
            echo "<td>
                    <a href='edit-user.php?id={$row['id']}' class='btn editBtn'>✏️ Edit</a>
                    <a href='view-user.php?id={$row['id']}' class='btn viewBtn'>👁 View</a>
                    <button class='btn deleteBtn' data-id='{$row['id']}'>🗑 Delete</button>
                  </td>";
            echo "</tr>";
        }
        ?>
    </tbody>
</table>

<script>
    $(document).ready(() => {
        $('#usersTable').DataTable();

        // Delete AJAX
        $(document).on('click', '.deleteBtn', function () {
            const userId = $(this).data('id');
            if (confirm('Are you sure you want to delete this user?')) {
                $.post('delete-user.php', { id: userId }, function (response) {
                    if (response.trim() === 'success') {
                        alert('User deleted successfully.');
                        location.reload();
                    } else {
                        alert('Failed to delete user.');
                    }
                });
            }
        });
    });
</script>

</body>
</html>
