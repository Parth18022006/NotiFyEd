<?php

header("Content-Type: application/json");

require_once "../../includes/init.php";

$Username = $_POST['Username'] ?? null;
$Password = $_POST['Password'] ?? null;

function trylogin($conn,$table,$Username,$Password){
    $q = "SELECT * FROM `$table` WHERE `Username` = ? AND `Password` = ?";
    $param = [$Username,$Password];

    $stmt = $conn->prepare($q);
    $stmt->execute($param);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

$user = trylogin($conn,"User",$Username,$Password);
if($user){
    $_SESSION['loggedIn'] = true;
    $_SESSION['user'] = $user['id'];
    $_SESSION['email'] = $user['Email'];
    $_SESSION['role'] = $user['role'];
    $_SESSION['Username'] = $user['Username'];
    $_SESSION['type'] = 'Admin';
    if($_SESSION['role'] == 'Super Admin'){
        $_SESSION['type2'] = 'Super Admin';
    }
    echo json_encode(['success' => true, 'user' => $user]);
    exit;
}
$user = trylogin($conn,"student",$Username,$Password);
if($user){
    $_SESSION['loggedIn'] = true;
    $_SESSION['user'] = $user['id'];
    $_SESSION['email'] = $user['Email'];
    $_SESSION['role'] = $user['role'];
    $_SESSION['Username'] = $user['Username'];
    $_SESSION['class'] = $user['Class'];
    $_SESSION['name'] = $user['Username'];
    $_SESSION['type'] = 'student';
    echo json_encode(['success' => true, 'user' => $user]);
    exit;
}

$foundUsername = false;

$q2 = "SELECT Username FROM `User` WHERE `Username` = ?";
$param = [$Username];

$stmt = $conn->prepare($q2);
$stmt->execute($param);

if($stmt->fetch()){
    $foundUsername = true;
}

$q3 = "SELECT Username FROM `student` WHERE `Username` = ?";
$param = [$Username];
$stmt = $conn->prepare($q3);
$stmt->execute($param);

if($stmt->fetch()){
    $foundUsername = true;
}

if($foundUsername){
    echo json_encode(['success' => false , 'reason' => 'Password']);
}else{
    echo json_encode(['success' => false , 'reason' => 'Username']);

}