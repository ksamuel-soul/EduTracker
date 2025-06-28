<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Student Attendance</title>

  <!-- Bootstrap 5.0 CSS -->
  <link
    href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"
    rel="stylesheet"
  >
</head>
<body class="bg-light">

  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">Attendance</a>

      <!-- Toggler for mobile view -->
      <button
        class="navbar-toggler"
        type="button"
        data-bs-toggle="collapse"
        data-bs-target="#navbarContent"
        aria-controls="navbarContent"
        aria-expanded="false"
        aria-label="Toggle navigation"
      >
        <span class="navbar-toggler-icon"></span>
      </button>

      <!-- Navbar items -->
      <div class="collapse navbar-collapse justify-content-end" id="navbarContent">
        <button class="btn btn-outline-light" type="button" onclick="window.location.href='/api/home_stu'">Student_Home_Page</button>
      </div>
    </div>
  </nav>
  <style>
    .container{
        /* border: 2px solid red; */
        width: 100%;
        padding-top: 25px;
        height:auto;
        display: flex;
        justify-content: space-evenly;
    }
    .table{
        /* border: 2px solid green; */
        width: 100%;
        height:auto;
        padding-top:10px;
    }
    #att_det{
      width:100%;
      /* border:2px solid black; */
      text-align:center;
    }
    th
    {
      border:2px solid red;
      font-size:25px;
    }

    td
    {
      border:2px solid green;
      font-size:20px;
    }
  </style>

<center><h1 style="padding-top:15px;"><u>Students</u> <u>Attendance</u> <u>Report</u></h1></center>
    <div class="container">
        <div class="table">
          <table id="att_det">
            <thead>
              <th>S.No</th>
              <th>Status</th>
              <th>Date&Time</th>
            </thead>
            <tbody>

            </tbody>
          </table>
        </div>
    </div>



  <!-- Bootstrap 5.0 JS + Popper -->
  <script
    src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
  ></script>
  <script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
  ></script>
</body>
</html>

<script>
  const token = sessionStorage.getItem('token');
  if(!token)
  {
    alert("Login First");
    window.location.href = "/api/login_stu";
  }


  const id = sessionStorage.getItem('Id');
  fetch(`http://127.0.0.1:8000/api/stu_det_sec/${id}`, {
    method:"GET",
    headers:{"Content-type":"application/json"}
  }).then(res=>res.json()).then(data=>{
      if(data.Status == 200)
      {
        const tdata = document.querySelector('#att_det tbody');
        tdata.innerHTML = "";
        let x = 1;
        data.User_Details.forEach(pro=>{
          let c = pro.created_at;
          const ist = new Date(c).toLocaleString("en-US", {timeZone: 'Asia/Kolkata'})
          const row = `
                        <tr>
                        <td>${x}</td>
                        <td>${pro.Status}</td>
                        <td>${ist}</td>
                        </tr>`;
            x+=1;
          tdata.innerHTML += row;
        });
      }
      else if(data.Status == 404)
      {
        alert(data.Message);
      }
  });
</script>