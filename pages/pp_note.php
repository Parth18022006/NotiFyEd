<?php
require_once "../includes/init.php";
include pathof('./includes/header.php');
include pathof('./includes/navbar.php');

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$q = "SELECT * FROM `student` WHERE id = $id";

$stmt = $conn->prepare($q);
$stmt->execute();

$fstud = $stmt->fetch(PDO::FETCH_ASSOC);

$q2 = "SELECT Username FROM `user` WHERE role = 'Admin'";

$stmt = $conn->prepare($q2);
$stmt->execute();

$admin = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
  <style>
    body {
      font-family: 'Poppins', sans-serif;
      background-color: #f4f0fa;
      padding: 2rem;
    }

    .form-container {
      background: rgba(255, 255, 255, 0.6);
      backdrop-filter: blur(8px);
      border-radius: 20px;
      box-shadow: 0 10px 30px rgba(106, 0, 255, 0.1);
      padding: 2rem 2rem;
      max-width: 800px;
      margin: auto;
    }

    h2 {
      color: #6a00ff;
      font-weight: 600;
      text-align: center;
      margin-bottom: 2rem;
    }

    .form-label {
      font-weight: 500;
      color: #6a00ff;
    }

    .form-control:focus,
    .form-select:focus {
      border-color: #6a00ff;
      box-shadow: 0 0 10px rgba(106, 0, 255, 0.2);
    }

    .form-select,
    .form-control[readonly] {
      background-color: #f5f0ff;
    }

    .btn-purple {
      background-color: #6a00ff;
      color: white;
      font-weight: 500;
      border-radius: 50px;
      transition: all 0.3s ease;
      padding: 0.5rem 2rem;
    }

    .btn-purple:hover {
      background-color: #5800cc;
      box-shadow: 0 6px 12px rgba(106, 0, 255, 0.2);
      transform: scale(1.03);
    }

    .back-btn {
      display: inline-block;
      color: #6a00ff;
      font-weight: 500;
      margin-bottom: 1rem;
      text-decoration: none;
      transition: all 0.3s ease;
    }

    .back-btn:hover {
      text-decoration: underline;
      color: #5800cc;
    }

    @media (max-width: 768px) {
      .form-container {
        padding: 1.5rem;
      }
    }
  </style>
</head>
<body>

  <div class="form-container">
    <h2>📢 Post Personal Notice</h2>

    <form method="POST">
      
      <div class="mb-3">
        <label class="form-label">To Student</label>
        <input type="text" name="student_name" class="form-control" value="<?= $fstud['Username']?>" id="student_name" readonly />
      </div>

      
      <div class="mb-3">
        <label class="form-label">Email</label>
        <input type="email" name="student_email" class="form-control" value="<?= $fstud['Email']?>" id="student_email" readonly />
      </div>

      
      <div class="mb-3">
        <label class="form-label">Notice Title</label>
        <input type="text" name="notice_title" class="form-control" placeholder="Enter notice title" id="notice_title"/>
      </div>

      
      <div class="mb-3">
        <label class="form-label">Category</label>
        <select name="category" class="form-select" id="category">
          <option selected disabled>Select Category</option>
          <option value="Personal">Personal</option>
          <option value="General">General</option>
          <option value="Important">Important</option>
          <option value="Special">Special</option>
        </select>
      </div>

      
      <div class="mb-3">
        <label class="form-label">Sender Faculty</label>
        <select name="faculty" class="form-select" id="faculty">
          <option selected disabled>Select Faculty</option>
          <?php foreach ($admin as $a) : ?>
              <option value="<?= htmlspecialchars($a['Username']); ?>">
                <?= htmlspecialchars($a['Username']); ?>
              </option>
            <?php endforeach; ?>
        </select>
      </div>

      
      <div class="mb-3">
        <label class="form-label">Notice Description</label>
        <textarea name="noticeBody" id="noticeBody" class="form-control" rows="4" placeholder="Write the notice here..."></textarea>
      </div>

      
      <div class="mb-3">
        <label class="form-label">Date</label>
        <input type="date" id="dateInput" name="dateInput" class="form-control"/>
      </div>

      
      <div class="mb-4">
        <label class="form-label">Day</label>
        <input type="text" id="dayInput" name="dayInput" class="form-control" placeholder="Auto-filled from publish date" readonly />
      </div>

      <small id="emsg" style="color: red;" class="text-danger d-block text-center w-100"></small><br>

      
      <div class="text-center">
        <button type="button" class="btn btn-purple" onclick="Post()">Post Notice</button>
      </div>
    </form>
  </div>

  <p class="text-center mt-3" style="font-size: 0.85rem; color: #888;">Powered by <span style="color: #6a00ff; font-weight: 600;">NotiFyEd</span></p>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

  
  <script>

    function Post(){

      let student_name = document.getElementById('student_name').value;
      let student_email = document.getElementById('student_email').value;
      let notice_title = document.getElementById('notice_title').value;
      let category = document.getElementById('category').value;
      let faculty = document.getElementById('faculty').value;
      let noticeBody = document.getElementById('noticeBody').value;
      let dateInput = document.getElementById('dateInput').value;
      let dayInput = document.getElementById('dayInput').value;

      document.getElementById('emsg').innerHTML = "";

      if(student_name !="" && student_name !=null && student_email !="" && student_email !=null && notice_title !="" && notice_title !=null && category !="" && category !=null && faculty !="" && faculty !=null && dateInput !="" && dateInput !=null && dayInput !="" && dayInput !=null && noticeBody !="" && noticeBody !=null){
        let data = {
          student_name:$('#student_name').val(),
          student_email:$('#student_email').val(),
          notice_title:$('#notice_title').val(),
          category:$('#category').val(),
          faculty:$('#faculty').val(),
          noticeBody:$('#noticeBody').val(),
          dateInput:$('#dateInput').val(),
          dayInput:$('#dayInput').val()
        }

        $.ajax({
          url:"../api/notice/issue_personal_notice.php",
          method:"POST",
          data:data,
          success:function(response){
            alert('Notice Issued Successfully');
            window.location.href = "../index.php";
          },
          error:function(error){
            alert('Notice Not Issued');
            window.location.href = "./post_note.php";
            return false;
          }
        });
      }else{
        document.getElementById('emsg').innerHTML = "Null Fields Not Allowed";
        return false;
      }

    }
    const dateInput = document.getElementById('dateInput');
    const dayInput = document.getElementById('dayInput');

    dateInput.addEventListener('change', function () {
      const date = new Date(this.value);
      if (!isNaN(date.getTime())) {
        const days = ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"];
        dayInput.value = days[date.getDay()];
      } else {
        dayInput.value = '';
      }
    });

    const cleanURL = window.location.protocol + "//" + window.location.host + window.location.pathname;
    
  window.history.replaceState({}, document.title, cleanURL);
  </script>
</body>
</html>
