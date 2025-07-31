<?php
require_once "../../includes/init.php";
include pathof('./includes/header.php');
include pathof('./includes/navbar.php');

?>
<style>
body {
  font-family: 'Poppins', sans-serif;
  background-color: #f4f0fa;
  margin: 0;
  padding: 0;
}

.text-purple {
  color: #6a00ff !important;
}

.nav-card {
  background-color: #ffffff;
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


.navbar-nav .nav-link.text-purple {
  font-weight: 600;
  transition: all 0.3s ease;
  text-align: center;
  color: #6a00ff !important;
}

.navbar-nav .nav-link.text-purple:hover {
  color: #5800cc !important;
  transform: scale(1.05);
}


.site-name {
  font-size: 1.8rem;
  font-weight: 700;
  color: #6a00ff;
  text-align: center;
  padding: 1rem 0;
}


body {
  font-family: 'Poppins', sans-serif;
  background-color: #f4f0fa;
  margin: 0;
  padding: 0;
}


.registration-form {
  max-width: 480px;            
  margin: 3rem auto 2rem;
  background: #fff;
  border-radius: 20px;
  padding: 2rem 1.8rem;
  box-shadow: 0 12px 30px rgba(106, 0, 255, 0.1);
  backdrop-filter: blur(12px);
  text-align: center;
  animation: fadeIn 0.4s ease-in;
}

.registration-form h3 {
  color: #6a00ff;
  font-weight: 700;
  margin: 0.8rem 0 1.2rem;
  font-size: 1.6rem;
}

.input-with-icon {
  position: relative;
  margin-bottom: 1rem;
}

.input-with-icon .form-icon {
  position: absolute;
  left: 16px;
  top: 50%;
  transform: translateY(-50%);
  color: #6a00ff;
  font-size: 1rem;
  pointer-events: none;
}

.registration-form input.form-control {
  width: 100%;
  padding: 10px 16px 10px 42px;
  border: 1.5px solid #ddd;
  border-radius: 50px;
  font-size: 0.95rem;
  transition: all 0.3s ease;
  outline: none;
}

.registration-form input.form-control:focus {
  border-color: #6a00ff;
  box-shadow: 0 0 8px rgba(106, 0, 255, 0.3);
}

.text-danger {
  font-size: 0.8rem;
  text-align: left;
  margin-top: -0.3rem;
  margin-bottom: 0.5rem;
  display: block;
}

.btn-purple {
  display: inline-block;
  width: 100%;
  padding: 0.75rem 1rem;
  background-color: #6a00ff;
  color: #fff;
  border: none;
  border-radius: 50px;
  font-size: 1rem;
  font-weight: 600;
  transition: all 0.3s ease;
  cursor: pointer;
}

.btn-purple:hover {
  background-color: #5800cc;
  box-shadow: 0 6px 18px rgba(106, 0, 255, 0.3);
}

.registration-form p {
  margin-top: 1.5rem;
  font-size: 0.85rem;
  color: #888;
}

@media (max-width: 768px) {
  .registration-form {
    margin: 2rem 1rem;
    padding: 1.5rem;
  }
  .registration-form h3 {
    font-size: 1.4rem;
  }
}

@media (max-width: 480px) {
  .registration-form {
    padding: 1.2rem;
    margin-top: 5rem; 
  }
  .registration-form h3 {
    font-size: 1.3rem;
  }
  .input-with-icon .form-icon {
    left: 12px;
  }
  .registration-form input.form-control {
    padding-left: 38px;
    font-size: 0.9rem;
  }
  .btn-purple {
    font-size: 0.9rem;
  }
}

@keyframes fadeIn {
  from {
    opacity: 0;
    transform: scale(0.98);
  }
  to {
    opacity: 1;
    transform: scale(1);
  }
}


</style>
</head>

<body>

    <form class="registration-form" method="Post">
      <h3>Create Admin Account</h3>

      <div class="mb-3 input-with-icon">
        <i class="fa fa-user form-icon"></i>
        <input type="text" class="form-control" id="Username" name="Username" placeholder="Username" />
      </div>
      <small id="emsg2" style="color: red;" class="text-danger d-block text-center w-100"></small>


      <div class="mb-3 input-with-icon">
        <i class="fa fa-envelope form-icon"></i>
        <input type="email" class="form-control" id="Email" name="Email" placeholder="Email Address" />
      </div>
      <small id="emsg3" style="color: red;" class="text-danger d-block text-center w-100"></small>


      <div class="mb-3 input-with-icon">
        <i class="fa fa-lock form-icon"></i>
        <input type="password" class="form-control" id="Password" name="Password" placeholder="Password" />
      </div>
      <small id="emsg4" style="color: red;" class="text-danger d-block text-center w-100"></small>


      <div class="mb-4 input-with-icon">
        <i class="fa fa-lock form-icon"></i>
        <input type="password" class="form-control" id="CPassword" name="CPassword" placeholder="Confirm Password" />
      </div>
      <small id="emsg5" style="color: red;" class="text-danger d-block text-center w-100"></small>
      <small id="emsg1" style="color: red;" class="text-danger d-block text-center w-100"></small><br>

      <input type="button" class="btn btn-purple" value="Register" onclick="insert()" />

      <p class="text-center mt-3" style="font-size: 0.85rem; color: #888;">Powered by <span style="color: #6a00ff; font-weight: 600;">NotiFyEd</span></p>

    </form>


  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

  <script>
    function insert() {

      let username = document.getElementById('Username').value;
      let Email = document.getElementById('Email').value;
      let Password = document.getElementById('Password').value;
      let CPassword = document.getElementById('CPassword').value;

      document.getElementById('emsg1').innerHTML = "";
      document.getElementById('emsg2').innerHTML = "";
      document.getElementById('emsg3').innerHTML = "";
      document.getElementById('emsg4').innerHTML = "";
      document.getElementById('emsg5').innerHTML = "";


      let vname = /^[A-Za-z]+(?: [A-Za-z]+)+$/;
      let vemail = /^[a-zA-Z0-9]+@[a-z]+\.[a-z]{2,}$/;
      let vpass = /^[A-z0-9]{6,18}$/;

      if (username != "" && username != null && Email != "" && Email != null && Password != "" && Password != null && CPassword != "" && CPassword != null) {
        if (vname.test(username)) {
          if (vemail.test(Email)) {
            if (vpass.test(Password)) {
              if (Password == CPassword) {
                let data = {
                  Username: $('#Username').val(),
                  Email: $('#Email').val(),
                  Password: $('#Password').val()
                }

                $.ajax({
                  url: "../../api/user/register.php",
                  method: "POST",
                  data: data,
                  success: function(response) {
                    alert("Registered Successfully");
                    window.location.href = "../../index.php";
                  },
                  error: function(error) {
                    alert("User With This E-mail & Password Is Already Registered");
                    window.location.href = "./register.php";
                  }
                })
              } else {
                document.getElementById('emsg5').innerHTML = "Password Mismatched";
                return false;
              }
            } else {
              document.getElementById('emsg4').innerHTML = "Password Pattern Not Matched";
              return false;
            }
          } else {
            document.getElementById('emsg3').innerHTML = "Email Pattern Not Matched";
            return false;
          }
        } else {
          document.getElementById('emsg2').innerHTML = "Name is too short";
          return false;
        }
      } else {
        document.getElementById('emsg1').innerHTML = "Null Field Not Allowed";
        return false;
      }
    };
  </script>
</body>

</html>