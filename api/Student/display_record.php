<?php

require_once "../../includes/init.php";

header("Content-Type: application/json");

$q = "SELECT `id`, `Username`, `Email`, `Class` FROM `student`";

$stmt = $conn->prepare($q);
$stmt->execute();

$student = $stmt->fetchAll(PDO::FETCH_ASSOC);

if($student != null){
    echo json_encode(['success' => true, 'student' => $student]);
}else{
    echo json_encode(['success' => false, 'message' => "Student Not Displayed"]);

}
?>