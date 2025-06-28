<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Student Dashboard</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">

  <style>
    .feature-card {
      border-radius: 15px;
      transition: transform 0.2s;
    }
    .feature-card:hover {
      transform: scale(1.03);
    }
    .hero {
      background: linear-gradient(135deg, #0d6efd, #0a58ca);
      color: white;
      padding: 50px 20px;
      border-radius: 0 0 30px 30px;
      text-align: center;
    }

    /* ─── wider profile dropdown, responsive ───────────────────────── */
    .profile-menu {                /* desktop / laptop width            */
      min-width: 260px;
    }
    @media (max-width: 991.98px) { /* lg and below (tablets / phones)   */
      .profile-menu {
        width: 90vw;               /* nearly full-width on small screens*/
        max-width: 350px;          /* but never exceed this             */
      }
    }
  </style>
</head>
<body>

  <!-- Navbar with Logout + Profile Dropdown -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">Student Dashboard</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse justify-content-end" id="navbarContent">
        <ul class="navbar-nav">
          <!-- Logout button -->
          <li class="nav-item me-3">
            <a class="btn btn-outline-light" style="cursor: pointer;" onclick="return logout()">Logout</a>
          </li>

          <!-- Profile circle & dropdown -->
          <li class="nav-item dropdown">
            <a class="nav-link p-0" href="#" id="profileDropdown" role="button"
               data-bs-toggle="dropdown" aria-expanded="false">
              <span class="d-inline-block rounded-circle bg-white text-primary fw-bold text-uppercase"
                    style="width:40px;height:40px;line-height:40px;" id="name_letter"></span>
            </a>
            <ul class="dropdown-menu dropdown-menu-end profile-menu" aria-labelledby="profileDropdown">
              <center><li><h6 class="dropdown-header">Profile Info</h6></li></center>
              <li><span class="dropdown-item-text" id="namee"> </span></li>
              <li><span class="dropdown-item-text" id="reg_no"></span></li>
              <li><span class="dropdown-item-text" id="sec"></span></li>
              <li><span class="dropdown-item-text" id="branch"></span></li>
            </ul>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- Hero Section -->
  <div class="hero">
    <h1 style="font-weight: bolder;">Hello <span id="name"></span></h1>
    <h2>Welcome to Student Dashboard</h2>
    <p class="lead">Access your academic details anytime, anywhere.</p>
  </div>

  <!-- Feature Cards -->
  <div class="container mt-5">
    <div class="row g-4">

      <!-- Attendance Feature -->
      <div class="col-md-6">
        <div class="card feature-card shadow p-4">
          <h4 class="card-title">📅 Student Attendance</h4>
          <p class="card-text">Check your daily attendance and keep track of your presence across all subjects.</p>
          <a href="/api/view_att" class="btn btn-primary mt-2">View Attendance</a>
        </div>
      </div>

      <!-- Marks Feature -->
      <div class="col-md-6">
        <div class="card feature-card shadow p-4">
          <h4 class="card-title">📚 Exam-wise Marks</h4>
          <p class="card-text">View your marks semester-wise and subject-wise in a detailed format.</p>
          <a href="/api/exam_marks" class="btn btn-success mt-2">View Marks</a>
        </div>
      </div>

    </div>
  </div>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>


<script>
  const utoken = sessionStorage.getItem('token');
  if(!utoken)
  {
    alert('First Login');
    window.location.href = "/api/login_stu";
  }
</script>


<script>
  const uname = sessionStorage.getItem('uname');
  document.getElementById('name').innerHTML = uname;
  document.getElementById('name_letter').innerHTML = `<center>${uname[0]}</center>`;
  document.getElementById('namee').innerHTML = `<b>Name: ${uname}</b>`;

  const bran = sessionStorage.getItem("branch");
  document.getElementById('branch').innerHTML = `<b>Branch: ${bran}</b>`;

  const iddd = sessionStorage.getItem('Id');
  document.getElementById('reg_no').innerHTML = `<b>Reg_No.: ${iddd}</b>`;

  const sec = sessionStorage.getItem('section');
  document.getElementById('sec').innerHTML = `<b>Section: ${sec}</b>`
</script>


<script>
  function logout()
  {
    const token = sessionStorage.getItem('token');
    fetch(`http://127.0.0.1:8000/api/logout_stu`, {
      method:"POST",
      headers:{"Content-type":"application/json", Authorization:"Bearer " + token}
    }).then(res=>res.json()).then(data=>{
      if(data.Status == 200)
    {
      sessionStorage.clear();
      alert(data.Message);
      window.location.href = "/api/login_stu";
    }
    });
  }
</script>