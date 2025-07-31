<?php
header("Content-Type: application/json");

require_once "../../includes/init.php";

$title = $_POST['title'] ?? null;
$category = $_POST['category'] ?? null;
$description = $_POST['description'] ?? null;
$submitted_by = $_POST['submitted_by'] ?? null;
$date = $_POST['date'] ?? null;

$q = "INSERT INTO `feedback`(`title`, `category`, `description`, `submitted_by`, `submit_date`) VALUES (?,?,?,?,?)";
$param = [$title,$category,$description,$submitted_by,$date];

$stmt = $conn->prepare($q);
$stmt->execute($param);

$feedback = $stmt->fetchAll(PDO::FETCH_ASSOC);

if($feedback){
    echo json_encode(['success' => true, 'message' => "Feedback Sent"]);
}else{
    echo json_encode(['success' => false, 'message' => "Feedback Not Sent"]);
}
?>