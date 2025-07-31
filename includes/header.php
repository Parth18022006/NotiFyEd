<?php
$url = urlof('pages/User/login.php');
if (!isset($_SESSION['user'])) {
    header("Location: $url");
    exit;
}
?><!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>NotiFyEd</title>
  <link rel="icon" href="<?= urlof('./assets/img/WhatsApp Image 2025-07-27 at 13.07.31_5d8d0ddf.png')?>" type="image/x-icon">


  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />

  <link href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.4.0/css/all.min.css" rel="stylesheet" />

  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">

   <link rel="stylesheet" href="<?= urlof('./assets/css/nav.css')?>">

   <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
