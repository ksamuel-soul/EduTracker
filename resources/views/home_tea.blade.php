<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Teacher Dashboard</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" />
  <style>
    .feature-card {
      border-radius: 15px;
      transition: transform 0.2s;
    }
    .feature-card:hover {
      transform: scale(1.03);
    }
    .hero {
      background: linear-gradient(135deg, #6610f2, #6f42c1);
      color: white;
      padding: 50px 20px;
      border-radius: 0 0 30px 30px;
      text-align: center;
    }
  </style>
</head>
<body>

  <!-- Navbar with Logout -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">Teacher Dashboard</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="btn btn-outline-light" onclick="return logout()" style="cursor:pointer">Logout</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- Hero Section -->
  <div class="hero">
    <h1>Welcome, <span id="tea_name"> </span></h1>
    <p class="lead">Manage attendance, student marks, and academic records efficiently.</p>
  </div>

  <!-- Feature Cards -->
  <div class="container mt-5">
    <div class="row g-4">

      <!-- Take Attendance -->
      <div class="col-md-4">
        <div class="card feature-card shadow p-4">
          <h4 class="card-title">📋 Take Attendance</h4>
          <p class="card-text">Mark daily attendance for your class quickly and accurately.</p>
          <a class="btn btn-primary" onclick="window.location.href = '/api/stu_att'">Take Attendance</a>
        </div>
      </div>

      <!-- Upload Marks -->
      <div class="col-md-4">
        <div class="card feature-card shadow p-4">
          <h4 class="card-title">📤 Upload Marks</h4>
          <p class="card-text">Upload internal and external exam marks subject-wise.</p>
          <a href="/api/stu_marks" class="btn btn-success">Upload Marks</a>
        </div>
      </div>

      <!-- View Student Marks -->
      <div class="col-md-4">
        <div class="card feature-card shadow p-4">
          <h4 class="card-title">📊 Student Marks Analysis</h4>
          <p class="card-text">Check and analyze student performance reports easily.</p>
          <a class="btn btn-info text-white" href="/api/analyse_stu_marks">View Marks</a>
        </div>
      </div>


      <div class="col-md-4">
        <div class="card feature-card shadow p-4">
          <h4 class="card-title">📊 Student Attendance Analysis</h4>
          <p class="card-text">Check and analyze student Attendance reports easily.</p>
          <a class="btn btn-info text-white" href="/api/analyse_stu_att">View Attendance</a>
        </div>
      </div>

    </div>
  </div>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<script>
    const token = sessionStorage.getItem('token_tea');
    const uname = sessionStorage.getItem('tea_name');
    document.getElementById('tea_name').innerHTML = uname;
    if(!token){
        alert('Login First..!!!');
        window.location.href = "/api/login_tea";
    }
</script>

<script>
    function logout()
    {
        const token = sessionStorage.getItem('token_tea');
        fetch(`http://127.0.0.1:8000/api/logout_tea`, {
            method:"POST",
            headers:{"Content-type":"application/json", Authorization:"Bearer " + token}
        }).then(res=>res.json()).then(data=>{
            if(data.Status == 200)
            {
                sessionStorage.clear();
                alert(data.Message);
                window.location.href = "/api/login_tea";
            }
        });
    }
</script>