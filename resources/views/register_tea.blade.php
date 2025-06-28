<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Teacher Registration</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

  <!-- Navbar with Login Button -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">Teacher Portal</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="btn btn-light" style="cursor:pointer;" onclick="window.location.href='/api/adm_home'">Admin Home</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- Teacher Registration Form -->
  <div class="container mt-5">
    <h2 class="mb-4 text-center">Teacher Registration Form</h2>
    
    <form id="tea_reg_form" method="POST">
      <!-- Teacher Name -->
      <div class="mb-3">
        <label for="Tea_Name" class="form-label">Teacher Name</label>
        <input type="text" class="form-control" id="Tea_Name" name="Tea_Name" required>
      </div>

      <!-- Branch -->
      <div class="mb-3">
        <label for="Branch" class="form-label">Branch</label>
        <select class="form-select" id="Branch" name="Branch" required>
          <option value="" selected disabled>Select Branch</option>
          <option value="CSE">CSE</option>
          <option value="Bio-Tech">Bio-Tech</option>
          <option value="EEE">EEE</option>
          <option value="ECE">ECE</option>
          <option value="Bio-Info">Bio-Info</option>
          <option value="Civil">Civil</option>
          <option value="Mech">Mech</option>
        </select>
      </div>

      <!-- Email -->
      <div class="mb-3">
        <label for="Tea_Email" class="form-label">Teacher Email</label>
        <input type="email" class="form-control" id="Tea_Email" name="Tea_Email" required>
      </div>

      <!-- Password -->
      <div class="mb-3">
        <label for="Password" class="form-label">Password</label>
        <input type="password" class="form-control" id="Pass" name="Password" required>
      </div>

      <!-- Confirmed_Password -->
      <div class="mb-3">
        <label for="Confirmed_Password" class="form-label">Confirmed Password</label>
        <input type="password" class="form-control" id="Con_Pass" name="Con_Password" required>
      </div>

      <!-- Phone Number -->
      <div class="mb-3">
        <label for="Tea_Phone" class="form-label">Teacher Phone</label>
        <input type="tel" class="form-control" id="Tea_Phone" name="Tea_Phone" pattern="[0-9]{10}" required>
      </div>

      <button type="submit" class="btn btn-primary w-100" id="submit", onclick="return register_tea()">Register</button>
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
    function register_tea()
    {
        const form = document.getElementById('tea_reg_form');
        form.addEventListener('submit', function(e){
            e.preventDefault();
            const data = {
                Tea_Name:document.getElementById('Tea_Name').value,
                Branch:document.getElementById('Branch').value,
                Tea_Email:document.getElementById('Tea_Email').value,
                Password:document.getElementById('Pass').value,
                Password_confirmation:document.getElementById('Con_Pass').value,
                Tea_Phone:document.getElementById('Tea_Phone').value
            };

            fetch(`http://127.0.0.1:8000/api/register_tea`, {
                method:"POST",
                headers:{'Content-type':'application/json'},
                body:JSON.stringify(data)
            }).then(res=>res.json()).then(data=>{
                // console.log(data);
                if(data.Status == 200)
                {
                  const x = confirm(data.Message + "\n" + "Do You Want to Register More..!!!");
                  if(!x){
                    window.location.href = '/api/adm_home';
                  }else{
                      window.location.href = '/api/register_tea';
                  }
                }
            });
        });
    }
</script>