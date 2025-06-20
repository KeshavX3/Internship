<?php
include 'db.php';

$id = $_POST['id'];

$sql = "SELECT * FROM users WHERE id = $id";
$result = $conn->query($sql);
$row = $result->fetch_assoc();

?>
<div>
    <h3><?php echo $row['name']; ?> (<?php echo $row['profile_title']; ?>)</h3>
    <p><strong>Email:</strong> <?php echo $row['email']; ?></p>
    <p><strong>Phone:</strong> <?php echo $row['phone']; ?></p>
    <p><strong>DOB:</strong> <?php echo $row['dob']; ?></p>
    <p><strong>Color:</strong> <span style="background:<?php echo $row['profile_color']; ?>;padding:5px 10px;border-radius:4px;"></span></p>
    <p><strong>Bio:</strong> <?php echo $row['bio']; ?></p>
    <p><strong>Favorite Video:</strong> <br><iframe width="250" src="<?php echo $row['youtube_video']; ?>"></iframe></p>
    <p><strong>Intro Video:</strong><br>
        <?php if ($row['intro_video']) { ?>
            <video width="250" controls>
                <source src="uploads/<?php echo $row['intro_video']; ?>" type="video/mp4">
            </video>
        <?php } else { echo "No video uploaded."; } ?>
    </p>
</div>
