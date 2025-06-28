<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>View Marks</title>

    <!-- Bootstrap 5.0 CSS -->
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"
        rel="stylesheet"
    />
</head>
<body class="bg-light">

    <!-- ======= Navbar ======= -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
        <div class="container-fluid">
            <a class="navbar-brand fw-bold" href="#">Exam - wise Marks</a>

            <!-- Toggler for mobile -->
            <button
                class="navbar-toggler"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#navbarContent"
                aria-controls="navbarContent"
                aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarContent">
                <!-- keep this empty so links align left if you add any later -->
                <ul class="navbar-nav me-auto mb-2 mb-lg-0"></ul>

                <!-- Right-aligned student-home button -->
                <div class="ms-auto">
                    <a href="/api/home_stu" class="btn btn-primary">
                        Student_Home
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- ======= Page Body ======= -->
    <div class="container py-4">

        <!-- Exam-selection dropdown button -->
        <div class="dropdown">
            <button
                class="btn btn-secondary dropdown-toggle"
                type="button"
                id="examsDropdown"
                data-bs-toggle="dropdown"
                aria-expanded="false"
            >
                Select Exam
            </button>
            <ul class="dropdown-menu" aria-labelledby="examsDropdown">
                <li><a class="dropdown-item" onclick="return t1_marks()" href="#">T1</a></li>
                <li><a class="dropdown-item" onclick="return t2_marks()" href="#">T2</a></li>
                <li><a class="dropdown-item" onclick="return t3_marks()" href="#">T3</a></li>
                <li><a class="dropdown-item" onclick="return m1_marks()" href="#">M1</a></li>
                <li><a class="dropdown-item" onclick="return m2_marks()" href="#">M2</a></li>
            </ul>
        </div>
    </div>
    <style>
        .cont
        {
            border: 2px solid red;
            width: 100%;
        }
        .tables
        {
            width: 100%;
            display: flex;
            justify-content: space-evenly;
        }
        th
        {
            text-align:center;
            border:2px solid black;
            font-size: 25px;
        }
        table
        {
            width:100%;
            border:2px solid black;
        }
        td
        {
            text-align:center;
            border:2px solid black;
            font-size: 20px;
            font-weight: 450;
            color: green;
        }
    </style>
    <div class="cont">
        <div class="tables">
            <table cellspacing='20' id="marks">
                <thead>
                    <th>Id</th>
                    <th>Name</th>
                    <th>Exam_Mode</th>
                    <th><span id="s1"> </span></th>
                    <th>Physics</th>
                    <th>Chemistry</th>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
    <script
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    ></script>
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
    const bran = sessionStorage.getItem('branch');
    if(bran == "Bio-Tech" || bran == "Bio-Info")
    {
        document.getElementById('s1').innerText = "Biology";
    }
    else
    {
        document.getElementById('s1').innerText = "Maths";
    }
    function t1_marks()
    {
        const id = sessionStorage.getItem('Id');
        fetch(`http://127.0.0.1:8000/api/t1_marks/${id}`, {
            method:"GET",
            headers:{"Content-type":"application/json"}
        }).then(res=>res.json()).then(data=>{
            if(data.Status == 200)
            {
                const tdata = document.querySelector("#marks tbody");
                const emode = data.Exam_Mode;
                tdata.innerHTML = "";
                data.Details.forEach(pro=>{
                    const ss1 = pro.Maths;
                    const ss2 = pro.Physics;
                    const ss3 = pro.Chemistry;
                    const row = `
                                <tr>
                                    <td>${pro.id}</td>
                                    <td>${pro.Stu_Name}</td>
                                    <td>${emode}</td>
                                    <td id='ss1'>${ss1}</td>
                                    <td id='ss2'>${ss2}</td>
                                    <td id='ss3'>${ss3}</td>
                                </tr>
                                `;
                        tdata.innerHTML += row;
                    if(ss1 < 5)
                    {
                        document.getElementById('ss1').style.color = 'red';
                    }
                    else
                    {
                        document.getElementById('ss1').style.color = 'green';
                    }
                    if(ss2 < 5)
                    {
                        document.getElementById('ss2').style.color = 'red';
                    }
                    else
                    {
                        document.getElementById('ss2').style.color = 'green';
                    }
                    if(ss3 < 5)
                    {
                        document.getElementById('ss3').style.color = 'red';
                    }
                    else
                    {
                        document.getElementById('ss3').style.color = 'green';
                    }
                });
            }
            else if(data.Status == 404)
            {
                alert(data.Message);
            }
        });
    }
