<?php
require_once "../includes/init.php";
include pathof('./includes/header.php');
include pathof('./includes/navbar.php');
?>

<style>
header,
.site-name {
  margin-top: 0 !important;
  padding-top: 0.8rem; /* adjust to make it a bit high but not too much */
  padding-bottom: 0.8rem;
}
.nav-card {
  margin-top: 0 !important;
}
  body {
    font-family: 'Poppins', sans-serif;
    background-color: #f4f0fa;
    padding: 2rem;
    padding-top: 0 !important;
    margin-top: 0 !important;
  }

  h2 {
    color: #6a00ff;
    font-weight: 600;
    margin-bottom: 1.5rem;
  }

  .search-bar {
    margin-bottom: 1.5rem;
    display: flex;
    justify-content: flex-end;
  }

  .search-input {
    border-radius: 50px;
    border: 1px solid #ccc;
    padding: 0.5rem 1rem;
    width: 300px;
    transition: box-shadow 0.3s ease;
  }

  .search-input:focus {
    outline: none;
    border-color: #6a00ff;
    box-shadow: 0 0 10px rgba(106, 0, 255, 0.3);
  }

  .table-container {
    background: rgba(255, 255, 255, 0.5);
    backdrop-filter: blur(10px);
    box-shadow: 0 10px 25px rgba(106, 0, 255, 0.1);
    border-radius: 20px;
    padding: 2rem;
    overflow-x: auto;
  }

  thead th {
    background-color: #6a00ff;
    color: white;
    font-weight: 600;
    text-align: center;
    vertical-align: middle;
  }

  tbody td {
    text-align: center;
    vertical-align: middle;
  }

  .btn-purple {
    background-color: #6a00ff;
    color: white;
    font-weight: 500;
    border-radius: 50px;
    padding: 0.4rem 1rem;
    transition: all 0.3s ease;
    border: none;
  }

  .btn-purple:hover {
    background-color: #5800cc;
    box-shadow: 0 6px 12px rgba(106, 0, 255, 0.2);
    transform: scale(1.03);
  }

  @media (max-width: 768px) {
    .search-bar {
      justify-content: center;
    }

    .search-input {
      width: 100%;
    }
  }
</style>
</head>

<body>

  <div class="container">
    <h2>Send Personal Notice to Students</h2>

    <div class="search-bar">
      <input type="text" class="form-control search-input" id="studentSearch" placeholder="Search by name, class, roll no..." onkeyup="filterStudents()" />
    </div>

    <div class="table-container">
      <table class="table table-bordered table-hover align-middle mb-0" id="studentTable">
        <thead>
          <tr>
            <th>Sr. No.</th>
            <th>Class</th>
            <th>Name</th>
            <th>Email</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody id="tbody">

        </tbody>
      </table>
    </div>
  </div>

  <p class="text-center mt-3" style="font-size: 0.85rem; color: #888;">Powered by <span style="color: #6a00ff; font-weight: 600;">NotiFyEd</span></p>

  <script>
    displayrecord();

    function displayrecord() {

      $.ajax({
        url: "../api/Student/display_record.php",
        method: "POST",
        success: function(response) {
          let record = "";

          if (response.student && response.student.length > 0) {
            for (let i = 0; i < response.student.length; i++) {
              record += ` 
          <tr>
            <td>${response.student[i].id}</td>
            <td>${response.student[i].Class}</td>
            <td>${response.student[i].Username}</td>
            <td>${response.student[i].Email}</td>
            <td><button class="btn btn-purple" onclick="giveNotice(${response.student[i].id})">Give Notice</button></td>
          </tr>
                      `
            }
          } else {
            record += `<tr><td colspan = "5" style="text-align:center ;">No Records</td></tr>`
          }
          $("#tbody").html(record);
        },
        error: function(error) {
          alert("Student Not Displayed");
        }
      });
    }

    function filterStudents() {
      const input = document.getElementById("studentSearch").value.toLowerCase();
      const rows = document.querySelectorAll("#studentTable tbody tr");

      rows.forEach(row => {
        const text = row.innerText.toLowerCase();
        row.style.display = text.includes(input) ? "" : "none";
      });
    }

    function giveNotice(studentid) {
      window.location.href = "./pp_note.php?id=" +studentid;
    }
  </script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>