<?php
session_start();
include "db.php";

if(!isset($_SESSION['admin'])){
    header("Location: login.php");
    exit();
}

$sql = "SELECT * FROM contacts ORDER BY id DESC";
$stmt = $conn->prepare($sql);
$stmt->execute();
$messages = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
  <div class="d">
    <h2>Admin Dashboard</h2>
<a href="logout.php">Logout</a>
</div>
<table border="1" cellpadding="10">
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Email</th>
        <th>Subject</th>
        <th>Message</th>
        <th>Action</th>
    </tr>

    <?php foreach($messages as $msg): ?>
    <tr>
        <td><?= $msg['id'] ?></td>
        <td><?= $msg['name'] ?></td>
        <td><?= $msg['email'] ?></td>
        <td><?= $msg['subject'] ?></td>
        <td><?= $msg['message'] ?></td>
        <td>
            <a href="delete.php?id=<?= $msg['id'] ?>">Delete</a>
            <a href="reply.php?id=<?= $msg['id'] ?>">Reply</a>
        </td>
    </tr>
    <?php endforeach; ?>
</table>
</body>
</html>