</script>

<script>
    function t2_marks()
    {
        const id = sessionStorage.getItem('Id');
        fetch(`http://127.0.0.1:8000/api/t2_marks/${id}`, {
            method:"GET",
            headers:{"Content-type":"application/json"}
        }).then(res=>res.json()).then(data=>{
            if(data.Status == 200)
            {
                const tdata = document.querySelector("#marks tbody");
                const emode = data.Exam_Mode;
                tdata.innerHTML="";
                data.Details.forEach(pro=>{
                    const row = `
                                <tr>
                                    <td>${pro.id}</td>
                                    <td>${pro.Stu_Name}</td>
                                    <td>${emode}</td>
                                    <td>${pro.Maths}</td>
                                    <td>${pro.Physics}</td>
                                    <td>${pro.Chemistry}</td>
                                </tr>
                                `;
                        tdata.innerHTML += row;
                });
            }
            else if(data.Status == 404)
            {
                alert(data.Message);
            }
        });
    }
</script>

<script>
    function t3_marks()
    {
        const id = sessionStorage.getItem('Id');
        fetch(`http://127.0.0.1:8000/api/t3_marks/${id}`, {
            method:"GET",
            headers:{"Content-type":"application/json"}
        }).then(res=>res.json()).then(data=>{
            if(data.Status == 200)
            {
                const tdata = document.querySelector("#marks tbody");
                const emode = data.Exam_Mode;
                tdata.innerHTML="";
                data.Details.forEach(pro=>{
                    const row = `
                                <tr>
                                    <td>${pro.id}</td>
                                    <td>${pro.Stu_Name}</td>
                                    <td>${emode}</td>
                                    <td>${pro.Maths}</td>
                                    <td>${pro.Physics}</td>
                                    <td>${pro.Chemistry}</td>
                                </tr>
                                `;
                        tdata.innerHTML += row;
                });
            }
            else if(data.Status == 404)
            {
                alert(data.Message);
            }
        });
    }
</script>

<script>
    function m1_marks()
    {
        const id = sessionStorage.getItem('Id');
        fetch(`http://127.0.0.1:8000/api/m1_marks/${id}`, {
            method:"GET",
            headers:{"Content-type":"application/json"}
        }).then(res=>res.json()).then(data=>{
            if(data.Status == 200)
            {
                const tdata = document.querySelector("#marks tbody");
                const emode = data.Exam_Mode;
                tdata.innerHTML="";
                data.Details.forEach(pro=>{
                    const row = `
                                <tr>
                                    <td>${pro.id}</td>
                                    <td>${pro.Stu_Name}</td>
                                    <td>${emode}</td>
                                    <td>${pro.Maths}</td>
                                    <td>${pro.Physics}</td>
                                    <td>${pro.Chemistry}</td>
                                </tr>
                                `;
                        tdata.innerHTML += row;
                });
            }
            else if(data.Status == 404)
            {
                alert(data.Message);
            }
        });
    }
</script>


<script>
    function m2_marks()
    {
        const id = sessionStorage.getItem('Id');
        fetch(`http://127.0.0.1:8000/api/m2_marks/${id}`, {
            method:"GET",
            headers:{"Content-type":"application/json"}
        }).then(res=>res.json()).then(data=>{
            if(data.Status == 200)
            {
                const tdata = document.querySelector("#marks tbody");
                const emode = data.Exam_Mode;
                tdata.innerHTML="";
                data.Details.forEach(pro=>{
                    const row = `
                                <tr>
                                    <td>${pro.id}</td>
                                    <td>${pro.Stu_Name}</td>
                                    <td>${emode}</td>
                                    <td>${pro.Maths}</td>
                                    <td>${pro.Physics}</td>
                                    <td>${pro.Chemistry}</td>
                                </tr>
                                `;
                        tdata.innerHTML += row;
                });
            }
            else if(data.Status == 404)
            {
                alert(data.Message);
            }
        });
    }
</script>