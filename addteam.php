<?php
include "includes/db.php";
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $addteam = $_POST['addteam'];

    $stmt = $conn->prepare("INSERT INTO teams (class_name) VALUES (?)");
    $stmt->execute([$addteam]);

    header("Location: teams.php");
    exit();
}
?>
