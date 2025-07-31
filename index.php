<?php
require_once "./includes/init.php";
include pathof('./includes/header.php');
include pathof('./includes/navbar.php');

$role = $_SESSION['role'];
$username = $_SESSION['Username'];
?>
<style>
  body {
    font-family: 'Poppins', sans-serif;
    background-color: #f4f0fa;
  }

  .text-purple {
    color: #6a00ff !important;
  }

  .main {
    padding: 2rem;
  }

  .card {
    border: none;
    border-radius: 20px;
    backdrop-filter: blur(12px);
    background: rgba(255, 255, 255, 0.5);
    box-shadow: 0 12px 30px rgba(106, 0, 255, 0.1);
    transition: all 0.3s ease;
  }

  .card:hover {
    transform: scale(1.01);
  }

  .card-title,
  .form-label,
  h2 {
    color: #6a00ff !important;
    font-weight: 600;
  }

  .btn-purple {
    background-color: #6a00ff;
    color: white;
    font-weight: 600;
    border-radius: 50px;
    border: none;
    transition: all 0.3s;
  }

  .btn-purple:hover {
    background-color: #5800cc;
    box-shadow: 0 6px 18px rgba(106, 0, 255, 0.3);
  }

  .form-control {
    border-radius: 50px;
    transition: border-color 0.3s ease, box-shadow 0.3s ease;
  }

  .form-control:focus {
    border-color: #6a00ff;
    box-shadow: 0 0 8px rgba(106, 0, 255, 0.4);
  }

  .nav-card {
    background-color: #fff;
    box-shadow: 0 6px 15px rgba(106, 0, 255, 0.1);
    border-radius: 16px;
    padding: 1rem 2rem;
    margin-bottom: 1.5rem;
    transition: box-shadow 0.3s ease, transform 0.3s ease;
  }

  .nav-card:hover {
    box-shadow: 0 8px 20px rgba(106, 0, 255, 0.15);
    transform: translateY(-2px);
  }

  .nav-link.text-purple {
    font-weight: 600;
    transition: all 0.3s ease;
    text-align: center;
  }

  .nav-link.text-purple:hover {
    color: #5800cc !important;
    transform: scale(1.05);
  }

  .navbar-toggler {
    border: none;
  }

  .navbar-toggler:focus {
    box-shadow: none;
  }

  p {
    font-size: 1.05rem;
    line-height: 1.6;
  }
</style>


<body>
  <div class="main container">
    <div class="card p-4">
      <h2 class="card-title mb-3">Welcome, <?= ucfirst($username); ?>!</h2>
      <p class="mb-1"><strong>You are logged in as:</strong> <span class="text-purple"><?= ucfirst($role); ?></span></p>

      <?php if (strtolower($role) === 'admin'): ?>
        <p class="mt-4">
        ➤ As an <strong>Admin</strong>, you can create, manage and schedule important notices, whether public or personal, for different classes. <br>
        ➤ Use the dashboard to post updates, track published notices, and engage effectively with students. <br>
        ➤ Ensure timely communication using categorized announcements.</p>
      <?php elseif (strtolower($role) === 'student'): ?>
        <p class="mt-4">
        ➤ As a <strong>Student</strong>, you can view all notices related to your class, Events, Exams, holidays, and personal Notices. <br>
        ➤ This system keeps you updated with important announcements. <br>
        ➤ Stay tuned and always check your dashboard for the latest info.</p>
      <?php else: ?>
        <p class="mt-4">Welcome to the Digital Notice Board system. Please use the navigation bar to access the features available to your role.</p>
      <?php endif; ?>
    </div>
  </div>

  <p class="text-center mt-3" style="font-size: 0.85rem; color: #888;">Powered by <span style="color: #6a00ff; font-weight: 600;">NotiFyEd</span></p>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
