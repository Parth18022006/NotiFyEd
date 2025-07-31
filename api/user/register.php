<?php

header("Content-Type: application/json");

require_once "../../includes/init.php";

$Username = $_POST['Username'] ?? null;
$Email = $_POST['Email'] ?? null;
$Password = $_POST['Password'] ?? null;

$q = "INSERT INTO `user`(`Username`, `Email`, `Password`) VALUES (?,?,?)";
$param = [$Username,$Email,$Password];

$stmt = $conn->prepare($q);
$user = $stmt->execute($param);

if($user > 0){
    echo json_encode(['success' => true, 'message' => "User Registered"]);
}else{
    echo json_encode(['success' => false, 'message' => "User Not Registered"]);
}
?>