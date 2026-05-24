<?php
include "db.php";

$id = $_GET['id'];

$sql = "DELETE FROM contacts WHERE id=:id";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':id',$id);

$stmt->execute();

header("Location: dashboard.php");
?>