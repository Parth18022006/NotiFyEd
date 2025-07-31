<?php

require_once "../../includes/init.php";

header("Content-Type: application/json");

$q = "SELECT * FROM `feedback`";

$stmt = $conn->prepare($q);
$stmt->execute();

$feedbacks = $stmt->fetchAll(PDO::FETCH_ASSOC);

if($feedbacks != null){
    echo json_encode(['success' => true, 'feedbacks' => $feedbacks]);
}else{
    echo json_encode(['success' => false, 'message' => "Feedback Not Displayed"]);
}
?>