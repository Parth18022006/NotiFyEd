<?php
require_once "../includes/init.php";
include pathof('./includes/header.php');
include pathof('./includes/navbar.php');

$q = "SELECT Username FROM `user` WHERE role = 'Admin'";

$stmt = $conn->prepare($q);
$stmt->execute();

$admin = $stmt->fetchAll(PDO::FETCH_ASSOC);

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

  .form-control,
  .form-select {
    border-radius: 20px;
    transition: border-color 0.3s ease, box-shadow 0.3s ease;
  }

  .form-control:focus,
  .form-select:focus {
    border-color: #6a00ff;
    box-shadow: 0 0 8px rgba(106, 0, 255, 0.4);
  }

  select.form-select {
    background-color: #fefbff;
    color: #333;
  }

  select.form-select option {
    padding: 8px;
  }
</style>
</head>

<body>

  <div class="main container">
    <h2 class="mb-4">Post a New Notice</h2>
    <div class="card p-4">
      <form method="POST">
        <div class="mb-3">
          <label for="title" class="form-label">Notice Title</label>
          <input type="text" class="form-control" id="title" placeholder="Enter notice title" name="title">
        </div>

        <div class="mb-3">
          <label for="noticeCategory" class="form-label">Category</label>
          <select class="form-select" id="noticeCategory" name="noticeCategory">
            <option value="" disabled selected hidden>Select category</option>
            <option value="Exams">Exams</option>
            <option value="Events">Events</option>
            <option value="Holidays">Holidays</option>
            <option value="Suspend">Suspend</option>
            <option value="Fees">Fees</option>
            <option value="Result Announcement">Result Announcement</option>
          </select>
        </div>

        <div class="mb-3">
          <label for="noticeDay" class="form-label">Day</label>
          <input type="text" class="form-control" id="noticeDay" placeholder="Auto-filled from publish date" name="noticeDay" readonly>
        </div>

        <div class="mb-3">
          <label for="facultyName" class="form-label">Sender (Faculty)</label>
          <select class="form-select" id="facultyName" name="facultyName">
            <option value="" disabled selected hidden>Select Faculty</option>
            <?php foreach ($admin as $a) : ?>
              <option value="<?= htmlspecialchars($a['Username']); ?>">
                <?= htmlspecialchars($a['Username']); ?>
              </option>
            <?php endforeach; ?>
          </select>

        </div>

        <div class="mb-3">
          <label for="targetClass" class="form-label">Target Class</label>
          <select class="form-select" id="targetClass" name="targetClass">
            <option value="All" selected>All</option>
            <option value="FY-A">FY-A</option>
            <option value="FY-B">FY-B</option>
            <option value="FY-C">FY-C</option>
            <option value="FY-D">FY-D</option>
            <option value="SY-A">SY-A</option>
            <option value="SY-B">SY-B</option>
            <option value="SY-C">SY-C</option>
            <option value="SY-D">SY-D</option>
            <option value="TY-A">TY-A</option>
            <option value="TY-B">TY-B</option>
            <option value="TY-C">TY-C</option>
            <option value="FY">FY</option>
            <option value="SY">SY</option>
            <option value="TY">TY</option>
          </select>
        </div>

        <div class="mb-3">
          <label for="noticeBody" class="form-label">Notice Content</label>
          <textarea class="form-control" id="noticeBody" rows="5" placeholder="Write notice details here..." name="noticeBody"></textarea>
        </div>

        <div class="mb-3">
          <label for="publishDate" class="form-label">Schedule Publish Date</label>
          <input type="date" class="form-control" id="publishDate" name="publishDate">
        </div>
        <small id="emsg" style="color: red;" class="text-danger d-block text-center w-100"></small>
        <button type="button" class="btn btn-purple" onclick="Post()">Post Notice</button>
      </form>
    </div>
  </div>

  <p class="text-center mt-3" style="font-size: 0.85rem; color: #888;">Powered by <span style="color: #6a00ff; font-weight: 600;">NotiFyEd</span></p>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    document.addEventListener("DOMContentLoaded", function() {
      const publishDate = document.getElementById("publishDate");
      const noticeDay = document.getElementById("noticeDay");

      publishDate.addEventListener("change", function() {
        const date = new Date(this.value);
        const options = {
          weekday: 'long'
        };
        if (!isNaN(date)) {
          noticeDay.value = date.toLocaleDateString('en-US', options);
        }
      });
    });

    function Post() {

      let title = document.getElementById('title').value;
      let noticeCategory = document.getElementById('noticeCategory').value;
      let facultyName = document.getElementById('facultyName').value;
      let targetClass = document.getElementById('targetClass').value;
      let noticeBody = document.getElementById('noticeBody').value;
      let noticeDay = document.getElementById('noticeDay').value;
      let publishDate = document.getElementById('publishDate').value;

      document.getElementById('emsg').innerHTML = "";

      if (title != "" && title != null && noticeCategory != "" && noticeCategory != null && facultyName != "" && facultyName != null && targetClass != "" && targetClass != null && noticeBody != "" && noticeBody != null && noticeDay != "" && noticeDay != null && publishDate != "" && publishDate != null) {
        let data = {
          title: $('#title').val(),
          noticeCategory: $('#noticeCategory').val(),
          facultyName: $('#facultyName').val(),
          targetClass: $('#targetClass').val(),
          noticeBody: $('#noticeBody').val(),
          noticeDay: $('#noticeDay').val(),
          publishDate: $('#publishDate').val()
        }

        $.ajax({
          url: "../api/notice/issue_notice.php",
          method: "POST",
          data: data,
          success: function(response) {
            alert('Notice Issued Successfully');
            window.location.href = "../index.php";
          },
          error: function(error) {
            alert('Notice Not Issued');
            window.location.href = "./post_note.php";
            return false;
          }


        })
      } else {
        document.getElementById('emsg').innerHTML = "Null Fields Not Allowed";
        return false;
      }



    }
  </script>
</body>

</html>