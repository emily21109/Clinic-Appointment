<?php
session_start();
include "db.php";

if (!isset($_SESSION["username"])) {
    header("Location: signin.php");
    exit();
}

$id = $_GET["id"];

$stmt = $conn->prepare("DELETE FROM appointments WHERE id=?");
$stmt->bind_param("i", $id);
$stmt->execute();

header("Location: clinic.php");
