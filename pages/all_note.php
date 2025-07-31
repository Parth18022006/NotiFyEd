<?php
require_once "../includes/init.php";
include pathof('./includes/header.php');
include pathof('./includes/navbar.php');

$role = $_SESSION['role'] ?? null;


$general = [];
$personal = [];

if ($role == 'student') {
  $user_class = $_SESSION['class'];
  $user_email = $_SESSION['email'];


  $class_prefix = strtoupper(explode('-', $user_class)[0]);


  $q = "SELECT title AS notice_title, 
  noticeCategory AS category, 
  facultyName AS faculty,
  targetClass AS target, 
  noticeBody AS body, 
  noticeDay AS day, 
  publishDate AS date
  FROM issue_notice
  WHERE targetClass = 'all' OR targetClass = ? OR targetClass = ?
  ORDER BY publishDate DESC";

  $stmt1 = $conn->prepare($q);
  $stmt1->execute([$user_class , $class_prefix]);
  $general = $stmt1->fetchAll(PDO::FETCH_ASSOC);

  $q2 = "SELECT
              notice_title,
              category,
              faculty,
              'Personal' AS target,
              noticeBody AS body,
              dayInput AS day,
              dateInput AS date
           FROM issue_personal_notice
           WHERE student_email = ?
           ORDER BY dateInput DESC";
  $stmt2 = $conn->prepare($q2);
  $stmt2->execute([$user_email]);
  $personal = $stmt2->fetchAll(PDO::FETCH_ASSOC);
} else {
  $q = "SELECT title AS notice_title, 
  noticeCategory AS category, 
  facultyName AS faculty, 
  targetClass AS target, 
  noticeBody AS body, 
  noticeDay AS day, 
  publishDate AS date
  FROM issue_notice ORDER BY publishDate DESC";
$stmt1 = $conn->prepare($q);
$stmt1->execute();
$general = $stmt1->fetchAll(PDO::FETCH_ASSOC);

$q2 = "SELECT
              notice_title,
              category,
              faculty,
              student_name AS target,
              noticeBody AS body,
              dayInput AS day,
              dateInput AS date
           FROM issue_personal_notice
           ORDER BY dateInput DESC";
    $stmt2 = $conn->prepare($q2);
    $stmt2->execute();
    $personal = $stmt2->fetchAll(PDO::FETCH_ASSOC);
}

$notices = array_merge($general, $personal);

usort($notices, function($a, $b) {
  return strtotime($b['date']) - strtotime($a['date']);
});
?>

<style>
header,
.site-name {
  margin-top: 0 !important;
  padding-top: 0.8rem; 
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
  margin-top: 0 !important
  }

  .text-purple {
    color: #6a00ff !important;
  }

  .main {
    max-width: 900px;
    margin: auto;
  }

  .notice-block {
    background: rgba(255, 255, 255, 0.55);
    backdrop-filter: blur(10px);
    border-radius: 18px;
    box-shadow: 0 12px 30px rgba(106, 0, 255, 0.1);
    padding: 2rem;
    margin-bottom: 2rem;
    transition: all 0.3s ease;
  }

  .notice-block:hover {
    transform: scale(1.01);
  }

  .notice-title {
    font-size: 1.25rem;
    font-weight: 600;
    color: #6a00ff;
    margin-bottom: 1.5rem;
    border-left: 5px solid #6a00ff;
    padding-left: 1rem;
  }

  .form-label {
    font-weight: 500;
    color: #6a00ff;
  }

  .form-control[readonly],
  .form-control:disabled {
    background-color: #f8f4ff;
    border: 1px solid #e0d5fc;
    border-radius: 12px;
    padding: 0.5rem 1rem;
    color: #333;
  }

  textarea.form-control {
    resize: none;
  }

  @media (max-width: 768px) {
    .notice-title {
      font-size: 1.1rem;
    }
  }
</style>
</head>

<body>

  <div class="main container">
    <h2 class="text-purple mb-4">All Notices</h2>

    <div class="mb-4">
  <input 
    type="text" 
    id="searchInput" 
    class="form-control" 
    placeholder="Search notices..."
    style="border-radius: 12px; padding: 0.75rem 1rem; border: 1px solid #ccc;"
  >
</div>
    <?php
    foreach ($notices as $n) :
    ?>
      <div class="notice-block">
        <div class="notice-title">📢 <?= $n['category'] ?> - <?= $n['target'] ?></div>
        <div class="row g-3 mb-3">
          <div class="col-md-6">
            <label class="form-label">Faculty</label>
            <input type="text" class="form-control" value="<?= $n['faculty'] ?>" readonly>
          </div>
          <div class="col-md-6">
            <label class="form-label">Class</label>
            <input type="text" class="form-control" value="<?= $n['target'] ?>" readonly>
          </div>
          <div class="col-md-6">
            <label class="form-label">Day</label>
            <input type="text" class="form-control" value="<?= $n['day'] ?>" readonly>
          </div>
          <div class="col-md-6">
            <label class="form-label">Published On</label>
            <input type="text" class="form-control" value="<?= $n['date'] ?>" readonly>
          </div>
          <div class="col-12">
            <label class="form-label">Notice Description</label>
            <textarea class="form-control" rows="3" readonly>
          <?= $n['body'] ?>
          </textarea>
          </div>
        </div>
      </div>
    <?php endforeach; ?>
  </div>

  <p class="text-center mt-3" style="font-size: 0.85rem; color: #888;">Powered by <span style="color: #6a00ff; font-weight: 600;">NotiFyEd</span></p>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
<script>
document.getElementById('searchInput').addEventListener('input', function() {
  const query = this.value.toLowerCase().trim();
  document.querySelectorAll('.notice-block').forEach(block => {
    const inputs = block.querySelectorAll('input.form-control[readonly]');
    const faculty = inputs[0]?.value.toLowerCase() || "";
    const classText = inputs[1]?.value.toLowerCase() || "";
    const dayText = inputs[2]?.value.toLowerCase() || "";
    const dateText = inputs[3]?.value.toLowerCase() || "";
    const categoryTarget = block.querySelector('.notice-title')?.textContent.toLowerCase() || "";

    // Combine only the selected fields (no description)
    const combined = faculty + " " + classText + " " + dayText + " " + dateText + " " + categoryTarget;

    block.style.display = combined.includes(query) ? '' : 'none';
  });
});
</script>
<script>
function showNoticePopup(message) {
    const popup = document.createElement("div");
    popup.innerHTML = message;
    popup.style.position = "fixed";
    popup.style.top = "20px";
    popup.style.right = "20px";
    popup.style.padding = "16px";
    popup.style.backgroundColor = "#6a00ff";
    popup.style.color = "#fff";
    popup.style.borderRadius = "10px";
    popup.style.boxShadow = "0 0 10px rgba(0,0,0,0.2)";
    popup.style.zIndex = "9999";
    document.body.appendChild(popup);

    setTimeout(() => popup.remove(), 6000);
}

window.addEventListener("DOMContentLoaded", () => {
    console.log("Checking for new notices...");
    fetch("<?= BASE_URL ?>/pages/check_new_notice.php")
        .then((res) => res.json())
        .then((data) => {
            console.log("Notice check result:", data);
            if (data.success && data.new_count > 0) {
                let message = `🛎️ You have ${data.new_count} new notice${data.new_count > 1 ? "s" : ""}:<br>`;
                data.notices.forEach((n) => {
                    message += `• <b>${n.notice_title}</b> (${n.date})<br>`;
                });
                showNoticePopup(message);
            }
        })
        .catch((err) => console.error("Notice fetch error:", err));
});
</script>





</html>