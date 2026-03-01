<?php
include 'db.php';
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
if ($id) {
    $conn->query("DELETE FROM users WHERE id=$id");
    // resequence ids to remove gaps
    $conn->query("SET @count = 0");
    $conn->query("UPDATE users SET id = @count:=@count+1");
    $conn->query("ALTER TABLE users AUTO_INCREMENT = 1");
}
header("Location: VIEW.php?msg=deleted");
exit;
?>