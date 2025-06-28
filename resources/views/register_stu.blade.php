<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Student Registration</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

  <!-- Navbar with Login Button -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-success">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">Student Portal</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="btn btn-light" style="cursor:pointer;" onclick="window.location.href = '/api/adm_home'">Admin_Home</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- Registration Form -->
  <div class="container mt-5">
    <h2 class="mb-4 text-center">Student Registration Form</h2>
    <form id="reg_form" method="POST">
      <div class="mb-3">
        <label for="student_name" class="form-label">Student Name</label>
        <input type="text" class="form-control" id="stu_name" name="student_name" required>
      </div>

      <div class="mb-3">
        <label for="student_branch" class="form-label">Student Branch</label>
        <select class="form-select" id="stu_branch" name="student_branch" required>
          <option value="" selected disabled>Select Branch</option>
          <option value="CSE">CSE</option>
          <option value="Bio-Tech">Bio-Tech</option>
          <option value="ECE">ECE</option>
          <option value="EEE">EEE</option>
          <option value="Bio-Info">Bio-Info</option>
          <option value="Food_Tech">Food_Tech</option>
          <option value="Civil">Civil</option>
          <option value="Mech">Mech</option>
        </select>
      </div>

      <div class="mb-3">
        <label for="student_section" class="form-label">Student Section</label>
        <select class="form-select" id="stu_sec" name="student_section" required>
          <option value="" selected disabled>Select Section</option>
          <option value="A">A</option>
          <option value="B">B</option>
          <option value="C">C</option>
          <option value="D">D</option>
          <option value="E">E</option>
          <option value="F">F</option>
          <option value="G">G</option>
          <option value="H">H</option>
          <option value="I">I</option>
          <option value="J">J</option>
        </select>
      </div>

      <div class="mb-3">
        <label for="student_email" class="form-label">Student Email</label>
        <input type="email" class="form-control" id="stu_email" name="student_email" required>
      </div>

      <div class="mb-3">
        <label for="student_password" class="form-label">Student Password</label>
        <input type="password" class="form-control" id="stu_pass" name="student_password" required>
      </div>

      <div class="mb-3">
        <label for="student_password" class="form-label">Student Confirm_Password</label>
        <input type="password" class="form-control" id="stu_pass_con" name="student_password" required>
      </div>

      <div class="mb-3">
        <label for="student_phone" class="form-label">Student Phone Number</label>
        <input type="tel" class="form-control" id="stu_phone" name="stu_phone" pattern="[0-9]{10}" required>
      </div>

      <button type="submit" class="btn btn-success w-100" id="submit" onclick="return register()">Register</button>
    </form>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>



<script>
  const adm_Token = sessionStorage.getItem('adm_Token');

  if(!adm_Token)
  {
    alert('Admin Login First');
    window.location.href = '/api/adm_login';
  }
    function register()
    {
        const form = document.getElementById('reg_form');
        form.addEventListener('submit', function(e){
            e.preventDefault();
            const data = {
                Stu_Name:document.getElementById('stu_name').value,
                Stu_Branch:document.getElementById('stu_branch').value,
                Stu_Sec:document.getElementById('stu_sec').value,
                Stu_Email:document.getElementById('stu_email').value,
                Stu_Password:document.getElementById('stu_pass').value,
                Stu_Password_confirmation:document.getElementById('stu_pass_con').value,
                Stu_Phone:document.getElementById('stu_phone').value
            };

            fetch(`http://127.0.0.1:8000/api/register_stu`, {
                method:"POST",
                headers:{"Content-type":"application/json"},
                body:JSON.stringify(data),
            }).then(res=>res.json()).then(data=>{
                if(data.Status == 200)
                {
                  const x = confirm(data.Message + "\n" + "Do You Want to Register More..!!!");
                  if(!x){
                    window.location.href = '/api/adm_home';
                  }else{
                      window.location.href = '/api/register_stu';
                  }
                }
                
            });
        });
    }
</script>