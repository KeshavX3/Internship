<?php include 'db.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Users List</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background: transparent;
        }
        .glass-card {
            background: #f8fafc;
            box-shadow: 0 4px 24px 0 rgba(31, 38, 135, 0.08);
            border-radius: 1.2rem;
            border: 1px solid #e3e8ef;
            padding: 2.5rem 2vw 2.5rem 2vw;
            margin: 2.5rem auto 0 auto;
            max-width: 98vw;
            width: 100%;
        }
        h2 {
            text-align: center;
            margin-bottom: 40px;
            color: #185a9d;
            font-weight: 700;
            letter-spacing: 1px;
            font-size: 2.2rem;
        }
        .table {
            background: rgba(255,255,255,0.97);
            border-radius: 1.5rem;
            overflow: hidden;
            box-shadow: 0 0 18px rgba(0,0,0,0.07);
            margin-bottom: 0;
            width: 100%;
        }
        .table th {
            background: linear-gradient(90deg, #43cea2 0%, #185a9d 100%);
            color: #fff;
            font-weight: 700;
            border: none;
            text-align: center !important;
            vertical-align: middle !important;
            font-size: 1.15rem;
            padding: 22px 18px;
        }
        .table td, .table th {
            vertical-align: middle !important;
            text-align: center !important;
            font-size: 1.08rem;
            padding: 20px 16px;
        }
        .table-hover tbody tr:hover {
            background: rgba(38,166,154,0.10);
            transition: background 0.2s;
        }
        img.thumb {
            width: 56px;
            height: 56px;
            min-width: 56px;
            min-height: 56px;
            border-radius: 50%;
            object-fit: cover;
            box-shadow: 0 0 6px rgba(0, 0, 0, 0.13);
            transition: transform 0.2s ease;
            background-color: #f1f1f1; /* subtle background to avoid flicker */
}

        }
        .color-box {
            width: 32px;
            height: 32px;
            border-radius: 8px;
            border: 1px solid #ccc;
            margin: auto;
        }
        .btn {
            font-size: 1.08rem;
            border-radius: 10px;
            margin: 2px 4px;
            padding: 8px 16px;
        }
        .editBtn {
            background: #43cea2;
            color: #fff;
        }
        .editBtn:hover {
            background: #2fa07a;
            color: #fff;
        }
        .deleteBtn {
            background: #f44336;
            color: #fff;
        }
        .deleteBtn:hover {
            background: #c62828;
            color: #fff;
        }
        .viewBtn {
            background: #185a9d;
            color: #fff;
        }
        .viewBtn:hover {
            background: #0d305c;
            color: #fff;
        }
        @media (max-width: 991.98px) {
            .glass-card {
                padding: 1.2rem 0.7rem;
                max-width: 100vw;
            }
            .table th, .table td {
                font-size: 1rem;
                padding: 10px 6px;
            }
        }
        @media (max-width: 767.98px) {
            .glass-card {
                padding: 0.7rem 0.1rem;
                max-width: 100vw;
            }
            .table th, .table td {
                font-size: 0.95rem;
                padding: 7px 3px;
            }
        }
    </style>
</head>
<body>

<div class="glass-card">
    <h2><i class="bi bi-people-fill me-2"></i>Users Directory</h2>
    <div class="table-responsive">
        <table id="usersTable" class="table table-hover align-middle mb-0">
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
                    if (!empty($row['image'])) {
                        $optimizedImage = str_replace('/upload/', '/upload/w_80,h_80,c_fill,q_auto,f_auto/', $row['image']);
                        echo "<img src='{$optimizedImage}' alt='profile' class='thumb profile-pic' data-fallback='https://via.placeholder.com/50'>";
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
                            <a href='edit-user.php?id={$row['id']}' class='btn editBtn' title='Edit'><i class='bi bi-pencil-square'></i></a>
                            <a href='view-user.php?id={$row['id']}' class='btn viewBtn' title='View'><i class='bi bi-eye'></i></a>
                            <button class='btn deleteBtn' data-id='{$row['id']}' title='Delete'><i class='bi bi-trash'></i></button>
                          </td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

<!-- User Profile Modal -->
<div class="modal fade" id="userProfileModal" tabindex="-1" aria-labelledby="userProfileModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl modal-dialog-centered">
    <div class="modal-content border-0 rounded-4 shadow-lg">
      <div class="modal-header border-0">
        <h5 class="modal-title" id="userProfileModalLabel"><i class="bi bi-person-circle me-2"></i>User Profile</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body p-0" id="userProfileModalBody" style="background:#f8fafc;"></div>
    </div>
  </div>
</div>

<!-- Bootstrap JS Bundle -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
    $(document).ready(() => {
        $('#usersTable').DataTable({
            "order": [[0, "desc"]]
        });

        // View User Modal AJAX
        $(document).on('click', '.viewBtn', function (e) {
            e.preventDefault();
            const url = $(this).attr('href');
            const id = url.split('=')[1];
            $('#userProfileModalBody').html('<div class="text-center p-5"><div class="spinner-border text-primary" role="status"></div></div>');
            $('#userProfileModal').modal('show');
            $.post('view-user-modal.php', { id: id }, function (data) {
                $('#userProfileModalBody').html(data);
            });
        });

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
