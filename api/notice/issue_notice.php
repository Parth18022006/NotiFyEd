<?php

header("Content-Type: application/json");

require_once "../../includes/init.php";

$title = $_POST['title'] ?? null;
$noticeCategory = $_POST['noticeCategory'] ?? null;
$facultyName = $_POST['facultyName'] ?? null;
$targetClass = $_POST['targetClass'] ?? null;
$noticeBody = $_POST['noticeBody'] ?? null;
$noticeDay = $_POST['noticeDay'] ?? null;
$publishDate = $_POST['publishDate'] ?? null;

$q = "INSERT INTO `issue_notice`(`title`, `noticeCategory`, `facultyName`, `targetClass`, `noticeBody`, `noticeDay`, `publishDate`) VALUES (?,?,?,?,?,?,?)";
$param = [$title,$noticeCategory,$facultyName,$targetClass,$noticeBody,$noticeDay,$publishDate];

$stmt = $conn->prepare($q);
$notice = $stmt->execute($param);

if($notice){
    echo json_encode(['success' => true, 'message' => "Notice Issued"]);
}else{
    echo json_encode(['success' => false, 'message' => "Notice Not Issued"]);

}

?>