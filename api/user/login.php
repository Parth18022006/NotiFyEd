<?php

header("Content-Type: application/json");

require_once "../../includes/init.php";

$Username = $_POST['Username'] ?? null;
$Password = $_POST['Password'] ?? null;
$userType = $_POST['user_type'] ?? null;

if (!$userType) {
    echo json_encode(['success' => false, 'reason' => 'NoUserType']);
    exit;
}

if ($userType === 'admin') {
    $table = "User";
} elseif ($userType === 'student') {
    $table = "student";
} else {
    echo json_encode(['success' => false, 'reason' => 'InvalidType']);
    exit;
}

$q = "SELECT * FROM `$table` WHERE `Username` = ? and `Password` = ? ";
$param = [$Username,$Password];

$stmt = $conn->prepare($q);
$stmt->execute($param);

$user = $stmt->fetch(PDO::FETCH_ASSOC);

if($user){
    $_SESSION['loggedIn'] = true;
    $_SESSION['user'] = $user['id'];
    $_SESSION['email'] = $user['Email'];
    $_SESSION['role'] = $userType;
    $_SESSION['Username'] = $user['Username'];
    if($userType == 'student'){
        $_SESSION['class'] = $user['Class']; 
        $_SESSION['name'] = $user['Username'];

        $_SESSION['last_login'] = $user['last_login'];

        $updateLogin = $conn->prepare("UPDATE student SET last_login = NOW() WHERE id = ?");
        $updateLogin->execute([$user['id']]);
    }
    echo json_encode(['success' => true, 'user' => $user ,'session_after_set' => $_SESSION ]);
    exit;
}else{

    $q2 = "SELECT * FROM `$table` WHERE `Username` = ?";

    $stmt2= $conn->prepare($q2);
    $stmt2->execute([$Username]);
    $checkusername = $stmt2->fetch(PDO::FETCH_ASSOC);

    if (!$checkusername) {
        echo json_encode(['success' => false, 'reason' => 'Username']);
    } else {
        echo json_encode(['success' => false, 'reason' => 'Password']);
    }
}