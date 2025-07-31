<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Login | NotiFyEd</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />

  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet" />

  <link href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.4.0/css/all.min.css" rel="stylesheet" />
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


  <style>
    body {
      font-family: 'Poppins', sans-serif;
      background: linear-gradient(to right, #7f00ff, #e100ff);
      display: flex;
      justify-content: center;
      align-items: center;
      min-height: 100vh;
      padding: 1rem;
    }

    .login-form {
      background: white;
      padding: 2rem;
      border-radius: 20px;
      box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
      width: 100%;
      max-width: 400px;
    }

    .login-form h3 {
      color: #6a00ff;
      font-weight: 600;
      margin-bottom: 1.5rem;
      text-align: center;
    }

    .form-control {
      border-radius: 50px;
      padding-left: 2.5rem;
    }

    .input-with-icon {
      position: relative;
    }

    .form-icon {
      position: absolute;
      top: 50%;
      left: 20px;
      transform: translateY(-50%);
      color: #6a00ff;
    }

    .btn-purple {
      background-color: #6a00ff;
      color: white;
      font-weight: 600;
      border: none;
      border-radius: 50px;
      padding: 0.6rem 1.2rem;
      width: 100%;
      transition: all 0.3s ease;
    }

    .btn-purple:hover {
      background-color: #5800cc;
      box-shadow: 0 8px 16px rgba(106, 0, 255, 0.3);
    }

    .login-link {
      display: block;
      text-align: center;
      margin-top: 1rem;
      font-size: 0.9rem;
    }

    .site-name {
      color: #6a00ff;
      font-weight: 700;
      font-size: 1.2rem;
      text-align: center;
      text-transform: uppercase;
      margin-bottom: 0.5rem;
    }
  </style>
</head>

<body>
<div class="modal fade show" id="roleModal" tabindex="-1" style="display:block;background:rgba(0,0,0,0.5);">
<div class="modal-dialog modal-dialog-centered">
  <div class="modal-content p-4 text-center">
    <h5 class="mb-3">Select Login Type</h5>
    <button class="btn btn-primary w-100 mb-2" onclick="setRole('admin')">Login as Admin</button>
    <button class="btn btn-success w-100" onclick="setRole('student')">Login as Student</button>
  </div>
</div>
</div>

  <form class="login-form" method="Post" id="loginForm" style="display:none;">
    <div class="site-name">NotiFyEd</div>
    <h3 class="text-center mb-4">Login</h3>


    <input type="hidden" name="user_type" id="user_type">

    <div class="mb-3 input-with-icon">
      <input type="text" class="form-control" id="Username" name="Username" placeholder="Username" />
      <i class="fa fa-user form-icon"></i>
    </div>
    <small id="emsg2" style="color: red;" class="text-danger d-block text-center w-100"></small>


    <div class="mb-4 input-with-icon">
      <input type="password" class="form-control" id="Password" name="Password" placeholder="Password" />
      <i class="fa fa-lock form-icon"></i>
    </div>
    <small id="emsg1" style="color: red;" class="text-danger d-block text-center w-100"></small>

    <small id="emsg" style="color: red;" class="text-danger d-block text-center w-100"></small>


    <input type="button" class="btn-purple" value="Login" onclick="login()" />

    <p class="text-center mt-3" style="font-size: 0.85rem; color: #888;">Powered by <span style="color: #6a00ff; font-weight: 600;">NotiFyEd</span></p>

  </form>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script>


function setRole(role) {
  document.getElementById('user_type').value = role;
  document.getElementById('loginForm').style.display = 'block';
  const modal = document.getElementById('roleModal');
  modal.style.display = 'none';
  modal.classList.remove('show');
}
    function login() {

      let Username = document.getElementById('Username').value;
      let Password = document.getElementById('Password').value;
      let UserType = document.getElementById('user_type').value;

      document.getElementById('emsg1').innerHTML = "";
      document.getElementById('emsg').innerHTML = "";
      document.getElementById('emsg2').innerHTML = "";

      if (!UserType) {
    document.getElementById('emsg').innerHTML = "Please select login type first.";
    return;
  }

      let vname = /^[A-Za-z]+(?: [A-Za-z]+)+$/;
      let vpass = /^[A-z0-9]{6,18}$/;

      if (Username != "" && Username != null && Password != "" && Password != null) {
        if (vname.test(Username)) {
          if (vpass.test(Password)) {

            let data = {
              Username: $('#Username').val(),
              Password: $('#Password').val(),
              user_type: $('#user_type').val()
            }

            $.ajax({
              url: "../../api/user/login.php",
              method: "POST",
              data: data,
              success: function(response) {
                if (response.success) {
                  alert("Login Successfully");
                  $('#Username').val("");
                  $('#Password').val("");
                  window.location.href = "../../index.php"
                } else {
                  if (response.reason === "Username") {
                    document.getElementById('emsg2').innerHTML = "User With This Username Not Registered";
                  } else if (response.reason === "Password") {
                    document.getElementById('emsg1').innerHTML = "Incorrect Password";
                  }
                }
              },
              error: function(error) {
                alert("Not LoggedIn");
                window.location.href = "./login.php";
              }
            })
          } else {
            document.getElementById('emsg1').innerHTML = "Password Pattern Not Matched";
            return false;
          }
        } else {
          document.getElementById('emsg2').innerHTML = "Name is too short";
          return false;
        }
      } else {
        document.getElementById('emsg').innerHTML = "Null Field Not Allowed";
        return false;
      }



    }
  </script>
</body>

</html>