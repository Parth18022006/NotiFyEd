<?php
require_once "../includes/init.php";
// session_start();

if (!isset($_SESSION['email']) || $_SESSION['role'] !== 'student') {
    echo json_encode(['success' => false, 'error' => 'Unauthorized']);
    exit;
}

$lastLogin = $_SESSION['last_login'];
$user_email = $_SESSION['email'];
$user_class = $_SESSION['class'];
$class_prefix = strtoupper(explode('-', $user_class)[0]);

$q1 = "SELECT title AS notice_title, publishDate AS date 
       FROM issue_notice 
       WHERE (targetClass = 'all' OR targetClass = ? OR targetClass = ?) 
       AND publishDate > ?";
$stmt1 = $conn->prepare($q1);
$stmt1->execute([$user_class, $class_prefix, $lastLogin]);
$general = $stmt1->fetchAll(PDO::FETCH_ASSOC);

$q2 = "SELECT notice_title, dateInput AS date 
       FROM issue_personal_notice 
       WHERE student_email = ? AND dateInput > ?";
$stmt2 = $conn->prepare($q2);
$stmt2->execute([$user_email, $lastLogin]);
$personal = $stmt2->fetchAll(PDO::FETCH_ASSOC);

$all = array_merge($general, $personal);
usort($all, fn($a, $b) => strtotime($b['date']) - strtotime($a['date']));

echo json_encode([
    'success' => true,
    'new_count' => count($all),
    'notices' =>$all
]);
