<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Admin Dashboard</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" />
  <style>
    body {
      background-color: #f8f9fa;
    }
    .dashboard {
      max-width: 1000px;
      margin: 30px auto;
      padding: 30px;
      background-color: #fff;
      border-radius: 15px;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
    }
    .btn-group-custom .btn {
      min-width: 200px;
      margin: 10px;
    }
  </style>
</head>
<body>

  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container-fluid">
      <span class="navbar-brand">Hello, <span id="adm_name"> </span></span>
      <script>
        const token = sessionStorage.getItem('adm_Token');
        if(!token)
        {
            alert('Login_First');
            window.location.href = '/api/adm_login';
        }
        const name = sessionStorage.getItem('adm_name');
        document.getElementById('adm_name').innerText = name;
      </script>
      <div class="ms-auto">
        <button class="btn btn-outline-light" type="button" onclick="return logout()" style="cursor: pointer;">Logout</button>
      </div>
    </div>
  </nav>

  <!-- Dashboard Section -->
  <div class="container dashboard">
    <h2 class="text-center text-primary">Admin Dashboard</h2>
    <div class="row text-center btn-group-custom justify-content-center">
      <div class="col-md-4">
        <button class="btn btn-outline-primary w-100" onclick="window.location.href = '/api/register_stu' ">Student Registration</button>
      </div>
      <div class="col-md-4">
        <button class="btn btn-outline-success w-100" onclick="window.location.href = '/api/register_tea' ">Teacher Registration</button>
      </div>
      <div class="col-md-4">
        <button class="btn btn-outline-info w-100" onclick="window.location.href = '/api/stu_update' ">Update Student Details</button>
      </div>
      <div class="col-md-4">
        <button class="btn btn-outline-warning w-100" onclick="window.location.href = '/api/tea_update' ">Update Teacher Details</button>
      </div>
      <div class="col-md-4">
        <button class="btn btn-outline-dark w-100">Manage Courses</button>
      </div>
      <div class="col-md-4">
        <button class="btn btn-outline-secondary w-100">View Reports</button>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<script>
    function logout()
    {
        const token = sessionStorage.getItem('adm_Token');
        fetch(`http://127.0.0.1:8000/api/adm_logout`, {
            method:"POST",
            headers:{"Content-type":"application/json", Authorization: "Bearer " + token},
            
        }).then(res=>res.json()).then(data=>{
            if(data.Status == 200)
            {
                sessionStorage.clear();
                alert(data.Message);
                window.location.href = '/api/adm_login';
            }
        });
    }
</script>