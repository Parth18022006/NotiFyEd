<?php

header("Content-Type: application/json");

require_once "../../includes/init.php";

$student_name = $_POST['student_name'] ?? null;
$student_email = $_POST['student_email'] ?? null;
$notice_title = $_POST['notice_title'] ?? null;
$category = $_POST['category'] ?? null;
$faculty = $_POST['faculty'] ?? null;
$noticeBody = $_POST['noticeBody'] ?? null;
$dateInput = $_POST['dateInput'] ?? null;
$dayInput = $_POST['dayInput'] ?? null;

$q = "INSERT INTO `issue_personal_notice`(`student_name`, `student_email`, `notice_title`, `category`, `faculty`, `noticeBody`, `dateInput`, `dayInput`) VALUES (?,?,?,?,?,?,?,?)";
$param = [$student_name,$student_email,$notice_title,$category,$faculty,$noticeBody,$dateInput,$dayInput];

$stmt = $conn->prepare($q);
$stmt->execute($param);

$pstud = $stmt->fetchAll(PDO::FETCH_ASSOC);

if($pstud){
    echo json_encode(['success' => true, 'message' => "Notice Issued"]);
}else{
    echo json_encode(['success' => false, 'message' => "Notice Not Issued"]);
}
?>