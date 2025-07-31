<?php

header("Content-Type: application/json");

require_once "../../includes/init.php";

$Username = $_POST['Username'] ?? null;
$Email = $_POST['Email'] ?? null;
$Class = $_POST['Class'] ?? null;
$Password = $_POST['Password'] ?? null;

$q = "INSERT INTO `student`(`Username`, `Email`, `Class`, `Password`) VALUES (?,?,?,?)";
$param = [$Username,$Email,$Class,$Password];

$stmt = $conn->prepare($q);
$student = $stmt->execute($param);

if($student > 0){
    echo json_encode(['success' => true, 'message' => "Student Registered"]);
}else{
    echo json_encode(['success' => false, 'message' => "Student Not Registered"]);
}
?>