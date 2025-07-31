<?php
require_once "../includes/init.php";
$name = $_SESSION['name'];
include pathof('./includes/header.php');
include pathof('./includes/navbar.php');
?>
<style>
    body {
      font-family: 'Poppins', sans-serif;
      background-color: #f4f0fa;
    }

    .text-purple {
      color: #6a00ff !important;
    }

    .form-wrapper {
      max-width: 800px;
      margin: auto;
      padding: 2rem;
    }

    .form-card {
      border: none;
      border-radius: 20px;
      backdrop-filter: blur(12px);
      background: rgba(255, 255, 255, 0.5);
      box-shadow: 0 12px 30px rgba(106, 0, 255, 0.1);
      padding: 2rem;
      transition: all 0.3s ease;
    }

    .form-card:hover {
      transform: scale(1.01);
    }

    .form-label,
    .form-title {
      color: #6a00ff;
      font-weight: 600;
    }

    .form-control,
    .form-select,
    textarea {
      border-radius: 50px;
      transition: border-color 0.3s ease, box-shadow 0.3s ease;
    }

    .form-control:focus,
    .form-select:focus,
    textarea:focus {
      border-color: #6a00ff;
      box-shadow: 0 0 8px rgba(106, 0, 255, 0.4);
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

    select.form-select option {
      padding: 10px;
    }

    textarea.form-control {
      border-radius: 20px;
    }
  </style>
</head>
<body>

  <div class="text-center py-3" style="font-size: 1.8rem; font-weight: 700; color: #6a00ff;">
    Feedback Form
  </div>

  <div class="form-wrapper">
    <div class="form-card">
      <h4 class="form-title mb-4">Submit Request / Info</h4>
      <form method="POST">
        <div class="mb-3">
          <label for="title" class="form-label">Title</label>
          <input type="text" name="title" id="title" class="form-control" placeholder="Enter title">
        </div>

        <div class="mb-3">
          <label for="category" class="form-label">Category</label>
          <select name="category" id="category" class="form-select">
            <option value="">Select category</option>
            <option value="General">General</option>
            <option value="Request">Request</option>
            <option value="Feedback">Feedback</option>
          </select>
        </div>

        <div class="mb-3">
          <label for="description" class="form-label">Description</label>
          <textarea name="description" id="description" class="form-control" rows="5" placeholder="Write here..."></textarea>
        </div>

        <div class="mb-3">
          <label for="submittedBy" class="form-label">Submitted By</label>
          <input type="text" name="submitted_by" id="submitted_by" class="form-control" placeholder="Your name or ID" value="<?= $name?>" readonly>
        </div>

        <div class="mb-3">
          <label for="date" class="form-label">Date</label>
          <input type="date" name="date" id="date" class="form-control">
        </div>

        <small id="emsg" style="color: red;" class="text-danger d-block text-center w-100"></small>

        <button type="button" class="btn btn-purple w-100" onclick="feedback()">Submit</button>
      </form>
    </div>
  </div>

  <p class="text-center mt-3" style="font-size: 0.85rem; color: #888;">Powered by <span style="color: #6a00ff; font-weight: 600;">NotiFyEd</span></p>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    function feedback(){
      let title = document.getElementById('title').value;
      let category = document.getElementById('category').value;
      let description = document.getElementById('description').value;
      let submitted_by = document.getElementById('submitted_by').value;
      let date = document.getElementById('date').value;

      document.getElementById('emsg').innerHTML = "";

      if(title !="" && title !=null && category !="" && category !=null && description !="" && description !=null && submitted_by !="" && submitted_by !=null && date !="" && date !=null){
        let data = {
          title:$('#title').val(),
          category:$('#category').val(),
          description:$('#description').val(),
          submitted_by:$('#submitted_by').val(),
          date:$('#date').val()
        }

        $.ajax({

          url:"../api/Student/feedback.php",
          method:"POST",
          data:data,
          success:function(response){
            alert("Feedback Sent Successfully");
            window.location.href = "../index.php";
          },
          error:function(error){
            alert("Feedback Not Sent");
            window.location.href = "./feedback.php";
            return false;
          }
        });
      }else{
        document.getElementById('emsg').innerHTML = "Null Fields Not Allowed";
        return false;
      }
    }
  </script>
</body>
</html>
