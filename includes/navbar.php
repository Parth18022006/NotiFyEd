<?php
if(isset($_SESSION['role']) && $_SESSION['role'] == 'admin'){
  ?><div class="text-center py-3" style="font-size: 1.8rem; font-weight: 700; color: #6a00ff;">
  NotiFyEd Admin
</div><?php
}else{
  ?><div class="text-center py-3" style="font-size: 1.8rem; font-weight: 700; color: #6a00ff;">
  NotiFyEd Student
</div><?php
}
?>
<div class="container">
  <div class="nav-card">
    <nav class="navbar navbar-expand-lg">
      <div class="container-fluid px-0">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav justify-content-around w-100">
            <?php
            if($_SESSION['role'] == 'admin'){
              ?><li class="nav-item">
              <a class="nav-link text-purple" href="<?= urlof('./pages/post_note.php')?>">Post Notice</a>
            </li><?php
            }
            ?>
            
            <li class="nav-item">
              <a class="nav-link text-purple" href="<?= urlof('./pages/all_note.php')?>">All Notices</a>
            </li>
            <li class="nav-item">
              <a class="nav-link text-purple" href="<?= urlof('./index.php')?>">Dashboard</a>
            </li>
            <?php
            if($_SESSION['role'] == 'admin'){
              ?><li class="nav-item">
              <a class="nav-link text-purple" href="<?= urlof('./pages/personal.php')?>">Personal Notice</a>
            </li><?php
            }
            ?>
            
            <?php
            if($_SESSION['role'] == 'student'){
              ?><li class="nav-item">
              <a class="nav-link text-purple" href="<?= urlof('./pages/feedback.php');?>">Feedback</a>
            </li><?php
            }else{ ?>
            <li class="nav-item">
              <a class="nav-link text-purple" href="<?= urlof('./pages/feedback_admin.php');?>">Feedbacks</a>
            </li>
            <li class="nav-item">
              <a class="nav-link text-purple" href="<?= urlof('./pages/Student/register.php');?>">Add Student</a>
            </li>
            <li class="nav-item">
              <a class="nav-link text-purple" href="<?= urlof('./pages/User/register.php');?>">Add Admin</a>
            </li>

            <?php

            }
            ?>
            
            <li class="nav-item">
              <a class="nav-link text-purple" href="<?= urlof('./api/user/logout.php');?>" onclick="return confirm('Sure! You Want To Logout.');">Logout</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
  </div>
</div>
